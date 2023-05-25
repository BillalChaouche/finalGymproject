<?php 

if (!isset($_SESSION['SESSION_EMAIL']) || $_SESSION["page_visited"] == true) {
    header('Location: empty.php');
    exit;
}
else{
    // get the email to be dipslayed
    $email =$_SESSION['SESSION_EMAIL'];
    // visit only one time
    $_SESSION["page_visited"] = true;
}

?>