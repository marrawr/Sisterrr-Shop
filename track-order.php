<?php 
error_reporting(0); 
session_start(); 
include_once 'includes/config.php'; 
$oid = intval($_GET['oid']); 
?> 
 
<script language="javascript" type="text/javascript"> 
  function f2() { 
    window.close(); 
  } 
 
  function f3() { 
    window.print(); 
  } 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
  <title>Order Tracking Details</title> 
  <link href="style.css" rel="stylesheet" type="text/css" /> 
  <link href="anuj.css" rel="stylesheet" type="text/css"> 
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
  <div class="logo-heading-container"> 
    <!-- Include your logo image here --> 
    <img src="brandsimage/sisterrr shop.jpg" alt="user" class="logo"> 
    <h2 class="heading">Sister Shop's Tracking Order</h2> 
  </div> 
 
  <div style="margin-right: 50px;"> 
    <form name="updateticket" id="updateticket" method="post"> 
      <table width="100%" border="1" cellspacing="0" cellpadding="5"> 
        <tr height="50"> 
        <td colspan="2" class="fontkink2" style="padding-left: 0px; text-align: center;"> 
            <div class="fontpink2"> <b>Order Tracking Details !</b></div> 
          </td> 
        </tr> 
        
 
        <tr height="30"> 
          <td class="fontkink1"><b>Order Id:</b></td> 
          <td class="fontkink"><?php echo $oid; ?></td> 
        </tr> 
 
        <?php 
        $ret = mysqli_query($con, "SELECT * FROM ordertrackhistory WHERE orderId='$oid'"); 
        $num = mysqli_num_rows($ret); 
        if ($num > 0) { 
          while ($row = mysqli_fetch_array($ret)) { 
        ?> 
 
            <tr height="20"> 
              <td class="fontkink1"><b>At Date:</b></td> 
              <td class="fontkink"><?php echo $row['postingDate']; ?></td> 
            </tr> 
            <tr height="20"> 
              <td class="fontkink1"><b>Status:</b></td> 
              <td class="fontkink"><?php echo $row['status']; ?></td> 
            </tr> 
            <tr height="20"> 
              <td class="fontkink1"><b>Remark:</b></td> 
              <td class="fontkink"><?php echo $row['remark']; ?></td> 
            </tr> 
 
            <tr> 
              <td colspan="2"> 
                <hr /> 
              </td> 
            </tr> 
          <?php } 
        } else { 
          ?> 
          <tr> 
            <td colspan="2"> Status: Order Not Processed Yet</td> 
          </tr> 
        <?php } 
        $st = 'Delivered'; 
        $rt = mysqli_query($con, "SELECT * FROM orders WHERE id='$oid'"); 
        while ($num = mysqli_fetch_array($rt)) { 
          $currrentSt = $num['orderStatus']; 
        } 
        if ($st == $currrentSt) { 
        ?> 
          <tr> 
            <td colspan="2"><b>Status: Product Delivered Successfully</b></td> 
          </tr> 
        <?php } 
        ?> 
      </table> 
    </form> 
  </div> 
 
</body> 
 
</html>