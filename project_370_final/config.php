<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "project_370";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/* SSLCommerz Sandbox Credentials */
$store_id = "testbox";
$store_passwd = "qwerty";
?>