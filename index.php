<?php include 'includes/config.php';
// session_start();

// if (!isset($_SESSION['useradmin'])) 
// {
//   echo '<script>alert("Please Login First");window.location = "index.php";</script>';
// }
// $usertype = $_SESSION['useradmin'];
header('Access-Control-Allow-Origin: *');
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    
    // header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    // header("Access-Control-Allow-Headers: *");

if (isset($_POST['login'])) {
	$user = htmlspecialchars($_POST['email'], ENT_QUOTES);
	$pass = htmlspecialchars($_POST['password'], ENT_QUOTES);

	$username = $user;
	$password = $pass;
	//$password = md5($_POST['password']);

	$sql = "SELECT * from admin where email='$username' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	// print_r($result);die;
	if (mysqli_num_rows($result) > 0) {
		$_SESSION['useradmin'] = $username;
		echo '<script>window.location = "dashboard.php";</script>';
	} else {
		echo '<script>alert("Invalid Username and Password, Please try again.");window.location = "index.php";</script>';
	}
}
if (isset($_SESSION['useradmin'])) {
	echo '<script>window.location = "dashboard.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Login Page</title>

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
		<div class="home-btn d-none d-sm-block">
			<a href="" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
		</div>
		<div class="account-pages my-5 pt-sm-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6 col-xl-5">
						<div class="card overflow-hidden">
							<div class="bg-soft-primary">
								<div class="row">
									<div class="col-7">
										<div class="text-primary p-4">
											<h5 class="text-primary">Welcome Back !</h5>
											<p>Sign in to continue to Admin Console.</p>
										</div>
									</div>
								</div>
							</div>
							<style>
								.background-div {
									background-image: url('images/indexbackground.jpeg');
									background-size: cover;
									background-position: center;
									width: 100%;
									height: 300px;
								}
							</style>
							<div class="card-body pt-0 background-div">
								<div>
									<a href="#">
										<div class="avatar-md profile-user-wid mb-4">
											<span class="avatar-title rounded-circle bg-white">
												<img src="images/adminlogin.jpg" alt="" class="rounded-circle login_logo">
											</span>
										</div>
									</a>
								</div>
								<div class="p-2">
									<form class="form-horizontal" method="post">

										<div class="form-group">
											<label for="username" style="font-weight:500;font-size:15px;color:white;padding-left:7px;">User Name</label>
											<input type="text" class="form-control" id="name" name="email" placeholder="Enter username">
										</div>

										<div class="form-group" style="padding-top:5px;padding-bottom:5px;">
											<label for="userpassword" style="font-weight:500;font-size:15px;color:white;padding-left:7px;">Password</label>
											<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
										</div>


										<div class="mt-3">
											<button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="login">Log In</button>
										</div>

										<div class="mt-4 text-center">
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
	<script src="adminassets/js/customjs.js?v=1919"></script>


</body>

</html>