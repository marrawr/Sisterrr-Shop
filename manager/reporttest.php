<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
?>

<?php 
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d",strtotime(date("Y-m-d")." -7 days")) ;
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d") ;
?>

<title>Manager | Sales Report</title>
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
    
    
    
<form class="form-horizontal row-fluid" id="filter-form" name="bwdatesdata" action="" method="post" action="">
	
<div class="control-group">
<label for="date_start" style="margin-left:20px;">From Date :</label>
<div class="controls">
<input type="date" class="form-control" name="date_start" value="<?php echo date("Y-m-d",strtotime($date_start)) ?>">
</div>
</div>

<div class="control-group">
<label for="date_start" style="margin-left:20px;">To Date :</label>
<div class="controls">
<input type="date" class="form-control" name="date_end" value="<?php echo date("Y-m-d",strtotime($date_end)) ?>">
</div>
</div>


<div class="control-group">
<div class="controls">
<button class="btn btn-info btn-sm" ><i class="glyphicon glyphicon-filter"></i> Generate</button>
<button class="btn btn-success btn-sm" type="button" id="printt"><i class="glyphicon glyphicon-print"></i> Print</button>
</div>
</div>
     </form>
	 </div>


</div><!--/.content-->

<h6 class="page-header"></h6>

<div class="module" id="print_doc">
<div class="container-fluid">
<table class="table table-bordered" style="margin-left:20px; margin: right 50%; margin-top:20px; margin-bottom:40px;">

<thead>
<th>#</th>
<th>Order Date</th>
<th>Payment Method</th>
<th>Product Name</th>
<th>Quantity</th>
<th>Price</th>
<th>Sub Total</th>
</thead>

<tbody>
<tbody>
<?php 
$g_total = 0;
$i = 1;
$stock = $con->query("SELECT * FROM `orders` inner join `products` ON orders.productid = products.id where date(orderDate) between '{$date_start}' and '{$date_end}' order by unix_timestamp(orderDate)");
while($row = $stock->fetch_assoc()):
$subtotal = $row['quantity'] * $row['productPrice'];
$g_total += $subtotal;

?>

<tr>
    <td class="px-1 py-1 align-middle text-center"><?= $i++ ?></td>
    <td class="px-1 py-1 align-middle"><?= $row['orderDate'] ?></td>
    <td class="px-1 py-1 align-middle"><?= $row['paymentMethod'] ?></td>
    <td class="px-1 py-1 align-middle"><?= $row['productName'] ?></td>
    <td class="px-1 py-1 align-middle"><?= $row['quantity'] ?></td>
    <td class="px-1 py-1 align-middle"><?= $row['productPrice'] ?></td>
    
    <td class="px-1 py-1 align-middle"><?= $subtotal ?></td>
</tr>
<?php endwhile; ?>
<?php if($stock->num_rows <= 0): ?>
    <tr>
        <td class="py-1 text-center" colspan="6">..No Records Found..</td>
    </tr>
<?php endif; ?>
<tr>
    <td colspan="6" align="right"><b>Grand Total:</b></td>
    <td><?= $g_total ?></td>
</tr>
</tbody>

</table>  
</div>
</div>
</div>
	
				
				</div><!--/.content-->
			</div><!--/.span9-->
		</div><!--/.container-->
		</div>
		
	</div>
	</div><!--/.wrapper-->

	

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	

<noscript id="print-header">
    <div>
        <style>
            html{
                min-height:unset !important;
            }
        </style>
        <div class="d-flex w-100 align-items-center">
            <div class="col-2 text-center">
                <h1 class="text-center m-0"><b>TUDUNG REPORT</b></h1>
               
            </div>
            <div class="col-8">
                <div style="line-height:1em">
                    <div class="text-center font-weight-bold h5 mb-0"><h3>Sales Report</h3></div>
                    <?php if($date_start != $date_end): ?>
                    <p class="text-center m-0">Date Between <?php echo date("M d,Y", strtotime($date_start)) ?> and <?php echo date("M d,Y", strtotime($date_end)) ?></p>
                    <?php else: ?>
                    <p class="text-center m-0">As of <?php echo date("M d,Y", strtotime($date_start)) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <hr>
    </div>
</noscript>

<script>
    function print_r(){
        var h = $('head').clone()
        var el = $('#printout').clone()
        var ph = $($('noscript#print-header').html()).clone()
        h.find('title').text("Daily Sales Report - Print View")
        var nw = window.open("", "_blank", "width="+($(window).width() * .8)+",left="+($(window).width() * .1)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1))
            nw.document.querySelector('head').innerHTML = h.html()
            nw.document.querySelector('body').innerHTML = ph[0].outerHTML
            nw.document.querySelector('body').innerHTML += el[0].outerHTML
            nw.document.close()
           
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    end_loader()
                }, 200);
            }, 300);
    }
    $(function(){
        $('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = '?page=reports&'+$(this).serialize()
        })
        $('#print').click(function(){
            print_r()
        })

    })
</script>


<script>
    $(document).ready(function() {
        $("#printt").click(function() {
            // Open a new window for printing
            var printWindow = window.open("", "_blank");

            // Build the printable content
            var printableContent = `
			<link rel="stylesheet" href="css/bootstrap.min.css">
			` + document.getElementById("print-header").innerHTML + `
			` + document.getElementById("print_doc").outerHTML + `
                 
                 </div>
                </div>
                </body>
                </html>
            `;


            // Write the printable content to the new window, open it and print it
            printWindow.document.open();
            printWindow.document.write(printableContent);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();


        });
    });
</script>