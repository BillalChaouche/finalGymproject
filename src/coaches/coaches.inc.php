<?php
// get the id of the gym owner
$id_owner = $_SESSION['SESSION_ID'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the values and filter them 
    if(isset($_POST['name'])){
    $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    //insert them to coach table
    $sql = "INSERT INTO coach (name_coach, email_coach, phone_coach, adress_coach, status_coach, session_price) VALUES(?,?,?,?,?,?)";	

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $number, $address, $status, $price);
    $result = mysqli_stmt_execute($stmt);

    if($result){
        $last_id = mysqli_insert_id($conn);
    }
    else{
       // do nothing and javascript code will handle it
    }
    mysqli_stmt_close($stmt);
    // insert to table gym_to_coach many to many relation
    $sql = "INSERT INTO gym_to_coach(id_coach,id_owner) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $last_id,$id_owner);
    $result = mysqli_stmt_execute($stmt);
    if($result){
        // for the ajax rersponse
        echo "success";
    }
    else{
       // do nothing and javascript code will handle it
        
    }
    
    }
    // implement the logic of add button
    $id_coach_inc =filter_var(($_POST['id']), FILTER_SANITIZE_NUMBER_INT);
    if($id_coach_inc){
        $sql = "UPDATE coach SET num_session = num_session + 1 WHERE id_coach = ?";
        $stmt = mysqli_prepare($conn, $sql);
         mysqli_stmt_bind_param($stmt, "s",$id_coach_inc);
        $result = mysqli_stmt_execute($stmt);
        if($result){
            echo 'success';
        }
        else{
           // do nothing and javascript code will handle it
        }
        mysqli_stmt_close($stmt);

    }

 


}

// fetch data from databases to show them

$sql = "SELECT * FROM coach WHERE id_coach IN (SELECT id_coach FROM gym_to_coach WHERE id_owner = ?) ORDER BY id_coach DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id_owner);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);


// Generate HTML code for each task
while ($row = mysqli_fetch_assoc($result)) {
$id_coach = intval($row['id_coach']);
$name_coach = htmlspecialchars($row['name_coach']);
$email_coach = htmlspecialchars($row['email_coach']);
$phone_coach = htmlspecialchars($row['phone_coach']);
$address_coach = htmlspecialchars($row['adress_coach']);
$num_session = intval($row['num_session']);

$display_coach .= '<tr>
                  <td>'.$id_coach.'</td>
                  <td>'.$name_coach.'</td>
                  <td><a href="mailto:'.$email_coach.'" target="_blank" rel="noreferrer">'.$email_coach.'</a></td>
                  <td>'.$phone_coach.'</td>
                  <td>'.$address_coach.'</td>
                  <td id="m_increment"><p id="'.$id_coach.'">'.$num_session.'</p><button><i class="bi bi-plus increment" onclick = "increment('.$id_coach.')"></i></button></td>
                  <td id="buttons">
                  <button class="more" onclick="window.location.href=\''.BASE_URL.'/editCoach?id='.$id_coach.'\'"><i class="bi bi-arrow-right"></i></button>
                  </td>
                </tr>';


        }
