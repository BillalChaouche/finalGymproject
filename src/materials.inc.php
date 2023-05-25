<?php
session_start();

// connect with the database
include dirname(__DIR__) . '/lib/connect.php';

// import the config file
include dirname(__DIR__) . '/lib/config.php';






// fetch data from databases to show them
/*
$sql = "SELECT * FROM materials WHERE id IN (SELECT id FROM material WHERE id_owner = ?) ORDER BY id DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id_owner);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);


// Generate HTML code for each task
while ($row = mysqli_fetch_assoc($result)) {
    $id_material = intval($row['id_material']);
    $brand = htmlspecialchars($row['brand']);
    $maintence_date = htmlspecialchars($row['maintence_date']);
    $quantity = htmlspecialchars($row['quantity']);

    $rem = intval($row['']);

    $display_materials_more .= '<tr>
                  <td>' . $id_material . '</td>
                  <td>' . $brand . '</td>
                  <td>' . $maintence_date . '</td>
                  <td>' . $quantity . '</td>
                  <td id="buttons">
                  <a class="more" href="\'' . BASE_URL . '/view/editmaterials.php?id=' . $id_material . '\'"><i class="bi bi-arrow-right"></i></a>
                  </td>
                </tr>';


}
*/