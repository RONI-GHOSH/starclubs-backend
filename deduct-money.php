<?php include 'includes/config.php'; 

date_default_timezone_set('Asia/Calcutta');
// $date = date("Y/m/d");

if (!isset($_SESSION['useradmin']) ) {
  echo '<script>alert("You are not logged in");window.location = "index.php";</script>';
}

$usertype = $_SESSION['useradmin'];

$msg = "";
$error = "";

if (isset($_POST['removemoney'])) {

    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];
    
    $msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
    $mquery = mysqli_query($conn, $msql);
    if ($mrow = mysqli_fetch_array($mquery)) {
        $mbalance = $mrow['member_wallet_balance'];
    }

    $mrbalance = $mbalance - $amount;

    if ($mrbalance >= '0') {

    $mpsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$member_id'";
    if(mysqli_query($conn,$mpsql)){
         $msg = "Money Deduct Successfully" . ' New Balance is - ' . '( '.$mrbalance. ' )' ;
    }else {
        $error ='Money Deduct Fail' . ' New Balance is - ' . '( '.$mrbalance . ' )'; 
    }
}else {
    $error ='Wallet Balance is lower then requested' . ' Account Balance is - ' . '( '.$mbalance . ' )' ;
}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Deduct Wallet Management</title>

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
                        <div class="col-12 col-lg-6 mr-auto ml-auto">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Deduct Balance In User Wallet</h4>
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
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary waves-light m-t-10" id="removemoney" name="removemoney">Submit</button>
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
    <script src="adminassets/js/customjs.js?v=6003"></script>

</body>

</html>