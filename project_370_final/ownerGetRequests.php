<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

/* ================= OWNER ID ================= */
$owner_id = $_SESSION['owner_id'] ?? 0;

/* ================= FETCH REQUESTS ================= */
$sql = "SELECT 
            rr.request_id,
            rr.status,
            rr.created_at,
            t.room_count,
            t.rent,
            b.building_name,
            tn.full_name AS tenant_name
        FROM rental_request rr
        JOIN to_let t ON rr.let_id = t.let_id
        JOIN building b ON t.building_id = b.building_id
        JOIN tenant tn ON rr.tenant_id = tn.tenant_id
        WHERE rr.owner_id = '$owner_id'
        ORDER BY rr.request_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Owner Requests</title>

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

        .btn{
            padding:8px 12px;
            border:none;
            cursor:pointer;
            border-radius:5px;
            color:white;
        }

        .accept{ background:green; }
        .reject{ background:red; }
    </style>
</head>

<body>

<h2>Tenant Requests</h2>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card">

    <p><b>Tenant:</b> <?= $row['tenant_name'] ?></p>
    <p><b>Building:</b> <?= $row['building_name'] ?></p>
    <p><b>Rent:</b> <?= $row['rent'] ?></p>
    <p><b>Rooms:</b> <?= $row['room_count'] ?></p>
    <p><b>Status:</b> <?= $row['status'] ?></p>

    <form method="POST" action="updateRequest.php">
        <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>">

        <button class="btn accept" name="action" value="Accepted">Accept</button>
        <button class="btn reject" name="action" value="Rejected">Reject</button>
    </form>

</div>

<?php } ?>

</body>
</html>