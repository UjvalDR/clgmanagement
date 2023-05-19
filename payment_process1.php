<?php
session_start();
include("connection/connect.php");
if(isset($_POST['amt']) && isset($_SESSION["user_id"])){
    
    foreach ($_SESSION["cart_item"] as $item)
		{
            $item_total += ($item["price"]*$item["quantity"]);
            $SQL="insert into users_orders(u_id,title,quantity,price,pick_time) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."','".$_POST['Time']."')";
            mysqli_query($db,$SQL);	
        }
        unset($_SESSION["cart_item"]);
}

?>