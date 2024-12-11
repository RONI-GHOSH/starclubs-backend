<?php include 'includes/config.php'; 

date_default_timezone_set('Asia/Calcutta');
// $date = date("Y/m/d");

if (!isset($_SESSION['useradmin']) ) {
  echo '<script>alert("You are not logged in");window.location = "index.php";</script>';
}

$usertype = $_SESSION['useradmin'];

$msg = "";
$error = "";

if (isset($_POST['addmoney'])) {

    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];
    $transaction_date = $_POST['datetime'];  // Capturing the datetime value from the form
    
    $msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
    $mquery = mysqli_query($conn, $msql);
    if ($mrow = mysqli_fetch_array($mquery)) {
        $mbalance = $mrow['member_wallet_balance'];
    }
    
    $mrbalance = $mbalance + $amount;

    $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type) VALUES (' ','$amount','$member_id','$transaction_date,'AddAmt')";
    if (mysqli_query($conn, $sql)) {
    $lastid = mysqli_insert_id($conn);
    $num = rand(10000,100000);
    $pre = "ODR";

    $trans = $pre.$num.$lastid;

    $usql = "UPDATE wallet_transaction SET transaction_id='$trans' WHERE w_transaction_id='$lastid'";
    if(mysqli_query($conn,$usql)){

        $lastid = mysqli_insert_id($conn);
        $num = rand(10000,100000);
        $pre = "PAY";

        $mpsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$member_id'";
        if(mysqli_query($conn,$mpsql)){
             $msg = "Money added Successfully";
        }else {
            $error ='Failure3'; 
        }
    }else {
        $error ='Failure2'; 
    }
}else {
    $error ='Failure';
}
}   


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Wallet Management</title>

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
    
       <!-- Include Flatpickr CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">
       
        <?php include 'includes/header.php';  ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6 mr-auto ml-auto">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add Balance In User Wallet</h4>
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>User List</label>
                                                    <select id="user"  name="member_id" data-live-search="true" class="form-control  select2 show_parent">
                                                         <?php

                                          $getsql = "SELECT * FROM member";
                                          $getqry = mysqli_query($conn, $getsql);
                                          $i = 1;
                                          if (mysqli_num_rows($getqry) > 0) {
                                             while ($row = mysqli_fetch_assoc($getqry)) {
                                        ?>
                                            <option value="<?php echo $row['member_id']; ?>"><?php echo $row['member_mobile'] . '-' . $row['member_name']; ?></option>
                                        <?php }}?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input class="form-control" type="Number" min=0 name="amount" id="amount" placeholder="Enter Amount">
                                                </div>
                                                <!-- DateTime Picker Field -->
<div class="form-group">
    <label>Date and Time</label>
    <input class="form-control" type="datetime" name="datetime" id="datetime" placeholder="Select Date and Time">
</div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary waves-light m-t-10" id="addmoney" name="addmoney">Submit</button>
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

            <div class="col-md-12">
                    <?php if($msg){?>
                    <div class="alert alert-success left-icon-alert" role="alert">
                     <strong>Well done! </strong><?php echo htmlentities($msg); ?>
                     </div><?php } 
                     else if($error){?>
                        <div class="alert alert-danger left-icon-alert" role="alert">
                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                        </div>
                    <?php } ?>
                </div>

            <div id="paymentApprovalModel" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Payment Confirmation</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form class="theme-form" id="paymentApprovalFrm" method="post" enctype="multipart/formdata">

                                <div class="userInfo"></div>
                                <h6>Are you sure you want to transfer amount to this user.</h6>
                                <input type="hidden" id="user_id" name="user_id" value="">
                                <input type="hidden" id="user_amount" name="user_amount" value="">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm m-t-10" id="approvedPayment">Yes</button>
                                    <button type="submit" class="btn btn-danger btn-sm m-t-10" id="rejectPayment">No</button>
                                </div>
                                <div class="form-group m-b-0">
                                    <div id="alert_msg"></div>
                                </div>
                            </form>
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
                                <a href="krisshmatka-admin/logout" class="btn btn-info waves-effect waves-light">Logout</a>

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
    <script src="adminassets/js/customjs.js?v=6003"></script>


<script>
    flatpickr("#datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
</script>

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
        var dataTable = '';
    </script>


</body>

</html>