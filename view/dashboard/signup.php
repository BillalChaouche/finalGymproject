

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet"  href="<?php echo BASE_URL?>/static/css/signup.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>Signup</title>
</head>
<body>
    <?php echo $msg; ?>
    <form method="POST">
        <h1>Signup</h1>
        <div class="inputs">
            <div class="input-email">
                <p>Email: </p>
                <input type="email" placeholder="enter your email" required name="email"
                value="<?php if (isset($_POST['signup'])) { echo $email; } ?>">
            </div>
            <div class="input-password">
                <p>Password: </p>
                <input type="password" placeholder="enter your password" required name="password">
            </div>
            <div class="input-password">
                <p>Confirm Password: </p>
                <input type="password" placeholder="confirm your password" required name="confirm-password">
            </div>
            <input  type="submit" class="input-submit" value="Sign up" name="signup">
            
        </div>
        <p class="signup">Have an account?<a href="<?php echo BASE_URL?>/login">Login</a></p>
        
    </form>
    <div class="photo-dashboard">
        <h2>Power your gym by using a modern dashboard and<br> improve your productivity </h2>
        <img src="<?php echo BASE_URL?>/static/images/dashboard.png" alt="">
    </div>
</body>
</html>
