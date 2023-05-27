<?php




function getProductQuantity($id_prod, $conn) {

    // Prepare SQL statement
    $stmt = $conn->prepare('SELECT SUM(quantity_quant) as total_quantity FROM product_quant WHERE id_prod = ?');

    // Bind parameters
    $stmt->bind_param('i', $id_prod);

    // Execute statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Fetch row
    $row = $result->fetch_assoc();

    // Return total quantity
    return 0 + $row['total_quantity'];
}



    // assuming you have a database connection already established
    $query = "SELECT * FROM product WHERE id_owner = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $_SESSION['SESSION_ID']);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result) {
            // fetch all rows into an array
            $product = $result->fetch_all(MYSQLI_ASSOC);

            // free the result set
            $result->free_result();
        } else {
            // handle the case where the query was not successful
            echo "Error: " . $stmt->error;
        }
        $displayProducts = "";
        // close the statement
        $stmt->close();
        foreach ($product as $row) {
            $displayProducts .="
            <div id='product'>
                <button class='more' onclick=\"location.href='\productEdit?id_prod=" . urlencode($row['id_prod']) . "&prodname=" . urlencode($row['name_prod']) . "'\"><i class='bi bi-arrow-right'></i></button>
                <img src='" . BASE_URL . "/static/images/logo.png' alt='' id='product_img'>
                <h3>" . $row['name_prod'] . "</h3>
                <h1>Qt. : " . getProductQuantity($row['id_prod'], $conn) . "</h1>
            </div>
            ";
        }
    } else {
        // handle the case where the statement preparation failed
        echo "Error: Unable to prepare statement";
    }




function getProductPrice($id, $conn) {
    

    $query = "SELECT price_prod FROM product WHERE id_prod = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row["price_prod"];
    } else {
        return null;
    }

}

?>