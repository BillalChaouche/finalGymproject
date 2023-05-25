<?php 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader


$msg = '';



if (isset($_POST['signup'])) { 
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $code = bin2hex(random_bytes(16));
    
    if (!$email) {
        $msg = "<div class='danger'>Invalid email address.</div>";
    } else { 
         $sql = "SELECT id_owner FROM gym_owner WHERE email_gym = ?";
         $stmt = mysqli_prepare($conn, $sql);
         mysqli_stmt_bind_param($stmt, "s", $email);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_store_result($stmt);
         $num_rows = mysqli_stmt_num_rows($stmt);
         mysqli_stmt_close($stmt); 
         if ($num_rows > 0) {
          $msg = "<div class='danger'>{$email} - This email address has already been registered.</div>";}
         else {
         
           if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO gym_owner (email_gym, password_gym, code) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $email, $hashed_password, $code);
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
                    $mail->Body = 'Here is the verification link <b><a href="'.BASE_URL.'/profileSetup/?verification=' . $code . '">Verify my account</a></b>';

                    $mail->send();
                } catch (Exception $e) {
                    echo 'something went wrong';
                }
                echo "</div>";
                $_SESSION['SESSION_EMAIL'] = $email;
                // for the link page
                $_SESSION["page_visited"] = false;
                header("Location:" .BASE_URL."/link");
                exit;
            } else {
                $msg = "<div class='danger'>Something went wrong.</div>";
            }
        } else {
            $msg = "<div class='danger'>Password and Confirm Password do not match</div>";
        }
    }
    
}
}

?>
