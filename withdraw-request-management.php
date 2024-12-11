<?php include 'includes/config.php'; 
// session_start();

if (!isset($_SESSION['useradmin'])) 
{
  echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];

if (isset($_POST['reject'])) {

    $member_id = $_POST['member_id'];
    $trans_id = $_POST['trans_id'];
    $amount = $_POST['amount'];

    $msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
    $mquery = mysqli_query($conn, $msql);
    if ($mrow = mysqli_fetch_array($mquery)) {
        $mbalance = $mrow['member_wallet_balance'];
    }

    $newbal = $mbalance + $amount ;

    $sql = "UPDATE member_wallet SET member_wallet_balance='$newbal' WHERE member_id='$member_id'";
    if(!mysqli_query($conn,$sql)) {
       echo '<script>alert("Payment Failed");window.location = "withdraw-request-management.php";</script>';
    }else{
        $qry = "UPDATE wallet_transaction SET withdrawl_status='approved' WHERE w_transaction_id='$trans_id'";
        if(!mysqli_query($conn,$qry)) {
           echo '<script>alert("Payment Failed");window.location = "withdraw-request-management.php";</script>';
        }else{
            echo '<script>alert("Payment Refunded");window.location = "withdraw-request-management.php";</script>';
        }
    }
}elseif (isset($_POST['approve'])) {
    $member_id = $_POST['member_id'];
    $trans_id = $_POST['trans_id'];
    $sql = "UPDATE wallet_transaction SET withdrawl_status='approved' WHERE w_transaction_id='$trans_id'";
    if(!mysqli_query($conn,$sql)) {
       echo '<script>alert("Payment Failed");window.location = "withdraw-request-management.php";</script>';
    }else{
        echo '<script>alert("Payment Approved");window.location = "withdraw-request-management.php";</script>';
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Withdraw Request Managment</title>

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
                        <!-- Zero Configuration  Starts-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Withdraw Request List</h4>

                                    <table class="table table-striped table-bordered " id="withdrawRequestList">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Member Name</th>
                                                <th>Mobile Number</th>
                                                <th>Upi Number</th>
                                                <th>Withdrawl Amount</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                          $getsql = "SELECT m.*,wt.*,mpg.paytm_no,mpg.google_pay_no, mpg.phone_pay_no FROM wallet_transaction wt INNER JOIN member m ON wt.member_id = m.member_id INNER JOIN member_payment_getway mpg ON mpg.member_id = m.member_id WHERE transaction_type = 'WithdrawAmt' AND withdrawl_status ='pending'";
                                          $getqry = mysqli_query($conn, $getsql);
                                          $i = 1;
                                          if (mysqli_num_rows($getqry) > 0) {
                                             while ($row = mysqli_fetch_assoc($getqry)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['member_name']; ?></td>
                                            <td><?php echo $row['member_mobile']; ?></td>
                                            <td><?php $paymentGateways = array_filter([ 'Paytm' => $row['paytm_no'],'Gpay' => $row['google_pay_no'],'Phonepe' => $row['phone_pay_no'],]);
                                                    $formattedGateways = [];
                                                    foreach ($paymentGateways as $key => $value) {
                                                    $formattedGateways[] = ucfirst($key) . ': ' . $value;
                                                    }
                                                    
                                                    echo implode(', ', $formattedGateways); ?>
                                            </td>
                                            <td><?php echo $row['transaction_amount']; ?></td>
                                            <td> 
                                                <form method="POST" action="">
                                                    <input type="hidden" name="trans_id" value="<?php echo $row['w_transaction_id']; ?>">
                                                    <input type="hidden" name="amount" value="<?php echo $row['transaction_amount']; ?>">
                                                    <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
                                                    <button type="submit" name="approve" class="btn btn-success waves-effect m-r-20" >Approve</button>
                                                     <button type="submit" name="reject" class="btn btn-danger waves-effect m-r-20" >Reject</button>
                                                </form>
                                            </td>
                                        </tr>                                  
                                    <?php $i++;}}?>
                                    </tbody>
                                    </table>

                                    <div id="msg"></div>
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
    <script src="adminassets/js/customjs.js?v=4905"></script>

    <script type="text/javascript">
                $(document).ready(function() {
                    $('#withdrawRequestList').DataTable();
                });
            </script>



</body>

</html>