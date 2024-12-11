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
                                <form method="POST" action="">
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
                                            <div class="form-group" style=padding-top:26px;>
                                                <input type="submit" class="btn btn-danger" name="submit" value="Filter Data">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Market Name</th>
                                                <th>Market Type</th>
                                                <th>Bet Amount</th>
                                                <!-- <th>Referal Amount</th> -->
                                                <th>Winning Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                $startdate = $_POST['startdate'];
                                                $enddate = $_POST['enddate'];
                                                $formattedStartDate = date('Y-m-d', strtotime($startdate));
                                                $formattedEndDate = date('Y-m-d', strtotime($enddate));

                                                $msql = "SELECT starlinemarketbat.*, wallet_transaction.market_name, wallet_transaction.game_name, 
                                                wallet_transaction.transaction_amount, wallet_transaction.transaction_type, 
                                                wallet_transaction.transaction_update_date FROM starlinemarketbat LEFT JOIN wallet_transaction ON 
                                                starlinemarketbat.game_name = wallet_transaction.game_name WHERE  
                                                (wallet_transaction.transaction_type = 'ReferAmt' OR 
                                                wallet_transaction.transaction_type = 'WinningBat') AND (wallet_transaction.transaction_update_date BETWEEN '$formattedStartDate' AND '$formattedEndDate') ORDER BY wallet_transaction.w_transaction_id DESC";
                                            } else {
                                                $msql = "SELECT starlinemarketbat.*, wallet_transaction.market_name, wallet_transaction.game_name, 
                                                wallet_transaction.transaction_amount, wallet_transaction.transaction_type, 
                                                wallet_transaction.transaction_update_date FROM starlinemarketbat LEFT JOIN wallet_transaction ON 
                                                starlinemarketbat.game_name = wallet_transaction.game_name WHERE  
                                                (wallet_transaction.transaction_type = 'ReferAmt' OR 
                                                wallet_transaction.transaction_type = 'WinningBat') AND (wallet_transaction.transaction_update_date BETWEEN '$date' AND '$date') ORDER BY wallet_transaction.w_transaction_id DESC";
                                            }
                                            $mquery = mysqli_query($conn, $msql);
                                            $i = 0;
                                            $tba = 0;
                                            $twa = 0;
                                            $lp = 0;
                                            if (mysqli_num_rows($mquery) > 0) {
                                                while ($row = mysqli_fetch_assoc($mquery)) {
                                                    $b_member_id = $row['b_member_id'];
                                                    $bet_amount = $row['bet_amount'];
                                                    $game_name = $row['game_name'];
                                                    $transaction_amount = $row['transaction_amount'];
                                                    $transaction_type = $row['transaction_type'];
                                                    $transaction_update_date = $row['transaction_update_date'];

                                                    $tba = $tba + $bet_amount;
                                                    $i++;

                                            ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo "StarLine"; ?></td>
                                                        <td><?php echo $game_name; ?></td>
                                                        <td><?php echo $bet_amount; ?></td>
                                                        <?php
                                                        if ($transaction_type == "ReferAmt") { ?>
                                                            <!-- <td><?php echo $transaction_amount; ?></td>
                                                            <td>NA</td> -->
                                                        <?php
                                                        } else if ($transaction_type == "WinningBat") { ?>
                                                            <!-- <td>NA</td> -->
                                                            <td><?php echo $transaction_amount; ?></td>
                                                        <?php
                                                            $twa = $twa + $transaction_amount;
                                                        } ?>
                                                        <td><?php echo $transaction_update_date; ?></td>
                                                    </tr>
                                            <?php
                                                }
                                                $lp = $tba - $twa;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div id="msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($lp == '0') {
                                    ?>
                                        <div class="form-group col-md-4">
                                            <label for="market_close">Total Bet Amount</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:azure" value="<?php echo $tba; ?> Rs" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="market_close">Total Winning Amount</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:azure" value="<?php echo $twa; ?> Rs" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="market_close">Profit/Loss</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:azure" value="No Profit No Loss!" readonly>
                                            </div>
                                        </div>
                                    <?php
                                    } elseif ($lp > '0') {
                                    ?>
                                        <div class="form-group col-md-4">
                                            <label for="market_close">Total Bet Amount</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:lightgreen" value="<?php echo $tba; ?> Rs" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="market_close">Total Winning Amount</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:lightgreen" value="<?php echo $twa; ?> Rs" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="market_close">Profit/Loss</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:lightgreen" value="Profit : <?php echo $lp; ?> Rs" readonly>
                                            </div>
                                        </div>
                                    <?php
                                    } elseif ($lp < '0') {
                                    ?>
                                        <div class="form-group col-md-4">
                                            <label for="market_close">Total Bet Amount</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:lightsalmon" value="<?php echo $tba; ?> Rs" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="market_close">Total Winning Amount</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:lightsalmon" value="<?php echo $twa; ?> Rs" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="market_close">Profit/Loss</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" style="background-color:lightsalmon" value="Loss : <?php echo $lp; ?> Rs" readonly>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
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
        function filterTable() {
            var startDate = document.getElementById("startDate").value;
            var endDate = document.getElementById("endDate").value;
            var table = document.getElementById("datatable-buttons");
            alert(startDate);
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var rowDate = rows[i].getElementsByTagName("td")[1].innerText;
                if (rowDate >= startDate && rowDate <= endDate) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>