<?php 
session_start();
include('../includes/config.php');

if(isset($_POST['username'])){
    $_SESSION['order_id']=$_POST['Booking_no'];
    $_SESSION['payment']='1';
    $_SESSION['customerid']=$_POST['customerid'];
    $_SESSION['totalp']=$_POST['totalp'];
    $_SESSION['address']=$_POST['address'];
    $_SESSION['trackorder']=$_POST['trackorder'];
    header("location:payment-detail.php?bank=".$_POST['bank']);

    
}

else if(isset($_GET['payment'])){
    $fee_id=$_SESSION['customerid'];
    $customer_id = $_SESSION['customerid'];
    $totalp=$_SESSION['totalp'];
    $totalr=$_SESSION['totalrev'];
    $payment_date=date('y-m-d');
    
    $delivery_address=$_SESSION['address'];

    $sql2 = $con->query("UPDATE orders SET statuspayment='Paid' WHERE trackorder='" . $_SESSION['trackorder'] . "'");
    header("location:payment-success.php?id=$fee_id");

}
else if(isset($_GET['complete'])){

    $_SESSION['payment']='0';
    $_SESSION['totalp']='0';
    $_SESSION['fee_id']='0';
    header("location:../Parent/fee.php?success=Payment Successful");
}


?>