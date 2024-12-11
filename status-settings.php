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

$msg = "";
$error = "";

if (isset($_POST['updateqrcode'])) {

    $slider_status = $_POST["slider_status"];
    $notification_status = $_POST["notification_status"];
    $call_status = $_POST["call_status"];
    $whatsapp_status = $_POST["whatsapp_status"];
    $qr_status = $_POST["qr_status"];
    $game_mode = $_POST["game_mode"];
    $starline_status = $_POST["starline_status"];
    $front_game_status = $_POST["front_game_status"];
    $second_game_status = $_POST["second_game_status"];
    $third_game_status = $_POST["third_game_status"];
    $fourth_game_status = $_POST["fourth_game_status"];
    $jantri_status = $_POST["jantri_status"];
    $autoresult = $_POST["autoresult"];

    $sql = "UPDATE admin SET slider_status='$slider_status', notification_status='$notification_status', call_status='$call_status', 
    whatsapp_status='$whatsapp_status', qr_status='$qr_status', game_mode='$game_mode', starline_status='$starline_status', 
    front_game_status='$front_game_status', second_game_status='$second_game_status', third_game_status='$third_game_status', 
    fourth_game_status='$fourth_game_status', jantri_status='$jantri_status', autoresult = '$autoresult' WHERE id='1'";

    if (mysqli_query($conn, $sql)) {
        $msg = "Status Updated Successfully";
    } else {
        $error = "Fail to Update Settings";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="adminassets/images/favicon.ico">
    <link href="adminassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="adminassets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="adminassets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/css/app.min.css?v=2" id="app-style" rel="stylesheet" type="text/css" />
    <link href="adminassets/css/custom.css?v=11" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="assest/ckeditor/ckeditor.js"></script>
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        <?php include 'includes/header.php';  ?>
        <div class="main-content">
            <div class="page-content">
                <div class="col-md-12">
                    <?php if ($msg) { ?>
                        <div class="alert alert-success left-icon-alert" role="alert">
                            <strong>Well done! </strong><?php echo htmlentities($msg); ?>
                        </div><?php } else if ($error) { ?>
                        <div class="alert alert-danger left-icon-alert" role="alert">
                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card p-4">
                                <div class="header">
                                    <h2><strong>Setting</strong> <small>&nbsp; &nbsp; Update Some Important Status</small> </h2>
                                </div>
                                <div class="body">
                                    <?php
                                    $sql = "SELECT * FROM admin";
                                    $getqry = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($getqry);
                                    $slider_status = $row["slider_status"];
                                    $notification_status = $row["notification_status"];
                                    $call_status = $row["call_status"];
                                    $whatsapp_status = $row["whatsapp_status"];
                                    $qr_status = $row["qr_status"];
                                    $game_mode = $row["game_mode"];
                                    $starline_status = $row["starline_status"];
                                    $front_game_status = $row["front_game_status"];
                                    $second_game_status = $row["second_game_status"];
                                    $third_game_status = $row["third_game_status"];
                                    $fourth_game_status = $row["fourth_game_status"];
                                    $jantri_status = $row["jantri_status"];
                                    $autoresult = $row["autoresult"];
                                    ?>
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Auto Result</label>
                                                    <select class="form-control" name="autoresult" id="autoresult">
                                                        <option <?php if ($autoresult == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($autoresult == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Slider</label>
                                                    <select class="form-control" name="slider_status" id="slider_status">
                                                        <option <?php if ($slider_status == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($slider_status == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Notification</label>
                                                    <select class="form-control" name="notification_status" id="notification_status">
                                                        <option <?php if ($notification_status == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($notification_status == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Call</label>
                                                    <select class="form-control" name="call_status" id="call_status">
                                                        <option <?php if ($call_status == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($call_status == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Whatsapp</label>
                                                    <select class="form-control" name="whatsapp_status" id="whatsapp_status">
                                                        <option <?php if ($whatsapp_status == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($whatsapp_status == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">QR Code</label>
                                                    <select class="form-control" name="qr_status" id="qr_status">
                                                        <option <?php if ($qr_status == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($qr_status == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Game Mode</label>
                                                    <select class="form-control" name="game_mode" id="game_mode">
                                                        <option <?php if ($game_mode == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($game_mode == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">StarLine</label>
                                                    <select class="form-control" name="starline_status" id="starline_status">
                                                        <option <?php if ($starline_status == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($starline_status == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Front Game</label>
                                                    <select class="form-control" name="front_game_status" id="front_game_status">
                                                        <option <?php if ($front_game_status == 'gali') {
                                                                    echo 'selected';
                                                                }  ?> value="gali">Gali</option>
                                                        <option <?php if ($front_game_status == 'mumbai') {
                                                                    echo 'selected';
                                                                } ?> value="mumbai">Mumbai</option>
                                                        <option <?php if ($front_game_status == 'color') {
                                                                    echo 'selected';
                                                                }  ?> value="color">Color</option>
                                                        <option <?php if ($front_game_status == 'jodi') {
                                                                    echo 'selected';
                                                                } ?> value="jodi">Jodi</option>
                                                        <option <?php if ($front_game_status == 'roulet') {
                                                                    echo 'selected';
                                                                } ?> value="roulet">Roulet</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Second Game</label>
                                                    <select class="form-control" name="second_game_status" id="second_game_status">
                                                        <option <?php if ($second_game_status == 'gali') {
                                                                    echo 'selected';
                                                                }  ?> value="gali">Gali</option>
                                                        <option <?php if ($second_game_status == 'mumbai') {
                                                                    echo 'selected';
                                                                } ?> value="mumbai">Mumbai</option>
                                                        <option <?php if ($second_game_status == 'color') {
                                                                    echo 'selected';
                                                                }  ?> value="color">Color</option>
                                                        <option <?php if ($second_game_status == 'jodi') {
                                                                    echo 'selected';
                                                                } ?> value="jodi">Jodi</option>
                                                        <option <?php if ($second_game_status == 'roulet') {
                                                                    echo 'selected';
                                                                } ?> value="roulet">Roulet</option>
                                                        <option <?php if ($second_game_status == 'hide') {
                                                                    echo 'selected';
                                                                } ?> value="hide">Hide</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Third Game</label>
                                                    <select class="form-control" name="third_game_status" id="third_game_status">
                                                        <option <?php if ($third_game_status == 'gali') {
                                                                    echo 'selected';
                                                                }  ?> value="gali">Gali</option>
                                                        <option <?php if ($third_game_status == 'mumbai') {
                                                                    echo 'selected';
                                                                } ?> value="mumbai">Mumbai</option>
                                                        <option <?php if ($third_game_status == 'color') {
                                                                    echo 'selected';
                                                                }  ?> value="color">Color</option>
                                                        <option <?php if ($third_game_status == 'jodi') {
                                                                    echo 'selected';
                                                                } ?> value="jodi">Jodi</option>
                                                        <option <?php if ($third_game_status == 'roulet') {
                                                                    echo 'selected';
                                                                } ?> value="roulet">Roulet</option>
                                                        <option <?php if ($third_game_status == 'hide') {
                                                                    echo 'selected';
                                                                } ?> value="hide">Hide</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Fourth Game</label>
                                                    <select class="form-control" name="fourth_game_status" id="fourth_game_status">
                                                        <option <?php if ($fourth_game_status == 'gali') {
                                                                    echo 'selected';
                                                                }  ?> value="gali">Gali</option>
                                                        <option <?php if ($fourth_game_status == 'mumbai') {
                                                                    echo 'selected';
                                                                } ?> value="mumbai">Mumbai</option>
                                                        <option <?php if ($fourth_game_status == 'color') {
                                                                    echo 'selected';
                                                                }  ?> value="color">Color</option>
                                                        <option <?php if ($fourth_game_status == 'jodi') {
                                                                    echo 'selected';
                                                                } ?> value="jodi">Jodi</option>
                                                        <option <?php if ($fourth_game_status == 'roulet') {
                                                                    echo 'selected';
                                                                } ?> value="roulet">Roulet</option>
                                                        <option <?php if ($fourth_game_status == 'hide') {
                                                                    echo 'selected';
                                                                } ?> value="hide">Hide</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Jantri</label>
                                                    <select class="form-control" name="jantri_status" id="jantri_status">
                                                        <option <?php if ($jantri_status == 'Active') {
                                                                    echo 'selected';
                                                                }  ?> value="Active">Active</option>
                                                        <option <?php if ($jantri_status == 'Inactive') {
                                                                    echo 'selected';
                                                                } ?> value="Inactive">Inacitve</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateqrcode" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <hr class="m-0">
                                        <br>
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
    <script src="adminassets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="adminassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
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
    <script src="adminassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="adminassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="adminassets/js/pages/datatables.init.js"></script>
    <script src="adminassets/js/app.js"></script>
    <script src="adminassets/js/customjs.js?v=9212"></script>
</body>

</html>