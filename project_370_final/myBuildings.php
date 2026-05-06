<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

if (!isset($_SESSION['owner_id'])) {
    header("Location: login.php");
    exit();
}

$owner_id = $_SESSION['owner_id'];

/* ================= GET BUILDINGS ================= */
$sql = "SELECT 
            b.building_id,
            b.building_name,
            b.address,
            b.total_floor,
            b.construction_year,
            b.built_material,
            COUNT(c.complain_id) AS total_complain
        FROM building b
        LEFT JOIN complain c ON b.building_id = c.building_id
        WHERE b.owner_id = $owner_id
        GROUP BY b.building_id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Buildings</title>
    <link rel="stylesheet" href="myBuildings.css">
</head>

<body>

<h2>My Buildings with Risk Score</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>Floors</th>
    <th>Year</th>
    <th>Material</th>
    <th>Risk Score</th>
    <th>Status</th>
</tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {

    $fire_exit = $row['fire_exit'] ?? 0;
    $stair_case = $row['stair_case'] ?? 0;
    $assembly_point = $row['assembly_point'] ?? 0;
    $complain = $row['total_complain'] ?? 0;

    $facility_count = 0;
    if($fire_exit) $facility_count++;
    if($stair_case) $facility_count++;
    if($assembly_point) $facility_count++;

    if($facility_count == 3) $facility_score = 0;
    elseif($facility_count == 2) $facility_score = 0.4;
    elseif($facility_count == 1) $facility_score = 0.7;
    else $facility_score = 0;

    $material = strtolower(trim($row['built_material'] ?? ''));

    if($material == "steel structure") $material_score =1;
    elseif($material == "brick") $material_score = 0.6;
    elseif($material == "mixed") $material_score = 0.3;
    elseif($material == "concrete") $material_score = 0.1;
    else $material_score = 0.5;

    $year = $row['construction_year'] ?? 0;

    if($year > 2015) $construction_score = 0.2;
    elseif($year >= 2000) $construction_score = 0.5;
    else $construction_score = 1;

    if($complain == 0) $complain_score = 0;
    elseif($complain <= 3) $complain_score = 0.5;
    else $complain_score = 1;

    $floor = $row['total_floor'] ?? 0;

    if($floor <= 3) $floor_score = 0.2;
    elseif($floor <= 7) $floor_score = 0.5;
    else $floor_score = 1;

    $risk_score = ($facility_score + $material_score + $construction_score + $floor_score + $complain_score) / 5;

    if($risk_score <= 0.3) $status = "LOW";
    elseif($risk_score <= 0.6) $status = "MEDIUM";
    else $status = "HIGH";
?>

<tr>
    <td><?= $row['building_id'] ?></td>
    <td><?= $row['building_name'] ?></td>
    <td><?= $row['address'] ?></td>
    <td><?= $floor ?></td>
    <td><?= $year ?></td>
    <td><?= $row['built_material'] ?></td>
    <td><?= number_format($risk_score, 2) ?></td>
    <td><?= $status ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>