<?php
$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("DB Connection Failed");
}

$search = trim($_GET['search'] ?? '');

if ($search == '') {

    $sql = "SELECT 
                b.*,
                o.full_name,
                COUNT(c.complain_id) AS total_complain
            FROM building b
            JOIN owner o ON b.owner_id = o.owner_id
            LEFT JOIN complain c ON b.building_id = c.building_id
            GROUP BY b.building_id";

} else {

    $sql = "SELECT 
                b.*,
                o.full_name,
                COUNT(c.complain_id) AS total_complain
            FROM building b
            JOIN owner o ON b.owner_id = o.owner_id
            LEFT JOIN complain c ON b.building_id = c.building_id
            WHERE b.building_name LIKE '%$search%'
            GROUP BY b.building_id";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Risk Report</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        form {
            margin-bottom: 15px;
        }

        input[type="text"] {
            padding: 10px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 15px;
            background: #1e1e2f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #34345a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #1e1e2f;
            color: white;
        }
    </style>
</head>

<body>

<h2>Building Risk Report</h2>

<!-- search-->
<form method="GET" id="searchForm">
    <input type="text"
           name="search"
           id="searchInput"
           value="<?= $search ?>"
           placeholder="Search by Building Name">
    
    <button type="submit">Search</button>
</form>

<table>
<tr>
    <th>Building ID</th>
    <th>Building Name</th>
    <th>Owner Name</th>
    <th>Risk Score</th>
    <th>Risk Level</th>
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
    <td><?= $row['full_name'] ?></td>
    <td><?= number_format($risk_score, 2) ?></td>
    <td><?= $status ?></td>
</tr>

<?php } ?>

</table>


<script>
document.getElementById("searchInput").addEventListener("input", function () {
    if (this.value.trim() === "") {
        window.location = "risk.php";
    }
});
</script>

</body>
</html>