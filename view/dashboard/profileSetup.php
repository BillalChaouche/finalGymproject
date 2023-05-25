

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>/static/css/profileSetup.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">

    <title>Set up Profile</title>
</head>
<body>
<?php echo $msg ?>
    <div class="orange">
        <h1>Brand</h1>
        <div class="text-center">
            <h2>Start your<br> journey with us</h2>
            <p>make it easier and more<br> productive on the same time by<br> one click</p>
        </div>
        <div class="opinion">
            <p>nice platform, it enhance my works and revenue
                 and since I use it every thing become organized</p>
            <div class="info-orange">
                <img src="<?php echo BASE_URL ;?>/static/images/profile.jpg">
                <h2>North gym</h2>
            </div>
        </div>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="add-photo">
            <div class="profile-pic-div">
                <img src="<?php echo BASE_URL ;?>/static/images/Untitled design (2).png" id="photo">
                <input type="file" id="file" name="gym_photo">
                <label for="file" id="uploadBtn" style="display: none;">Choose Photo</label>
            </div>
            <p>Add a picture</p>
        </div>
        <div class="inputs">
            <div class="input-name">
                <p>Name: 
                    <div class="req"></div>
                </p>
                <input type="text" placeholder="enter your gym name" required name="name" value="<?php if (isset($_POST['done'])) { echo $gym_name; } ?>">
            </div>
            <div class="input-location">
                <div class="input-country">
                    <p>Country: 
                        <div class="req"></div>
                    </p>
                    <input type="text" placeholder="enter country" required name="country" value="<?php if (isset($_POST['done'])) { echo $gym_country; } ?>">
                </div>
                <div class="input-address">
                    <p>address: 
                        <div class="req"></div>
                    </p>
                    <input type="text" placeholder="enter your address" required name="address" value="<?php if (isset($_POST['done'])) { echo $gym_address; } ?>">
                </div>
                
            </div>
            <div class="input-phone">
                <p>Phone number: 
                    <div class="req"></div>
                </p>
                <input type="number" placeholder="enter your phone number" required name="number" value="<?php if (isset($_POST['done'])) { echo $gym_pnum; } ?>">
            </div>
            <div class="input-description">
                <p>description: 
                </p>
                <input type="text" placeholder="enter description" name="description" value="<?php if (isset($_POST['done'])) { echo $gym_desc; } ?>">
            </div>
        </div>
        <div class="submit">
            <input  type="submit" value="Done" name="done">
        </div>
        
    </form>
    <script src="<?php echo BASE_URL?>/js/profileSetup.js"></script>
</body>
</html>