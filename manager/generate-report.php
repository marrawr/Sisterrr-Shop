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
	

									<br />
    
    
    
<form class="form-horizontal row-fluid" name="bwdatesdata" action="" method="post" action="" autocomplete="off">
	
<div class="control-group">
<label class="control-label" for="basicinput">From Date :<?php echo $_POST['fdate']?></label>
<div class="controls">
<input type="text" class="form-control" id="fdate" name="fdate" data-date-format="yyyy-mm-dd">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">To Date :<?php echo $_POST['tdate'] ?></label>
<div class="controls">
<input type="text" class="form-control" id="tdate" name="tdate" data-date-format="yyyy-mm-dd">
</div>
</div>

<div class="control-group">
<div class="controls">
<button type="submit" name="submit" class="btn">Submit</button></td>
</div>
</div>
     </form>
	 </div>

     <?php
                    $select = $pdo->prepare("SELECT count(o.id) as order,
                    o.productId,
                    SUM(o.quantity * p.productPrice) AS subtotal
                    FROM orders o
                    JOIN products p ON o.productId = p.id
                    WHERE order_date BETWEEN :fromdate AND :todate
                    GROUP BY o.productId;");
                    $select->bindParam(':fromdate', $_POST['fdate']);
                    $select->bindParam(':todate', $_POST['tdate']);
                    $select->execute();

                    $row = $select->fetch(PDO::FETCH_OBJ);

                    $subtotal = $row->subtotal;

                    $orders = $row->orders;

                  ?>


</div><!--/.content-->

<div class="row">
                <div class="col-md-offset-2 col-md-4 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Total Items Sold</span>
                      <span class="info-box-number"><?php echo $orders; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-offset-1 col-md-5 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Sub Total</span>
                      <span class="info-box-number">RM.<?php echo number_format($subtotal,0) ; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <!-- /.col -->
              </div>

               <!--- Transaction Table -->
               <div style="overflow-x:auto;">
                  <table class="table table-striped" id="mySalesReport">
                      <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>Pendapatan</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                            $select = $pdo->prepare("SELECT * FROM orders WHERE orderDate BETWEEN :fromdate AND :todate");
                            $select->bindParam(':fromdate', $_POST['fdate']);
                            $select->bindParam(':todate', $_POST['tdate']);

                            $select->execute();
                            while($row=$select->fetch(PDO::FETCH_OBJ)){
                            ?>
                                <tr>
                                <td><?php echo $row->orderDate; ?></td>
                                <td>Rp. <?php echo number_format($row->subtotal); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                      </tbody>
                  </table>
              </div>

              <!-- Transaction Graphic -->
              <?php
                  $select = $pdo->prepare("SELECT orderDate, sum(subtotal) as total FROM orders WHERE orderDate BETWEEN :fromdate AND :todate
                  GROUP BY orderDate");
                  $select->bindParam(':fromdate', $_POST['fdate']);
                  $select->bindParam(':todate', $_POST['tdate']);
                  $select->execute();
                  $total=[];
                  $date=[];
                  while($row=$select->fetch(PDO::FETCH_ASSOC)){
                      extract($row);
                      $total[]=$total;
                      $date[]=$orderDate;

                  }
                  // echo json_encode($total);
              ?>

                <div class="chart">
                  <canvas id="myChart" style="height:250px;">

                  </canvas>
              </div>

              <?php
                  $select = $pdo->prepare("SELECT product_name, sum(qty) as q FROM tbl_invoice_detail WHERE order_date BETWEEN :fromdate AND :todate
                  GROUP BY product_id");
                  $select->bindParam(':fromdate', $_POST['date_1']);
                  $select->bindParam(':todate', $_POST['date_2']);
                  $select->execute();
                  $pname=[];
                  $qty=[];
                  while($row=$select->fetch(PDO::FETCH_ASSOC)){
                      extract($row);
                      $pname[]=$product_name;
                      $qty[]=$q;

                  }
                  // echo json_encode($total);
              ?>
              <div class="chart">

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
									


    <div class="row">
      <div class="col-xs-12">
      	

    
    <div class="span9">
					<div class="content">

	<div class="module">
							
							<div class="module-body table">
  



<hr >
<div class="row">


<table>

<div class="span9">
					<div class="content">

	<div class="module">
							
							<div class="module-body table">
        <hr >
<div class="row">
  <?php }?>  

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
<?php ?>