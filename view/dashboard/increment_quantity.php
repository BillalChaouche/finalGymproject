<?php
include dirname(__DIR__) . '/lib/connect.php';

// import the config file
include dirname(__DIR__) . '/lib/config.php';

// import the config file
include dirname(__DIR__) . '/lib/config.php';

// get the ID parameter from the URL
// increment or decrement the quantity in the database
if (isset($_POST['idin'])) {
    $id_material = $_POST['idin'];
    $stmt = mysqli_query($conn, "UPDATE sub_material SET new_price_quant = new_price_quant + 1 WHERE id_sub_mat = '$id_material'");
    $result = mysqli_query($conn, "SELECT new_price_quant FROM sub_material WHERE id_sub_mat = '$id_material'");
    $row = mysqli_fetch_assoc($result);
    echo $row['new_price_quant'];
} else if (isset($_POST['idde'])) {
    $id_material = $_POST['idde'];
    $stmt = mysqli_query($conn, "UPDATE sub_material SET new_price_quant = new_price_quant - 1 WHERE id_sub_mat = '$id_material'");
    $result = mysqli_query($conn, "SELECT new_price_quant FROM sub_material WHERE id_sub_mat = '$id_material'");
    $row = mysqli_fetch_assoc($result);
    echo $row['new_price_quant'];
}

?>