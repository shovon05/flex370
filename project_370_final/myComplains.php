<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

if (!isset($_SESSION['tenant_id'])) {
    header("Location: login.php");
    exit();
}

$tenant_id = $_SESSION['tenant_id'];

$sql = "SELECT 
            c.complain_id,
            c.description,
            c.status,
            c.photo,
            b.building_name
        FROM complain c
        JOIN building b ON c.building_id = b.building_id
        WHERE c.tenant_id = $tenant_id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Complains</title>
    <link rel="stylesheet" href="myComplains.css">
</head>

<body>

<div class="main">

    <a href="tenantHomePage.php" class="back-btn">← Back</a>

    <h2>My Complains</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Building</th>
            <th>Description</th>
            <th>Status</th>
            <th>Photo</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['complain_id'] ?></td>
            <td><?= $row['building_name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="uploads/<?= $row['photo'] ?>" target="_blank">
                    View
                </a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5'>No complaints found</td></tr>";
        }
        ?>

    </table>

</div>

</body>
</html>