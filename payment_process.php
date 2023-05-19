<?php
session_start();
include("connection/connect.php");
if(isset($_POST['amt']) && isset($_SESSION["user_id"])){
    $amt=$_POST['amt'];
    $name=$_SESSION["user_id"];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    $SQL1 = "insert into payment(name,amount,payment_status,added_on) values('$name','$amt','$payment_status','$added_on')";
    mysqli_query($db,$SQL1);	
    //mysqli_query($con,"insert into payment(name,amount,payment_status,added_on) values('$name','$amt','$payment_status','$added_on')");
    $_SESSION['OID']=mysqli_insert_id($db);
    
}


if(isset($_POST['payment_id']) && isset($_SESSION["user_id"])){
    $payment_id=$_POST['payment_id'];
    $SQL2 = "update payment set payment_status='complete',payment_id='$payment_id' where id='".$_SESSION['OID']."'";
    mysqli_query($db,$SQL2);
    
    //mysqli_query($con,"update payment set payment_status='complete',payment_id='$payment_id' where id='".$_SESSION['user_id']."'");
    foreach ($_SESSION["cart_item"] as $item)
		{
            $item_total += ($item["price"]*$item["quantity"]);
            $SQL="insert into users_orders(u_id,title,quantity,price,pick_time) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."','".$_POST['Time']."')";
            mysqli_query($db,$SQL);	
        }
        unset($_SESSION["cart_item"]);
}
?>