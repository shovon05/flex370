<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['inspector_id'])) {
    die("Inspector not logged in!");
}

$inspector_id = $_SESSION['inspector_id'];

$sql = "SELECT 
            c.complain_id,
            c.description,
            c.photo,
            t.full_name,
            t.email,
            t.phone_number,
            b.building_name
        FROM complain c
        JOIN tenant t ON c.tenant_id = t.tenant_id
        JOIN building b ON c.building_id = b.building_id
        WHERE c.inspector_id = $inspector_id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>