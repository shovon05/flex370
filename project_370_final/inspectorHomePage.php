<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['inspector_id'])) {
    header("Location: logInSignUp.html");
    exit();
}

$inspector_id = $_SESSION['inspector_id'];

//Update status with Feedback
if (isset($_POST['update_status'])) {

    $complain_id = $_POST['complain_id'];
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];

    $photo_name = "";

    //feedBack Photo uplaod
    if (!empty($_FILES['feedback_photo']['name'])) {

        $photo_name = time() . "_" . $_FILES['feedback_photo']['name'];
        $tmp = $_FILES['feedback_photo']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $photo_name);
    }

    $sql = "UPDATE complain 
            SET status='$status',
                feedback='$feedback'";

    if ($photo_name != "") {
        $sql .= ", feedback_photo='$photo_name'";
    }

    $sql .= " WHERE complain_id='$complain_id'
              AND inspector_id=$inspector_id";

    mysqli_query($conn, $sql);
}

//Complain Table
$sql = "SELECT 
            c.complain_id,
            c.description,
            c.photo,
            c.status,
            c.feedback,
            c.feedback_photo,
            t.full_name,
            t.email,
            t.phone_number,
            b.building_name,
            b.address
        FROM complain c
        JOIN tenant t ON c.tenant_id = t.tenant_id
        JOIN building b ON c.building_id = b.building_id
        WHERE c.inspector_id = $inspector_id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inspector Dashboard</title>
    <link rel="stylesheet" href="inspectorHomePage.css">

    <style>
        textarea {
            width: 100%;
            height: 60px;
            margin-top: 5px;
        }

        .thumb {
            width: 60px;
            border-radius: 5px;
        }

        .feedback-img {
            width: 60px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>Inspector Panel</h2>
    <a href="#">My Complaints</a>
    <a href="logOut.php">Logout</a>
</div>

<div class="main">
    <h1 class="name">My Assigned Complaints</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Tenant</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Building</th>
            <th>Address</th>
            <th>Complain</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Feedback</th>
            <th>feedBack Photo</th>
            <th>Update</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['complain_id'] ?></td>
            <td><?= $row['full_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td><?= $row['building_name'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['description'] ?></td>

            <td>
                <a href="uploads/<?= $row['photo'] ?>" target="_blank">
                    <img src="uploads/<?= $row['photo'] ?>" class="thumb">
                </a>
            </td>

            <td><?= $row['status'] ?></td>

            <td><?= $row['feedback'] ?? 'No feedback' ?></td>

            <td>
                <?php if(!empty($row['feedback_photo'])) { ?>
                    <img src="uploads/<?= $row['feedback_photo'] ?>" class="feedback-img">
                <?php } else { echo "No Image"; } ?>
            </td>

            <td>
                <form method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="complain_id" value="<?= $row['complain_id'] ?>">

                    <select name="status" required>
                        <option value="">Select</option>
                        <option value="Pending">Pending</option>
                        <option value="Working">Working</option>
                        <option value="Solved">Solved</option>
                    </select>

                    <textarea name="feedback" placeholder="Write feedback..." required></textarea>

                    <input type="file" name="feedback_photo">

                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>

        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='12'>No complaints assigned yet</td></tr>";
        }
        ?>

    </table>
</div>

</body>
</html>