
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
    
    
									<form method="POST" action="generate_report.php">
        <label for="report_type">Select Report Type:</label>
        <select name="report_type" id="report_type">
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
        <br><br>
        <input type="submit" value="Generate Report">
    </form>


							
								<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
									


    <div class="row">
      <div class="col-xs-12">
      	 
    <div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
                            <h3>Sales Report Month Wise</h3>
							</div>
							<div class="module-body table">
  



</table>  
<?php

// Prepare the SQL query based on the report type
if ($reportType == "monthly") {
    $query = "
    SELECT
        p.id AS productId,
        SUM(o.quantity) AS totalQuantity,
        SUM(o.quantity * p.productPrice) AS totalRevenue
    FROM
        orders o
    JOIN
        products p ON o.productId = p.id
    WHERE
        o.orderDate >= DATE_TRUNC('month', CURRENT_DATE)
    GROUP BY
        p.id;
    ";
} elseif ($reportType == "yearly") {
    $query = "
    SELECT
        p.id AS productId,
        SUM(o.quantity) AS totalQuantity,
        SUM(o.quantity * p.productPrice) AS totalRevenue
    FROM
        orders o
    JOIN
        products p ON o.productId = p.id
    WHERE
        o.orderDate >= DATE_TRUNC('year', CURRENT_DATE)
    GROUP BY
        p.id;
    ";
}


// Display the sales report
if ($result->num_rows > 0) {
    echo "<h2>{$reportType} Sales Report</h2>";
    echo "<table>";
    echo "<tr><th>Product ID</th><th>Total Quantity</th><th>Total Revenue</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['productId']}</td>";
        echo "<td>{$row['totalQuantity']}</td>";
        echo "<td>{$row['totalRevenue']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No sales data available for the selected report type.</p>";
}

// Close the database connection
$conn->close();
?>

</div>
      </div>
    </div>  
  </div>
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
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
    