<?php


// Retrieve the product ID from the POST data
if(isset($_POST['id'])){
$idProd = $_POST['id'];

// Prepare a DELETE statement and execute it
$stmt = $conn->prepare("DELETE FROM product WHERE id_prod = ?");
$stmt->bind_param("i", $idProd);
$stmt->execute();

// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    // Return a success response
    echo true;
} else {
    // Return an error response
    echo false;
}

}


?>
