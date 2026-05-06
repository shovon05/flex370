<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

/* ================= GET DATA ================= */
$request_id = $_POST['request_id'] ?? 0;
$action = $_POST['action'] ?? '';

if ($request_id == 0 || $action == '') {
    header("Location: tenantHomePage.php");
    exit();
}

/* ================= UPDATE REQUEST STATUS ================= */
$sql = "UPDATE rental_request 
        SET status = '$action' 
        WHERE request_id = '$request_id'";

if (mysqli_query($conn, $sql)) {

    echo "<script>
        alert('Request $action Successfully!');
        window.location.href='ownerHomePage.php';
    </script>";

} else {
    echo "Error: " . mysqli_error($conn);
}
?>