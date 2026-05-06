<?php
session_start();
include "config.php";


if(isset($_SESSION['owner_id'])){
    $table = "owner";
    $id_col = "owner_id";
    $id = $_SESSION['owner_id'];
}
elseif(isset($_SESSION['tenant_id'])){
    $table = "tenant";
    $id_col = "tenant_id";
    $id = $_SESSION['tenant_id'];
}
elseif(isset($_SESSION['inspector_id'])){
    $table = "inspector";
    $id_col = "inspector_id";
    $id = $_SESSION['inspector_id'];
}
else{
    die("No user logged in");
}



$sql = "SELECT * FROM $table WHERE $id_col='$id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>

    <link rel="stylesheet" href="profile.css">
</head>

<body>

<h2>My Profile</h2>

<form action="update_profile.php" method="POST">

<input type="hidden" name="table" value="<?php echo $table; ?>">
<input type="hidden" name="id_col" value="<?php echo $id_col; ?>">
<input type="hidden" name="id" value="<?php echo $user[$id_col]; ?>">

Name:<br>
<input type="text" name="name" value="<?php echo $user['full_name']; ?>"><br><br>

Email:<br>
<input type="email" name="email" value="<?php echo $user['email']; ?>"><br><br>

Phone:<br>
<input type="text" name="phone" value="<?php echo $user['phone_number']; ?>"><br><br>

<?php if($table=="owner"){ ?>
Address:<br>
<input type="text" name="address" value="<?php echo $user['present_address']; ?>"><br><br>
<a href="ownerHomePage.php" class="back-btn">Back</a>
<?php } ?>

<?php if($table=="tenant"){ ?>
Moving Date:<br>
<input type="date" name="moving_date" value="<?php echo $user['moving_date']; ?>"><br><br>
<a href="tenantHomePage.php" class="back-btn">Back</a>
<?php } ?>
<button type="submit">Update</button>
</form>

</body>
</html>