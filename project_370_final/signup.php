<?php

$conn = mysqli_connect("localhost", "root", "", "project_370");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// basic check
if (empty($fullname) || empty($email) || empty($password) || empty($role)) {
    die("All fields required");
}

if ($role == "Owner") {

    $sql = "INSERT INTO owner (full_name, email, password)
            VALUES ('$fullname', '$email', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: logInSignUp.html");
        exit();
    } else {
        echo mysqli_error($conn);
    }

}

elseif ($role == "Tenant") {

    $sql = "INSERT INTO tenant (full_name, email, password)
            VALUES ('$fullname', '$email', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: logInSignUp.html");
        exit();
    } else {
        echo mysqli_error($conn);
    }

}

elseif ($role == "Admin") {

    $sql = "INSERT INTO admin (full_name, email, password)
            VALUES ('$fullname', '$email', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: logInSignUp.html");
        exit();
    } else {
        echo mysqli_error($conn);
    }

}

elseif ($role == "Inspector") {

    $sql = "INSERT INTO inspector (full_name, email, password)
            VALUES ('$fullname', '$email', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:logInSignUp.html");
        exit();
    } else {
        echo mysqli_error($conn);
    }

} else {
    echo "Invalid Role";
}

mysqli_close($conn);

?>
