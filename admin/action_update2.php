<?php
  include('include/config.php');
  
$id=$_GET['staff'];
$srole=$_POST['srole'];
$pp=$_POST['payment2'];



  $sql="update orders set orderStatus='$srole',statuspayment='$pp' where id='$id'";
  $con->query($sql);

  echo "<script
  type='text/jscript'>alert('Update status!')</script>";
  header('refresh:1 url=pending-orders.php');
?>