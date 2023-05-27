


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/coaches.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/addCoach.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/side.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>coaches</title>
</head>
<body>
    <?php echo $msg; ?>
    <!-- this is the form for adding coach -->
    <form class="form-add">
        <button id="exit"><i class="bi bi-x-circle"></i></button>
        <div class="title">
            <h1>Add a coach</h1>
        </div>
        <div class="inputs">
            <div class="input-name">
                <p>Name: 
                    <div class="req"></div>
                </p>
                <input type="text" placeholder="enter your coach name" required id="add-name" maxlength="20">
            </div>
            <div class="input-contact">
                <div class="input-email">
                    <p>Email: 
                        <div class="req"></div>
                    </p>
                    <input type="email" placeholder="enter email" required id="add-email" maxlength="30">
                </div>
                <div class="input-phone">
                    <p>Phone number: 
                        <div class="req"></div>
                    </p>
                    <input type="number" placeholder="enter phone number" required id="add-number" oninput="limitInputLength(this, 10)">
                </div>
                
            </div>
            <div class="input-address">
                <p>address: 
                    <div class="req"></div>
                </p>
                <input type="text" placeholder="enter your address" required id="add-address" maxlength="50">
            </div>
            
            <div class="input-status">
                <p>Status:</p>
                <div class="option">
                    <div class="option1">
                        <input type="radio" id="option" value="active">
                        <label for="option1">active</label>
                    </div>
                    <div class="option1">
                        <input type="radio" id="option"  value="inactive">
                        <label for="option2">inactive</label>
                    </div>
                    

                 
            </div>
                </div>
            <div class="input-price">
                <p>Day price: 
                </p>
                <input type="number" placeholder="enter the price" id="add-price" oninput="limitInputLength(this, 10)">
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="Done" id="done">
        </div>
        
    </form>
    
    <!-- the side bar -->
    <!-- include the side file -->
    <?php
    include dirname(__DIR__).'/view/side.php';
    ?>
    <!-- the search, notifaction and settings -->
    <?php
    include dirname(__DIR__).'/view/header.php';
    ?>
    <!-- the table -->

    <section class="coaches-table">
        <div class="header">
            <h1>Coaches</h1>
            <button  id="add"> <i class="bi bi-plus"></i></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th> ID </th>
                    <th> Name </th>
                    <th> email </th>
                    <th> Phone </th>
                    <th id="address"> Address </th>
                    <th> worked days </th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody class="show-coaches">
            <?php echo $display_coach;
            $display_coach = '';?>
            </tbody>
        </table>
    </section>
    <script src="<?php echo BASE_URL?>/js/input.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?php echo BASE_URL?>/js/coaches.js"></script>
</body>
</html>