<?php
session_start();
// get important data form config
include dirname(__DIR__) . '/lib/config.php';
include dirname(__DIR__) . '/lib/connect.php';
$id_owner = $_SESSION['SESSION_ID'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['done'])) {
    $id_mat = $_GET['id'];
    $brand_sub_mat = mysqli_real_escape_string($conn, $_POST['brand']);
    $maintenance_sub_mat = mysqli_real_escape_string($conn, $_POST['maintenance_date']);
    $new_price_quant = intval($_POST['quantity']);
    $id_sub_mat = intval($_POST['id']);

    // Prepare INSERT statement
    // Prepare INSERT statement
    $sql = "INSERT INTO sub_material (id_mat, id_owner, brand_sub_mat, maintenance_sub_mat, new_price_quant, id_sub_mat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die('Error in SQL query: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "iisssi", $id_mat, $id_owner, $brand_sub_mat, $maintenance_sub_mat, $new_price_quant, $id_sub_mat);
    mysqli_stmt_execute($stmt);
    header("Location: http://localhost/GymFlex/view/materials.php? id= $id_mat ");

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        die('Error inserting data: ' . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

}




// include the php logic for this signup

// Retrieve form data
/*
$id_mat = intval($_GET['id']);
$id_owner = 3; //$_SESSION['id_owner']; // Assuming you have the owner ID in a session variable
$brand_sub_mat = mysqli_real_escape_string($conn, $_POST['brand']);
$maintenance_sub_mat = mysqli_real_escape_string($conn, $_POST['maintenance_date']);
$new_price_quant = intval($_POST['quantity']);
$id_sub_mat = intval($_POST['id']);

// Prepare INSERT statement
$sql = "INSERT INTO sub_material (id_mat, id_owner, brand_sub_mat, maintenance_sub_mat, new_price_quant, id_sub_mat) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iisssi", $id_mat, $id_owner, $brand_sub_mat, $maintenance_sub_mat, $new_price_quant, $id_sub_mat);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("Location: http://localhost/GymFlex/view/showmaterial.php");

// ...
$sql = "SELECT * FROM material m JOIN sub_material sm ON m.id_mat = sm.id_mat WHERE sm.id_owner = ? ORDER BY m.id_mat DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id_owner);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

// Generate HTML code for each material
while ($row = mysqli_fetch_assoc($result)) {
    $id_material = intval($row['id_mat']);
    $brand = htmlspecialchars($row['brand_sub_mat']);

    $maintenance_date = htmlspecialchars($row['maintenance_sub_mat']);
    $remaining_days = intval((strtotime($maintenance_date) - time()) / (60 * 60 * 24));
    $quantity = intval($row['new_price_quant']);

    $display_materials_more .= '<tr>
                  <td>' . $id_material . '</td>
                  <td>' . $brand . '</td>
                  <td>' . $maintenance_date . '</td>
                  <td>' . $remaining_days . '</td>
                  <td>' . $quantity . '</td>
                  <td id="buttons">
                  <button class="more" onclick="window.location.href=\'' . BASE_URL . '/view/editmaterials.php?id=' . $id_material . '\'"><i class="bi bi-arrow-right"></i></button>
                  </td>
                </tr>';
}
*/