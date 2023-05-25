<?php

$msg ='';

// get the id using Get_request

if (isset($_GET['id'])) {
    // this sql query verify that this coach ID belong to the Logged in gymOwner 
    $id_coach = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['id']); 
    $id_owner = $_SESSION['SESSION_ID'];
    $sql = "SELECT * FROM  gym_to_coach WHERE id_coach = ? AND id_owner = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $id_coach, $id_owner);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);
        // implement logic of incrment the number of session (used here ajax for the Post request)
    if($num_rows === 1){
        
        // if he belongs to this gym => fectch the data of this Coach 
        $sql = "SELECT * FROM coach WHERE id_coach = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id_coach);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row = mysqli_fetch_assoc($result);
        $id_coach = intval($row['id_coach']);
        $name_coach = htmlspecialchars($row['name_coach']);
        $email_coach = htmlspecialchars($row['email_coach']);
        $phone_coach = htmlspecialchars($row['phone_coach']);
        $address_coach = htmlspecialchars($row['adress_coach']);
        $status_coach = htmlspecialchars($row['status_coach']);
        $num_session = intval($row['num_session']);
        $price_session = intval($row['session_price']);
        $total_fund = $price_session * $num_session;

        


    }
    else{
        // if not return to the coaches.php page
        header("Location:".BASE_URL."/coaches");
    }}
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // implement logic of incrment the number of session (used here ajax for the Post request)
    $id_coach_inc =filter_var(($_POST['idIn']), FILTER_SANITIZE_NUMBER_INT);
    if($id_coach_inc){
    $sql = "UPDATE coach SET num_session = num_session + 1 WHERE id_coach = ?";
    $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, "s",$id_coach_inc);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($result){
    echo 'success';
    } 
    else{
     // do nothing and javascript code will handle it
     }
    }
    // implement logic of decrement the number of session (used here ajax for the Post request)
     $id_coach_dec =filter_var(($_POST['idDe']), FILTER_SANITIZE_NUMBER_INT);
    if($id_coach_dec){
    $sql = "UPDATE coach SET num_session = num_session - 1 WHERE id_coach = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s",$id_coach_dec);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($result){
    echo 'success';
     }
    
    else{
    // do nothing and javascript code will handle it
    }
}

  }
  // save the update
  if(isset($_POST['done'])){
    // get the values and filter them 
    $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_var($_POST['option'], FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // update the new inforamtion
    //insert them to coach table
    $sql = "UPDATE coach SET name_coach=?, email_coach=?, phone_coach=?, adress_coach=?, status_coach=?, session_price=? WHERE id_coach=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $number, $address, $status, $price,$id_coach);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if($result){
        // if saved go to coaches page
        header('Location: '.BASE_URL.'/coaches');
    }
    else{
        // else show that there is an error
        $msg = "<div class='danger'>something went wrong</div>";
       
    }
    
  }
  // delete a coach 
  if(isset($_POST['delete'])){
    $sql = "DELETE FROM coach WHERE id_coach = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s",$id_coach);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if($result){
        // if saved go to coaches page
        header('Location: '.BASE_URL.'/coaches');
    }
    else{
        // else show that there is an error
        $msg = "<div class='danger'>something went wrong</div>";
       
    }
  }


?>