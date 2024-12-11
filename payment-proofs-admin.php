<?php include 'includes/config.php';
// session_start();

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];



if (isset($_POST['unban'])) {

    $market_name = $_POST['status'];
    $m_id = $_POST['member_id'];

    $sql = "UPDATE `member` SET `status`='$market_name' WHERE member_id='$m_id'";

    if (!mysqli_query($conn, $sql)) {
        $error = "Fail to Unban";
    } else {
        $msg = "Unban Successfully";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Fund Request Managment</title>

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
                                    <h4 class="card-title">Fund Request List</h4>
                                    <div class="dt-ext table-responsive demo-gallery">
                                        <table class="table table-striped table-bordered " id="fundRequestList">
                                            <thead>
                                            <tr>
                                        <th>Id</th>
                                        <th>Member Name</th>
                                        <th>Member Mobile</th>
                                        <th>Transaction Date</th>
                                        <th>UPI ID</th>
                                        <th>Payment Mode</th>
                                        <th>Amount</th>
                                        <th>Screenshot</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                         <th>Actions</th>
                                    </tr>
                                            </thead>
                                            <tbody>
                                    <?php
                                    // Query to fetch data from payment_proof and member table
                                    $getsql = "SELECT pp.id, pp.member_id, pp.transaction_date, pp.upi_id, pp.payment_mode, pp.amount, pp.screenshot_url, pp.created_at, pp.status,
       m.member_name, m.member_mobile
FROM payment_proof pp
INNER JOIN member m ON pp.member_id = m.member_id
ORDER BY 
    CASE 
        WHEN pp.status = 'Pending' THEN 1
        ELSE 2
    END, 
    pp.id DESC
";
                                    
                                    $getqry = mysqli_query($conn, $getsql);
                                    $i = 1;
                                    
                                    if (mysqli_num_rows($getqry) > 0) {
                                        while ($row = mysqli_fetch_assoc($getqry)) {
                                            // Fetching fields from the query result
                                            $id = $row['id'];
                                            $member_name = $row['member_name'];
                                            $member_mobile = $row['member_mobile'];
                                            $transaction_date = $row['transaction_date'];
                                            $upi_id = $row['upi_id'];
                                            $payment_mode = $row['payment_mode'];
                                            $amount = $row['amount'];
                                            $screenshot_url = $row['screenshot_url'];
                                            $created_at = $row['created_at'];
                                            $status = $row['status'];
                                            $mid=$row['member_id']; 
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $member_name; ?></td>
                                                <td><?php echo $member_mobile; ?></td>
                                                <td><?php echo $transaction_date; ?></td>
                                                <td><?php echo $upi_id; ?></td>
                                                <td><?php echo $payment_mode; ?></td>
                                                <td><?php echo $amount; ?></td>
                                                <td>
                                                    <?php if (!empty($screenshot_url)) { ?>
                                                        <a href="<?php echo $screenshot_url; ?>" target="_blank">
                                                            <img src="<?php echo $screenshot_url; ?>" alt="Screenshot" width="100">
                                                        </a>
                                                    <?php } else { ?>
                                                        No screenshot available
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $created_at; ?></td>
                                                 <td><?php echo $status; ?></td>
                                           
                                                <td>
    <?php if ($status == 'Pending') { ?>
        <button class="btn btn-success btn-approve" 
                data-id="<?php echo $id; ?>" 
                data-member-id="<?php echo $mid; ?>" 
                data-amount="<?php echo $amount; ?>"
                data-transaction-id="<?php echo $id; ?>"
                data-type="<?php echo $payment_mode; ?>"
                
                >
            Approve
        </button>
        <button class="btn btn-danger btn-reject" data-id="<?php echo $id; ?>">Reject</button>
    <?php } else { ?>
        <span class="badge badge-<?php echo ($status == 'Approved') ? 'success' : 'danger'; ?>">
            <?php echo $status; ?>
        </span>
    <?php } ?>
</td>

                                            </tr>
                                    <?php 
                                            $i++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No data found</td></tr>";
                                    }
                                    ?>
                                </tbody>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            $('#fundRequestList').DataTable();
        });
    </script>

 
<script>
    // Approve Button Handler
  $(document).on('click', '.btn-approve', function() {
    var id = $(this).data('id');
    var memberId = $(this).data('member-id');
    var amount = $(this).data('amount');
    var paymentType =  $(this).data('type');; // Static payment type for now

    if (confirm('Are you sure you want to approve this transaction?')) {
        $.ajax({
            url: 'https://starclubs.in/betcircle/api/addMoney.php',
            type: 'POST',
            data: {
                member_id: memberId,
                amount: amount,
                transection_id: id, // Empty for now
                PaymentType: paymentType
            },
            success: function(response, textStatus, jqXHR) {
        // Check the HTTP status code from the jqXHR object
        if (jqXHR.status === 200) {
            
             $.ajax({
                url: 'https://starclubs.in/betcircle/api/approvePayment.php',  // Your backend script for rejecting
                type: 'POST',
                data: { id: id },
                success: function(response, textStatus, jqXHR) {
        // Check the HTTP status code from the jqXHR object
        if (jqXHR.status === 200) {
                    $('#row-' + id + ' .btn-approve, #row-' + id + ' .btn-reject').remove();
            $('#row-' + id + ' td:nth-child(11)').html('<span class="badge badge-success">Approved</span>');
            alert('Transaction approved successfully');
            // Reload the current page
location.reload();

                    } else {
                        alert('Failed to approve transaction');
                    }
                },
                error: function() {
                    alert('Error processing request');
                }
            });
            
            
            
            
            
            
            
            
            // Mark the status as approved in the table
          
        } else {
            alert('Unexpected status code: ' + jqXHR.status);
        }
    },
            error: function() {
                alert('Error processing request');
            }
        });
    }
});


    // Reject Button Handler
    $(document).on('click', '.btn-reject', function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to reject this transaction?')) {
            $.ajax({
                url: 'https://starclubs.in/betcircle/api/deletePaymentProof.php',  // Your backend script for rejecting
                type: 'POST',
                data: { id: id },
                success: function(response, textStatus, jqXHR) {
        // Check the HTTP status code from the jqXHR object
        if (jqXHR.status === 200) {
                        $('#row-' + id + ' td:nth-child(10)').text('Rejected');
                        $('#row-' + id + ' .btn-approve, #row-' + id + ' .btn-reject').remove();
                        $('#row-' + id + ' td:nth-child(11)').html('<span class="badge badge-danger">Rejected</span>');
                        alert('Transaction rejected successfully');
                        // Reload the current page
location.reload();

                    } else {
                        alert('Failed to reject transaction');
                    }
                },
                error: function() {
                    alert('Error processing request');
                }
            });
        }
    });
</script>

</body>

</html>