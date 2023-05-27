<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

require dirname(__DIR__).'/vendor/autoload.php';


function sendEmail($content,$email){


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
                        $mail->Body = $content;
                        $mail->send();
                    } catch (Exception $e) {
                        //hande by javascript
                    }
    
                }
    
                function checkEmailExistence($email) {
                    // Extract the domain from the email
                    $domain = substr(strrchr($email, "@"), 1);
                
                    // Check if the domain has MX records
                    return checkdnsrr($domain, "MX");
                }
                
                
?>