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
    <title>Transactions Managment</title>

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
                                <h4 class="mb-0 font-size-18">Transactions List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Trnasactions List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form name="getMarketBidFrm" method="post">

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <label for="market_close">Select Start Date</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control" placeholder="Date" name="start_date1" id="start_date1" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="market_close">Select End Date</label>
                                            <div class="form-group">
                                                <input type="date" class="form-control" placeholder="Date" name="end_date1" id="end_date1" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group" style=padding-top:26px;>
                                                <input type="submit" class="btn btn-danger" id="getsubmit" name="submit" value="Filter Data">
                                                <!-- <button type="button" id="getsubmit" class="btn btn-danger">Submit</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Game Name</th>
                                                <th>Game Type</th>
                                                <th>Bet Amount</th>
                                                <th>Referal Amount</th>
                                                <th>Winning Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $totalsql = "SELECT SUM(betting_amount) as betting_amount FROM betting WHERE DATE(betting_date) = Date('$date')";
                                                $totalquery = mysqli_query($conn, $totalsql);
                                                $totalrow = mysqli_fetch_assoc($totalquery);
                                                $betting_amount = $totalrow['betting_amount'] ?: '0';
                                                ?>
                                                <td>#</td>
                                                <td>Game Name</td>
                                                <td>Game Type</td>
                                                <td id="bet_amount"><?php echo $betting_amount; ?></td>
                                                <td id="referal_amount"><?php echo $betting_amount; ?></td>
                                                <td id="winning_amount"><?php echo $betting_amount; ?></td>
                                                <td>Date</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div id=" msg">
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

    <script>
        $(document).ready(function() {
            $('#getsubmit').on('click', function() {
                //var id = $('#market_id').val();
                // setInterval(function() {
                var id = $('#game_name').val();
                var betdate = $('#start_date1').val();
                var endbetdate = $('#end_date1').val();
                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "apiz/delhi_transaction_records.php",
                    data: {
                        id: id,
                        betdate: betdate,
                        endbetdate: endbetdate,
                    },
                    success: function(dataResult) {
                        alert(dataResult);
                        var data = JSON.parse(dataResult).data;
                        var betamt = data.betamt;
                        var winamt = data.winamt;
                        var totalamt = data.totalamt;
                        var bttype = data.type;
                        var totalreferramt = data.totalreferramt;
                        document.getElementById("bet_amount").innerHTML = betamt;
                        document.getElementById("winning_amount").innerHTML = winamt;
                        document.getElementById("total_profit_amt").innerHTML = totalamt;
                        document.getElementById("referal_amount").innerHTML = totalreferramt;

                        if (bttype == "Profit") {
                            document.getElementById("mensales").style.background = "#556ee6";
                        } else if (bttype == "Noloss") {
                            document.getElementById("mensales").style.background = "#0dcebc";
                        } else {
                            document.getElementById("mensales").style.background = "#f1673e";
                        }
                    }
                });
                // },1000);
            });
        });
    </script>





    <!-- <script type="text/javascript">
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
    </script> -->




</body>

</html>