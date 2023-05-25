<?php
require_once(dirname(__DIR__).'/lib/config.php');
// check if the session start() has been called before
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// if the user did not login in => exit to the index page
if (isset($_SESSION['SESSION_EMAIL'])) {
    header('Location:'.BASE_URL.'/view/home.php');
    exit;
}
?>