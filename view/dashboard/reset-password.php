

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet"  href="<?php echo BASE_URL?>/static/css/reset-password.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>Reset-password</title>
</head>
<body>
    <?php echo $msg; ?>
    <form method="POST">
        <h1>Reset password</h1>
        <div class="inputs">
            
            <div class="input-password">
                <p>Password: </p>
                <input type="password" placeholder="enter the new password" required name="password">
            </div>
            <div class="input-password">
                <p>Confirm Password: </p>
                <input type="password" placeholder="confirm your password" required name="confirm-password">
            </div>
            <input  type="submit" class="input-submit" value="Reset" name="reset">
            
        </div>
        
    </form>
    
</body>
</html>
