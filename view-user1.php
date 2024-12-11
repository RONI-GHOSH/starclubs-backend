<?php include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) 
{
	echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
$id = $_GET['member_id']; 
// $id = '31';

$getsql = "SELECT m.member_id, m.member_name, m.member_mobile,m.member_referral_code, m.member_password, m.member_passcode, m.member_username, m.create_date, m.update_date, m.status as status , mpg.member_id, mpg.account_no as account_no, mpg.bank_name as bank_name, mpg.ifsc_code as ifsc_code, mpg.ac_holder_name as ac_holder_name, mpg.paytm_no as paytm_no, mpg.google_pay_no as google_pay_no, mpg.phone_pay_no as phone_pay_no , mw.member_wallet_balance FROM member m LEFT JOIN member_payment_getway mpg ON m.member_id = mpg.member_id LEFT JOIN member_wallet mw ON m.member_id = mw.member_id  WHERE m.member_id='$id'  ";
$getqry = mysqli_query($conn, $getsql);
$row = mysqli_fetch_assoc($getqry);
$mname = $row['member_name'];
$mmob = $row['member_mobile'];
$mreferralcode = $row['member_referral_code'];
$mpin = $row['member_passcode'];
$mpass = $row['member_password'];

$acno = $row['account_no'] ?? 'N/A';
$bank_name = $row['bank_name'] ?? 'N/A';
$ifsc_code = $row['ifsc_code'] ?? 'N/A';
$ac_holder_name = $row['ac_holder_name'] ?? 'N/A';
$branch_name = $row['branch_name'] ?? 'N/A';
$paytm_no = $row['paytm_no'] ?? 'N/A';
$google_pay_no = $row['google_pay_no'] ?? 'N/A';
$phone_pay_no = $row['phone_pay_no'] ?? 'N/A';

$mbal = $row['member_wallet_balance'] ?? 'N/A';

$status = $row['status'] ?? 'N/A';



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>View User</title>

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

		<div class="main-content">	<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-flex align-items-center justify-content-between">
							<h4 class="mb-0 font-size-18">User Details</h4>
							<input type="hidden" name="" id="member_id" value="<?php echo $id?>">
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
									<li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a></li>
									<li class="breadcrumb-item active">User Details</li>
								</ol>
							</div>

						</div>
					</div>
				</div>

				<div class="row row_col">
					<div class="col-xl-4">
						<div class="card overflow-hidden h100p">
							<div class="bg-soft-primary">
								<div class="row">
									<div class="col-7">
										<div class="text-primary p-3">
											<h5 class="text-primary"><?php echo $mname?></h5>
											<p><?php echo $mmob?>																		<a href="tel:91<?php echo $mmob?>"><i class="mdi mdi-cellphone-iphone"></i></a>
												<a href="https://wa.me/91<?php echo $mmob?>" target="blank"><i class="mdi mdi-whatsapp"></i></a>
											</p>
										</div>
									</div>
									<div class="col-5 align-center">
										<div class="p-3 text-right">
											<?php 
												if ($status == "Banned") {
													?>
											<div class="mb-2">
												Active:
												<a role="button" class="chngstt" atr="Active" id="success-348-tb_user-user_id-status"><span class="badge badge-pill  badge-danger font-size-12">No</span></a>
											</div>
											<div class="mb-2">
												Banned: 
												<a role="button" class="chngstt" atr="Banned" id="danger-348-tb_user-user_id-betting_status"><span class="badge badge-pill badge-success font-size-12">Yes</span></a>
											</div>
													<?php }else {
														?>
											<div class="mb-2">
												Active:
												<a role="button" class="chngstt" atr="Active" id="success-348-tb_user-user_id-status"><span class="badge badge-pill badge-success font-size-12">Yes</span></a>
											</div>
											<div class="mb-2">
												Banned: 
												<a role="button" class="chngstt" atr="Banned" id="danger-348-tb_user-user_id-betting_status"><span class="badge badge-pill badge-danger font-size-12">No</span></a>
											</div>
														<?php
													}
											?>
											

										</div>
									</div>
								</div>
							</div>
							<div class="card-body pt-0">
								<div class="row">
									<div class="col-sm-4">
										<div class="avatar-md profile-user-wid mb-4">
											<img src="adminassets/images/user.png" alt="" class="img-thumbnail rounded-circle">
										</div>

									</div>
								</div>
							</div>
							<div class="card-body border-top">

								<div class="row">
									<div class="col-sm-12">
										<div>
											<p class="text-muted mb-2">Available Balance</p>
											<h5><?php echo $mbal?></h5>
										</div>

									</div>

									<div class="col-sm-6">
										<div class="mt-3">
											<button class="btn btn-success btn-sm w-md btn-block" id="adFund">Add Fund</button>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="mt-3">
											<button class="btn btn-danger btn-sm w-md btn-block" id="withdrawFund"> Withdrawl Fund </button>
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>

					<div class="col-xl-8">
						<div class="card h100p">
							<div class="card-body">
								<h4 class="card-title mb-4">Personal Information</h4>
								<div class="table-responsive">
									<table class="table table-nowrap mb-0">
										<tbody>
											<tr>
												<th scope="row">Full Name :</th>
												<td><?php echo $mname?></td>
												<th>Security Pin</th>
												<td><?php echo $mpin?></td>
												<button  class="btn btn-success btn-sm w-md" onclick="editUserDetails('<?php echo $mmob ?>', '<?php echo $mpin ?>','<?php echo $id ?>')">Edit</button>

											</tr>
											<tr>
												<th scope="row">Mobile :</th>
												<td><?php echo $mmob?>												<a href="tel:91<?php echo $mmob?>"><i class="mdi mdi-cellphone-iphone"></i></a>
													<a href="https://wa.me/91<?php echo $mmob?>" target="blank"><i class="mdi mdi-whatsapp"></i></a>
												</td>
												<th scope="row">Password :</th>
												<td><?php echo $mpass?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<h4 class="card-title mb-4">Payment Information</h4>
								<div class="table-responsive">
									<table class="table table-nowrap mb-0">
										<tbody>
											<tr>
												<th scope="row">Bank Name :</th>
												<td><?php echo $bank_name ?></td>
												<th scope="row">A/c Holder Name :</th>
												<td><?php echo $ac_holder_name ?></td>
												<th scope="row"></th>
												<td></td>

											</tr>
											<tr>
												<th scope="row">A/c Number :</th>
												<td><?php echo $acno ?></td>
												<th scope="row">IFSC Code :</th>
												<td><?php echo $ifsc_code ?></td>
												<th scope="row"></th>
												<td></td>

											</tr>
											<tr>
												<th scope="row">PhonePe No. :</th>
												<td><?php echo $phone_pay_no ?></td>
												<th scope="row">Google Pay No. :</th>
												<td><?php echo $google_pay_no ?></td>
												<th scope="row">Paytm No. :</th>
												<td><?php echo $paytm_no ?></td>

											</tr>
											<tr>
											    <th scope="row">Referral Code :</th>
											    <td> <?php echo $mreferralcode; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

			<!--<div class="container-fluid">
				<div class="row"> 
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Add Fund Request List</h4>
								<div class="demo-gallery">
									<table id="addFundList" class="table table-striped table-bordered  list-unstyled">
										<thead> 
											<tr>
												<th>#</th>
												<th>Request Amount</th>
												<th>Request	No.</th>
												<th>Date</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div id="msg"></div>
							</div>
						</div>
					</div>
				</div>
			</div>-->

			<div class="container-fluid">
				<div class="row"> 
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Withdraw Fund Request List</h4>
								<div class="demo-gallery">
									<table id="withdrawTable" class="table table-striped table-bordered list-unstyled">
										<thead> 
											<tr>
												<th>#</th>
												<th>Request Amount</th>
												<th>Request	No.</th>
												<th>Request Date</th>
												<th>Status</th>
												<!--<th>Action</th>-->
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div id="msg"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" id="user_id" value="<?php echo $id;?>">

			<div class="container-fluid">
				<div class="row"> 
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Bid History</h4>
								<div class="">
									<table id="bidHistoryTable" class="table table-striped table-bordered">
										<thead> 
											<tr>
												<th>#</th>
												<th>Game Name</th>
												<th>Game Type</th>
												<th>Session</th>
												<th>Digits</th>
												<th>Close Digits</th>
												<th>Points</th>
												<th>Date</th>
											</tr>
										</thead>
									</table>
								</div>
								<div id="msg"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 col-xl-12 xl-100">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Wallet Transaction History</h4>
								<ul class="nav nav-tabs nav-tabs-custom nav-justified" id="top-tab" role="tablist">
									<li class="nav-item"><a class="nav-link active" id="top-allr-tab" data-toggle="tab" href="#top-allr" role="tab" aria-controls="top-allr" aria-selected="true">All</a></li>
								</ul>
								<div class="tab-content p-3" id="top-tabContent">
									<div class="tab-pane fade show active" id="top-allr" role="tabpanel" aria-labelledby="top-allr-tab">
										<div class="">
											<table id="allTransactionTable" class="table table-striped table-bordered">
												<thead>
													<tr> 
														<th>#</th>
														<th>Tx Req. No.</th>
														<th>Amount</th>
														<th>Transaction Type</th>
														<!-- <th>Transfer Note</th> -->
														<th>Date</th>
														
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div id="addFundModel" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Fund</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form class="theme-form" method="post" enctype="multipart/formdata">

							<div class="form-group">
								<label class="col-form-label">Amount</label>
								<input class="form-control" type="Number" min="0" name="addamount" id="addamount" placeholder="Enter Amount" data-original-title="" title="">
							</div>
							<input type="hidden" name="member_id" id="member_id" value="<?php echo $id?>">
							<div class="form-group">							
								<button type="button" class="btn btn-info btn-sm m-t-10" id="submitAddBtn" name="submitBtn">Submit</button>
							</div>
						</form>
					</div>
					<div class="modal-footer">

					</div>
				</div>
			</div>
		</div>

		<div id="withdrawFundModel" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Withdrawl Fund</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form class="theme-form" method="post" >
							<div class="form-group">
								<label class="col-form-label">Amount</label>
								<input class="form-control" type="Number" min="0" name="subamount" id="subamount" placeholder="Enter Amount" data-original-title="" title="">
							</div>
							<input type="hidden" name="member_id" id="member_id" value="<?php echo $id?>">
							<div class="form-group">							
								<button type="button" class="btn btn-info btn-sm m-t-10" id="submitSubBtn" name="submitBtn2">Submit</button>
							</div>
						</form>
					</div>
					<div class="modal-footer">

					</div>
				</div>
			</div>
		</div>

		<div id="changePinModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Change Pin</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form class="theme-form"  id="changePinFrm" method="post" enctype="multipart/formdata">

							<div class="form-group">
								<label class="col-form-label">Enter New Pin</label>
								<input class="form-control digit_number" type="number" name="security_pin" id="security_pin" placeholder="Enter Security Pin" min="0" max="9999" maxlength="4">
							</div>
							<input type="hidden" name="user_id" id="user_id" value="348">
							<div class="form-group">							
								<button type="submit" class="btn btn-info btn-sm m-t-10" id="submitchangepinBtn" name="submitchangepinBtn">Submit</button>
							</div>
							<div class="form-group m-b-0">
								<div id="alert_msg"></div>
							</div>
						</form>
					</div>
					<div class="modal-footer">

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
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>	
		<footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<script>document.write(new Date().getFullYear())</script> ©Matka.
					</div>
					<div class="col-sm-6">
						<div class="text-sm-right d-none d-sm-block">

						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>	</div>


	<input type="hidden" id="base_url" value="">
	<input type="hidden" id="admin" value="">
	
	<div id="snackbar"></div>
	<div id="snackbar-info"></div>
	<div id="snackbar-error"></div>
	<div id="snackbar-success"></div>
	
	
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
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>


	<div id="requestApproveModel" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Approve Withdraw Request</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form class="theme-form"  id="withdrawapproveFrm" method="post" enctype="multipart/formdata">
						<div class="form-group user_info">

						</div>
						<div class="form-group">
							<label for="">Payment Receipt Image<span class="Img_ext">(Allow Only.jpeg,.jpg,.png)</span></label>
							<input class="form-control" name="file" id="file" type="file" onchange="return validateImageExtensionOther(this.value,1)"/>
						</div>
						<div class="form-group">
							<label>Remark</label>
							<input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remark"/>
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
					<form class="theme-form"  id="withdrawRejectFrm" method="post" enctype="multipart/formdata">
						<div class="form-group">
							<label>Remark</label>
							<input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remark"/>
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


	<!-- Modal or Form for Editing -->
<div  class="modal fade " role="dialog" id="editModal" data-dismiss="modal">
    		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				    <h4 class="mb-0 font-size-18">Update Mobile Number and Mpins</h4>
				    					<button type="button" class="close" style="text-align:right" data-dismiss="modal">&times;</button>
                        </div>
				    <div class="modal-body">
    <label for="editMobile">Mobile:</label>
    <input type="text" id="editMobile" value="<?php echo $mmob ?>">

    <label for="editPassword">Mpin:</label>
    <input type="text" id="editPassword" value="<?php echo $mpass ?>">
    <input type="hidden" id="memberId" value="<?php echo $id ?>">

    <button onclick="updateUserDetails()" class="btn btn-success btn-sm">Update</button>
    </div></div></div>
</div>
	<div class="modal fade " id="open-img-modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="text-align:right" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<img class="my_image"/>
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
	<script src="adminassets/js/customjs.js?v=1463"></script>
	

	<script>
	function editUserDetails(mobile, password, id) {
        // Set initial values in the modal or form
        $('#editMobile').val(mobile);
        $('#editPassword').val(password);
        $('#memberId').val(id);
        
        // Show the modal or form
        $("#editModal").modal('show');
    }
    
    function updateUserDetails() {
        // Get updated values from the modal or form
        var updatedMobile = $('#editMobile').val();
        var updatedPassword = $('#editPassword').val();
        var memberId = $('#memberId').val();

        // Perform AJAX request to update the user details
        $.ajax({
            url: 'api/update_user_details.php', // Update with your server-side script
            type: 'post',
            data: {
                mobile: updatedMobile,
                password: updatedPassword,
                id: memberId
            },
            success: function (data) {
                // Handle the success response, e.g., update the displayed values
                $('#mmob').text(updatedMobile);
                $('#passwordDisplay').text(updatedPassword);

                // Hide the modal or form
                $('#editModal').modal('hide');
                alert('Data updated successfully')
               location.reload()
            },
            error: function (error) {
                // Handle the error response
                console.error(error);
            }
        });
    }
		$(document).ready(function(){

			$(".open-img-modal"	).click(function(){
				var imgsrc = $(this).data('id');
				$('.my_image').attr('src',imgsrc);
				$("#open-img-modal").modal('show');
			});

			$(".categor_select_2").select2({
				placeholder: "Select Category",
				allowClear: true
			});

			$(".select_digit").select2({
				placeholder: "Select Digit",
				allowClear : true
			});

		});

		Date.prototype.toShortFormat = function() {

			var month_names =["Jan","Feb","Mar",
			"Apr","May","Jun",
			"Jul","Aug","Sep",
			"Oct","Nov","Dec"];

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
	</script>


	<script type="text/javascript">
		var member_id = $('#member_id').val();
		$('#addFundList').DataTable({
            "ajax":"apiz/add_fund_list.php?member_id="+member_id,
            "data": [],
        });
	</script>

	<script type="text/javascript">
		var member_id = $('#member_id').val();
		$('#bidHistoryTable').DataTable({
            "ajax":"apiz/member_bet.php?member_id="+member_id,
            "data": [],
        });
	</script>

	<script type="text/javascript">
		var member_id = $('#member_id').val();
		$('#allTransactionTable').DataTable({
            "ajax":"apiz/transaction_history.php?member_id="+member_id,
            "data": [],
        });
	</script>

	<script type="text/javascript">
		var member_id = $('#member_id').val();
		$('#withdrawTable').DataTable({
            "ajax":"apiz/withdrawl_request.php?member_id="+member_id,
            "data": [],
        });
	</script>

<script type="text/javascript">
  $(document).ready(function() {
    // Approve Request
    var member_id = $('#member_id').val();
    $(document).on('click', '.chngstatus', function() {
      var trans_id = $(this).attr('data-withdraw_request_id');
      var amount = $(this).attr('amount');
      var action = $(this).attr('stat');

      alert(member_id + ' ' + trans_id + ' ' + amount + ' ' + action )

      $.ajax({
        url: 'apiz/withdrawal_status.php',
        type: 'POST',
        data: {
          'member_id': member_id,
          'trans_id': trans_id,
          'amount': amount,
          'action': action,
        },
        success: function(response) {
        	alert(response)
           // location.reload()
        }
      });
    });
  });
</script>

<script type="text/javascript">
      $(document).ready(function() {
        // Approve Request
        $(document).on('click', '.chngstt', function() {
          var atr = $(this).attr('atr');
          var member_id = $('#member_id').val();

          // alert(member_id + ' ' + atr )

          $.ajax({
            url: 'apiz/change_member_stat.php',
            type: 'POST',
            data: {
              'member_id': member_id,
              'atr': atr,
            },
            success: function(response) {
                alert(response)
               location.reload()
            }
          });
        });
      });
</script>

<script type="text/javascript">
      $(document).ready(function() {
        // Approve Request
        $(document).on('click', '#submitAddBtn', function() {
          var amount = $('#addamount').val();
          var member_id = $('#member_id').val();

          // alert(member_id + ' ' + atr )

          $.ajax({
            url: 'apiz/addMoney.php',
            type: 'POST',
            data: {
              'member_id': member_id,
              'amount': amount,
            },
            success: function(response) {
                alert(response)
               location.reload()
            }
          });
        });
      });
</script>

<script type="text/javascript">
      $(document).ready(function() {

        // Approve Request
        $(document).on('click', '#submitSubBtn', function() {
          var amount = $('#subamount').val();
          var member_id = $('#member_id').val();

          // alert(member_id + ' ' + atr )

          $.ajax({
            url: 'apiz/subMoney.php',
            type: 'POST',
            data: {
              'member_id': member_id,
              'amount': amount,
            },
            success: function(response) {
                alert(response)
               location.reload()
            }
          });
        });
      });
</script>


	
</body>

</html>