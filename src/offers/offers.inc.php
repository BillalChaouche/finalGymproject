<?php

// array of offers color
$offersColor = array('red'=>  'linear-gradient(90deg, rgba(255, 87, 87, 0.505) 0%, rgba(255, 171, 171, 0.671) 100%)',
                     'gold' => 'linear-gradient(90deg, rgba(255, 177, 82, 0.505) 0%, rgba(255, 251, 121, 0.671) 100%)',
                     'green' => 'linear-gradient(90deg, rgba(67, 255, 189, 0.505) 0%, rgba(156, 255, 230, 0.671) 100%)',
                     'blue' => 'linear-gradient(90deg, rgba(87, 205, 255, 0.505) 0%, rgba(171, 235, 255, 0.671) 100%)',
                     'purple' => 'linear-gradient(90deg, rgba(154, 87, 255, 0.505) 0%, rgba(216, 171, 255, 0.671) 100%)' );

                     
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the request from the form-add-offer form
    if (isset($_POST['name']) && isset($_POST['duration']) && isset($_POST['places']) && isset($_POST['sessions']) && isset($_POST['color']) && isset($_POST['price'])) {
        // get the values and filter them 
        $name = $_POST['name'];
        $duration = $_POST['duration'];
        $places = $_POST['places'];
         $sessions = $_POST['sessions'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        if($name && $price && $color){
            // check that the offername does not exist
            $sql = "SELECT * FROM offers WHERE name_off = ? AND id_owner = ?";
            
            $db->query($sql, $name,$_SESSION['SESSION_ID']);

           $num_rows = $db->numRows();
           if($num_rows > 0){
            // print the error to notify the user and show it using javascript
            echo "error: Offer name already exists";
            exit(); 
           }
                    
            // Define the SQL query to insert a raw into the offers table
            $sql = "INSERT INTO offers (name_off, duration_off, num_places, num_session_off, color_off, price_off, id_owner) VALUES(?,?,?,?,?,?,?)";
                         
            $result = $db->query($sql,array($name, $duration, $places, $sessions, $color, $price, $_SESSION['SESSION_ID']));
                    
            if($result){
                echo 'done';
            }
                             
            else{
                 // do nothing and javascript code will handle it     
            }

                    
        }
    }
}

// display the offers                   
$sql = "SELECT * FROM offers WHERE id_owner = ? ORDER BY id_off DESC";

$db->query($sql, array($_SESSION['SESSION_ID']));

$num_rows = $db->numRows();
                    
if ($num_rows > 0) {
    // fetch the data from the result set as an associative array
    $offers = $db->fetchAll();

    foreach ($offers as $row) {
        $id_offer = intval($row['id_off']);
        $name_off = htmlspecialchars($row['name_off']);
        $duration_off= intval($row['duration_off']);
        $places = intval($row['num_places']);
        // get the number of subscription
        $sql = "SELECT * FROM members WHERE off_type = ? AND id_owner = ? "; 
        $db->query($sql,$name_off, $_SESSION['SESSION_ID']);
        $num_sub = $db->numRows();
        
        $num_session_off = intval($row['num_session_off']);
        $color_off = htmlspecialchars($row['color_off']);
        $price_off = intval($row['price_off']);
        // create html element      
        $display_offers .= '<div class="offer" style="background:' . $offersColor[$color_off] . '">
                                <header>
                                    <h1>'.$name_off.'</h1>
                                    <button class="more-offer" onclick="window.location.href=\''.BASE_URL.'/editOffer?id='.$id_offer.'&name='.urlencode($name_off).'&duration='.$duration_off.'&places='.$num_sub.'/'.$places.'&price='.$price_off.'&session='.$num_session_off.'&color='.urlencode($color_off).'\'"><i class="bi bi-arrow-right"></i></button>
                                </header>
                                <div class="info-offer">
                                    <p>duration: '.$duration_off.' days</p>
                                    <p>places:'.$num_sub.'/'.$places.'</p>
                                    <p>price: '.$price_off.' DZD</p>
                                </div>
                                <div class="session-number">
                                    <h2>session:</h2>
                                    <div class="number">
                                        <h1>'.$num_session_off.'</h1>
                                    </div>
                                </div>
                            </div>';
        // display offer option in Add member form
        $member_option .= '<option data-id="'.$id_offer.'">'.$name_off.'</option>';
                                         
        }
                    
 }

    ?>