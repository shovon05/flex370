<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}


$tenant_id = $_SESSION['tenant_id'] ?? 0;


$sql = "SELECT 
            t.let_id,
            t.owner_id,
            t.building_id,
            t.room_count,
            t.rent,
            t.description,
            t.status,
            b.building_name,
            o.full_name AS owner_name
        FROM to_let t
        JOIN building b ON t.building_id = b.building_id
        JOIN owner o ON t.owner_id = o.owner_id
        WHERE t.status = 'Available'
        ORDER BY t.let_id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Let Listings</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #1e1e2f;
            margin-bottom: 20px;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #1e1e2f;
        }

        .info {
            font-size: 14px;
            margin: 5px 0;
            color: #444;
        }

        .rent {
            color: darkorange;
            font-weight: bold;
        }

        .status {
            background: #1e1e2f;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 12px;
        }

        .request-btn {
            width: 100%;
            padding: 8px;
            border: none;
            background: darkorange;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .request-btn:hover {
            background: #ff8800;
        }
    </style>
</head>

<body>

<h2>Available To-Let Listings</h2>

<div class="card-container">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card">

        <div class="title">
            <?= htmlspecialchars($row['building_name']) ?>
        </div>

        <div class="info">
            Owner: <?= htmlspecialchars($row['owner_name']) ?>
        </div>

        <div class="info">
            Rooms: <?= htmlspecialchars($row['room_count']) ?>
        </div>

        <div class="info rent">
            Rent: <?= htmlspecialchars($row['rent']) ?> BDT
        </div>

        <div class="info">
            <?= htmlspecialchars($row['description']) ?>
        </div>

        <div class="info">
            Status: <span class="status"><?= htmlspecialchars($row['status']) ?></span>
        </div>

        
        <form method="POST" action="requestToLet.php">
            <input type="hidden" name="let_id" value="<?= htmlspecialchars($row['let_id']) ?>">
            <input type="hidden" name="tenant_id" value="<?= htmlspecialchars($tenant_id) ?>">
            <input type="hidden" name="owner_id" value="<?= htmlspecialchars($row['owner_id']) ?>">

            <button class="request-btn" type="submit">Request</button>
        </form>

    </div>

<?php } ?>

</div>

</body>
</html>