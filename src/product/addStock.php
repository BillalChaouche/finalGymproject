<?php


if (isset($_POST['add-quant'])) {
    // Get the form inputs
    $supplier = $_POST['supplier'];
    $price = intval($_POST['price']);
    $expire_date = $_POST['expire_date'];
    $quantity = intval($_POST['quantity']);

    // Get the logged in user's ID and the product ID
    $id_prod = intval($_POST['id_prod']);
    $name_prod = $_POST['prodname'];

    echo "Supplier: " . $supplier . "<br>";
    echo "Price: " . $price . "<br>";
    echo "Expire date: " . $expire_date . "<br>";
    echo "Quantity: " . $quantity . "<br>";
    echo "Product ID: " . $id_prod . "<br>";

    
    $sql3 = "INSERT INTO product_quant(id_prod, quantity_quant, supplier_quant, expiry_quant, new_price_quant) 
    VALUES (?, ?, ?, ?, ?)";
    $stmt3 = mysqli_prepare($conn, $sql3);
    mysqli_stmt_bind_param($stmt3,"sssss", $id_prod, $quantity, $supplier, $expire_date, $price);
    $result = mysqli_stmt_execute($stmt3);
    if ($result) {
        // Redirect back to the product page with the updated URL parameters
        header("Location: ".BASE_URL."/productEdit?id_prod=$id_prod&prodname=$name_prod");
        exit;
    }
    else{
      // Error occurred while executing the SQL statement
      echo "Error: Unable to add stock data";
    }
}
?>
