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

$sql = "SELECT building_id FROM tenant WHERE tenant_id='$tenant_id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$building_id = $row['building_id'];

if (!$building_id) {
    die("No building assigned to this tenant");
}

$description = $_POST['description'];


$imageNames = [];

foreach ($_FILES['photo']['name'] as $key => $image) {

    $tmp = $_FILES['photo']['tmp_name'][$key];

    $path = "uploads/" . $image;

    move_uploaded_file($tmp, $path);

    $imageNames[] = $image;
}

$images = implode(",", $imageNames);


$sql = "INSERT INTO complain 
(status, photo, description, building_id,tenant_id)
VALUES
('pending', '$images', '$description', '$building_id','$tenant_id')";

if (mysqli_query($conn, $sql)) {
    header("Location: tenantHomePage.php");
    exit();
} else {
    echo " Error: " . mysqli_error($conn);
}

$conn->close();
?>