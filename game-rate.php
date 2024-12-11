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
    <title>Game Rate</title>

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
        
         <?php include 'includes/header.php';?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-8 mr-auto ml-auto">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add Games Rate</h4>
                                            <form class="theme-form mega-form" action="apiz/update-game-rate.php" name="gameRatesFrm" method="post">
                                                <input type="hidden" name="game_rate_id" value="1">
                                                <div class="row">
                                                <?php 
                                                    $getsql = "SELECT * FROM game_rate WHERE game_name != 'Delhi Jodi'";
                                                    $getqry = mysqli_query($conn, $getsql);
                                                    $i = 1;
                                                    if (mysqli_num_rows($getqry) > 0) {
                                                     while ($row = mysqli_fetch_assoc($getqry)) {
                                                ?>
                                                        <div class="form-group col-md-6">
                                                            <label class="col-form-label"><?php echo $row['game_name']; ?></label>
                                                            <input class="form-control" type="text" name="game_amount[]" id="single_digit_1" value="<?php echo $row['game_amount']; ?>" >
                                                            <input type="hidden" name="id[]" value="<?php echo $row['id'];?>">
                                                        </div>
                                                <?php } }?>
                                                    <!-- <div class="form-group col-md-6">
                                                        <label class="col-form-label">Single Digit Value 2</label>
                                                        <input class="form-control" type="number" name="single_digit_2" id="single_digit_2" value="95" placeholder="Enter Single Digit Value">
                                                    </div> -->
                                                    <!-- <div class="form-group col-md-6">
                                                        <label class="col-form-label">Jodi Digit Value 1</label>
                                                        <input class="form-control" type="number" name="jodi_digit_1" id="jodi_digit_1" value="10" placeholder="Enter Jodi Digit Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Jodi Digit Value 2</label>
                                                        <input class="form-control" type="number" name="jodi_digit_2" id="jodi_digit_2" value="900" placeholder="Enter Jodi Digit Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Single Pana Value 1</label>
                                                        <input class="form-control" type="number" name="single_pana_1" id="single_pana_1" value="10" placeholder="Enter Single Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Single Pana Value 2</label>
                                                        <input class="form-control" type="number" name="single_pana_2" id="single_pana_2" value="1400" placeholder="Enter Single Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Double Pana Value 1</label>
                                                        <input class="form-control" type="number" name="double_pana_1" id="double_pana_1" value="10" placeholder="Enter Double Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Double Pana Value 2</label>
                                                        <input class="form-control" type="number" name="double_pana_2" id="double_pana_2" value="2800" placeholder="Enter Double Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Tripple Pana Value 1</label>
                                                        <input class="form-control" type="number" name="tripple_pana_1" id="tripple_pana_1" value="10" placeholder="Enter Tripple Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Tripple Pana Value 2</label>
                                                        <input class="form-control" type="number" name="tripple_pana_2" id="tripple_pana_2" value="7000" placeholder="Enter Tripple Pana Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Half Sangam Value 1</label>
                                                        <input class="form-control" type="number" name="half_sangam_1" id="half_sangam_1" value="10" placeholder="Enter Half Sangam Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Half Sangam Value 2</label>
                                                        <input class="form-control" type="number" name="half_sangam_2" id="half_sangam_2" value="10000" placeholder="Enter Half Sangam Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Full Sangam Value 1</label>
                                                        <input class="form-control" type="number" name="full_sangam_1" id="full_sangam_1" value="10" placeholder="Enter Full Sangam Value">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Full Sangam Value 2</label>
                                                        <input class="form-control" type="number" name="full_sangam_2" id="full_sangam_2" value="100000" placeholder="Enter Full Sangam Value">
                                                    </div> -->
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary waves-light m-t-10" id="submitBtn" name="update-amount">Update</button>
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

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 text-right">
                                <p>Are you sure you want to logout? If you logout then your session is terminated.</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">Cancel</button>
                                <a href="logout" class="btn btn-info waves-effect waves-light">Logout</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmOpenResutlt" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to delete this result?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <input type="hidden" name="delete_game_id" id="delete_game_id" value="">
                                <button onclick="OpenDeleteResultData();" id="openDecBtn1" class="btn btn-success waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteConfirmOpenStarlineResutlt" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to delete this result?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <input type="hidden" name="delete_starline_game_id" id="delete_starline_game_id">
                                <button onclick="OpenDeleteStarlineResultData();" id="openDecBtn1" class="btn btn-success waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteConfirmOpenGalidisswarResutlt" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to delete this result?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <input type="hidden" name="delete_gali_game_id" id="delete_gali_game_id">
                                <button onclick="OpenDeleteGalidisswarResultData();" id="openDecBtn1" class="btn btn-success waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteConfirmCloseResutlt" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to delete this result?</p>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="delete_close_game_id" id="delete_close_game_id" value="">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <button onclick="closeDeleteResultData();" id="closeDecBtn1" class="btn btn-success waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="fundRequestAcceptModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to accept this fund request?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <button onclick="accept_request(this.value)" id="accept_request_id" class="btn btn-success waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="winnerListModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Winner List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Total Bid Amount : <b><span id="total_bid"></span></b></h5>
                                <h5>Total Winning Amount : <b><span id="total_winneing_amt"></span></b></h5>

                                <div class="dt-ext table-responsive" style="max-height: 400px;overflow-y: scroll;">

                                    <table class="table table-striped table-bordered">

                                        <thead>

                                            <tr>

                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Bid Points</th>
                                                <th>Winning Amount</th>
                                                <th>Type</th>
                                                <th>Bid TX ID</th>

                                            </tr>

                                        </thead>

                                        <tbody id="winner_result_data">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fundRequestRejectModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to reject this fund request?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <button onclick="reject_request(this.value)" id="reject_request_id" class="btn btn-danger waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="fundRequestAutoRejectModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to reject this fund request?</p>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Remark</label>
                                <input type="text" name="reject_auto_remark" id="reject_auto_remark" class="form-control" placeholder="Enter Remark" />
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <button onclick="reject_auto_request(this.value)" id="reject_auto_request_id" class="btn btn-danger waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="autoDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to delete this fund request?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <button onclick="delete_auto_request(this.value)" id="delete_auto_id" class="btn btn-danger waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fundRequestAutoAcceptModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to accept this fund request?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <button onclick="accept_auto_request(this.value)" id="accept_auto_request_id" class="btn btn-success waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="autoDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-frame modal-top modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure you want to delete this fund request?</p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info waves-effect waves-light" data-dismiss="modal">No</button>
                                <button onclick="delete_auto_request(this.value)" id="delete_auto_id" class="btn btn-danger waves-effect waves-light">Yes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="viewWithdrawRequest" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Withdraw Request Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body viewWithdrawRequestBody">



                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div id="requestApproveModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Withdraw Request</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="theme-form" id="withdrawapproveFrm" method="post" enctype="multipart/formdata">
                        <div class="form-group user_info">

                        </div>
                        <div class="form-group">
                            <label for="">Payment Receipt Image<span class="Img_ext">(Allow Only.jpeg,.jpg,.png)</span></label>
                            <input class="form-control" name="file" id="file" type="file" onchange="return validateImageExtensionOther(this.value,1)" />
                        </div>
                        <div class="form-group">
                            <label>Remark</label>
                            <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remark" />
                        </div>
                        <input type="hidden" name="withdraw_req_id" id="withdraw_req_id" value="">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-sm m-t-10" id="submitBtn" name="submitBtn">Submit</button>
                        </div>
                        <div class="form-group m-b-0">
                            <div id="alert_msg_manager"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <div id="requestRejectModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Withdraw Request</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="theme-form" id="withdrawRejectFrm" method="post" enctype="multipart/formdata">
                        <div class="form-group">
                            <label>Remark</label>
                            <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remark" />
                        </div>
                        <input type="hidden" name="withdraw_req_id" id="r_withdraw_req_id" value="">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-sm m-t-10" id="submitBtnReject" name="submitBtnReject">Submit</button>
                        </div>
                        <div class="form-group m-b-0">
                            <div id="alert_msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade " id="open-img-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" style="text-align:right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <img class="my_image" />
                </div>
            </div>
        </div>
    </div>

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
    <script src="adminassets/js/customjs.js?v=7441"></script>


    <script>
        $(document).ready(function() {
            $(".open-img-modal").click(function() {
                var imgsrc = $(this).data('id');
                $('.my_image').attr('src', imgsrc);
                $("#open-img-modal").modal('show');
            });

            $(".categor_select_2").select2({
                placeholder: "Select Category",
                allowClear: true
            });

            $(".select_digit").select2({
                placeholder: "Select Digit",
                allowClear: true
            });

        });

        Date.prototype.toShortFormat = function() {

            var month_names = ["Jan", "Feb", "Mar",
                "Apr", "May", "Jun",
                "Jul", "Aug", "Sep",
                "Oct", "Nov", "Dec"
            ];

            var day = this.getDate();
            var month_index = this.getMonth();
            var year = this.getFullYear();
            var hours = this.getHours();
            var minutes = this.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;

            return "" + day + "-" + month_names[month_index] + "-" + year + " " + strTime;
        }
        var today = new Date();
        var exceldate = today.toShortFormat()
    </script>
    <script>
        //$('.timepicker').val('')

        var options = {
            twentyFour: false,
            upArrow: 'wickedpicker__controls__control-up',
            downArrow: 'wickedpicker__controls__control-down',
            close: 'wickedpicker__close',
            showSeconds: false,
            secondsInterval: 1,
            minutesInterval: 1,
            beforeShow: null,
            show: null,
            clearable: false,

        };
        var seridevi_open_time = $('#seridevi_open_time').val();;
        var seridevi_close_time = $('#seridevi_close_time').val();;
        var madhur_m_open_time = $('#madhur_m_open_time').val();;
        var madhur_m_close_time = $('#madhur_m_close_time').val();;
        var gold_d_open_time = $('#gold_d_open_time').val();;
        var gold_d_close_time = $('#gold_d_close_time').val();;
        var madhur_d_open_time = $('#madhur_d_open_time').val();;
        var madhur_d_close_time = $('#madhur_d_close_time').val();;
        var super_milan_open = $('#super_milan_open').val();;
        var super_milan_close = $('#super_milan_close').val();;
        var rajdhani_d_open = $('#rajdhani_d_open').val();;
        var rajdhani_d_close = $('#rajdhani_d_close').val();;
        var supreme_d_open = $('#supreme_d_open').val();;
        var supreme_d_close = $('#supreme_d_close').val();;
        var sridevi_night_open = $('#sridevi_night_open').val();;
        var sridevi_night_close = $('#sridevi_night_close').val();;
        var gold_night_open = $('#gold_night_open').val();;
        var gold_night_close = $('#gold_night_close').val();;
        var madhure_night_open = $('#madhure_night_open').val();;
        var madhure_night_close = $('#madhure_night_close').val();;
        var supreme_night_open = $('#supreme_night_open').val();;
        var supreme_night_close = $('#supreme_night_close').val();;
        var rajhdhani_night_open = $('#rajhdhani_night_open').val();;
        var rajhdhani_night_close = $('#rajhdhani_night_close').val();;

        $('.timepicker').wickedpicker(options);



        $('#seridevi_open_time').val(seridevi_open_time);;
        $('#seridevi_close_time').val(seridevi_close_time);;
        $('#madhur_m_open_time').val(madhur_m_open_time);;
        $('#madhur_m_close_time').val(madhur_m_close_time);;
        $('#gold_d_open_time').val(gold_d_open_time);;
        $('#gold_d_close_time').val(gold_d_close_time);;
        $('#madhur_d_open_time').val(madhur_d_open_time);;
        $('#madhur_d_close_time').val(madhur_d_close_time);;
        $('#super_milan_open').val(super_milan_open);;
        $('#super_milan_close').val(super_milan_close);;
        $('#rajdhani_d_open').val(rajdhani_d_open);;
        $('#rajdhani_d_close').val(rajdhani_d_close);;
        $('#supreme_d_open').val(supreme_d_open);;
        $('#supreme_d_close').val(supreme_d_close);;
        $('#sridevi_night_open').val(sridevi_night_open);;
        $('#sridevi_night_close').val(sridevi_night_close);;
        $('#gold_night_open').val(gold_night_open);;
        $('#gold_night_close').val(gold_night_close);;
        $('#madhure_night_open').val(madhure_night_open);;
        $('#madhure_night_close').val(madhure_night_close);;
        $('#supreme_night_open').val(supreme_night_open);;
        $('#supreme_night_close').val(supreme_night_close);;
        $('#rajhdhani_night_open').val(rajhdhani_night_open);;
        $('#rajhdhani_night_close').val(rajhdhani_night_close);;
    </script>
    <script>
        dataTable.on('page.dt', function() {
            $('html, body').animate({
                scrollTop: $(".dataTables_wrapper").offset().top - 50
            }, 'slow');
        });
    </script>


</body>

</html>