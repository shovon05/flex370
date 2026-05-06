<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['tenant_id'])) {
    header("Location: logInSignUp.html");
    exit();
}

$tenant_id = $_SESSION['tenant_id'];
$building_id = $_POST['building_id'];


$check = "SELECT building_id FROM building WHERE building_id = '$building_id'";
$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) == 0) {
    echo "❌ Invalid Building ID";
    exit();
}

$sql = "UPDATE tenant 
        SET building_id = '$building_id' 
        WHERE tenant_id = '$tenant_id'";

if (mysqli_query($conn, $sql)) {
    header("Location: tenantHomePage.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>