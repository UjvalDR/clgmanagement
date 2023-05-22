<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once('product-action.php');
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else
{	
    date_default_timezone_set("asia/kolkata");
    					  
		foreach ($_SESSION["cart_item"] as $item)
		{			
           		
                $item_total += ($item["price"]*$item["quantity"]);
				
				if($_POST['submit'])
				{	
                 
                    if(!empty($_POST['pickTime']))
                    {	
                        if(substr($_POST['pickTime'],0,2) < date("G"))
                        {              
                                $error = "Pick-Up Time Not Valid!";	                       
                        }
                        elseif(substr($_POST['pickTime'],0,2) == date("G"))
                        {                                     
                            if(substr($_POST['pickTime'],3,2) < date("i") + 10)
                            {                          
                                $error = "Please Select Time After 10 Minutes";	
                            }
                            else
                            {                          
                                $SQL="insert into users_orders(u_id,title,quantity,price,pick_time) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."','".$_POST['pickTime']."')";
                                mysqli_query($db,$SQL);	
                                unset($_SESSION["cart_item"]);
                                $success = "Thank You!! Order Placed successfully! <p>You will be redirected to order page  in <span id='counter'>5</span> second(s).</p>
							
													'";	                              	
                             }	
                        }        
                        else
                        {    $SQL="insert into users_orders(u_id,title,quantity,price,pick_time) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."','".$_POST['pickTime']."')";
                                mysqli_query($db,$SQL);	
                                unset($_SESSION["cart_item"]);         
                                
                                $success = "Thank You!! Order Placed successfully! <p>You will be redirected to order page  in <span id='counter'>5</span> second(s).</p>
													'";                        	
                         }	
                          
                    }
                    else
                    {
                        $error = "Pick-Up Time Must be Fillup!";
                    }       
                							    																											
				}
        }      
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Starter Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style-starter.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script> </head>
<?php include_once('header.php'); ?>
   

        <section class="w3l-breadcrumb">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span> Checkout</li>
                </ul>
            </div>
        </section>	
         <div class="container">
			 <span style="color:green;"> <?php echo $success; ?></span>
             <span style="color:red;"> <?php echo $error; ?></span>				
         </div>
            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> 
                                        </div>
                                        <div class="cart-totals-fields">
                                          <table class="table">
											<tbody>                                          												 				   
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td> <?php echo "₹".$item_total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pick-Up Time</td>
                                                        <td><input type="time" id="pickTime" name="pickTime" required></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong> <?php echo "₹".$item_total; ?></strong></td>
														
                                                    </tr>
                                                </tbody>				
                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" checked id="radio_2" value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                     </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod"  type="radio" value="paypal" id="radio_1" class="custom-control-input" > <span class="custom-control-indicator"></span> <span class="custom-control-description">Online Payment <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="button" id="btn" onclick="pay_now()" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
                                    </div>
									</form>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>
           
            <?php include_once('footer.php');?>

            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
         </div>

     <!-- Bootstrap core JavaScript
    ================================================== -->
   <!-- <script src="js/jquery.min.js"></script> -->
   <!-- <script src="jquery.toaster.js"></script> -->
       <script>
   const pressEnter = (event) => {
      if (event.key === "Enter") 
      {
         event.preventDefault();
      }
   };
   document.getElementById("pickTime").addEventListener("keydown",
   pressEnter);
</script>
<script>
    function pay_now(){
        var name=jQuery('#name').val();
		var time = jQuery('#pickTime').val();
        if (time == ""){
            // alert("Please pick a time");
            Swal.fire({
					icon: 'error',
					title: 'Ohho...',
					text:'Please Pick a Time!',
				})
            return false;
        }


        //alert(time);
		
// var date = new Date();
// let day = date.getDate().toString();
// let month = date.getMonth().toString();
// let year = date.getFullYear().toString();
// let hours = date.getHours().toString(); 
// let mins = date.getMinutes().toString();

// hrs = time.substring(0, 2);
// tim = time.substring(3, 4);
// var reserv = new Date(year,month,day,hours,mins);
// var reserv2 = new Date(year,month,day,hrs,tim);

// var rem = reserv2.getTime() - reserv.getTime();
// var minutess = Math.floor(rem / 60000);
// alert(minutess);

        var amt= '<?php echo $item_total; ?>';
		var c = $("#radio_1").is(":checked");
        var d = $("#radio_2").is(":checked");
        if (d){
            //alert("Offline payment");
            jQuery.ajax({
                               type:'post',
                               url:'payment_process1.php',
                               data:"amt="+amt+"&Time="+time,
                               success:function(result){
                                   window.location.href="your_orders.php";
                               }
                           });
        }
		//alert(c);
		//alert(amt);
        if(c){
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&Time="+time,
               success:function(result){
                   var options = {
                        "key": "rzp_test_sEmQuP0PdLYQgy", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Walk In Cafeteria",
                        "description": "UPI Transaction",
                        "image": "https://e7.pngegg.com/pngimages/620/797/png-clipart-fork-knife-computer-icons-spoon-fork-logo-fork.png",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id+"&Time="+time,
                               success:function(result){
                                   window.location.href="your_orders.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
		}
        
        
    }
</script>
	
  <!-- move top -->
  <button onclick="topFunction()" id="movetop" title="Go to top">
  	&#10548;
  </button>
  <script>
  	// When the user scrolls down 20px from the top of the document, show the button
  	window.onscroll = function () {
  		scrollFunction()
  	};

  	function scrollFunction() {
  		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
  			document.getElementById("movetop").style.display = "block";
  		} else {
  			document.getElementById("movetop").style.display = "none";
  		}
  	}

  	// When the user clicks on the button, scroll to the top of the document
  	function topFunction() {
  		document.body.scrollTop = 0;
  		document.documentElement.scrollTop = 0;
  	}
  </script>
  <!-- /move top -->
  </section>


  <!--/MENU-JS-->
  <script>
  	$(window).on("scroll", function () {
  		var scroll = $(window).scrollTop();

  		if (scroll >= 80) {
  			$("#site-header").addClass("nav-fixed");
  		} else {
  			$("#site-header").removeClass("nav-fixed");
  		}
  	});
  </script>



<?php
}
?>
