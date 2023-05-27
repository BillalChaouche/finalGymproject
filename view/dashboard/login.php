
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/login.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>Login</title>
</head>
<body>
    <?php echo $msg; ?>
    <form method="POST">
        <h1>Log in</h1>
        <div class="inputs">
            <div class="input-email">
                <p>Email: </p>
                <input type="email" placeholder="enter your email" required name="email"
                value="<?php if (isset($_POST['login'])) { echo $email; } ?>">
            </div>
            <div class="input-password">
                <p>Password: </p>
                <input type="password" placeholder="enter your password" required name="password">
            </div>
            <a id="forget" href="<?php echo BASE_URL?>/Reset">Forget password?</a>
            <input  type="submit" class="input-submit" value="Login" name="login">
            
        </div>
        <p class="signup">New?<a href="<?php echo BASE_URL?>/signup">Get started</a></p>
        
    </form>
    <div class="photo-dashboard">
        <h2>Power your gym by using a modern dashboard and<br> improve your prductivity </h2>
        <img src="<?php echo BASE_URL?>/static/images/dashboard.png" alt="">
    </div>
</body>
</html>