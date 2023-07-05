<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manager | Sales Report</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<?php include('include/header.php');?>

        

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
								<h3>Generate Report</h3>
							</div>
							<div class="module-body table">
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />
    
    
    
<form class="form-horizontal row-fluid" name="bwdatesdata" action="" method="post" action="">
	
<div class="control-group">
<label class="control-label" for="basicinput">From Date :</label>
<div class="controls">
<input type="date" name="fdate" class="form-control" id="fdate">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">To Date :</label>
<div class="controls">
<input type="date" name="tdate" class="form-control" id="tdate">
</div>
</div>

<div class="control-group">
<label class="control-label" scope="row">Request Type :</label>
<div class="controls">
<input type="radio" name="requesttype" value="mtwise" checked="true">Month wise</td>
<input type="radio" name="requesttype" value="yrwise">Year wise</td>
</div>
</div>

<div class="control-group">
<div class="controls">
<button type="submit" name="submit" class="btn">Submit</button></td>
</div>
</div>
     </form>
	 </div>


</div><!--/.content-->

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
									


    <div class="row">
      <div class="col-xs-12">
      	 <?php
      	 if(isset($_POST['submit']))
{ 
$fdate=$_POST['fdate'];
$tdate=$_POST['tdate'];
$rtype=$_POST['requesttype'];
?>
<?php if($rtype=='mtwise'){
$month1=strtotime($fdate);
$month2=strtotime($tdate);
$m1=date("F",$month1);
$m2=date("F",$month2);
$y1=date("Y",$month1);
$y2=date("Y",$month2);
    ?>
    
    <div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
                            <h3>Sales Report Month Wise</h3>
							</div>
							<div class="module-body table">
  


<h4 align="center" style="color:chocolate">Sales Report  from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h4>
<hr >
<div class="row">
<table class="table table-bordered" width="100%"  border="0" style="padding-left:40px">
<th>S.NO</th>
<th>Month / Year </th>
<th>Sales</th>



<?php
$ret=mysqli_query($con,"select month(orderDate) as onemonth, year(orderDate) as oneyear,
products.productPrice,orders.quantity from orders 
join products on products.id=orders.productId 
where date(orders.orderDate) between '$fdate' and '$tdate' 
group by onemonth, oneyear");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
 
?>
<tbody>
<tr>
        <td><?php echo $cnt;?></td>
        <td><?php  echo $row['onemonth']."/".$row['oneyear'];?></td>
        <td><?php  echo $total=$row['productPrice']*$row['quantity'];?></td>
</tr>
<?php
$ftotal+=$total;
$cnt++;
}?>

              <td colspan="2" align="center">Total </td>
              <td><?php  echo $ftotal;?></td>
                </tr>             
               </tbody>
</table>

<table>
<?php } } else {
$year1=strtotime($fdate);
$year2=strtotime($tdate);
$y1=date("Y",$year1);
$y2=date("Y",$year2);
?>
<div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
                            <h3>Sales Report Year Wise</h3>
							</div>
							<div class="module-body table">

<h4 align="center" style="color:chocolate">Sales Report  from <?php echo $y1;?> to <?php echo $y2;?></h4>
        <hr >
<div class="row">
<table class="table table-bordered" width="100%"  border="0" style="padding-left:40px">
<thead>
<th>S.NO</th>
<th>Year </th>
<th>Sales</th>

</thead>
<?php

$ret=mysqli_query($con,"select month(orderDate) as onemonth, year(orderDate) as oneyear,
products.productPrice, orders.quantity from orders 
join products on products.ID=orders.productId 
where date(orders.orderDate) between '$fdate' and '$tdate'
group by oneyear ");

$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
<tbody>
<tr>
<td><?php echo $cnt;?></td>
<td><?php  echo $row['oneyear'];?></td>
<td><?php  echo $total=$row['productPrice']*$row['quantity'];?></td>
</tr>
<?php
$ftotal+=$total;
$cnt++;
}?>
<tr>
<td colspan="2" align="center">Total </td>
<td><?php  echo $ftotal;?></td>
</tr>             
 </tbody>
</table>  <?php } } }?>  

</table>
	
				
				</div><!--/.content-->
			</div><!--/.span9-->
		</div><!--/.container-->
		
	</div>
	</div><!--/.wrapper-->

	


<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
	
</body>
<?php } ?>