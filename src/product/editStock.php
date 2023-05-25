<?php

    // Get the form data
    $id_quant = $_POST['id_quant'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];
    $expire_date = $_POST['expire_date'];
    $quantity = $_POST['quantity'];

    // Prepare and execute the query to update the stock record
    $stmt = $conn->prepare('UPDATE product_quant SET supplier_quant = ?, new_price_quant = ?, expiry_quant = ?, quantity_quant = ? WHERE id_quant = ?');
    $result = $stmt->execute([$supplier, $price, $expire_date, $quantity, $id_quant]);

    // Check if the query was successful
    if ($result) {
        // Return a success message
        echo 'Stock updated successfully';
    } else {
        // Return an error message
        echo 'Error updating stock';
    }



?>