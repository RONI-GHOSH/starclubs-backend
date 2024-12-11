<?php include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) 
{
  echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="adminassets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="adminassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="adminassets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <link href="adminassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="adminassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="adminassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="adminassets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="adminassets/css/app.min.css?v=2" id="app-style" rel="stylesheet" type="text/css" />

        <link href="adminassets/css/custom.css?v=11" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

        <div id="layout-wrapper">
            
            <?php include 'includes/header.php';  ?>

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                            <div class="row">
                                            <?php
                                                        $marketsql = "SELECT * FROM `market` WHERE active_status !='Removed'  AND market_type='mumbai'";
                                                        $marketqry = mysqli_query($conn, $marketsql);
                            	while ($market = mysqli_fetch_assoc($marketqry))
                            	{  $marketid = $market['market_id']; ?>
                                <div class="col-xl-4">
                                   
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4"><?= $market['market_name']; ?> Details</h4>
                                            <div class="row">
                                                <div class="col-sm-12"> 
                                                     <?php
                                                        $amsql = "SELECT SUM(b.betting_amount) as idc FROM betting b JOIN market m ON b.b_market_id = m.market_id WHERE DATE(b.betting_date) = Date('$date') AND m.market_type = 'mumbai' AND b.b_market_id = '$marketid'";
                                                        $amqry = mysqli_query($conn, $amsql);
                                                        $amrow = mysqli_fetch_assoc($amqry);
                                                        $amnum = $amrow['idc'] ?: '0';
                                                        ?>
                                                    <h3 id="bid_amt"></h3>
                                                    <p class="text-muted">Total Bid Amount</p>
    
                                                    <div class="row" id="tabledata">
                                                        <div class="col-md-12">
                                                            <div class="bid_history_box bhb_bid_amt" style="border: 1px dotted black;padding: 2px; margin:5px;">
                                                                <div class="row" style="align-items: baseline; padding:5px;">
                                                                    <div class="col-md-4">    
                                                                     <h5 class="text-muted font-weight-medium" style="font-size: 13px;">Total Bid Amount</h5>
                                                                    </div>
                                                                    <div class="col-md-5"> <h5 style="font-size: 12px;" id="total_bid_amt"><i class="bx bx-rupee"></i><?php echo number_format($amnum, 2); ?></h5>
                                                                    </div>
                                                                    <div class="col-md-3 text-sm-right"> 
                                                                     <button type="button" class="btn btn-primary waves-light btn-xs showbettbl" id="winner_btn">View</button>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                // $amsql = "SELECT SUM(betting_amount) as idc FROM betting WHERE DATE(betting_date) LIKE '%$date%'";
                                                                $amsql = "SELECT wt.*, SUM(wt.transaction_amount) as amt, COUNT(wt.w_transaction_id) as cont
                                                                FROM wallet_transaction wt
                                                                JOIN market m ON wt.market_id = m.market_id
                                                                WHERE wt.transaction_type = 'WinningBat' 
                                                                AND wt.status = '1' 
                                                                AND DATE(wt.transaction_update_date) = DATE('$date')
                                                                AND m.market_type = 'delhi' AND m.market_id = '$marketid'";
                                                                $amqry = mysqli_query($conn, $amsql);
                                                                $amrow = mysqli_fetch_assoc($amqry);
                                                                $amnum1 = $amrow['amt'] ?: '0';
                                                                ?>
                                                            <div class="bid_history_box bhb_win_amt" style="border: 1px dotted black;padding: 2px; margin:5px;">
                                                                <div class="row" style="align-items: baseline; padding:5px;">
                                                                    <div class="col-md-4">   
                                                                        <h5 class="text-muted font-weight-medium" style="font-size: 13px;">Total Win Amount</h5>
                                                                    </div>
                                                                    <div class="col-md-5"> <h5 class="mb-0" style="font-size: 13px;" id="total_win_amt"><i class="bx bx-rupee"></i><?php echo number_format($amnum1, 2); ?></h5>
                                                                    </div>
                                                                    <div class="col-md-3 text-sm-right">
                                                                        <button type="button" class="btn btn-primary waves-light btn-xs showwidtbl"  id="winner_btn">View</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
    
                                                            //   $refersql = "SELECT * , SUM(transaction_amount) as amt , COUNT(w_transaction_id) as cont FROM `wallet_transaction` WHERE transaction_type='ReferAmt' AND status='1' AND Date(transaction_update_date)=Date('$date')";
                                                                $refersql = "SELECT wt.*, SUM(wt.transaction_amount) as amt, COUNT(wt.w_transaction_id) as cont
                                                                FROM wallet_transaction wt
                                                                JOIN market m ON wt.market_id = m.market_id
                                                                WHERE wt.transaction_type = 'ReferAmt' 
                                                                AND wt.status = '1' 
                                                                AND DATE(wt.transaction_update_date) = DATE('$date')
                                                                AND m.market_type = 'delhi' AND m.market_id = '$marketid'";
                                                                $referqry = mysqli_query($conn, $refersql);
                                                                $referrow = mysqli_fetch_assoc($referqry);
                                                                $totalreferr = $referrow['amt'] ?: '0';
                                                                $totalMinus = $amnum1+$totalreferr;
                                                                $ttl = $amnum - $totalMinus;
                                                            
                                                                if ($ttl > 0) {
                                                                	$color = "green";
                                                                }elseif($ttl == 0){
                                                                	$color = "#556ee6";
                                                                }else{
                                                                	$color = "red";
                                                                }
                                                                
                                                                ?>
                                                            <div class="bid_history_box bhb_win_amt" style="border: 1px dotted black;padding: 2px; margin:5px;">
                                                                <div class="row" style="align-items: baseline; padding:5px;">
                                                                    <div class="col-md-4">   
                                                                        <h5 class="text-muted font-weight-medium" style="font-size: 13px;">Total Referral Amount</h5>
                                                                    </div>
                                                                    <div class="col-md-5"> <h5 class="mb-0" style="font-size: 13px;" id="total_refer_amt"><i class="bx bx-rupee"></i><?php echo number_format($totalreferr, 2);?></h5>
                                                                    </div>
                                                                    <div class="col-md-3 text-sm-right">
                                                                        <button type="button" class="btn btn-primary waves-light btn-xs showwidtbl"  id="winner_btn">View</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="bid_history_area">
                                                                    <div class="bid_history_box bhb_profit_amt" id="mensales" style="border: 2px solid green;padding: 2px; margin:5px;">
                                                                        <div class="row" style="align-items: baseline; padding:5px;background:<?php echo $color;?>;">
                                                                            <div class="col-md-4">
                                                                                <h5 class="text-muted font-weight-medium" id="profit_loss" style="font-size: 13px;">Total Profit Amount</h5>
                                                                            </div>
                                                                            <div class="col-md-5"><h5 class="mb-0" style="font-size: 13px;" id="total_profit_amt"><i class="bx bx-rupee"></i> <?php echo number_format($ttl, 2); ?> </h5>
                                                                            </div>
                                                                            <div class="col-md-3"></div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                        </div>
                                                    </div>
                                                </div>
    
                                            </div>
    
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>


                    </div>
                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            



            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> ©Matka.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">

                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> ©Matka.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">

                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> ©Matka.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">

                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>
        </div>


        <input type="hidden" id="base_url" value="">
        <input type="hidden" id="admin" value="">

        <div id="snackbar"></div>
        <div id="snackbar-info"></div>
        <div id="snackbar-error"></div>
        <div id="snackbar-success"></div>


        <script src="adminassets/libs/jquery/jquery.min.js"></script>
        <script src="adminassets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="adminassets/libs/metismenu/metisMenu.min.js"></script>
        <script src="adminassets/libs/simplebar/simplebar.min.js"></script>
        <script src="adminassets/libs/node-waves/waves.min.js"></script>
        <script src="adminassets/libs/select2/js/select2.min.js"></script>
        <script src="adminassets/js/pages/form-advanced.init.js"></script>
        <!-- Required datatable js -->
        <script src="adminassets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="adminassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="adminassets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="adminassets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="adminassets/libs/jszip/jszip.min.js"></script>
        <script src="adminassets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="adminassets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="adminassets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="adminassets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="adminassets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="adminassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="adminassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="adminassets/js/pages/datatables.init.js"></script>
        <!-- App js -->
        <script src="adminassets/js/app.js"></script>
        <!-- <script src="adminassets/js/customjs.js?v=9051"></script> -->


        
        <script type="text/javascript">
              $(document).ready(function() {
                // Approve Request
                // $(document).on('click', '#getbet', function() {
                    $('#getbet').on('click', function () {
                  var game_id = document.getElementById('game_id').value
                  var market_open = document.getElementById('market_open').value
                  var zero = 0;
                  
                  for (var i = 0; i < 10; i++) {
                         var n = 'total'+i;
                         var m = 'bid'+i;
                         document.getElementById(n).innerHTML = zero;
                         document.getElementById(m).innerHTML = zero;
                }
                
        
                //   alert(game_id + ' ' + market_open )
        
                  $.ajax({
                    url: 'apiz/singlenumber_bet.php',
                    type: 'POST',
                    data: {
                      'game_id': game_id,
                      'market_open': market_open,
                    },
                    success: function(response) {
                        var res = JSON.parse(response);
                        // console.log(JSON.parse(response))
                        var list = res.list;
                        if (list != 'No Bet') {

                            var num = null;
                        
                        for (var i = list.length - 1; i >= 0; i--) {
                            var num = list[i].number
                            var amount = ''
                            var numcount = list[i].betnum
                            if (num == 0) {
                                var amount = list[i].amount;
                                document.getElementById("total0" ).innerHTML = amount;
                                document.getElementById("bid0" ).innerHTML = numcount;
                            }
                            if (num == 1) {
                                var amount = list[i].amount;
                                document.getElementById("total1" ).innerHTML = amount;
                                document.getElementById("bid1" ).innerHTML = numcount;
                            }
                            if (num == 2) {
                                var amount = list[i].amount;
                                document.getElementById("total2" ).innerHTML = amount;
                                document.getElementById("bid2" ).innerHTML = numcount;
                            }
                            if (num == 3) {
                                var amount = list[i].amount;
                                document.getElementById("total3" ).innerHTML = amount;
                                document.getElementById("bid3" ).innerHTML = numcount;
                            }
                            if (num == 4) {
                                var amount = list[i].amount;
                                document.getElementById("total4" ).innerHTML = amount;
                                document.getElementById("bid4" ).innerHTML = numcount;
                            }
                            if (num == 5) {
                                var amount = list[i].amount;
                                document.getElementById("total5" ).innerHTML = amount;
                                document.getElementById("bid5" ).innerHTML = numcount;
                            }
                            if (num == 6) {
                                var amount = list[i].amount;
                                document.getElementById("total6" ).innerHTML = amount;
                                document.getElementById("bid6" ).innerHTML = numcount;
                            }
                            if (num == 7) {
                                var amount = list[i].amount;
                                document.getElementById("total7" ).innerHTML = amount;
                                document.getElementById("bid7" ).innerHTML = numcount;
                            }
                            if (num == 8) {
                                var amount = list[i].amount;
                                document.getElementById("total8" ).innerHTML = amount;
                                document.getElementById("bid8" ).innerHTML = numcount;
                            }
                            if (num == 9) {
                                var amount = list[i].amount;
                                document.getElementById("total9" ).innerHTML = amount;
                                document.getElementById("bid9" ).innerHTML = numcount;
                            }
                            console.log (num + ' - ' + amount)
                        }

                        }else {
                            alert('No Ank Bet Found')
                        }
                        
                    }
                  });
                });
              });
        </script>


        <!-- Bet Hide Show -->

        <script>
            $(document).ready(function(){
                $('.showbettbl').on('click', function() {
                    document.getElementById("bettbl").style.display = 'block';
                    document.getElementById("widtbl").style.display = 'none';
                });

                $('.showwidtbl').on('click', function() {
                    document.getElementById("widtbl").style.display = 'block';
                    document.getElementById("bettbl").style.display = 'none';
                });
            }); 
        </script>

        <!-- Bet Hide Show -->

        <!-- work start is here -->
        <script>
            $(document).ready(function(){
                    $('#getsubmit').on('click', function() {
                        //var id = $('#market_id').val();
                    // setInterval(function() {
                        var id = $('#game_name').val();
                        var betdate = $('#start_date1').val();
                        var endbetdate = $('#end_date1').val();
                        $.ajax({ //create an ajax request to display.php
                            type: "POST",
                            url: "apiz/bet_live_copy.php",
                            data : {
                                id: id,
                                betdate: betdate,
                                endbetdate:endbetdate,
                            },
                            success: function(dataResult) {
                                var data = JSON.parse(dataResult).data;
                                var betamt = data.betamt;
                                var winamt = data.winamt;
                                var totalamt = data.totalamt;
                                var bttype = data.type;
                                var totalreferramt = data.totalreferramt;
                                document.getElementById("total_bid_amt").innerHTML = betamt;
                                document.getElementById("total_win_amt").innerHTML = winamt;
                                document.getElementById("total_profit_amt").innerHTML = totalamt;
                                document.getElementById("total_refer_amt").innerHTML = totalreferramt;
                                
                                if(bttype == "Profit"){
                                    document.getElementById("mensales").style.background = "#556ee6";
                                }else if(bttype == "Noloss"){
                                    document.getElementById("mensales").style.background = "#0dcebc";
                                }else {
                                    document.getElementById("mensales").style.background = "#f1673e";
                                }
                            }
                        });
                    // },1000);
                });
            }); 
        </script>
        <script>
            $(document).ready(function(){
                    // $('#getsubmit').on('click', function() {
                        //var id = $('#market_id').val();
                    // setInterval(function() {
                        // var id = $('#game_name').val();
                        // var betdate = $('#start_date1').val();
                        $.ajax({ //create an ajax request to display.php
                            type: "POST",
                            url: "apiz/dailycount.php",
                            data : {
                                // id: id,
                                // betdate: betdate,
                            },
                            success: function(dataResult) {
                                var data = JSON.parse(dataResult).data;
                                var betamt = data.betamt;
                                var winamt = data.winamt;
                                var totalamt = data.totalamt;
                                var bttype = data.type;

                                document.getElementById("total_dep").innerHTML = betamt;
                                document.getElementById("total_wid").innerHTML = winamt;
                                document.getElementById("total_amt").innerHTML = totalamt;
                                if(bttype == "Profit"){
                                    document.getElementById("trns").innerHTML = bttype; 
                                    document.getElementById("trns").style.background = "#556ee6";
                                }else if(bttype == "Noloss"){
                                    document.getElementById("trns").innerHTML = bttype; 
                                    document.getElementById("trns").style.background = "#0dcebc";
                                }else {
                                    document.getElementById("trns").innerHTML = bttype; 
                                    document.getElementById("trns").style.background = "#f1673e";
                                }
                            }
                        });
                    // },1000);
                });
            // }); 
        </script>
        <!-- work end is here -->

    </body>

    </html>