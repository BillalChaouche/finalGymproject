
<?php


// Check if the id_quant parameter was sent
if (isset($_POST['id_quant'])) {
    // Sanitize the value to prevent SQL injection attacks
    $id_quant = $_POST['id_quant'];

    // Build the DELETE query and execute it
    $sql = "DELETE FROM product_quant WHERE id_quant = '$id_quant'";
    if (mysqli_query($conn, $sql)) {
      // Return a success message to the AJAX request
      echo "Record deleted successfully";
    } else {
      // Return an error message to the AJAX request
      echo "Error deleting record: " . mysqli_error($conn);
    }

    // Close the database connection
  } else {
    // Return an error message if the id_quant parameter was not sent
    echo "No id_quant parameter was provided";
  }

?>