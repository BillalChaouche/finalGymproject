<?php
ini_set('memory_limit', '256M');
$email = $_SESSION['SESSION_EMAIL'];
$sql = "SELECT code,name_gym,id_owner FROM gym_owner WHERE email_gym = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);
    if ($num_rows === 1) {
        mysqli_stmt_bind_result($stmt, $code, $name, $id_owner);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
       if(!empty($code)){

if (isset($_GET['verification'])) {
    $verification_code = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['verification']); // Remove all non-alphanumeric characters from the verification code$verification_code = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['verification']);
    $sql = "SELECT * FROM gym_owner WHERE code = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $verification_code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);

    if ($num_rows === 1) {
        $stmt = mysqli_prepare($conn, "UPDATE gym_owner SET code='' WHERE code=?");
        mysqli_stmt_bind_param($stmt, "s", $verification_code);
        $query = mysqli_stmt_execute($stmt);

        if ($query) {
            $msg = "<div class='success'>Account verification has been successfully completed.</div>";
        }
    } else {
        header("Location: ".BASE_URL."/signup");
        exit;
    }
} else{
    header("Location: ".BASE_URL."");
    exit;
}
}
else{
    if(!empty($name)){
        header("Location: ".BASE_URL."");
        exit;
    }
}
    
}

if(isset($_POST['done'])){
// Get gym name and filter it

$gym_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

// Get gym phone number and filter it
$gym_pnum = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT);


// Get gym address and filter it
$gym_address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);

// Get gym country and filter it
$gym_country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_SPECIAL_CHARS);

// Get gym description and filter it
$gym_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

// Get gym logo
if(isset($_FILES['gym_photo'])) {
    $file = $_FILES['gym_photo'];
    $content = file_get_contents($file['tmp_name']);
}
if ($content === false) {
    $msg = "<div class='danger'>Invalid file format. Please upload a valid image.</div>";
    exit();
}
// Insert the inputs into gym owner row in the database
$sql = "UPDATE gym_owner SET name_gym=?, phone_owner=?, gym_country=?, address_gym=?, gym_desc=?, logo_gym= ? WHERE email_gym= ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssss", $gym_name, $gym_pnum, $gym_country, $gym_address, $gym_desc, $content, $email);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if($result){
// the user is logged in
$_SESSION['SESSION_log'] = true;
header("Location: ".BASE_URL."");
exit;
}
else{
$msg = "<div class='danger'>Something went wrong.</div>";
}

}

?>