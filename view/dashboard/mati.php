<?php
// get important data form config
include dirname(__DIR__) . '/lib/config.php';
include dirname(__DIR__) . '/lib/connect.php';
if (isset($_GET['id'])) {

    // Get the material ID from the URL parameter
    $id_material = $_GET['id'];
    // Fetch the data for the material with the given ID
    $sql = "SELECT * FROM material WHERE id_mat = $id_material";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if the "Remove" button was clicked
    if (isset($_POST['remove-material'])) {
        // Prepare a delete statement to remove the material with the given ID
        $sql = "DELETE FROM material WHERE id_mat = $id_material";
        $result = mysqli_query($conn, $sql);
        echo "hello";
        // Check if the delete statement was successful
        if ($result) {
            // Redirect to the materials page
            header("Location: http://localhost/GymFlex/view/showmaterial.php");
        } else {
            // Display an error message
            echo "Error deleting material: " . mysqli_error($conn);
        }
    } else {
        // Check if the "Save" button was clicked
        if (isset($_POST['dn'])) {
            // Get the new name for the material
            $new_name = mysqli_real_escape_string($conn, $_POST['name']);

            // Prepare an update statement to change the name of the material with the given ID
            $sql = "UPDATE material SET name_mat = '$new_name' WHERE id_mat = $id_material";
            $result = mysqli_query($conn, $sql);

            // Check if the update statement was successful
            if ($result) {
                // Redirect to the materials page
                header("Location: http://localhost/GymFlex/view/showmaterial.php");
            } else {
                // Display an error message
                echo "Error updating material: " . mysqli_error($conn);
            }
        }
    }
}


?>