<html lang="en">
<?php

session_start();
include('../includes/config.php');
$bank = $_SESSION['payment'];
$balance = '0';
$sql = $con->query("SELECT * FROM bank where id=$bank");
foreach ($sql->fetch_array() as $k => $val) {
  $$k = $val;
}

$amount = $_SESSION['totalp'];
?>

<?php
$customertt = $_SESSION['customerid'];
$qry = $con->query("SELECT * from `users` inner join `dummybank` ON users.id=dummybank.customer_id where customer_id=$customertt ");
if ($qry) {
  // Fetch data using a while loop
  while ($row = $qry->fetch_array()) {
    // Access data using column names or indices
    $accountNumber = $row['accountNo'];
    $balanceNumber = $row['balance'];
  }
} else {
  // Query was not successful, handle the error
  echo "Error executing the query: " . $con->error;
}

$balance = $balanceNumber - $amount;

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Payment - <?php echo $name ?></title>
  <link rel="icon" href="bank-img/Bank-Islam.png">
  <?php require('links.php'); ?>

  <!-- <script>
    //to make popup only
    function showPopupChat() {
      // Replace this with your own popup chat implementation
      // For example, you can use a modal or an alert box
      alert("Successful Payment! Thank you for your purchase.");
    }
  </script> -->


</head>

<body>
  <section>
    <div class=" ">
      <div class="row d-flex justify-content-center align-items-center  ">


        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="text-center py-4">
            <img src="bank-img/<?php echo $image ?>" width="450">
          </div>

          <div class="card bg-white text-black mb-5  bg-body" style="border-radius: none;">
            <div class="card-header" style="background-color:<?php echo $color ?>;">
              <h5 class="text-<?php echo $text_color ?> p-3 font-weight-light"><i class="fa-solid fa-lock"></i> You are in a secure site</h5>
            </div>

            <!--sign option-->
            <div class="card-body  p-4     ">

              <h5 style="opacity:70%"><b>Third Party Account Transfer (Step 2 of 3)</b> </h5>
              <div class="pull-right">
                <p class="">as at <?php date_default_timezone_set("Asia/Kuala_Lumpur");
                                  echo date('d-m-y h:i:s')  ?></p>
              </div>
              <table class="table">
                <thead style="border-bottom:0px;">
                  <tr style="background-color:<?php echo $color ?>; border-bottom:hidden; ">
                    <th colspan="5" class="text-<?php echo $text_color ?> p-3">
                      Transfer Details
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="p-3"></td>
                    <td class="p-3">From Account</td>
                    <td class="p-3">:</td>
                    <td class="p-3">Saving Account - <?php echo $accountNumber; ?></td>
                    <td class="p-3"></td>
                  </tr>
                  <tr>
                    <td class="p-3"></td>
                    <td class="p-3">Transfer Type</td>
                    <td class="p-3">:</td>
                    <td class="p-3">Fund Transfer to Saving/Current</td>
                    <td class="p-3"></td>
                  </tr>

                  <tr>
                    <td class="p-3"></td>
                    <td class="p-3">Transfer Amount</td>
                    <td class="p-3">:</td>
                    <td class="p-3">MYR <?php echo number_format($amount, 2) ?></td>
                    <td class="p-3"></td>
                  </tr>

                  <tr style="border-bottom:hidden;">
                    <td class="p-3"></td>
                    <td class="p-3">Effective Date</td>
                    <td class="p-3">:</td>
                    <td class="p-3">Today</td>
                    <td class="p-3"></td>
                  </tr>

                </tbody>
              </table>

              <table>
                <tr>
                  <form method="POST" action="update.php?idd=<?php echo $_SESSION['customerid']; ?>">
                    <input type="hidden" name="balance" value="<?= $balance ?>">
                    <td class="p-3"></td>
                    <td class="p-3">Available Balance</td>
                    <td class="p-3">:</td>
                    <td class="p-3">MYR <?php echo $balance; ?>.00</td>
                    <td class="p-3"></td>
                </tr>
                <tr>
                  <td class="p-3"></td>
                  <td class="p-3">Recipient Account</td>
                  <td class="p-3">:</td>
                  <td class="p-3">Saving Account - 0893098321 MYR</td>
                  <td class="p-3"></td>
                </tr>

                <tr>
                  <td class="p-3"></td>
                  <td class="p-3">Recipient Name</td>
                  <td class="p-3">:</td>
                  <td class="p-3">Titan Life Resources</td>
                  <td class="p-3"></td>
                </tr>
                </tbody>
              </table>

            </div>

            <div class="card-footer " style="background-color:white;">
              <button type="submit" class="btn text-dark pull-right mx-2  " style="background-color:<?php echo $color ?>; ">Complete</button>
              </form>
            </div>
            <!-- <div class="card-footer " style="background-color:white;">
              <a href="../?p=orders" class="btn text-dark pull-right mx-2" style="background-color:<?php echo $color ?>;" onclick="showPopupChat()">Complete</a>
            </div> -->

          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>