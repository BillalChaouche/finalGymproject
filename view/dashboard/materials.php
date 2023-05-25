<?php
// get important data form config
include dirname(__DIR__) . '/lib/config.php';
include dirname(__DIR__) . '/lib/connect.php';
include dirname(__DIR__) . '/src/materials.inc.php';
if (isset($_GET['id'])) {
    // Get the material ID from the URL parameter
    $id_material = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the data for the material with the given ID
    $sql = "SELECT * FROM material WHERE id_mat = $id_material";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name_material = $row['name_mat'];

    // Check if the "Remove" button was clicked
    if (isset($_POST['submit']) && $_POST['submit'] == 'remove') {
        // Prepare a delete statement to remove the material with the given ID
        $sql = "DELETE FROM material WHERE id_mat = $id_material";
        $result = mysqli_query($conn, $sql);

        // Check if the delete statement was successful
        if ($result) {
            // Redirect to the materials page
            header("Location: http://localhost/GymFlex(v2)/view/materials.php");
            exit();
        } else {
            // Display an error message
            echo "Error deleting material: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['submit']) && $_POST['submit'] == 'save') {
        // Get the new name for the material
        $new_name = mysqli_real_escape_string($conn, $_POST['name']);

        // Prepare an update statement to change the name of the material with the given ID
        $sql = "UPDATE material SET name_mat = '$new_name' WHERE id_mat = $id_material";
        $result = mysqli_query($conn, $sql);

        // Check if the update statement was successful
        if ($result) {
            // Redirect to the materials page
            header("Location: http://localhost/GymFlex(v2)/view/materials.php?id=$id_material");
            exit();
        } else {
            // Display an error message
            echo "Error updating material: " . mysqli_error($conn);
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/notification.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/material.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/side.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/addmaterial.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/notification.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/side.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/addmatt.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Materials</title>
</head>

<body>
    <!-- this is the form for adding material -->
    <form class="form-add" method="POST" action="..\src\addmaterial.php?id=<?php echo $_GET['id'] ?>">
        <button id="exit"><i class="bi bi-x-circle"></i></button>
        <div class="title">
            <h1>Add a Material</h1>
        </div>
        <div class="inputs">
            <div class="input-id">
                <p>ID:</p>
                <div class="req"></div>
                <input type="text" placeholder="enter your material ID" required id="add-id" name="id">
            </div>
            <div class="input-contact">
                <div class="input-brand">
                    <p>Brand:</p>
                    <div class="req"></div>
                    <input type="text" placeholder="enter the brand" required id="add-brand" name="brand">
                </div>
            </div>
            <div class="input-date">
                <p>Maintenance date:</p>
                <div class="req"></div>
                <input type="date" required id="add-date" name="maintenance_date">
            </div>
            <div class="input-id">
                <p>Quantity:</p>
                <div class="req"></div>
                <input type="number" placeholder="enter your material quantity" required id="add-quantity"
                    name="quantity">
            </div>
        </div>
        <div class="submit">
            <input type="submit" name="done" value="Done" id="done">
        </div>
    </form>


    <!-- the side bar -->
    <!-- include the side file -->
    <?php
    include dirname(__DIR__) . '/view/side.php';
    ?>
    <!-- the X button above -->
    <?php
    $idmat = $_GET["id"];
    $sql = "SELECT name_mat FROM material WHERE id_mat = '$idmat'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name_material = $row['name_mat'];

    ?>

    <section class="above">

        <button id="notification"><i class="bi bi-bell"></i></button>
    </section>
    <!-- here the material place -->
    <section class="thematerialchoosen">
        <form method="POST" action="mati.php?id=<?php echo $idmat ?>">
            <div class="input">
                <img src="..\static\css\155-1558252_gym-equipment-gym-equipments-clipart-png.png" alt="">

                <div class="input-name">
                    <p>Name:
                    </p>
                    <input type="text" required value="<?php echo $name_material ?>" name="name">
                </div>
            </div>
            <div class="submit">
                <input type="submit" id="remove" value="Remove" name='remove-material'>
                <input type="submit" value="Save" id="done-edit" name='dn'>
            </div>
        </form>
    </section>
    <?php
    $id_mat = intval($_GET['id']);
    $id_owner = $_SESSION['SESSION_ID'];

    $sql = "SELECT * FROM sub_material m INNER JOIN material sm ON m.id_mat = sm.id_mat WHERE m.id_owner = ? AND sm.id_mat = ? ORDER BY m.id_mat DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $id_owner, $id_mat);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    // Generate HTML code for each material
    while ($row = mysqli_fetch_assoc($result)) {
        $id_material = intval($row['id_sub_mat']);
        $brand = htmlspecialchars($row['brand_sub_mat']);

        $maintenance_date = htmlspecialchars($row['maintenance_sub_mat']);
        $remaining_days = intval((strtotime($maintenance_date) - time()) / (60 * 60 * 24));
        $quantity = intval($row['new_price_quant']);

        $display_materials_more .= '<tr>
                  <td>' . $id_material . '</td>
                  <td>' . $brand . '</td>

                  <td>' . $maintenance_date . '</td>
                  <td>' . $quantity . '</td>
                  <td>' . $remaining_days . '</td>
                  <td id="buttons">
                  <a class="more" href="http://localhost/GymFlex(v2)/view/editmaterials.php?id=' . $id_material . '&ID=' . $id_mat . '"><i class="bi bi-arrow-right"></i></a>
                  </td>
                </tr>';
    }

    ?>
    <section class="material-table">
        <div class="header">
            <button id="add"> <i class=" bi-plus-lg"></i></button>
        </div>
        <!-- the table -->
        <table>
            <thead>
                <tr>
                    <th> ID </th>
                    <th> Brand </th>
                    <th> Maintence date </th>
                    <th> quantity </th>
                    <th> remaining days </th>
                    <th>More</th>
                </tr>



            </thead>
            <tbody class="show-materials">
                <?php echo $display_materials_more;
                $display_materials_more = ''; ?>
            </tbody>
        </table>


    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL ?>/js/material.js"></script>
</body>

</html>