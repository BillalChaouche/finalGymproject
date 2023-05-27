<?php

$msg = ''; 
if (isset($_SESSION['reset_password_success'])) {
    $msg = "<div class='success'>{$_SESSION['reset_password_success']}</div>";
    unset($_SESSION['reset_password_success']); // Clear the session variable
}



    // verfiy if the user is login
    $email = $_SESSION['SESSION_EMAIL'];
    // get the user value from the database
    //sql query for his name
    $sql = "SELECT id_owner, password_gym, code, name_gym,logo_gym  FROM gym_owner WHERE email_gym = ?";
    // sql query for for the number of coaches
    $sql2 = "SELECT COUNT(id_coach)
             FROM gym_to_coach
             WHERE id_owner = ?";
    // excute the sql1
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_rows = mysqli_stmt_num_rows($stmt);
    // excute the sql2
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "s", $email);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_store_result($stmt2);
    // check if the user exist
        if ($num_rows === 1) {
            // get the user data like name
            mysqli_stmt_bind_result($stmt, $id_owner, $hashed_password, $code, $gym_name, $logo);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            // excute the sql2 after getting id from the execution of sql1
            $stmt2 = mysqli_prepare($conn, $sql2);
             mysqli_stmt_bind_param($stmt2, "s", $id_owner);
            $_SESSION['SESSION_ID'] = $id_owner;
             
             mysqli_stmt_execute($stmt2);
             mysqli_stmt_store_result($stmt2);
            // get the number of coaches
            mysqli_stmt_bind_result($stmt2,$num_coaches);
            mysqli_stmt_fetch($stmt2);
            mysqli_stmt_close($stmt2);
            // number of members
            $sql2 = "SELECT COUNT(identity_mem)
            FROM members
            WHERE id_owner = ?";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "s", $id_owner);
           $_SESSION['SESSION_ID'] = $id_owner;
            
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_store_result($stmt2);
           // get the number of coaches
           mysqli_stmt_bind_result($stmt2,$num_members);
           mysqli_stmt_fetch($stmt2);
           mysqli_stmt_close($stmt2);
           // number of offers
           $sql2 = "SELECT COUNT(id_off)
            FROM offers
            WHERE id_owner = ?";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "s", $id_owner);
           $_SESSION['SESSION_ID'] = $id_owner;
            
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_store_result($stmt2);
           // get the number of coaches
           mysqli_stmt_bind_result($stmt2,$num_offers);
           mysqli_stmt_fetch($stmt2);
           mysqli_stmt_close($stmt2);

            // check if the user setup profile
            /* we will check only if the name is empty because the setup profie process
            ensure that all input must be filled to be submited*/
            if(empty($gym_name)){
                // if he did not setup his profile go to login
                header("Location:".BASE_URL."/login");
                exit();
            }
            else{
                // get the profile url
                $logoData = base64_encode($logo);
                $logoSrc = 'data:image/jpeg;base64,' . $logoData;
                // add task 
                    // get the content task
                    $task = $_POST['task'];

                    if($task){
                
                    // Get current date and time
                    date_default_timezone_set('Africa/Algiers'); // set timezone to Algeria Time
                    $current_date = date('Y-m-d'); // format: YYYY-MM-DD
                    $current_time = date('H:i'); // format: HH:MM
                
                    $sql3 = "INSERT INTO task (id_owner, date_task, time_task, content_task) VALUES (?, ?, ?, ?)";
                    $stmt3 = mysqli_prepare($conn, $sql3);
                    mysqli_stmt_bind_param($stmt3, "ssss", $id_owner, $current_date, $current_time, $task);
                    $result = mysqli_stmt_execute($stmt3);
                    if (!$result) {
                        echo mysqli_error($conn);
                        exit;
                    }
                    else{
                    mysqli_stmt_close($stmt3);
                    
                    }
                }
                // delete a task 
                // get task ID from AJAX request
                $taskId = $_POST['task_id'];
                if($taskId){
                // delete task from database
               $sql5 = "DELETE FROM task WHERE id_task = ?";
               $stmt5 = mysqli_prepare($conn, $sql5);
                mysqli_stmt_bind_param($stmt5, "s", $taskId);
                $result = mysqli_stmt_execute($stmt5);
                mysqli_stmt_close($stmt5);
                }

               
           
                // Fetch tasks from the database
                
               $sql4 = "SELECT *, DATE_FORMAT(time_task, '%H:%i') AS time_only FROM task WHERE id_owner=? ORDER BY id_task DESC";
               $stmt4 = mysqli_prepare($conn, $sql4);
               mysqli_stmt_bind_param($stmt4, "s", $id_owner);
               mysqli_stmt_execute($stmt4);
               $result = mysqli_stmt_get_result($stmt4);

               // Generate HTML code for each task
               while ($row = mysqli_fetch_assoc($result)) {
               $id_task = intval($row['id_task']);
               $date_task = htmlspecialchars($row['date_task']);
               $time_task = htmlspecialchars($row['time_only']);
               $content_task = htmlspecialchars($row['content_task']);

               $display_tasks .= '<div class="task">'.
                '<div class="header">'.
               '<div class="time">'.
               '<p id="date">' . $date_task . '</p>'.
               '<p id="time">' . $time_task . '</p>'.
               '</div>'.
               '<div class="buttons">'.
               '<button id="delete" ondblclick="deleteTask('.$id_task.')" ></button>'.
               '</div>'.
               '</div>'.
               '<div class="content">'.
               '<p>' . $content_task . '</p>'.
               '</div>'.
               '</div>';

               }
            

            }
            }






?>