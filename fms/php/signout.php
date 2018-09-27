<?php session_start();
$con = new mysqli('localhost', 'root', '', 'fms');
$con->query("UPDATE users_log SET LOG_OUT_TIME = now() WHERE LOG_OUT_TIME IS NULL AND USER_ID = '" . $_SESSION['userid'] . "';");
session_destroy();
header("Location: ../index.php");