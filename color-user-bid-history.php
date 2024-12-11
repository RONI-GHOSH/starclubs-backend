<?php include 'includes/config.php'; 
// session_start();

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
    <title>Bid History Managment</title>

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
                        <div class="col-sm-12 col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Bid History Report</h5>
                                            <form class="theme-form mega-form" action="#" method="post">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label>Date</label>
                                                        <div class="date-picker">
                                                            <div class="input-group">
                                                                <input class="form-control digits" required="" type="date" value="<?php echo $date ?>" name="dt" id="dt">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Game Name</label>
                                                        <select id="market_id"  required="" name="market_id" class="form-control">
                                                            <option value="">- Please Select Color Time -</option>
                                                        <?php 
                                                        $getsql = "SELECT * FROM colorMarketList ";
                                                        $getqry = mysqli_query($conn, $getsql);
                                                        $i = 1;
                                                        if (mysqli_num_rows($getqry) > 0)
                                                        {
                                                             while ($row = mysqli_fetch_assoc($getqry)) {
                                                                 $timec = date('h:i a' , strtotime($row['market_time']));
                                                        ?>
                                                        <option value="<?= date('h:i a', strtotime($row['market_time']));?>"><?php echo date('h:i a', strtotime($row['market_time']));?></option>
                                                    <?php }}?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;;</label>
                                                        <button type="button" class="btn btn-primary btn-block" id="checkbid" name="checkbid">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div id="error_msg"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <input type="hidden" id="bidHistory_date">
                <input type="hidden" id="bid_game_name">
                <input type="hidden" id="bid_game_type">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bid History List
                                        <!--<button id='export_btn' class="btn btn-primary btn-sm btn-float m-r-5" onclick="getStarlineBidHistoryExcelData()">Export To Excel</button>-->
                                    </h4>
                                    <div class="dt-ext table-responsive">
                                        <table id="bidHistory" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Member Name</th>
                                                    <th>Betting Amount</th>
                                                    <th>Betting Nunber</th>
                                                    <th>Betting Time</th>
                                                    <th>Color Bet Time</th> 
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table">

                                            </tbody>
                                        </table>
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


    <input type="hidden" id="base_url" value="">
    <input type="hidden" id="admin" value="krisshmatka-admin">

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
    <script src="adminassets/js/customjs.js?v=6782"></script>


    <!-- <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Change Bet Number</h4>
                </div>
                <div class="modal-body"> 
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <form method="post" action="apiz/colorBettingtestCode.php">
                                <label for="market_name">Bet Number </label>
                                <input class="form-control" type="text" name="bet_number" id="bet_number">
                                <br>
                                <input type="hidden" name="get_id" id="savechange">
                                <button type="submit"  name="bet_submit" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Change Bet Number</h4>
                </div>
                <div class="modal-body"> 
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <form>
                                <label for="market_name">Bet Number </label>
                                <input class="form-control" type="text" name="bet_number" id="bet_number">
                                <br>
                                <input type="hidden" name="get_id" id="savechange">

                                <button type="button" name="bet_submit" data-dismiss="modal" onclick="changebetNumber(this);" class="btn btn-success btn-round waves-effect">SAVE CHANGES</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">
    function idtrans(el) 
    {
        var id = $(el).attr('alt');
        $("#savechange").val(id); 
        var bat_number = $(el).data('bat_number');
         // alert(bat_amount);
        $("#bet_number").val(bat_number);
    }
</script>


   <script type="text/javascript">
        $(document).ready( function () {
            $('#bidHistory').DataTable();
        } );
    </script>

    <script>
        $(document).ready(function(){
                $('#checkbid').on('click', function() {
                    //var id = $('#market_id').val();
                // setInterval(function() 
                // {
                    var dt = $('#dt').val();
                    var valTime = $('#market_id').val();
                    // alert(valTime);
                    $.ajax({ //create an ajax request to display.php
                        type: "POST",
                        url: "apiz/color_Betting_fetch.php",
                        data : {
                             valTime,
                            dt},
                        success: function(dataResult) {
                            $("#table").html(dataResult);
                        }
                    });
                // },5000);
            });
        }); 
    </script>

    <script type="text/javascript">
        function changebetNumber(eb) {
            var bet_number = $("input[name=bet_number").val();
            var get_id = $("input[name=get_id]").val();

            $.ajax({ //create an ajax request to display.php
                type: "POST",
                url: "apiz/colorBettingtestCode.php",
                data : {
                    bet_number: bet_number,
                    get_id : get_id,
                },
                success: function(dataResult) {
                    if (dataResult == "Yes") {
                        alert("Bid Update Failed");window.location = "color-user-bid-history.php";
                    }
                    else
                    {
                        alert("Bid Update Successfully");window.location = "color-user-bid-history.php";
                    }
                }
            });
        }
    </script>


</body>

</html>