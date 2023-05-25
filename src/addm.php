<?php
session_start();
$id_owner = $_SESSION['SESSION_ID'];
echo $id_owner;


// connect with the database
include dirname(__DIR__) . '/lib/connect.php';

// import the config file
include dirname(__DIR__) . '/lib/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the values and filter them 
    $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);

    // prepare the statements
    $stmt1 = $conn->prepare("INSERT INTO material (name_mat) VALUES (?)");
    $stmt2 = $conn->prepare("INSERT INTO gym_to_material (id_mat, id_owner) VALUES (?, ?)");

    // begin the transaction
    $conn->begin_transaction();

    try {
        // execute the first query
        $stmt1->bind_param("s", $name);
        $stmt1->execute();

        // get the last inserted id from the first query
        $id_mat = $stmt1->insert_id;

        // execute the second query
        $stmt2->bind_param("ii", $id_mat, $id_owner);
        $stmt2->execute();

        // commit the transaction
        $conn->commit();

        // redirect to the show material page
        header("Location: http://localhost/GymFlex/view/showmaterial.php");
    } catch (Exception $e) {
        // rollback the transaction on error
        $conn->rollback();

        // handle the error
        echo "Error: " . $e->getMessage();
    }

    // close the statements
    $stmt1->close();
    $stmt2->close();
}