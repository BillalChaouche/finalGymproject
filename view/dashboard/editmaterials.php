<?php
session_start();
$id_mat = $_GET['ID'];

// check that the user is logged in 
// get important data form config
include dirname(__DIR__) . '/lib/connect.php';

// import the config file
include dirname(__DIR__) . '/lib/config.php';

if (isset($_POST['done'])) {
    $id_material = $_POST['ID'];
    $brand = $_POST['brand'];
    $maintenace_date = $_POST['date'];

    // Update the data in the database
    $stmt = mysqli_query($conn, "UPDATE sub_material SET brand_sub_mat = '" . $brand . "', maintenance_sub_mat = '" . $maintenace_date . "' WHERE id_sub_mat = '" . $id_material . "'");
    header("Location: http://localhost/GymFlex/view/showmaterial.php");


}
if (isset($_POST['delete'])) {
    $id_material = $_POST['ID'];

    // Delete the data from the database
    $stmt = mysqli_query($conn, "DELETE FROM sub_material WHERE id_sub_mat = '" . $id_material . "'");
    header("Location: http://localhost/GymFlex/view/showmaterial.php");

}




// Check if the ID parameter is set
if (isset($_GET['id'])) {
    // Get the material ID from the URL parameter
    $id_material = $_GET['id'];
    $result = mysqli_query($conn, "SELECT DATE_FORMAT(maintenance_sub_mat, '%Y-%m-%d') AS maintenace_sub_date FROM  sub_material WHERE id_sub_mat = $id_material");

    // Fetch the result
    $row = mysqli_fetch_assoc($result);

    // Get the maintenance date from the database
    $maintenace_date = $row['maintenace_sub_date'];
    $formatted_date = date('Y-m-d', strtotime($maintenace_date));

    // Prepare a select statement to fetch the data for the material with the given ID
    $sql = "SELECT * FROM sub_material WHERE id_sub_mat = $id_material";

    // Execute the select statement
    $result = mysqli_query($conn, $sql);



    // Check if there is any data
    if (mysqli_num_rows($result) > 0) {
        // Fetch the data as an associative array
        $row = mysqli_fetch_assoc($result);

        // Extract the data into separate variables
        $brand = $row['brand_sub_mat'];
        // Get the maintenance date from the database
        // $maintenace_date = $row['maintenace_sub_date'];

        // Format the date as 'yy-yy-yyyy'
        //$maintenace_datee = date('y-y-Y', strtotime($maintenace_date));

        // Display the formatted date
        $num_quant = $row['new_price_quant'];

        //$price_session = $row['price_session'];
    } else {
        // No data found with the given ID
        $msg = "No data found with the given ID.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // ID parameter is not set
    $msg = "No ID parameter specified.";
}
$remaining_days = intval((strtotime($formatted_date) - time()) / (60 * 60 * 24));



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/editmaterial.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/notification.css">

    <title>Edit material</title>
</head>

<body>
    <?php echo $msg ?>
    <!-- this is the form for to see more and edit about  coach -->
    <button id="exit-edit" onclick="window.location.href='<?php echo BASE_URL ?>/view/showmaterial.php'"><i
            class="bi bi-x-circle"></i></button>

    <form class="form-edit" method="POST">


        <div class="stats">

            <div class="quantity-number">
                <h2>Quantity</h2>
                <div>
                    <button id="quan-add" onclick="event.preventDefault(); increment('<?php echo $id_material ?>')"><i
                            class="bi bi-caret-up"></i></button>
                    <p id="quan">
                        <?php echo $num_quant ?>
                    </p>
                    <button id="quan-sub" onclick="event.preventDefault(); decrement('<?php echo $id_material ?>')"><i
                            class="bi bi-caret-down"></i></button>
                </div>

            </div>
            <div class="days">
                <h2>remaining days</h2>
                <p>
                    <?php echo $remaining_days ?>
                </p>
            </div>
        </div>
        <div class="inputs">
            <div class="input-id">
                <p>ID:
                <div class="req"></div>
                </p>
                <input type="text" placeholder="enter the material ID" required value="<?php echo $id_material ?>"
                    name="ID">
            </div>
            <div class="input-brand">
                <p>Brand:
                <div class="req"></div>
                </p>
                <input type="text" placeholder="enter brand" required value="<?php echo $brand ?>" name="brand">
            </div>
            <div class="input-date">
                <p>maintenace date:
                <div class="req"></div>
                </p>

                <input type="date" placeholder="enter maintenace date " required value="<?php echo $formatted_date ?>"
                    name="date">
            </div>

        </div>



        <div class="submit">
            <button id="remove" name="remove-coach">remove</button>

            <input type="submit" value="Done" id="done-edit" name="done">
        </div>
        <div class="delete-material">
            <p>Are you sure you want to delete this material from your gym</p>
            <div class="choose-btn">
                <button id="cancel">cancel</button>
                <input type="submit" name="delete" value="delete" id="delete">
            </div>

        </div>
    </form>
    <script>
        function increment(id) {
            idin = id,
                $.ajax({

                    type: 'POST',
                    url: "http://localhost/GymFlex/view/increment_quantity.php",
                    data: { idin: id },
                    success: function (data) {
                        $('#quan').text(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
        }

        function decrement(id) {
            idde = id,
                $.ajax({

                    type: 'POST',
                    url: "http://localhost/GymFlex/view/increment_quantity.php",
                    data: { idde: id },

                    success: function (data) {
                        $('#quan').html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/js/editmaterial.js"></script>
</body>

</html>