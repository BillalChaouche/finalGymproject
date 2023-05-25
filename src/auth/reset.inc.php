<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader


$msg = '';

if (isset($_POST['reset'])) {
    // get the email inserted
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (!$email) { // if email is not valid 
        $msg = "<div class='danger'>Invalid email address.</div>";
    } else { 
        $sql = "SELECT * FROM gym_owner WHERE email_gym = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_rows = mysqli_stmt_num_rows($stmt);
        if ($num_rows === 1) { // if email exist on the database
            $code = bin2hex(random_bytes(16));
            $sql = "UPDATE gym_owner SET reset_code = ? WHERE email_gym = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $code, $email);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($result) {
                echo "<div style='display: none;'>";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                    //Enable verbose debug output
                    $mail->isSMTP();
                    $mail->SMTPSecure = 'ssl';                                            //Send using SMTP
                    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = EMAIL_USERNAME;                     //SMTP username
                    $mail->Password   = EMAIL_PASSWORD;                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    //Recipients
                    $mail->setFrom(EMAIL_USERNAME);
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'no reply';
                    $mail->Body = 'Here is the reset link<b><a href="'.BASE_URL.'/reset-password/?reset='. $code .'">Link to reset the password</a></b>';
                    $mail->send();
                } catch (Exception $e) {
                    $msg = "<div class='danger'>Something went wrong.</div>";
                }
                echo "</div>";
                $msg = "<div class='info'>We have send the reset link <br>to your email address</div>";
                $email = '';

            } else {
                $msg = "<div class='danger'>Something went wrong.</div>";
            }
            
        }
        else{
            $msg = "<div class='danger'>Email does not exist </div>";
        }
    }
}