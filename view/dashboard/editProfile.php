<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL?>static/css/profileSetup.css">
    <title>edit Profile</title>
</head>
<body style="background-color:#FFF0E7;">
    
    <form style="background-color: white;padding-top: 1%;">
        <div class="add-photo">
            <div class="profile-pic-div">
                <img src="images/Untitled design (2).png" id="photo">
                <input type="file" id="file">
                <label for="file" id="uploadBtn" style="display: none;">Choose Photo</label>
            </div>
            <p>Add a picture</p>
        </div>
        <div class="inputs">
            <div class="input-name">
                <p>Name: 
                    <div class="req"></div>
                </p>
                <input type="text" placeholder="enter your gym name" required>
            </div>
            <div class="input-location">
                <div class="input-country">
                    <p>Country: 
                        <div class="req"></div>
                    </p>
                    <input type="text" placeholder="enter country" required>
                </div>
                <div class="input-address">
                    <p>address: 
                        <div class="req"></div>
                    </p>
                    <input type="text" placeholder="enter your address" required>
                </div>
                
            </div>
            <div class="input-phone">
                <p>Phone number: 
                    <div class="req"></div>
                </p>
                <input type="number" placeholder="enter your phone number" required>
            </div>
            <div class="input-description">
                <p>description: 
                </p>
                <input type="texr" placeholder="enter description">
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="Done">
        </div>
        
    </form>
    <script src="js/profileSetup.js"></script>
</body>
</html>