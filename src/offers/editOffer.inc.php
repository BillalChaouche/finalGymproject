<?php

$msg ='';

// get the id using Get_request
$offersColor = array('red'=>  'linear-gradient(90deg, rgba(255, 87, 87, 0.505) 0%, rgba(255, 171, 171, 0.671) 100%)',
                     'gold' => 'linear-gradient(90deg, rgba(255, 177, 82, 0.505) 0%, rgba(255, 251, 121, 0.671) 100%)',
                     'green' => 'linear-gradient(90deg, rgba(67, 255, 189, 0.505) 0%, rgba(156, 255, 230, 0.671) 100%)',
                     'blue' => 'linear-gradient(90deg, rgba(87, 205, 255, 0.505) 0%, rgba(171, 235, 255, 0.671) 100%)',
                     'purple' => 'linear-gradient(90deg, rgba(154, 87, 255, 0.505) 0%, rgba(216, 171, 255, 0.671) 100%)' );

if (isset($_GET['id'])) {
    $id_off = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['id']); 
    $id_owner = $_SESSION['SESSION_ID'];
    $sql = "SELECT * FROM offers WHERE id_owner = ? AND id_off = ?";
    $db->query($sql,$_SESSION['SESSION_ID'],$id_off);
    $num_rows = $db->numRows();
    // verify the valididty of the offer id
    if($num_rows === 1){
        $name_off = $_GET['name'];
        $duration_off= $_GET['duration'];
        $places = $_GET['places'];
        $price = $_GET['price'];
        $session = $_GET['session'];
        $color = $_GET['color'];
       // get the members belongs to this offer
       // get the name of the offer from the database to avoid sql injection
       $result = $db->fetchArray();
       $name = $result['name_off'];
       $sql = "SELECT * FROM members WHERE off_type = ? AND id_owner = ?";
       $db->query($sql,$name,$_SESSION['SESSION_ID']);
       $num_rows = $db->numRows();
       if($num_rows){
        $members = $db->fetchAll();
        foreach ($members as $row) {
            $code = $row['identity_mem'];
            $memName = $row['name_mem'];
            $memEmail = $row['email_mem'];
            // get info about the member to offer
            $sql = "SELECT end_date, session_done FROM member_to_offers WHERE id_off=? AND identity_mem = ?";
            $db->query($sql,$id_off,$code);
            $membersInfo = $db->fetchArray();
            $endDate = $membersInfo['end_date'];
            $sessionDone = $membersInfo['session_done'];

            $displayMembers .= '<tr>
                                 <td> '.$code. '</td>
                                 <td> '.$memName. '</td>
                                 <td> '.$memEmail. ' </td>
                                 <td> '.$endDate. '</td>
                                 <td> '.$sessionDone. '</td>
                              </tr>';

       }



}
if(isset($_POST['delete'])){
    // we get this value from database to ensure the correctness of the value(number of subscription)
    $sql = "SELECT * FROM members WHERE off_type = ? AND id_owner = ? "; 
    $db->query($sql,$name_off, $_SESSION['SESSION_ID']);
    $num_sub = $db->numRows();
    if($num_sub>0){
       $msg = "<div class='danger'>Impossibe to delete this offer due to number of subsecription</div>";
    }
    else{
        $sql = "DELETE FROM offers WHERE id_owner = ? and id_off = ?";
        $result = $db->query($sql,$_SESSION['SESSION_ID'],$id_off);
        if($result){
            header("Location:".BASE_URL. "/members");
        }
        else{
       $msg = "<div class='danger'>something went wrong</div>";

        }
        
    }
}
    }
}