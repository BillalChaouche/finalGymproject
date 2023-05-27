<?php

// prepare the SQL statement
if (isset($_POST['name']) && isset($_POST['price'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    echo $name;
    // create the SQL query
    $sql = "INSERT INTO product (id_owner, name_prod, price_prod) VALUES (?, ?, ?)";

    // prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // bind parameters
        $stmt->bind_param("sss", $_SESSION['SESSION_ID'], $name, $price);

        // execute the statement
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // SQL statement executed successfully
            echo "Product added successfully";
            
        } else {
            // Error occurred while executing the SQL statement
            echo "Error: Unable to add product";
        }
    } else {
        // Error occurred while preparing the statement
        echo "Error: Unable to prepare statement";
    }

    // close the statement
    $stmt->close();
    
}
?>