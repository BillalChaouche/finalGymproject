<?php

$msg = "";

if (isset($_POST['login'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if (!$email) {
        $msg = "<div class='danger'>Invalid email address.</div>";
    } else {
        $sql = "SELECT id_owner, password_gym, code, name_gym FROM gym_owner WHERE email_gym = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_rows = mysqli_stmt_num_rows($stmt);

        if ($num_rows === 1) {
            mysqli_stmt_bind_result($stmt, $id_owner, $hashed_password, $code, $gym_name);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if (password_verify($password, $hashed_password)) {
                if (empty($code) && $gym_name) {
                    $_SESSION['SESSION_EMAIL'] = $email;
                    $_SESSION['SESSION_ID'] = $id_owner;
                    $_SESSION['SESSION_log'] = true;
                    header("Location: ".BASE_URL."");
                    exit();
                } else if (empty($code) && !$gym_name) {
                    $_SESSION['SESSION_EMAIL'] = $email;
                    $_SESSION['SESSION_ID'] = $id_owner;
                    header("Location: ".BASE_URL."/profileSetup");
                    exit();
                } else {
                    $msg = "<div class='danger'>First verify your account and try again.</div>";
                }
            }
             else {
                $msg = "<div class='danger'>Email or password do not match.</div>";
            }
        }
         else {
            $msg = "<div class='danger'>Email or password do not match.</div>";
        }
    }
}
?>