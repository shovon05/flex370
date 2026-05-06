<?php
include "config.php";

$table = $_POST['table'];
$id_col = $_POST['id_col'];
$id = $_POST['id'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$extra = "";

if($table=="owner"){
    $extra = ", present_address='".$_POST['address']."'";
}
elseif($table=="tenant"){
    $extra = ", moving_date='".$_POST['moving_date']."'";
}
elseif($table=="inspector"){
    $extra = ", exp_year='".$_POST['exp_year']."',
               certification_num='".$_POST['certification_num']."'";
}

$sql = "UPDATE $table SET 
        full_name='$name',
        email='$email',
        phone_number='$phone'
        $extra
        WHERE $id_col='$id'";

mysqli_query($conn, $sql);

if($table=="owner"){
    header("Location: ownerHomePage.php");
}
elseif($table=="tenant"){
    header("Location: tenantHomePage.php");
}
exit();
?>