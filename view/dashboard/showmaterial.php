<?php
session_start();

// check that the user is logged in 
include dirname(__DIR__) . '/src/isLogged.php';
// get important data form config
include dirname(__DIR__) . '/lib/config.php';
// include the php logic for this signup
include dirname(__DIR__) . '/src/materials.inc.php';
$id_owner = $_SESSION['SESSION_ID'];
if (isset($_POST['submit'])) {
    // Get the search term from the form input
    $search_term = mysqli_real_escape_string($conn, $_POST['task-input']);

    // Modify the SQL query to include a WHERE clause that filters based on the search term
    $sql = "SELECT *
    FROM material sm
    INNER JOIN gym_to_material gm ON sm.id_mat = gm.id_mat
    WHERE sm.name_mat LIKE '%$search_term%' AND gm.id_owner = $id_owner";


    $result = mysqli_query($conn, $sql);
    // Generate HTML code for each material
    $display_materials = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $id_mat = intval($row['id_mat']);
        $name_mat = htmlspecialchars($row['name_mat']);

        // Get the count of sub-materials for this material
        $sql_count = "SELECT COUNT(*) as count FROM sub_material WHERE id_mat = $id_mat ";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $count_sub_mat = intval($row_count['count']);

        $display_materials .= '<div class="material" data-id=' . $id_mat . '>' .
            '<a><i class="bi bi-three-dots"></i></a>' .
            '<div class="mat">' .
            '<img src="' . BASE_URL . '/static/css/155-1558252_gym-equipment-gym-equipments-clipart-png.png" alt="">' .
            '<p>' . $name_mat . '</p>' .
            '<h1>' . $count_sub_mat . '</h1>' .
            '</div>' .
            '</div>';
    }
} else {
    $sql = "SELECT *
    FROM material sm
    INNER JOIN gym_to_material gm ON sm.id_mat = gm.id_mat
    WHERE  gm.id_owner = $id_owner";
    $result = mysqli_query($conn, $sql);
    // Generate HTML code for each material
    $display_materials = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $id_mat = intval($row['id_mat']);
        $name_mat = htmlspecialchars($row['name_mat']);

        // Get the count of sub-materials for this material
        $sql_count = "SELECT COUNT(*) as count FROM sub_material WHERE id_mat = $id_mat ";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $count_sub_mat = intval($row_count['count']);

        $display_materials .= '<div class="material" data-id=' . $id_mat . '>' .
            '<a><i class="bi bi-three-dots"></i></a>' .
            '<div class="mat">' .
            '<img src="' . BASE_URL . '\static\css\155-1558252_gym-equipment-gym-equipments-clipart-png.png" alt="">' .
            '<p>' . $name_mat . '</p>' .
            '<h1>' . $count_sub_mat . '</h1>' .
            '</div>' .
            '</div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/coaches.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/showmaterials.css">

    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/notification.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/side.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/addmaterial.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>material</title>
</head>

<body>


    <form class="form-add" action="<?php echo BASE_URL; ?>./src/addm.php" method="POST">
        <button id="exit"><i class="bi bi-x-circle"></i></button>
        <div class="title">
            <h2>Add New Material</h2>
        </div>

        <div class="inputs">
            <div class="input-id">
                <p>Name:</p>
                <div class="req"></div>

                <input type="text" name="name" placeholder="enter your material name" required id="add-id">
            </div>
        </div>
        <div class="submit">
            <button type="submit" name="add-material"><i class="bi bi-plus-circle"></i> Add</button>
        </div>
    </form>
    <?php echo $msg; ?>


    <!-- the side bar -->
    <!-- include the side file -->
    <?php
    include dirname(__DIR__) . '/view/side.php';
    ?>
    <!-- the search, notifaction and settings -->

    <section class="above">
        <div class="search">
            <button id="search-icon"><i class="bi bi-search"></i></button>
            <input type="text" placeholder="search">
        </div>
        <button id="notification"><i class="bi bi-bell"></i></button>
        <button id="settings"><i class="bi bi-gear"></i></button>
    </section>



    <!-- the table -->
    <section class="materials-table">
        <div class="hey">
            <button id="add"> <i class="bi bi-plus"></i></button>
        </div>
        <div class="header">

            <form class="enter-material" method="POST">
                <input type="text" placeholder="search for material" id="task-input" name="task-input">
                <button type="submit" id="add-task" name="submit"><i class="bi bi-search"></i></button>

            </form>

        </div>
        <div class="show-material">

            <?php echo $display_materials;
            $display_materials = ''; ?>
        </div>

        </div>
    </section>


    <script>

        // Add click event listener to each material
        const materials = document.querySelectorAll('.material');
        materials.forEach(material => {
            material.addEventListener('click', (e) => {
                e.preventDefault();
                // Get the selected material ID
                const materialId = material.dataset.id;
                // Redirect to the material page with the selected material ID
                window.location.href = `materials.php?id=${materialId}`;
            });
        });

        // Populate the material page with the selected material information
        const urlParams = new URLSearchParams(window.location.search);
        const materialId = urlParams.get('id');
        const materialInput = document.querySelector('.thematerialchoosen input[name="name"]');
        if (materialId) {
            // Get the selected material information using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `get_material_info.php?id=${materialId}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    const materialInfo = JSON.parse(this.responseText);
                    // Populate the material input field with the selected material name
                    materialInput.value = materialInfo.name;
                }
            }
            xhr.send();
        }



    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL ?>/js/addmat.js"></script>
</body>

</html>