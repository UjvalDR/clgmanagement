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
                    <h3 class="text-primary">Sales Report</h3> 
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Sales Report</li>
                    </ol>
                </div>
            </div>

            <div class="container">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" >Sales Report in ₹ v/s Date</h4>
                                <div id="chart-container">
                                    <canvas id="graphCanvas"></canvas>
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
<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
<script type="text/javascript" src="js/Chart.min.js"></script>
<script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data1.php",
                function (data1)
                {
                    console.log(data1);
                     var name = [];
                    var marks = [];
                    var color = [];
                    //const ddata = JSON.parse(data1);
                    // var obj = jQuery.parseJSON (data1);
                    //var obj = JSON.stringify(data1);
                    console.log(data1);
                
                    

                    for (var i in data1) {
                        //console.log(data1[i].price);
                        //console.log(typeof(data1[i].price));
                        name.push(data1[i].date);
                        marks.push(data1[i].sales);
                        var randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
                        var randomRGB = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                        //console.log(randomRGB());
                        color.push(randomRGB());
                    }

                    //console.log(name);


                    //const randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);
                    //const randomRGB = () => `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                    //console.log(data1);
                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Sales',
                                backgroundColor: 'rgb(255, 0, 0)',
                                //borderColor: '#46d5f1',
                                // hoverBackgroundColor: '#CCCCCC',
                                // hoverBorderColor: '#666666',
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1,
                                // fill: false,
                                // lineTension: 0,
                                // backgroundColor: "rgba(0,0,255,1.0)",
                                // borderColor: "rgba(0,0,255,0.1)",
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata,
                        options: {
                            responsive: true,
                        plugins: {
                         title: {
                            display: true,
                            text: 'Sales in ₹ v/s Date'
                            },
                        },
                            
                            scales: {
                                x: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Date'
                                    }
                                },
                                y: {
                                    min: 0,
                                    max: 100,
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Amount'
                                    },
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