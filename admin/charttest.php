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

                <!-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All user Orders</h4>
                                <canvas id="myChart" style="width:100%;max-width:600px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->
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
                    console.log(data);
                     var name = [];
                    var marks = [];
                    var color = [];

                    for (var i in data) {
                        name.push(data[i].title);
                        marks.push(data[i].quantity);
                        var randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
                        var randomRGB = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                        //console.log(randomRGB());
                        color.push(randomRGB());
                    }

                    //const randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
                    //const randomRGB = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                    console.log(color);
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
                        type: 'pie',
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