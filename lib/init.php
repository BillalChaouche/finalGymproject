<?php

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('APP_LANG','en');

include("db.php");
include("config.php");


//It is very stupid to share passwords within GIT, but for demostration, we will close our eyes on this principle.
$dbhost = DB_HOST;
$dbuser = DB_USERNAME;
$dbpass = DB_PASSWORD;
$dbname = DB_NAME;

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

?>