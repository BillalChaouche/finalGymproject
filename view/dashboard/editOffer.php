<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/editOffer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">


    <title>editOffer</title>
</head>
<body>
<?php echo $msg?>
<div class="offer" style="background: <?php echo $offersColor[$color]; ?>;">
    <h1><?php echo $name_off?></h1>
    <div class="stat">
        <div>
            <p>duration</p>
            <h2><?php echo $duration_off?></h2>
        </div>
        <div>
            <p>places</p>
            <h2><?php echo $places?></h2>
        </div>
        <div>
            <p>prices </p>
            <h2><?php echo $price?>DZD</h2>
        </div>
        <div>
            <p>sessions</p>
            <h2><?php echo $session?></h2>
        </div>
</div>
<div class="members">
    <h2>subscription</h2>
    <table class="table">
         <thead>
            <tr>
                <th> Code </th>
                <th> Name </th>
                <th> email </th>
                <th> end date </th>
                <th> sessions </th>
                </tr>
            </thead>
            <tbody class="show-members">
            <h2><?php echo $displayMembers?></h2>
            
            </tbody>
        </table>
</div>
        
<button id="delete-off">delete</button>

</div>
<form class="delete-offer" method="POST">
            <p>Are you sure you want to delete this offer from your gym</p>
            <div class="choose-btn">
            <button id="cancel">cancel</button>
            <input type="submit" name="delete" value="delete" id="delete">
            </div> 
</form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL ;?>/js/editOffer.js"></script>
</html>