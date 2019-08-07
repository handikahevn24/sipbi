<?php
session_start();
include "config/db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query_login = mysqli_query($con,"SELECT * FROM user where username='$username' and password='$password'")or die(mysql_error());
$row = mysqli_fetch_array($query_login);
if($query_login){
    $_SESSION['nama_user'] = $row['nama_user'];
    header('location: admin/index.php');
}

?>
