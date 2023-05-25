<?php


// Get the form data
$name = $_POST['name'];
$price = $_POST['price'];
$id = $_POST['id'];

// Prepare and execute the SQL query
$sql = "UPDATE product SET name_prod='$name', price_prod='$price' WHERE id_prod='$id'";

if (mysqli_query($conn, $sql)) {
  // If the query was successful, send a success response
  echo "success";
} else {
  // If the query failed, send an error response
  echo "error";
}

// Close the database connection
mysqli_close($conn);

?>