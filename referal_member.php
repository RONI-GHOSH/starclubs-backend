<?php include 'includes/config.php';
$get_member_id = $_GET['member_id'];

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Managment</title>

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
                                <h4 class="mb-0 font-size-18">User List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">User List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title d-flex align-items-center justify-content-between">&nbsp; <a href="un-approved-users-list.php" class="btn btn-primary waves-effect waves-light btn-sm">Un-approved Users List</a>
                                    <!--<a href="" class="btn btn-primary waves-effect waves-light btn-sm">Clear Bid and Winning History</a>-->
                                </h4>
                                <form method="POST">
                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <label for="market_close">Select Start Date</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control" placeholder="Date" id="startdate" name="startdate" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="market_close">Select End Date</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control" placeholder="Date" id="enddate" name="enddate" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-success" onclick="truncateTables()"> Clear History </button>
                                        </div>

                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Mobile No</th>
                                                <th>Referral Code</th>
                                                <th>Referral Count</th>
                                                <th>P.Ref Code</th>
                                                <th>Wallet Balance</th>
                                                <!-- <th>Betting</th>
                                                <th>Transfer</th>
                                                <th>Active</th> -->
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $msql = "SELECT 
m.member_id, 
m.member_name, 
m.member_mobile, 
m.member_referral_code, 
m.member_password, 
m.status,
m.status_second,
m.status_third, 
mw.member_wallet_balance,
COUNT(r.referrer_id) AS referral_count
FROM 
member_referral r
LEFT JOIN 
member m ON r.referrer_id = m.member_id
LEFT JOIN 
member_wallet mw ON m.member_id = mw.member_id
WHERE 
m.status != 'Banned' AND r.member_id = $get_member_id
GROUP BY 
m.member_id
ORDER BY 
m.member_id DESC";
                                            $mquery = mysqli_query($conn, $msql);
                                            $i = 1;
                                            if (mysqli_num_rows($mquery) > 0) {
                                                while ($row = mysqli_fetch_assoc($mquery)) {
                                                    $id = $row['member_id'];
                                                    $status = $row['status'];
                                                    $status_second = $row['status_second'];
                                                    $status_third = $row['status_third'];

                                                    if ($status_third == "Active") {
                                                        $normalStatus = "<div class='checkbox_select'>
<input type='checkbox' id='candidateDetail" . $i . "'  class='optin required checkbox-toggle' checked style='display: none; visibility: hidden;' onclick='userOneChange_status(this);' alt='onestatus" . $i . "' data-normalone='" . $id . "'>
<label for='candidateDetail" . $i . "' class='optin required' name='onestatus" . $i . "'>" . $status_third . "</label>
</div>";
                                                    } else {
                                                        $normalStatus = "<div class='checkbox_select'>
<input type='checkbox' id='candidateDetail" . $i . "' class='optin required checkbox-toggle' style='display: none; visibility: hidden;' onclick='userOneChange_status(this);' alt='onestatus" . $i . "' data-normalone='" . $id . "'>
<label for='candidateDetail" . $i . "' class='optin required' name='onestatus" . $i . "'>" . $status . "</label>
</div>";
                                                    }

                                                    if ($status_second == "Active") {
                                                        $softStatus = "<div class='checkbox_select'>
<input type='checkbox' id='softstatus" . $i . "'  class='optin required checkbox-toggle' checked style='display: none; visibility: hidden;' onclick='userTwoChange_status(this);' alt='twostatus" . $i . "' data-normalone='" . $id . "'>
<label for='softstatus" . $i . "' class='optin required' name='twostatus" . $i . "'>" . $status_second . "</label>
</div>";
                                                    } else {
                                                        $softStatus = "<div class='checkbox_select'>
<input type='checkbox' id='softstatus" . $i . "' class='optin required checkbox-toggle'  style='display: none; visibility: hidden;' onclick='userTwoChange_status(this);' alt='twostatus" . $i . "' data-normalone='" . $id . "'>
<label for='softstatus" . $i . "' class='optin required' name='twostatus" . $i . "'>" . $status_second . "</label>
</div>";
                                                    }

                                                    if ($status == "Active") {
                                                        $hardStatus = "<div class='checkbox_select'>
<input type='checkbox' id='hardstatus" . $i . "'  class='optin required checkbox-toggle' checked style='display: none; visibility: hidden;' onclick='userThreeChange_status(this);' alt='threestatus" . $i . "' data-normalone='" . $id . "'>
<label for='hardstatus" . $i . "' class='optin required' name='threestatus" . $i . "'>" . $status . "</label>
</div>";
                                                    } else {
                                                        $hardStatus = "<div class='checkbox_select'>
<input type='checkbox' id='hardstatus" . $i . "' class='optin required checkbox-toggle'  style='display: none; visibility: hidden;' onclick='userThreeChange_status(this);' alt='threestatus" . $i . "' data-normalone='" . $id . "'>
<label for='hardstatus" . $i . "' class='optin required' name='threestatus" . $i . "'>" . $status . "</label>
</div>";
                                                    }
                                            ?>
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><?php echo $row['member_name']; ?></td>


                                                        <?php
                                                        $sql_whatsammpmessage = "SELECT whatsappmessage FROM admin WHERE id=1";
                                                        $query_whatsappmessage = mysqli_query($conn, $sql_whatsammpmessage);
                                                        $row_whatsappmessage = mysqli_fetch_assoc($query_whatsappmessage);
                                                        $defaultMessage = $row_whatsappmessage['whatsappmessage'];

                                                        $mmob = $row['member_mobile'];
                                                        $encodedPhoneNumber = urlencode($mmob);
                                                        $encodedMessage = urlencode($defaultMessage);
                                                        $whatsappLink = "https://wa.me/$encodedPhoneNumber/?text=$encodedMessage";
                                                        ?>

                                                        <td>
                                                            <a href="tel:+91<?php echo $mmob ?>"><?php echo $mmob; ?></a>
                                                            <a href="<?php echo $whatsappLink; ?>" target="_blank">
                                                                <i class="mdi mdi-whatsapp" style="font-size:16px; font-weight: 500; color:green;"></i>
                                                            </a>
                                                        </td>




                                                        <td><?php echo $row['member_referral_code']; ?></td>

                                                        <?php
                                                        $sql_count = "SELECT COUNT(*) AS row_count FROM member_referral WHERE member_id = $id";
                                                        $result_count = mysqli_query($conn, $sql_count);
                                                        if ($result_count) {
                                                            $row_count_data = mysqli_fetch_assoc($result_count);
                                                            $row_count = $row_count_data['row_count'];
                                                        }

                                                        if ($row_count == 0) {
                                                        ?>
                                                            <td>
                                                                0
                                                            </td>
                                                        <?php } else { ?>
                                                            <td>
                                                                <a href="referal_member.php?member_id=<?php echo $id; ?>">
                                                                    <?php echo $row_count; ?>
                                                                </a>
                                                            </td>
                                                        <?php } ?>

                                                        <?php
                                                        $sqlrefer = "SELECT member_id FROM member_referral WHERE referrer_id=$id";
                                                        $queryrefer = mysqli_query($conn, $sqlrefer);
                                                        $rowrefer = mysqli_fetch_array($queryrefer);
                                                        $referrerid = $rowrefer['member_id'];

                                                        $sqlrefer = "SELECT member_referral_code FROM member WHERE member_id=$referrerid";
                                                        $queryrefer = mysqli_query($conn, $sqlrefer);
                                                        $rowrefer = mysqli_fetch_array($queryrefer);
                                                        $referrerid = $rowrefer['member_referral_code'];

                                                        ?>
                                                        <td><?php echo $referrerid; ?></td>

                                                        <td><?php echo $row['member_wallet_balance'] ?? '0'; ?></td>
                                                        <!-- <td><?php echo $normalStatus; ?></td>
                                                        <td><?php echo $softStatus; ?></td>
                                                        <td><?php echo $hardStatus; ?></td> -->
                                                        <td><a href="view-user.php?member_id=<?php echo $id; ?>" target="_blank"><i class="mdi mdi-eye font-size-18"></i></a></td>
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
                    status: $(cp).is(':checked') == true ? 'Active' : 'Pending'
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
                    status: $(cp).is(':checked') == true ? 'Active' : 'Pending'
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
            $.post("apiz/user-status-three-change.php", {
                    id: $(cp).data('normalone'),
                    status: $(cp).is(':checked') == true ? 'Active' : 'Pending'
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


</body>

</html>