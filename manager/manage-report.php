<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
}
?>

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
    <script language="javascript" type="text/javascript">
        var popUpWin = 0;

        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>
    <style> 
    /* Additional CSS styles for logo and heading alignment */ 
    .logo-heading-container { 
      display: flex; 
      align-items: center; 
      margin-bottom: 20px; 
    } 
 
    .logo { 
      width: 60px; 
      height: auto; 
      margin-right: 20px; 
    } 
 
    .heading { 
      font-size: 24px; 
      font-weight: bold; 
      align-items: center; 
    } 
  </style> 
</head>

<body>

    <?php
    $date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d", strtotime(date("Y-m-d") . " -7 days"));
    $date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d");
    ?>



    <?php include('include/header.php'); ?>



    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php'); ?>
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
                                        <label class="control-label" for="date_start">From Date</label>
                                        <div class="controls">
                                            <input type="date" class="span8 tip" name="date_start" value="<?php echo date("Y-m-d", strtotime($date_start)) ?>">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="date_start">To Date</label>
                                        <div class="controls">
                                            <input type="date" class="span8 tip" name="date_end" value="<?php echo date("Y-m-d", strtotime($date_end)) ?>">
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <div class="controls">
                                            <button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-filter"></i> Generate</button>
                                            <button class="btn btn-success btn-sm" type="button" id="printt"><i class="glyphicon glyphicon-print"></i> Print</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div><!--/.content-->

                        <!-- <h6 class="page-header"></h6> -->
                        <div class="module" id="print_doc">
                            <!-- <div class="module"> -->
                                <div class="module-head">
                                    <h3>Sales Reports</h3>
                                </div>
                                <div class="module-body table">
                                    <!-- <table width="100%" border="1" cellspacing="0" cellpadding="5"> -->
                                    <table cellpadding="5" cellspacing="0" border="1" class="datatable-1 table table-bordered table-striped	 display" width="100%" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Number of Orders</th>
                                                <th>Total Quantity</th>
                                                <th>Price</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $g_total = 0;
                                            $i = 1;
                                            $merged_data = array(); // Array to store merged data

                                            $stock = $con->query("SELECT * FROM `orders` INNER JOIN `products` ON orders.productid = products.id WHERE date(orderDate) BETWEEN '{$date_start}' AND '{$date_end}' ORDER BY productName");
                                            while ($row = $stock->fetch_assoc()) {
                                                $subtotal = $row['quantity'] * $row['productPrice'];
                                                $g_total += $subtotal;
                                                $price = $row['productPrice'];
                                                $product_name = $row['productName'];

                                                // Check if the product already exists in the merged data array
                                                if (isset($merged_data[$product_name])) {
                                                    // If product already exists, update the quantity, number of orders, and subtotal
                                                    $merged_data[$product_name]['quantity'] += $row['quantity'];
                                                    $merged_data[$product_name]['num_orders']++;
                                                    $merged_data[$product_name]['subtotal'] += $subtotal;
                                                } else {
                                                    // If product does not exist, add it to the merged data array
                                                    $merged_data[$product_name] = array(
                                                        'quantity' => $row['quantity'],
                                                        'num_orders' => 1,
                                                        'subtotal' => $subtotal
                                                    );
                                                }
                                            }

                                            // Loop through the merged data array and display the results
                                            foreach ($merged_data as $product_name => $product_data) {
                                                $quantity = $product_data['quantity'];
                                                $num_orders = $product_data['num_orders'];
                                                $subtotal = $product_data['subtotal'];
                                                // Display the merged data in the table rows
                                            ?>
                                                <tr>
                                                    <td class="px-1 py-1 align-middle text-center"><?= $i++ ?></td>
                                                    <td class="px-1 py-1 align-middle"><?= $product_name ?></td>
                                                    <td class="px-1 py-1 align-middle"><?= $num_orders ?></td>
                                                    <td class="px-1 py-1 align-middle"><?= $quantity ?></td>
                                                    <td class="px-1 py-1 align-middle"><?= $price ?></td>
                                                    <td class="px-1 py-1 align-middle"><?= $subtotal ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <?php if (empty($merged_data)) : ?>
                                                <tr>
                                                    <td class="py-1 text-center" colspan="6">..No Records Found..</td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td colspan="5" align-text="center"><b>Grand Total:</b></td>
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



    <?php include('include/footer.php'); ?>


    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js"></script>


    <noscript id="print-header">
        <div>
            <style>
                html {
                    min-height: unset !important;
                }
            </style>
            <div class="d-flex w-100 align-items-center">
                <!-- <div class="col-2 text-center">
                <img src="brandsimage/sisterrr shop.jpg" alt="user" class="logo"> 
                    <h1 class="text-center m-0"><b>TUDUNG REPORT</b></h1>

                </div> -->

                <div class="logo-heading-container">
                    <!-- Include your logo image here -->
                    <img src="manager/brandsimage/sisterrr shop.jpg" alt="sister" class="logo">
                    <h2 class="heading">Sales Report</h2>
                </div>
                <div class="col-8">
                    <div style="line-height:1em">
                        <div class="text-center font-weight-bold h5 mb-0">
                            <!-- <h3>Sales Report</h3> -->
                        </div>
                        <?php if ($date_start != $date_end) : ?>
                            <p class="text-center m-0">Date Between <?php echo date("M d,Y", strtotime($date_start)) ?> and <?php echo date("M d,Y", strtotime($date_end)) ?></p>
                        <?php else : ?>
                            <p class="text-center m-0">As of <?php echo date("M d,Y", strtotime($date_start)) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </noscript>

    <script>
        function print_r() {
            var h = $('head').clone()
            var el = $('#printout').clone()
            var ph = $($('noscript#print-header').html()).clone()
            h.find('title').text("Monthly Sales Report - Print View")
            var nw = window.open("", "_blank", "width=" + ($(window).width() * .8) + ",left=" + ($(window).width() * .1) + ",height=" + ($(window).height() * .8) + ",top=" + ($(window).height() * .1))
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
        $(function() {
            $('#filter-form').submit(function(e) {
                e.preventDefault()
                location.href = '?page=reports&' + $(this).serialize()
            })
            $('#print').click(function() {
                print_r()
            })

        })
    </script>
    <link type="text/css" rel="stylesheet" href="assets/plugins/bootstrap-datepicker/css/datepicker.css">
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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