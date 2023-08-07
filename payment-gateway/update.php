<?php
include('../includes/config.php');

$id = $_GET['idd'];
$estatus = $_POST['balance'];

$sql = "update dummybank set balance='$estatus' where customer_id='$id'";
$con->query($sql);

echo "<script
	type='text/jscript'>alert('Successfull Payment')</script>";
header('refresh:1 url=../todays-order-history.php');
?>