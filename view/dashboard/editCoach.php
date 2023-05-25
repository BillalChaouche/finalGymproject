


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/editCoach.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">

    <title>Edit coach</title>
</head>
<body>
    <?php echo $msg ?>
  <!-- this is the form for to see more and edit about  coach -->
  <button id="exit-edit" onclick="window.location.href='<?php echo BASE_URL ?>/coaches'"><i class="bi bi-x-circle"></i></button>

  <form class="form-edit" method="POST">


    <div class="stats">
        <div class="session-price">
            <h2>Session price</h2>
            <p ><?php echo $price_session ?></p>
        </div>
        <div class="session-number">
            <h2>Session number</h2>
            <div>
            <button id="session-add" onclick="event.preventDefault(); increment('<?php echo $id_coach ?>')"><i class="bi bi-caret-up"></i></button>
            <p id="number-of-session"><?php echo $num_session ?></p>
            <button id="session-sub" onclick="event.preventDefault(); decrement('<?php echo $id_coach ?>')"><i class="bi bi-caret-down"></i></button>

            </div>
            
        </div>
        <div class="funds">
            <h2>total fund</h2>
            <p id="total-fund"><?php echo $total_fund?> DZ</p>
        </div>
    </div>
    <div class="inputs">
        <div class="input-name">
            <p>Name: 
                <div class="req"></div>
            </p>
            <input type="text" placeholder="enter the coach name" required value="<?php echo $name_coach?>" name="name">
        </div>
        <div class="input-contact">
            <div class="input-email">
                <p>Email: 
                    <div class="req"></div>
                </p>
                <input type="email" placeholder="enter email" required value="<?php echo $email_coach?>"name="email">
            </div>
            <div class="input-phone">
                <p>Phone number: 
                    <div class="req"></div>
                </p>
                <input type="number" placeholder="enter phone number" required value="<?php echo $phone_coach?>" name="number">
            </div>
            
        </div>
        <div class="input-address">
            <p>address: 
                <div class="req"></div>
            </p>
            <input type="text" placeholder="enter your address" required value="<?php echo $address_coach?>" name="address" >
        </div>
        
        <div class="input-status">
            <p>Status:</p>
            <div class="option">
                <div class="option1">
                    <input type="radio" id="option" name="option" value="active" <?php if($status_coach == 'active') {echo 'checked';}?>>
                    <label for="option1">active</label>
                </div>
                <div class="option1">
                    <input type="radio" id="option" name="option" value="inactive" <?php if($status_coach == 'inactive') {echo 'checked';}?>>
                    <label for="option2">inactive</label>
                </div>
                

             
        </div>
            </div>
        <div class="input-price">
            <p>Session price: 
            </p>
            <input type="number" placeholder="enter the price" value="<?php echo $price_session?>" name="price">
        </div>
    </div>
    <div class="submit">
        <button id="remove" name="remove-coach">remove</button>
        
        <input type="submit" value="Done" id="done-edit" name="done">
    </div>
    <div class="delete-coach">
            <p>Are you sure you want to delete this coach from your gym</p>
            <div class="choose-btn">
            <button id="cancel">cancel</button>
            <input type="submit" name="delete" value="delete" id="delete">
            </div>
            
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL ;?>/js/editCoach.js"></script>
</body>
</html>