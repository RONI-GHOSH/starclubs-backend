<?php include 'includes/config.php'; 
// session_start();

if (!isset($_SESSION['useradmin'])) 
{
  echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];



if (isset($_POST['unban'])) {

$market_name = $_POST['status'];
$m_id = $_POST['member_id'];
    
    $sql = "UPDATE `member` SET `status`='$market_name' WHERE member_id='$m_id'";
    
    if (!mysqli_query($conn,$sql)) {
            $error = "Fail to Unban";
        }else{
            $msg = "Unban Successfully";
        }
    }

    $totalUsers = 0;
    $totalBalance = 0;

    $getsql = "SELECT member.member_id, member.member_name,member.member_mobile, member_wallet.member_wallet_balance
    FROM member
    INNER JOIN member_wallet ON member.member_id = member_wallet.member_id";
    $result = mysqli_query($conn, $getsql);
    $i = 1;
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $totalUsers++; // Increment the user count
            $totalBalance += (float)$row["member_wallet_balance"]; // Add the balance to the total
        }
        $result->free();
    } else {
        echo "Error: " . $conn->error;
    }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Wallet Managment</title>

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

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">User Wallet List</h4>
                                    <h4 class="card-title">Total Users : <?php  echo $totalUsers;?></h4>
                                    <h4 class="card-title">Total Balance : <?php echo '₹ '.$totalBalance;?> </h4>
                                    <div class="dt-ext table-responsive demo-gallery">
                                        <table class="table table-striped table-bordered " id="userBalanceList">
                                            <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Member Name</th>
                                            <th>Member Mobile</th>
                                            <th>Amount</th>
                                            <!-- <th>Status</th> -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Member Name</th>
                                            <th>Member Mobile</th>
                                            <th>Wallet Balance</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                          $getsql = "SELECT member.member_id, member.member_name,member.member_mobile, member_wallet.member_wallet_balance
                                          FROM member
                                          INNER JOIN member_wallet ON member.member_id = member_wallet.member_id";
                                          $getqry = mysqli_query($conn, $getsql);
                                          $i = 1;
                                          if (mysqli_num_rows($getqry) > 0) {
                                             while ($row = mysqli_fetch_assoc($getqry)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['member_name']; ?></td>
                                            <td><?php echo $row['member_mobile']; ?></td>
                                            <td><?php echo '₹ '.$row['member_wallet_balance']; ?></td>
                                        </tr>
                                    <?php $i++;}}?>
                                        </table>
                                    </div>
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
    <script src="adminassets/js/customjs.js?v=4428"></script>

    <script type="text/javascript">
                $(document).ready(function() {
                    $('#userBalanceList').DataTable();
                });
            </script>


</body>

</html>