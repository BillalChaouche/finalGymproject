

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>/static/css/profileSetup.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


    <title>edit Profile</title>
</head>
<body>
<?php echo $msg ?>
<button id="exit-edit" onclick="window.location.href='<?php echo BASE_URL ?>/home'"><i class="bi bi-x-circle"></i></button>

    <form method="POST" enctype="multipart/form-data" class="form">
        <div class="add-photo">
            <div class="profile-pic-div">
                <img src="<?php echo $logo_URL?>" id="photo">
                <input type="file" id="file" name="gym_photo" >
                <label for="file" id="uploadBtn" style="display: none;">Choose Photo</label>
            </div>
            <p>Add a picture</p>
        </div>
        <div class="inputs">
            <div class="input-name">
                <p>Name: 
                    <div class="req"></div>
                </p>
                <input type="text" placeholder="enter your gym name" required name="name" maxlength="30" value="<?php  echo $gym_name; ?>">
            </div>
            <div class="input-location">
                <div class="input-country">
                    <p>Country: 
                        <div class="req"></div>
                    </p>
                    <input type="text" placeholder="enter country" required name="country" maxlength="30" value="<?php  echo $gym_country;  ?>">
                </div>
                <div class="input-address">
                    <p>address: 
                        <div class="req"></div>
                    </p>
                    <input type="text" placeholder="enter your address" required name="address" maxlength="100" value="<?php echo $gym_address; ?>">
                </div>
                
            </div>
            <div class="input-phone">
                <p>Phone number: 
                    <div class="req"></div>
                </p>
                <input type="number" placeholder="enter your phone number" required name="number" oninput="limitInputLength(this, 10)" value="<?php echo $gym_pnum; ?>">
            </div>
            <div class="input-description">
                <p>description: 
                </p>
                <input type="text" placeholder="enter description" name="description" maxlength="200" value="<?php  echo $gym_desc; ?>">
            </div>
        </div>
        <div class="submit">
            <input  type="submit" value="Done" name="update">
            <button  type="button" id="remove">delete Account</button>
        </div>
        
    </form>
    <form class="delete-owner" method="POST">
            <p>Are you sure you want to delete your account and all your information</p>
            <div class="choose-btn">
            <button id="cancel">cancel</button>
            <input type="submit" name="delete" value="delete" id="delete">
            </div>
            
</form>
        
    <script src="<?php echo BASE_URL?>/js/profileSetup.js"></script>
    <script src="<?php echo BASE_URL?>/js/profileEdit.js"></script>
    <script src="<?php echo BASE_URL?>/js/input.js"></script>
</body>
</html>