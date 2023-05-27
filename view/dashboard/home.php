



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/home.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/side.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>dashboard</title>
</head>
<body>
    <!-- include the side file -->
    <?php
    echo $msg;
   ?>
   
    <section class="main-info">
    <div class="statistics">
                <div class="header">
                    <h2>statistics</h2>
                    <div class="statheader">
                    <p id="days">30 days</p>
                    <a><i class="bi bi-three-dots"></i></a>
                    </div>
                </div>
                <div class="statistics_main">

               <?php 
               $statistics = getStatistics($conn,7,$_SESSION['SESSION_ID']) ;
                printStatistics($statistics);
                ?>
                </div>
            </div>
            <div class="profile">
                <div class="header">
                    <h2>Profile</h2>
                    <a href="<?php echo BASE_URL?>/editProfile?id=<?php echo $_SESSION['SESSION_ID'];?>"><i class="bi bi-pen" style="color:black"></i></a>
                </div>
                <div class="body">
                    <img src="<?php echo $logoSrc; ?>" alt="profile-image">
                    <p><?php echo $gym_name ?></p>
                    <div class="gym-stat">
                        <div id="coaches-stat">
                            <h2><?php echo $num_coaches ?></h2>
                            <p>coaches</p>
                        </div>
                        <div id="members-stat">
                            <h2><?php echo $num_members ?></h2>
                            <p>members</p>
                        </div>
                        <div id="session-stat">
                            <h2><?php echo $num_offers ?></h2>
                            <p>offers</p>
                        </div>
                    </div>
                </div>

            </div>
    </section>
    <section class="tasks">
        <div class="header">
            <h2>tasks
            </h2>
            <a><i class="bi bi-three-dots"></i></a>
        </div>
        <form class="enter-task" id="enter-task" action="<?php echo BASE_URL;?>/home.inc.php">
            <input type="text" placeholder="add a task" id="task-input">
            <button id="add-task" type="submit"><i class="bi bi-plus-lg"></i></button>
            
        </form>
        <div class="show-tasks">
            <?php echo $display_tasks;
            $display_tasks = '';?>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL ;?>/js/home.js"></script>
</body>
</html>