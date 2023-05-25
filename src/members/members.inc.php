<?php


// call the precedure to decide the status of member
$db->query("CALL update_off_type(".$_SESSION['SESSION_ID'].")");



//function generate the member code
function generateRandomNumber() {
    return rand(0, 99999999);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
      // Handle the request from the form-add-member form
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['offer'])) {
    
        // Get the input values from (passed by ajax)
        $name = $_POST['name'];
        $email = $_POST['email'];
        $offer = $_POST['offer'];
        $offerId = $_POST['offerId'];
        $session = $_POST['session'];
        $price = $_POST['price'];
        if($name && $email && $offer){

             // check that the member email does not exist
             $sql = "SELECT * FROM members WHERE email_mem = ? AND id_owner = ?";
             
             $db->query($sql, $email,$_SESSION['SESSION_ID']);

            $num_rows = $db->numRows();
            if($num_rows > 0){
            // print the error to notify the user and show it using javascript
             echo "error: Member email already exist";
             exit(); // terminate the script
             }

            
            do {
                // Generate a random number
                $code = generateRandomNumber();
               
                $sql = "SELECT * FROM members WHERE identity_mem = ?";
                
                $db->query($sql, $code);
               
                $num_rows = $db->numRows();
            }while ($num_rows > 0);
            if($offer === 'free'){
                // add to members table
                $sql = "INSERT INTO members (identity_mem ,off_type, name_mem, email_mem, id_owner) VALUES(?,?,?,?,?)" ;     
                
               $result = $db->query($sql,array($code, 'free', $name, $email,$_SESSION['SESSION_ID']));
               // add to member_to_free table
               $sql = "INSERT INTO member_to_free(identity_mem,sessions,session_done,price) VALUES(?,?,?,?)";
               $result = $db->query($sql,array($code, $session, 0, $price));
               if($result){
                $content = 'This is your enetering code to the Gym: '.$code;
                // notify the javascript to show a notification to user
                echo 'done';
                sendEmail($content,$email);

               }
               
            
            }
            else{
                
                // add to members table(prepare the sql query)
                $sql = "INSERT INTO members (identity_mem ,off_type, name_mem, email_mem, id_owner) VALUES(?,?,?,?,?)";
                $result = $db->query($sql,array($code, $offer, $name, $email,$_SESSION['SESSION_ID']));
                // Get current date and time
                date_default_timezone_set('Africa/Algiers'); // set timezone to Algeria Time (need to updated to dynamic)
                $current_date = date('Y-m-d'); // format: YYYY-MM-DD
                $sql = "INSERT INTO member_to_offers(id_off, identity_mem,start_date,session_done) VALUES(?,?,?,?)";
               $result = $db->query($sql,array($offerId, $code, $current_date, 0));
               if($result){
                $content = 'This is your enetering code to the Gym: '.$code;
                echo 'done';
                sendEmail($content,$email);


               }


            }
        }
    }
    //inceremtent the number of session
    if(isset($_POST['id'])){
        // recieve the id from using ajax
        $code = $_POST['id'];
        $sql = "SELECT * FROM members WHERE identity_mem = ? AND id_owner = ?";
        $db->query($sql, $code,$_SESSION['SESSION_ID']);
        $num_rows = $db->numRows();

        if($num_rows === 1){
            $result = $db->fetchArray();
            $offer = $result['off_type'];
            // reach the limit of session for the free sub
            $db->query("CALL update_off_type(".$_SESSION['SESSION_ID'].")");
            if($offer === 'free'){
                $sql = "SELECT sessions, session_done FROM member_to_free WHERE identity_mem = ? ORDER BY id_free DESC LIMIT 1";
                 $db->query($sql,$code);
                 // fetch the data from the result set as an associative array
                 $sub = $db->fetchArray();
                 $session_mem = intval($sub['session_done']);
                 $sessions = intval($sub['sessions']); 
                 $new_session_mem = $session_mem + 1;
                 if($new_session_mem > $sessions){
                    echo "error: excced the limited number of sessions";
                    exit(); // terminate the script
                 }
                 else{
                    // update the session_done value in the member_to_free table
                    $sql = "UPDATE member_to_free SET session_done = ? WHERE identity_mem = ? ORDER BY id_free DESC LIMIT 1";
                    $db->query($sql, $new_session_mem, $code);
                    echo 'done';
                 }

            }

            else{
                // fetch the done session
                $sql = "SELECT session_done FROM member_to_offers WHERE identity_mem = ? ORDER BY id_off DESC LIMIT 1";
                $db->query($sql,$code);
                 // fetch the data from the result set as an associative array
                 $sub = $db->fetchArray();
                 $session_mem = intval($sub['session_done']);
                 $new_session_mem = $session_mem + 1;
                // fetch the number of session in this offer
                $sql = "SELECT num_session_off FROM offers WHERE name_off= ? AND id_owner = ?";
                $db->query($sql,$offer,$_SESSION['SESSION_ID']);
                 // fetch the data from the result set as an associative array
                 $sub = $db->fetchArray();
                 $sessions = intval($sub['num_session_off']);

                 if($new_session_mem > $sessions){
                    echo "error: excced the limited number of sessions";
                    exit(); // terminate the script
                 }
                 else{
                    // update the session_done value in the member_to_free table
                    $sql = "UPDATE member_to_offers SET session_done = ? WHERE identity_mem = ? ORDER BY id_off DESC LIMIT 1";
                    $db->query($sql, $new_session_mem, $code);
                    echo 'done';
                 }


            }
            
        }



    }
    
function notifyDeletedUsers($email,$id_owner,$content){
    global $db;
    $sql = "SELECT name_gym FROM gym_owner WHERE id_owner = ?";
    $db->query($sql,$id_owner);
    $result = $db->fetchArray();
    $name = $result['name_gym'];
    $content = $content . $name;
    sendEmail($content,$email);
}
// handle the delete of member
if(isset($_POST['code'])){
    $code = intval($_POST['code']);
    $sql = "SELECT email_mem FROM members WHERE identity_mem = ?";
    $db->query($sql,$code);
    $result = $db->fetchArray();
    // get the email of delete member
    $email = $result['email_mem'];
    // generate email content
    $content = 'Your account has been deleted from ';
    notifyDeletedUsers($email,$_SESSION['SESSION_ID'],$content);
    $sql = "DELETE FROM members WHERE identity_mem =?";
    $result = $db->query($sql,$code);
    if($result){
        echo 'done'; //notify the the ajax response
    }
    else{
        // empty to be handle by javascript file
    }

}
}
// hande the delete of members due to finish offer
// used scheduled trigger to add those user into delete_member table 

$sql = "SELECT email FROM delete_member WHERE id_owner= ?";
$db->query($sql,$_SESSION['SESSION_ID']);
$num_rows = $db->numRows();
if ($num_rows > 0) {
    //content of the sending message
    $content = "your account have been deleted due to subscription, expiration from ";
    $delete_member = $db->fetchAll();
    // Loop through the result and output the data
    foreach ($delete_member as $row) {
        $email = $row["email"];
        notifyDeletedUsers($email,$_SESSION['SESSION_ID'],$content);
    }
// then delete the members form delete_member table
$sql = "DELETE FROM delete_member WHERE id_owner=?";
$db->query($sql,$_SESSION['SESSION_ID']);
$result = $db->query($sql,$code);
    if($result){
        echo 'done'; //notify the the ajax response
    }
    else{
        // empty to be handle by javascript file
    }


}

// display members
$sql = "SELECT * FROM members WHERE id_owner = ?";
 // execute the sql using the query method of the db class
$db->query($sql, array($_SESSION['SESSION_ID']));
 // store the result and get the number of rows
$num_rows = $db->numRows();
if ($num_rows > 0) {
    // fetch the data from the result set as an associative array
    $members = $db->fetchAll();
    // Loop through the result and output the data
    foreach ($members as $row) {
        $code = intval($row['identity_mem']);
        $name_mem = htmlspecialchars($row['name_mem']);
        $email_mem= htmlspecialchars($row['email_mem']);
        $offer_mem = htmlspecialchars($row['off_type']);
        // fetch the data about the subscribtion plan(offer or free)
        if($offer_mem === 'free'){
            $sql = "SELECT * FROM member_to_free WHERE identity_mem = ? ORDER BY id_free DESC LIMIT 1";
            $db->query($sql,$code);
            // fetch the data from the result set as an associative array
            $sub = $db->fetchArray();
            $session_mem = $sub['session_done'];
            $sessions = $sub['sessions']; 
            $session_mem =$session_mem ."/".$sessions;
            $end_date = "/";
            $color = "black";



        }
        elseif($offer_mem === 'none'){
            $session_mem = '/';
            $end_date = "/";
            $color = "black";
            

        }
        else{
            $sql = "SELECT * FROM member_to_offers WHERE identity_mem = ? ORDER BY id_off DESC LIMIT 1";
            $db->query($sql, $code);
            // fetch the data from the result set as an associative array
            $off = $db->fetchArray();
            $session_mem = $off['session_done'];
            $end_date = $off['end_date'];
            // this to get the offer color
            $sql = "SELECT color_off FROM offers WHERE name_off = ? AND id_owner = ?";
            $db->query($sql, $offer_mem,$_SESSION['SESSION_ID']);
            $result = $db->fetchArray();
            $color = $result['color_off'];



        }
        $display_members .= '<tr style="background-color: ' . ($offer_mem === 'none' ? '#c1c1c19d' : 'transparent') . ' ">
                                 <td> '.$code.'</td>
                                 <td> '.$name_mem.'</td>
                                 <td> '.$email_mem.'</td>
                                 <td> '. $end_date.'</td>
                                 <td style="color:' . $color . '">'.$offer_mem.'</td>';
                                if ($offer_mem !== 'none') {
                                 $display_members .= '<td id="m_increment"><p id="'.$code.'">'.$session_mem.'</p><button><i class="bi bi-plus increment" onclick = "increment('.$code.')"></i></button></td>';
                                }
                                else{
                                $display_members .='<td >'.$session_mem.'</td>';
                                }
        $display_members .= '<td id="buttons">
                             <button class="more" onclick="deleteMember('.$code.')"><i class="bi bi-x-circle"></i></button>


                                </td>';
    }
}





                    
                    
                    