<?php
include "config.php";

$tran_id = $_GET['tran_id'] ?? null;
$status = $_GET['status'] ?? '';

if ($status == "") {

    $query = "UPDATE payment 
              SET status='Success'
              WHERE payment_method='SSLCommerz' 
              ORDER BY created_at DESC 
              LIMIT 1";

    mysqli_query($conn, $query);

    echo "<script>
        alert('Payment Successfully!');
        window.location.href='tenantHomePage.php';
        </script>";
} else {
    echo "<h2 style='color:red;text-align:center;'>Invalid Payment</h2>";
}
?>