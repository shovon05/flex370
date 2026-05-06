<?php
session_start();
$conn = mysqli_connect("localhost","root","","project_370");

if (!$conn) {
    die("DB Connection Failed");
}

/* ================= GET REQUEST ID ================= */
$request_id = $_GET['request_id'] ?? $_POST['request_id'] ?? null;

if (!$request_id) {
    die("Invalid request - missing request_id");
}

/* ================= PROCESS PAYMENT ================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['amount'])) {

    include "config.php";

    $amount = $_POST['amount'];
    $tran_id = "TXN" . uniqid();

    // save pending payment first (optional but good)
    $insert = "INSERT INTO payment 
        (request_id, amount, payment_method, status, created_at)
        VALUES 
        ('$request_id', '$amount', 'SSLCommerz', 'Pending', NOW())";

    mysqli_query($conn, $insert);

    /* ================= SSL COMMERZ ================= */
    $data = array(
        'store_id' => $store_id,
        'store_passwd' => $store_passwd,
        'total_amount' => $amount,
        'currency' => "BDT",
        'tran_id' => $tran_id,
        'success_url' => "http://localhost/project_370_final/success.php",
        'fail_url' => "http://localhost/project_370_final/fail.php",
        'cancel_url' => "http://localhost/project_370_final/cancel.php",
        'cus_name' => "Test User",
        'cus_email' => "test@mail.com",
        'cus_add1' => "Dhaka",
        'cus_phone' => "01700000000"
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://sandbox.sslcommerz.com/gwprocess/v4/api.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    if (isset($result['GatewayPageURL'])) {
        header("Location: " . $result['GatewayPageURL']);
        exit();
    } else {
        echo "Gateway Error!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>

    <style>
        body{
            font-family: Arial;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            padding:20px;
        }

        .box{
            background:white;
            padding:20px;
            width:300px;
            margin:auto;
            margin-top:50px;
            border-radius:10px;
            text-align:center;
        }

        input, select{
            width:100%;
            padding:10px;
            margin:10px 0;
        }

        button{
            width:100%;
            padding:10px;
            background:#4facfe;
            color:white;
            border:none;
            cursor:pointer;
        }

        button:hover{
            background:#007bff;
        }
    </style>
</head>

<body>

<div class="box">

<h2>Payment Page</h2>

<form method="POST">
    <input type="hidden" name="request_id" value="<?= $request_id ?>">

    <input type="number" name="amount" placeholder="Enter Amount" required>

    <button type="submit">Pay Now</button>
</form>

</div>

</body>
</html>