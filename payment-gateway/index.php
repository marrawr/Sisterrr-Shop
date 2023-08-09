<html lang="en">
<?php
error_reporting(0);
include_once 'config.php';
$bank = $_GET['bank'];
$id = $_GET['id'];
$customer_id = $_GET['customerid'];
$totalprice = $_GET['totalprice'];
$trackorder = $_GET['trackorder'];


$sql = $con->query("SELECT * FROM bank where id=$bank");
foreach ($sql->fetch_array() as $k => $val) {
  $$k = $val;
}

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Payment - <?php echo $name ?></title>
  <link rel="icon" href="bank-img/Bank-Islam.png">
  <?php require('links.php'); ?>

</head>
<section class="vh-100 gradient-custom s">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100 ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-white text-black shadow-lg bg-body" style="border-radius: 0.5rem;">


          <!--sign option-->
          <div class="card-body  p-5 text-center signin_option   ">


            <img src="bank-img/<?php echo $image ?>" width="250">
            <h5 class="text-black-50 mb-5  mt-3  font-weight-light">WELCOME TO <?php echo Strtoupper($name) ?> INTERNET BANKING</h5>

            <form class="user" method="POST" action="config.php" id="signin-form">

              <div class="mb-3">

                <input type="username" class="form-control form-control-user" name="username" placeholder="Username" required>
                <input type="hidden" class="form-control form-control-user" name="Booking_no" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" class="form-control form-control-user" name="totalp" value="<?php echo $totalprice ?>">
                <input type="hidden" class="form-control form-control-user" name="customerid" value="<?php echo $customer_id ?>">
                <input type="hidden" class="form-control form-control-user" name="trackorder" value="<?php echo $trackorder ?>">

              </div>

              <div class="mb-3">

                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
              </div>

              <div class="container">

                <div class="row">

                  <div class="col">
                    <button type="submit" class="btn btn-secondary btn-user btn-block">Login</button>
                  </div>

                  <div class="col">
                    <a class="btn btn-outline-dark btn-user btn-block" href='../pending-orders.php'>Cancel</a>
                  </div>

                </div>
              </div>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>