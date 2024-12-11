<?php include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Fund request Managment QR</title>

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
    <link href="adminassets/css/main-style.css" rel="stylesheet" type="text/css" />
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
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Fund Request QR</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Fund Request QR</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Member Name</th>
                                                <th>Member Mobile</th>
                                                <th>Transaction Id</th>
                                                <th>Amount</th>
                                                <th>Bonus</th>
                                                <th>Total Amount</th>
                                                <th>Date Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Member Name</th>
                                                <th>Member Mobile</th>
                                                <th>Transaction Id</th>
                                                <th>Amount</th>
                                                <th>Bonus</th>
                                                <th>Total Amount</th>
                                                <th>Date Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $date_transection = $dateTime;
                                            //$getsql = "SELECT * FROM wallet_transaction wt INNER JOIN member m ON wt.member_id = m.member_id  WHERE wt.transaction_type = 'AddAmtQrcode' ORDER BY wt.w_transaction_id DESC";
                                            $getsql = "SELECT wt.*, m.member_id as member_id, m.status as member_status, m.member_name as member_name, m.member_mobile as member_mobile FROM wallet_transaction wt INNER JOIN member m ON wt.member_id = m.member_id  WHERE wt.transaction_type = 'AddAmtQrcode' ORDER BY wt.w_transaction_id DESC";
                                            $mquery = mysqli_query($conn, $getsql);
                                            $i = 0;
                                            if (mysqli_num_rows($mquery) > 0) {
                                                while ($row = mysqli_fetch_assoc($mquery)) {
                                                    $i = $i + 1;
                                                    $member_id = $row['member_id'];
                                                    $member_name = $row['member_name'];
                                                    $member_mobile = $row['member_mobile'];


                                                    $id = $row['w_transaction_id'];
                                                    $transaction_id = $row['transaction_id'];
                                                    $transaction_amount = $row['transaction_amount'];
                                                    $transaction_update_date = $row['transaction_update_date'];
                                                    $add_bonus = $row['add_bonus'];
                                                    $total = $transaction_amount + $add_bonus;

                                                    $status = $row['status'];

                                            ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $member_name; ?></td>
                                                        <td><?php echo $member_mobile ?></td>
                                                        <td><?php echo $transaction_id; ?></td>
                                                        <td><?php echo $transaction_amount; ?></td>
                                                        <td><?php echo $add_bonus; ?></td>
                                                        <td><?php echo $total; ?></td>
                                                        <td><?php echo $transaction_update_date; ?></td>
                                                        <td>
                                                            <?php if ($status == "2") { ?>
                                                                <select style="width:80px;height:auto;" name="qr_status" id="qr_status_<?php echo $id; ?>">
                                                                    <option value="2">Pending</option>
                                                                    <option value="1">Accept</option>
                                                                    <option value="3">Reject</option>
                                                                </select>
                                                            <?php } elseif ($status == 1) { ?>
                                                                Accept
                                                            <?php } elseif ($status == 3) { ?>
                                                                Reject
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
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

    <script type="text/javascript">
        var member_id = $('#member_id').val();
        $('#userList').DataTable({
            "ajax": "apiz/get_member_list.php",
            "data": [],
        });
    </script>

    <script>
        dataTable.on('page.dt', function() {
            $('html, body').animate({
                scrollTop: $(".dataTables_wrapper").offset().top - 50
            }, 'slow');
        });
    </script>

    <script type="text/javascript">
        function userOneChange_status(cp) {
            var label = $(cp).attr('alt');
            $.post("apiz/user-status-one-change.php", {
                    id: $(cp).data('normalone'),
                    status: $(cp).is(':checked') == true ? '1' : '2'
                },
                function(data) {
                    if (data == 'fail') {
                        $.notify("Status Not Changed", "error");

                    } else {
                        $("label[name=" + label + "]").text(data);
                        location.reload();
                        //$('#datatable-buttons').DataTable().ajax.reload();
                    }
                });
        }
    </script>

    <script type="text/javascript">
        function userTwoChange_status(cp) {
            var label = $(cp).attr('alt');
            $.post("apiz/user-status-two-change.php", {
                    id: $(cp).data('normalone'),
                    status: $(cp).is(':checked') == true ? '1' : '2'
                },
                function(data) {
                    if (data == 'fail') {
                        $.notify("Status Not Changed", "error");

                    } else {
                        $("label[name=" + label + "]").text(data);
                        location.reload();
                    }
                });
        }
    </script>

    <script type="text/javascript">
        function truncateTables() {

            // Get start date and end date from input fields
            var startDate = $('#startdate').val();
            var endDate = $('#enddate').val();
            // Validate date format (additional validation may be needed)
            var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
            if (!dateRegex.test(startDate) || !dateRegex.test(endDate)) {
                alert('Invalid date format. Please use YYYY-MM-DD.');
                return;
            }

            // Send AJAX request to the server
            $.ajax({
                url: 'api/truncate_tables.php', // Replace with your server-side script
                type: 'post',
                dataType: 'json',
                data: {
                    startdate: startDate,
                    enddate: endDate
                },
                success: function(response) {
                    // Handle success response
                    if (response && typeof response === 'object') {
                        // Access the property that holds the success message
                        var valuesArray = Object.values(response);

                        // Display the array
                        alert(JSON.stringify(valuesArray));
                        location.reload();

                    } else {
                        // If the response is not an object, display it as is
                        alert(response);
                    }
                },
                error: function(error) {
                    alert(error);
                    // Handle error response
                    console.error(error);
                }
            });
        }

        function userThreeChange_status(cp) {
            var label = $(cp).attr('alt');

            $.post("apiz/qr_status_change.php", {
                    id: $(cp).data('normalone'),
                    status: $(cp).is(':checked') == true ? '1' : '2'
                },
                function(data) {
                    alert(data);
                    if (data == 'fail') {
                        $.notify("Status Not Changed", "error");

                    } else {
                        $("label[name=" + label + "]").text(data);
                        location.reload();
                    }
                });
        }
    </script>


    <script>
        $(document).ready(function() {
            $('select[name="qr_status"]').change(function() {
                var id = $(this).attr('id').split('_')[2]; // Extract the ID from the dropdown's ID
                var newValue = $(this).val(); // Get the selected value
                // alert("ID: " + id + ", Value: " + newValue); // Alert the ID and value

                $.ajax({
                    type: 'POST',
                    url: 'apiz/qr_status_change.php',
                    data: {
                        id: id,
                        newValue: newValue
                    },
                    success: function(response) {                        
                        if (response == 'fail') {
                            $.notify("Status Not Changed", "error");

                        } else {
                            alert('Payment Status Changed Successfully!');
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });

            });
        });
    </script>


</body>

</html>