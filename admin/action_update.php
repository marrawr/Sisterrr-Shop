<?php
  include('include/config.php');
  
$id=$_GET['staff'];
$srole=$_POST['srole'];

  $sql="update orders set orderStatus='$srole' where id='$id'";
  $con->query($sql);

  echo "<script
  type='text/jscript'>alert('Update status!')</script>";
  header('refresh:1 url=todays-orders.php');
?>