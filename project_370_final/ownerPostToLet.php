<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

/* ================= CHECK OWNER LOGIN ================= */
if (!isset($_SESSION['owner_id'])) {
    header("Location: login.php");
    exit();
}

$owner_id = $_SESSION['owner_id'];

/* ================= INSERT TO LET ================= */
$message = "";

if (isset($_POST['submit'])) {

    $building_id = $_POST['building_id'];
    $room_count  = $_POST['room_count'];
    $rent        = $_POST['rent'];
    $description = $_POST['description'];

    $sql = "INSERT INTO to_let 
            (building_id, owner_id, room_count, rent, description)
            VALUES 
            ('$building_id', '$owner_id', '$room_count', '$rent', '$description')";

    if (mysqli_query($conn, $sql)) {
        $message = "✅ To-Let Posted Successfully!";
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post To-Let</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #1e1e2f;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            background: #1e1e2f;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        button:hover {
            background: #34345a;
        }

        .msg {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
            color: green;
        }

    </style>
</head>

<body>

<div class="box">

    <h2>Post To-Let</h2>

    <!-- MESSAGE -->
    <?php if ($message != "") { ?>
        <div class="msg"><?= $message ?></div>
    <?php } ?>

    <form method="POST">

        <input type="number" name="building_id" placeholder="Building ID" required>

        <input type="number" name="room_count" placeholder="Number of Rooms" required>

        <input type="number" name="rent" placeholder="Rent Amount" required>

        <textarea name="description" placeholder="Description" required></textarea>

        <button type="submit" name="submit">Post To-Let</button>

    </form>

</div>

</body>
</html>