<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

//Inspector Add
if (isset($_POST['add_inspector'])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $exp_year = $_POST['exp_year'];
    $certification_num = $_POST['certification_num'];
    $password = $_POST['password'];

    mysqli_query($conn, "INSERT INTO inspector 
    (full_name, email, phone_number, exp_year, certification_num, password)
    VALUES 
    ('$full_name', '$email', '$phone_number', '$exp_year', '$certification_num', '$password')");
}

//Building Add
if (isset($_POST['add_building'])) {

    $building_name = $_POST['building_name'];
    $address = $_POST['address'];
    $owner_id = $_POST['owner_id'];
    $total_floor = $_POST['total_floor'];
    $construction_year = $_POST['construction_year'];
    $built_material = $_POST['built_material'];
    $owns_date = $_POST['owns_date'];

    mysqli_query($conn, "INSERT INTO building 
    (building_name, address, owner_id, total_floor, construction_year, built_material, owns_date)
    VALUES 
    ('$building_name', '$address', '$owner_id', '$total_floor', '$construction_year', '$built_material', '$owns_date')");
}

//Delete Building
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM building WHERE building_id=$id");
}

//Assigned Inspector to a complain
if (isset($_POST['assign_inspector'])) {

    $cid = $_POST['complain_id'];
    $iid = $_POST['inspector_id'];
    $assigned_date = $_POST['assigned_date'];

    mysqli_query($conn, "UPDATE complain 
        SET inspector_id='$iid',
            assigned_date='$assigned_date'
        WHERE complain_id='$cid'");
}

//For display all data
$buildings = mysqli_query($conn, "SELECT * FROM building order by building_name asc");
$complains = mysqli_query($conn, "SELECT * FROM complain");
$inspectors = mysqli_query($conn, "SELECT * FROM inspector");
$owners = mysqli_query($conn, "SELECT owner_id FROM owner");

$total_buildings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM building"))['total'];
$total_complaints = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM complain"))['total'];
$solved_complains = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM complain WHERE status='Solved'"))['total'];
$working_complains = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM complain WHERE status='Working'"))['total'];
$pending_complains = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM complain WHERE status='Pending'"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminHomePage.css">
</head>

<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="#add">Add Building</a>
    <a href="#building">Buildings</a>
    <a href="#addInsp">Add Inspector</a>
    <a href="#inspectors">Inspectors</a>
    <a href="#complain">Complaints</a>
    <a href="logOut.php">Logout</a>
</div>

<div class="main">

<h1>Admin Dashboard</h1>


<section id="add">
<h2>Add Building</h2>

<form method="POST">
<input type="text" name="building_name" placeholder="Building Name" required>
<input type="text" name="address" placeholder="Address" required>

<select name="owner_id" required>
<option value="">Select Owner</option>
<?php while($o = mysqli_fetch_assoc($owners)) { ?>
<option value="<?= $o['owner_id'] ?>"><?= $o['owner_id'] ?></option>
<?php } ?>
</select>

<input type="number" name="total_floor" placeholder="Total Floor" required>
<input type="number" name="construction_year" placeholder="Year" required>

<select name="built_material" required>
<option value="">Material</option>
<option>Brick</option>
<option>Concrete</option>
<option>Steel</option>
<option>Mixed</option>
</select>

<input type="date" name="owns_date" required>

<button name="add_building">Add Building</button>
</form>
</section>

<hr>


<section id="building">
<h2>Buildings</h2>

<table>
<tr>
<th>ID</th><th>Name</th><th>Address</th><th>Owner</th><th>Floor</th><th>Year</th><th>Material</th><th>Date</th><th>Action</th>
</tr>

<?php while($b = mysqli_fetch_assoc($buildings)) { ?>
<tr>
<td><?= $b['building_id'] ?></td>
<td><?= $b['building_name'] ?></td>
<td><?= $b['address'] ?></td>
<td><?= $b['owner_id'] ?></td>
<td><?= $b['total_floor'] ?></td>
<td><?= $b['construction_year'] ?></td>
<td><?= $b['built_material'] ?></td>
<td><?= $b['owns_date'] ?></td>
<td><a href="?delete=<?= $b['building_id'] ?>">Delete</a></td>
</tr>
<?php } ?>
</table>

<div class="summary-box">
Total Buildings: <?= $total_buildings ?>
</div>

</section>

<hr>


<section id="addInsp">
<h2>Add Inspector</h2>

<form method="POST">
<input type="text" name="full_name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="text" name="phone_number" placeholder="Phone" required>
<input type="number" name="exp_year" placeholder="Experience" required>
<input type="text" name="certification_num" placeholder="Certification" required>
<input type="password" name="password" placeholder="Password" required>

<button name="add_inspector">Add Inspector</button>
</form>
</section>

<hr>


<section id="inspectors">
<h2>Inspectors</h2>

<table>
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Experience</th>
</tr>

<?php
$insp = mysqli_query($conn, "SELECT * FROM inspector");
while($i = mysqli_fetch_assoc($insp)) {
?>
<tr>
<td><?= $i['inspector_id'] ?></td>
<td><?= $i['full_name'] ?></td>
<td><?= $i['email'] ?></td>
<td><?= $i['phone_number'] ?></td>
<td><?= $i['exp_year'] ?></td>
</tr>
<?php } ?>

</table>
</section>

<hr>


<section id="complain">
<h2>Complaints</h2>

<table>
<tr>
<th>ID</th>
<th>Description</th>
<th>Status</th>
<th>Inspector</th>
<th>Date</th>
<th>Assign</th>
<th>Feedback</th>
</tr>

<?php while($c = mysqli_fetch_assoc($complains)) { ?>
<tr>
<td><?= $c['complain_id'] ?></td>
<td><?= $c['description'] ?></td>
<td><?= $c['status'] ?></td>
<td><?= $c['inspector_id'] ?></td>
<td><?= $c['assigned_date'] ?></td>

<td>
<form method="POST">
<input type="hidden" name="complain_id" value="<?= $c['complain_id'] ?>">

<select name="inspector_id" required>
<option value="">Select Inspector</option>

<?php
mysqli_data_seek($inspectors, 0);
while($i = mysqli_fetch_assoc($inspectors)) {
?>
<option value="<?= $i['inspector_id'] ?>">
<?= $i['inspector_id'] ?>
</option>
<?php } ?>
</select>

<input type="date" name="assigned_date" required>

<button name="assign_inspector">Assign</button>
</form>
</td>
<td><?= $c['feedback'] ?? 'No feedback yet' ?></td>
</tr>
<?php } ?>

</table>

<div class="summary-box">Total Complains: <?= $total_complaints ?></div>
<div class="summary-box">Solved Complains: <?= $solved_complains ?></div>
<div class="summary-box">Working Complains: <?= $working_complains ?></div>
<div class="summary-box">Pending Complains: <?= $pending_complains ?></div>

</section>

</div>

</body>
</html>