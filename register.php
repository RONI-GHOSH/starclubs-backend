<?php include 'includes/config.php';
date_default_timezone_set('Asia/Calcutta');
// Get the protocol (http or https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
// Get the server name (domain name)
$serverName = $_SERVER['SERVER_NAME'];
// Get the base URL
$baseUrl = $protocol . '://' . $serverName;
// $date = date("Y/m/d");
if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("You are not logged in");window.location = "../admin/index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
if (isset($_POST['submit'])) {
    $api_url = "https://karnimaaonlinedesawar.com/adminapp/api/userRegistration_wotp.php";  // Replace with the actual URL of your API

    $postData = array(
        'name' => $_POST['name'],
        'mobileNum' => $_POST['mobileNum'],
        'password' => $_POST['password'],
        'member_passcode' => $_POST['member_passcode'],
        'referralcode' => isset($_POST['referralcode']) ? $_POST['referralcode'] : ''
    );

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Process $response as needed
    $responseData = json_decode($response, true);
//    echo "API Response: " . print_r($responseData, true);
    if ($responseData && isset($responseData['status']) && $responseData['status'] == 'User Are All ready exist') {
        // User already exists, show alert and redirect
        echo '<script>alert("User already exists");window.location = "register.php";</script>';
        exit;
    } else {
        echo '<script>alert("User Register Successfully!");window.location = "register.php";</script>';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="adminassets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="adminassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="adminassets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="adminassets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="adminassets/css/app.min.css?v=2" id="app-style" rel="stylesheet" type="text/css" />
    <link href="adminassets/css/custom.css?v=11" rel="stylesheet" type="text/css" />
    <!-- ckeditor  -->
    <script type="text/javascript" src="assest/ckeditor/ckeditor.js"></script>
    <!-- ckeditor -->
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        <?php include 'includes/header.php';  ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card p-4">
                                <div class="header">
                                    <h2><strong>User Registration</strong></h2>
                                </div>
                                <div class="body">
                                    <form method="POST" action="register.php" enctype="multipart/form-data">
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label for="market_name">Full Name </label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="name" name="name" class="form-control" required placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_open">Email</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="email" name="email" class="form-control" required placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Mobile</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="mobile" name="mobileNum" class="form-control" required placeholder="Mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Password</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="password" name="password" class="form-control" required placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="passcode">Passcode</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="passcode" name="member_passcode" class="form-control" required placeholder="Passcode">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="referalcode">Referal Code</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="referalcode" name="referalcode" class="form-control" placeholder="Referal Code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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
    <script src="adminassets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="adminassets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
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
    <script src="adminassets/js/customjs.js?v=9212"></script>
</body>

</html>