<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM owner WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    session_unset();

    $row = mysqli_fetch_assoc($result);

    $_SESSION['owner_id'] = $row['owner_id'];
    $_SESSION['user_name'] = $row['full_name'];

    header("Location: ownerHomePage.php"); 
    exit();
}


$sql = "SELECT * FROM tenant WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    session_unset();

    $row = mysqli_fetch_assoc($result);

    $_SESSION['tenant_id'] = $row['tenant_id'];
    $_SESSION['user_name'] = $row['full_name'];

    header("Location: tenantHomePage.php");
    exit();
}


$sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    session_unset();

    $row = mysqli_fetch_assoc($result);

    $_SESSION['admin_id'] = $row['admin_id'];

    header("Location: adminHomePage.php");
    exit();
}

$sql = "SELECT * FROM inspector WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    session_unset();

    $row = mysqli_fetch_assoc($result);

    $_SESSION['inspector_id'] = $row['inspector_id'];
    $_SESSION['user_name'] = $row['full_name'];

    header("Location: inspectorHomePage.php");
    exit();
}
else{
    header("Location: invalidLogIn.php");
    exit();
}

mysqli_close($conn);
?>