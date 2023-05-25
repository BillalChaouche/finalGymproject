<?php





function displayStocks($id_prod, $conn) {
    // connect to the database
    
    // query the database
    $query = "SELECT * FROM product_quant WHERE id_prod = $id_prod";
    $result = mysqli_query($conn, $query);

    // output the results
    if ($result->num_rows > 0) {
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr data-id="' . $row['id_quant'] . '">';
            echo '<td class="id-quant">' . $row['id_quant'] . '</td>';
            echo '<td class="supplier-quant">' . $row['supplier_quant'] . '</td>';
            echo '<td class="new-price-quant">' . $row['new_price_quant'] . ' DZ</td>';
            echo '<td class="expiry-quant">' . $row['expiry_quant'] . '</td>';
            echo '<td class="quantity-quant">' . $row['quantity_quant'] . '</td>';
            echo '<td><div class="table_btns">';
            echo '<button type="submit" class="edit-btn" data-id="' . $row['id_quant'] . '" style="background-color: #FF9D61;">Edit</button>';
            echo '<button type="button" class="delete-btn" data-id="' . $row['id_quant'] . '">Delete</button>';
            echo '</div></td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
    } else {
        echo '<tbody><tr><td colspan="7">No stocks found.</td></tr></tbody>';
    }

    // close the database connection
}





?>
