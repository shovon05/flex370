<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

/* ================= TENANT ID ================= */
$tenant_id = $_SESSION['tenant_id'] ?? 0;

/* ================= FETCH REQUESTS ================= */
$sql = "SELECT 
            rr.request_id,
            rr.status,
            rr.created_at,
            t.room_count,
            t.rent,
            b.building_name,
            o.full_name AS owner_name
        FROM rental_request rr
        JOIN to_let t ON rr.let_id = t.let_id
        JOIN building b ON t.building_id = b.building_id
        JOIN owner o ON rr.owner_id = o.owner_id
        WHERE rr.tenant_id = '$tenant_id'
        ORDER BY rr.request_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Requests</title>

    <style>
        body{
            font-family: Arial;
            background:#f4f6f9;
            padding:20px;
        }

        .card{
            background:white;
            padding:15px;
            margin-bottom:15px;
            border-radius:10px;
            box-shadow:0 5px 10px rgba(0,0,0,0.1);
        }

        .status{
            font-weight:bold;
        }

        .pending{ color:orange; }
        .accepted{ color:green; }
        .rejected{ color:red; }

        .pay-btn{
            padding:8px 12px;
            background:darkorange;
            color:white;
            border:none;
            border-radius:5px;
            text-decoration:none;
            display:inline-block;
            margin-top:10px;
        }
    </style>
</head>

<body>

<h2>My Rental Requests</h2>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card">

    <p><b>Building:</b> <?= $row['building_name'] ?></p>
    <p><b>Owner:</b> <?= $row['owner_name'] ?></p>
    <p><b>Rent:</b> <?= $row['rent'] ?></p>
    <p><b>Status:</b> 
        <span class="status 
        <?= strtolower($row['status']) ?>">
            <?= $row['status'] ?>
        </span>
    </p>

    <!-- ================= PAYMENT BUTTON ================= -->
    <?php if($row['status'] == 'Accepted') { ?>

        <a class="pay-btn" href="payment.php?request_id=<?= $row['request_id'] ?>">
            Pay Now
        </a>

    <?php } ?>

</div>

<?php } ?>

</body>
</html>