<?php 

include("../config.php");
if(isset($_POST['username'])){
    $_SESSION['order_id']=$_POST['Booking_no'];
    $_SESSION['payment']='1';
    $_SESSION['customerid']=$_POST['customerid'];
    $_SESSION['totalp']=$_POST['totalp'];
    $_SESSION['address']=$_POST['address'];
    $_SESSION['totalrev']=$_POST['totalrev'];
    header("location:payment-detail.php?bank=".$_POST['bank']);

    
}

else if(isset($_GET['payment'])){
    $fee_id=$_SESSION['customerid'];
    $customer_id = $_SESSION['customerid'];
    $totalp=$_SESSION['totalp'];
    $totalr=$_SESSION['totalrev'];
    $payment_date=date('y-m-d');
    
    $delivery_address=$_SESSION['address'];

    $sql2=$conn->query("SELECT * FROM cart_list where customer_id=".$fee_id);
    foreach($sql2->fetch_array() as $l => $value){
        $$l=$value;
    }
    $pref = date("Ymd");
	$ref=rand(1000,99999);
    $code = $pref.$ref;
   

    $insert=$conn->query("INSERT INTO order_list (`code`, `customer_id`, `delivery_address`, `total_amount`, `total_revenue`) VALUES 
    ('{$code}', '{$customer_id}', '{$delivery_address}', '{$totalp}', '{$totalr}')");
  
    $oid = $conn->insert_id;
    $data = "";
    $cart = $conn->query("SELECT c.*, p.name as product, p.brand as brand, p.revenue as revenue, p.price, cc.name as category, p.image_path, COALESCE((SELECT SUM(quantity) FROM `stock_list` where product_id = p.id and (expiration IS NULL or date(expiration) > '".date("Y-m-d")."')), 0) as `available` FROM `cart_list` c inner join product_list p on c.product_id = p.id inner join category_list cc on p.category_id = cc.id where customer_id = '{$customer_id}'");
    while($row = $cart->fetch_assoc()){
        if(!empty($data)) $data .= ", ";
        $data .= "('{$oid}', '{$row['product_id']}', '{$row['quantity']}', '{$row['price']}', '{$row['revenue']}')";
    }

    $last_id=$conn->insert_id;
    echo $last_id.$client_id;
    $insert2=$conn->query("INSERT INTO order_items (`order_id`, `product_id`, `quantity`, `price`, `revenue`) VALUES {$data}");

    if($insert && $insert2){
        $resp['status'] = 'success';
        $delete2=$conn->query("DELETE FROM `cart_list` WHERE customer_id=".$fee_id);
        header("location:payment-success.php?id=$last_id");
    }else{
        echo mysqli_error($conn);
    }

}
else if(isset($_GET['complete'])){

    $_SESSION['payment']='0';
    $_SESSION['totalp']='0';
    $_SESSION['fee_id']=0;
    header("location:../Parent/fee.php?success=Payment Successful");
}
else if($resp['status'] == 'success'){
    $this->settings->set_flashdata('success', 'Order has been placed successfully.');
}
return json_encode($resp);


?>