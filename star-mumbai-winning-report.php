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
    <title>Winning Report</title>

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

                                        <div class="card-header p-t-15 p-b-15">

                                            <h5>Winning History Report</h5>

                                        </div>

                                        <div class="card-body">
                                            <form class="theme-form mega-form" name="geWinningHistoryFrm" method="post">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label>Date</label>
                                                        <div class="date-picker">
                                                            <div class="input-group">
                                                                <input class="form-control digits" type="date" value="<?php echo $date?>" name="bid_date" id="bid_date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary btn-block" id="submitBtnw" name="submitBtnw">Submit</button>
                                                    </div>
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



                <input type="hidden" id="result_date">

                <input type="hidden" id="result_game_name">




                <div class="container-fluid">

                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-body">

                                    <h4 class="card-title">Winning History List</h4>

                                    <div class="dt-ext table-responsive">

                                        <table id="resultHistory" class="table table-striped table-bordered">

                                            <thead>

                                                <tr>
                                                    <th>Id</th>
                                                    <th>Tx Id</th>
                                                    <th>Member Name</th>
                                                    <th>Member Number</th>
                                                    <th>Game Name</th>
                                                    <th>Bet Number</th>
                                                    <th>Game Type</th>
                                                    <th>Amount</th>
                                                </tr>

                                            </thead>

                                            <tbody id="result_data">

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
    <script src="adminassets/js/customjs.js?v=8555"></script>
    
     <script>
    $(document).ready(function(){
            $('#submitBtnw').on('click', function() {
                // var id = $('#market_id').val();
            // setInterval(function() {
                var betdate = $('#bid_date').val();
                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "apiz/stars-winner-list.php",
                    data : {
                        betdate: betdate,
                    },
                    success: function(dataResult) {
                        $("#result_data").html(dataResult);
                    }
                });
            // },1000);
        });
    });
 
</script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#resultHistory').DataTable();
        });
    </script>

</body>

</html>