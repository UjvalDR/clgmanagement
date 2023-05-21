<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
?>
<?php include_once('header.php');?>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Today's Orders</h3> 
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Today's Orders</li>
                    </ol>
                </div>
            </div>

            <div class="container">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Today's Orders</h4>
                                <div id="chart-container">
                                    <canvas id="graphCanvas"></canvas>
                                </div>
                            </div>
                        </div>
					</div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Today's Orders</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>SR.No</th>	
                                                <th>Dish Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>	
												<th>Status</th>		
                                                <th>Pickup Time</th>												
												<th>Reg-Date</th>
												<th>Action</th>
												 
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
											
											<?php
												$sql="SELECT * FROM users_orders Where date(date) = current_date; ";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
														{
															echo '<td colspan="8"><center>No Orders-Data!</center></td>';
														}
													else
														{			$i=1;	
																	while($rows=mysqli_fetch_array($query))
																	{																					
										    ?>
																				<?php
																					echo ' <tr>
                                                                                           <td>'.$i.'</td>
																								<td>'.$rows['title'].'</td>
																								<td>'.$rows['quantity'].'</td>
																								<td>₹'.$rows['price'].'</td>';
																								?>
																								<?php 
                                                                                                    $status=$rows['status'];
                                                                                                    if($status=="" or $status=="NULL")
                                                                                                    {
                                                                                                    ?>
                                                                                                    <td> <button type="button" class="btn btn-primary"> <i class="fa fa-spinner fa-pulse"></i> <span></span>Pending</button></td> 
                                                                                                <?php 
                                                                                                    }
                                                                                                    if($status=="in process")
                                                                                                    { ?>
                                                                                                    <td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span> <span></span>Preparing!</button></td> 
                                                                                                    <?php
                                                                                                        }
                                                                                                    if($status=="closed")
                                                                                                        {
                                                                                                    ?>
                                                                                                    <td> <button type="button" class="btn btn-success"> <i class="fa fa-check-circle"></i> <span></span>Delivered</button></td> 

                                                                                                    <?php 
                                                                                                    } 
                                                                                                    ?>
                                                                                                    <?php
                                                                                                    if($status=="rejected")
                                                                                                        {
                                                                                                    ?>
                                                                                                    <td> <button type="button" class="btn btn-danger"> <i class="fa fa-times-circle"></i> <span></span>Cancelled</button></td> 
                                                                                                    <?php 
                                                                                                    } 
                                                                                                    ?>
                                                                                                    <?php
                                                                                                    if($status=="confirm")
                                                                                                    {
                                                                                                    ?>
                                                                                                    <td>  <button type="button" class="btn btn-info"> <i class="fa fa-check"></i> <span></span>Accepted</button></td> 
                                                                                                    <?php 
                                                                                                    }
                                                                                                    if($status=="prepared")
                                                                                                    {
                                                                                                    ?>
                                                                                                    <td><button type="button" class="btn btn-info" style="background-color: green !important;border-color:green;"> <i class="fa fa-shopping-bag"></i> <span></span>Prepared</button></td> 
                                                                                                    <?php 
                                                                                                    }  
                                                                                                    ?>
                                                                            
																						<?php	
                                                                                    		echo '	<td>'.$rows['pick_time'].'</td>';																				
																							echo '	<td>'.$rows['date'].'</td>';

																							?>
																									 <td>
																									 <a href="delete_orders.php?order_del=<?php echo $rows['o_id'];?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																								<?php
																								echo '<a href="view_order.php?user_upd='.$rows['o_id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
																									</td>
																									</tr>';
                                                                                                    $i++;				
																		}	
														}		
											
											?>                                           
                                        </tbody>
                                    </table>
                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
    
<script src="js/lib/datatables/datatables.min.js"></script>
<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="js/lib/datatables/datatables-init.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    //console.log(data);
                     var name = [];
                    var marks = [];
                    var color = [];

                    for (var i in data) {
                        console.log(data[i].quantity);
                        name.push(data[i].title);
                        marks.push(data[i].quantity);
                        var randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
                        var randomRGB = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                        //console.log(randomRGB());
                        color.push(randomRGB());
                    }

                    //const randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
                    //const randomRGB = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                    console.log(data);
                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                // label: 'Today\'s Orders',
                                backgroundColor: color,
                                // borderColor: '#46d5f1',
                                // hoverBackgroundColor: '#CCCCCC',
                                // hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'doughnut',
                        data: chartdata,
                        options: {
                            scales: {
                                y: {
                                    min: 0,
                                    max: 100,
                                    ticks: {
                                        stepSize: 1
                                        }
                                    }
                            }
                        },
                    });
                });
            }
        }
        </script>

<?php include_once('footer.php');?>