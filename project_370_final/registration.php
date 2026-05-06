<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "project_370";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$owner_id = $_SESSION['owner_id'];

$building_name = $_POST['building_name'] ?? '';
$address = $_POST['address'];
$material = $_POST['material'];
$floors = $_POST['floors'];
$year = $_POST['year'];
$date = $_POST['date'];

$stair_case = isset($_POST['stair_case']) ? 1 : 0;
$fire_exit = isset($_POST['fire_exit']) ? 1 : 0;
$assembly_point = isset($_POST['assembly_point']) ? 1 : 0;


$check = "SELECT * FROM building 
          WHERE building_name = '$building_name' 
          AND total_floor = '$floors'";

$result = $conn->query($check);

if ($result->num_rows > 0) {

    echo "This building name with same floor already exists!";
    exit();

} else {

    $sql = "INSERT INTO building
    (owner_id, building_name, address, built_material, total_floor, construction_year, owns_date)
    VALUES
    ('$owner_id', '$building_name', '$address', '$material', '$floors', '$year', '$date')";

    if ($conn->query($sql) === TRUE) {

       
        $building_id = $conn->insert_id;

        
        $facility_sql = "INSERT INTO emergency_facility
        (building_id, fire_exit, stair_case, assembly_point)
        VALUES
        ('$building_id', '$fire_exit', '$stair_case', '$assembly_point')";

        if ($conn->query($facility_sql) === TRUE) {

            header("Location: ownerHomePage.php");
            exit();

        } else {

            echo "Emergency Facility Insert Failed: " . $conn->error;
        }

    } else {

        echo "Registration Failed: " . $conn->error;
    }
}

$conn->close();
?>