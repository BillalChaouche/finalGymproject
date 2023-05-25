<?php

// use this veraible to notify the user about the done task of any problem
$msg ='';
// get the code using Get_request
if (!isset($_GET['reset'])) {
    // Redirect the user to the login page 
    header("Location: " . BASE_URL . "");
    exit();
}
else{
    // this sql query verify that this coach ID belong to the Logged in gymOwner 
    $code = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['reset']); // Remove all non-alphanumeric characters from the coach ID = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['id']);
    $sql = "SELECT * FROM gym_owner WHERE reset_code = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_rows = mysqli_stmt_num_rows($stmt);
        if ($num_rows === 1) { // if the sent code  exist on the database
            if(isset($_POST['reset'])){
                // get the input vlaues
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm-password'];

                if ($password === $confirm_password) { // check if password and confirm password match
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE gym_owner SET password_gym = ? WHERE reset_code = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $code);
                    $result = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    if ($result) {
                    $msg = "The password is updated successfully";
                    // Store message in session
                     $_SESSION['reset_password_success'] = $msg;
                    // to enter to home page directly we need to create a sssesion email
                    $sql = "SELECT email_gym FROM gym_owner WHERE reset_code = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $code);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $email);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);
                    $_SESSION['SESSION_EMAIL'] = $email;

                    // make the reset_code empty so after updating the password successfully
                    $sql = "UPDATE gym_owner SET reset_code = '' WHERE reset_code = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $code);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    // go to home page 

                    $_SESSION['SESSION_log'] = true; // the user is logged in
                     header("Location:".BASE_URL."");
                }
                else{
                    // if there is an error in updating
                $msg = "<div class='danger'>Something went wrong.</div>";
                

                }
            }
            else{
                    // if the password and confirm password does not match
            $msg = "<div class='danger'>Password and Confirm Password do not match</div>";

            }
            }

        }
    }