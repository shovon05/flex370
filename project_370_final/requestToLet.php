<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed: " . mysqli_connect_error());
}

/* ================= CHECK LOGIN ================= */
if (!isset($_SESSION['tenant_id'])) {
    die("You must login as tenant first.");
}

/* ================= GET DATA FROM FORM ================= */
$let_id = $_POST['let_id'] ?? 0;
$tenant_id = $_POST['tenant_id'] ?? 0;
$owner_id = $_POST['owner_id'] ?? 0;

/* ================= VALIDATION ================= */
if ($let_id == 0 || $tenant_id == 0 || $owner_id == 0) {
    die("Invalid request data.");
}

/* ================= CHECK DUPLICATE REQUEST ================= */
$check = "SELECT * FROM rental_request 
          WHERE let_id='$let_id' 
          AND tenant_id='$tenant_id'";

$checkResult = mysqli_query($conn, $check);

if (mysqli_num_rows($checkResult) > 0) {

    echo "<script>
        alert('You already sent a request for this property!');
        window.location.href='vacancy.php';
    </script>";

    exit();
}

/* ================= INSERT REQUEST ================= */
$sql = "INSERT INTO rental_request 
        (let_id, tenant_id, owner_id, status)
        VALUES 
        ('$let_id', '$tenant_id', '$owner_id', 'Pending')";

if (mysqli_query($conn, $sql)) {

    echo "<script>
        alert('Request Sent Successfully!');
        window.location.href='vacancy.php';
    </script>";

} else {
    echo "Error: " . mysqli_error($conn);
}
?>