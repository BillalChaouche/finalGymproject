<?php
ini_set('memory_limit', '256M');

if (isset($_GET['id'])) {
    $id = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['id']); // Remove all non-alphanumeric characters from the verification code$verification_code = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['verification']);
if ($_SESSION['SESSION_ID'] == $id) {
    $sql = "SELECT  logo_gym,name_gym,phone_owner,address_gym,gym_country,gym_desc FROM gym_owner WHERE id_owner = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);

   if ($num_rows === 1) {
        // Fetch the column values
        mysqli_stmt_bind_result($stmt,$logo_gym,$name_gym, $phone,$address,$country,$desc);
        mysqli_stmt_fetch($stmt);
        $gym_name = $name_gym;
        $logo = $logo_gym;
        $gym_country = $country;
        $gym_address = $address;
        $gym_pnum = $phone;
        $gym_desc = $desc;
        // get the logo url
        $logoData = base64_encode($logo);
        $logoSrc = 'data:image/jpeg;base64,' . $logoData;
        $logo_URL = $logoSrc;

        // hande data update
        if(isset($_POST['update'])){
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
        if($file['tmp_name']){
        $content = file_get_contents($file['tmp_name']);
        }else{
            $content = $logo;
        }
        
        if ($content === false) {
            $msg = "<div class='danger'>Invalid file format. Please upload a valid image.</div>";
        }}
        
        // Insert the inputs into gym owner row in the database
        $sql = "UPDATE gym_owner SET name_gym=?, phone_owner=?, gym_country=?, address_gym=?, gym_desc=?, logo_gym= ? WHERE id_owner= ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $gym_name, $gym_pnum, $gym_country, $gym_address, $gym_desc, $content, $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if($result){
        // the user is logged in

        header("Location: ".BASE_URL."/home");
        exit();
        }
      else{
    $msg = "<div class='danger'>Something went wrong.</div>";
    }

   }
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM gym_owner WHERE id_owner = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($result) {
         // Deletion successful
         header("Location: ".BASE_URL."/logout");
        } else {
         // Deletion failed
        $msg = "<div class='danger'>Something went wrong.</div>";
         
     }
        
    }
        }


    }
    else{
        // the id is not the same as the logged ID
        header("Location:".BASE_URL);

    }


}
else{
    // no access witout ID
    header("Location:".BASE_URL);

}