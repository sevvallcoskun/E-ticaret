<?php
session_start();

include("inc/db.php");

$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$pass=$_POST['pass'];
$ins="INSERT INTO customer SET name='$name',email='$email',phone='$phone',password='$pass'";
$con->query($ins);



?>

<script >
	alert("Üyelik başarıyla gerçekleştirildi");
	window.location='index.php';
</script>
