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
    <title>Starline Game Rates Managment</title>

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
                        <div class="col-12 col-lg-8 mr-auto ml-auto">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Add Games Rate</h5>
                                            <form class="theme-form mega-form" id="starlineGameRatesFrm" name="starlineGameRatesFrm" method="post">
                                                <input type="hidden" name="game_rate_id" value="1">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Single Digit Value 1</label>
                                                        <input class="form-control" type="number" name="single_digit_1" id="single_digit_1" value="10" placeholder="Enter Single Digit Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Single Digit Value 2</label>
                                                        <input class="form-control" type="number" name="single_digit_2" id="single_digit_2" value="100" placeholder="Enter Single Digit Value">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Single Pana Value 1</label>
                                                        <input class="form-control" type="number" name="single_pana_1" id="single_pana_1" value="10" placeholder="Enter Single Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Single Pana Value 2</label>
                                                        <input class="form-control" type="number" name="single_pana_2" id="single_pana_2" value="1500" placeholder="Enter Single Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Double Pana Value 1</label>
                                                        <input class="form-control" type="number" name="double_pana_1" id="double_pana_1" value="10" placeholder="Enter Double Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Double Pana Value 2</label>
                                                        <input class="form-control" type="number" name="double_pana_2" id="double_pana_2" value="3000" placeholder="Enter Double Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Tripple Pana Value 1</label>
                                                        <input class="form-control" type="number" name="tripple_pana_1" id="tripple_pana_1" value="10" placeholder="Enter Tripple Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Tripple Pana Value 2</label>
                                                        <input class="form-control" type="number" name="tripple_pana_2" id="tripple_pana_2" value="7000" placeholder="Enter Tripple Pana Value">
                                                    </div>


                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary waves-light m-t-10" id="submitBtn" name="buysubmitBtn">Submit</button>
                                                </div>
                                                <div class="form-group">
                                                    <div id="error"></div>
                                                </div>
                                            </form>
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
    <script src="adminassets/js/customjs.js?v=5445"></script>

</body>

</html>