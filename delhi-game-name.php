<?php include 'includes/config.php';
// session_start();

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];

$msg = "";
$error = "";

if (isset($_POST['addmarket'])) {

    $market_name = $_POST['market_type'];
    $market_type = $_POST['market_name'];
    $market_open = $_POST['market_open'];
    $market_close = $_POST['market_open'];

    $motime = date("g:i a", strtotime($market_open));
    $mctime = date("g:i a", strtotime($market_close));

    $params = json_encode(array(
        "market_name" => $market_name,
        "market_type" => $market_type,
        "market_opentime" => $motime,
        "market_closetime" => $mctime,
    ));


    $sql = "call CreateMarket('" . $params . "')";

    $data = mysqli_query($conn, $sql);

    if (!empty($data)) {
        echo '<script>alert("Market Added Successfully");window.location = "delhi-game-name.php";</script>';
    } else {
        echo '<script>alert("Market Not Added Successfully");window.location = "delhi-game-name.php";</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Game Name Managment</title>

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
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Select Game</h4>
                                            <form method="POST" action="">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label for="market_close">Market Name</label>
                                                        <div class="form-group">
                                                            <input required="" type="text" class="form-control" placeholder="Market Name" name="market_type">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="market_name">Market Type </label>
                                                        <select class="form-control show-tick" id="market_name" required="" name="market_name">
                                                            <option value="" required>Select</option>
                                                            <option value="Delhi">Delhi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="market_open">Market Time</label>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <input type="time" id="market_open" name="market_open" required="" class="form-control" placeholder="Enter Market Time">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-2 mt-4">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" name="addmarket" id="addmarket" class="btn btn-raised btn-primary btn-round waves-effect">Add Market</button>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <?php if ($msg) { ?>
                                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                                <strong>Well done! </strong><?php echo htmlentities($msg); ?>
                                                            </div><?php } else if ($error) { ?>
                                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>

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
                    <div class="row">
                        <!-- Zero Configuration  Starts-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="gameList">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Game Name</th>
                                                    <th>Today Open</th>
                                                    <th>Today Close</th>
                                                    <th>Market Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $getsql = "SELECT * FROM market WHERE active_status !='Removed' AND market_type='delhi' ";
                                                $getqry = mysqli_query($conn, $getsql);
                                                $i = 1;
                                                if (mysqli_num_rows($getqry) > 0) {
                                                    while ($row = mysqli_fetch_assoc($getqry)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['market_name']; ?></td>
                                                            <!-- <td><?php echo $row['market_type']; ?></td> -->
                                                            <td><?php echo $row['market_open_time']; ?></td>
                                                            <td><?php echo $row['market_close_time']; ?></td>
                                                            <td><?php echo $row['active_status']; ?></td>
                                                            <td>
                                                                <button type="button" class="btn btn-default btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?php echo $row['market_id']; ?>">Edit</button>

                                                                <form method="POST" action="apiz/delhi-marketstatus.php">
                                                                    <input type="hidden" name="market_id" value="<?php echo $row['market_id']; ?>">
                                                                    <?php if ($row['active_status'] == 'Removed') {
                                                                    ?>
                                                                        <button type="submit" name="status" value="Active" class="btn btn-danger waves-effect m-r-20"> Restore</button>
                                                                    <?php
                                                                    } elseif ($row['active_status'] != 'Removed') {
                                                                    ?>
                                                                        <button type="submit" name="status" value="Removed" class="btn btn-danger waves-effect m-r-20"> Remove</button>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </form>

                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="largeModal<?php echo $row['market_id']; ?>" tabindex="-1" role="dialog">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="title" id="largeModalLabel">Market <?php echo $row['market_name']; ?> </h4>
                                                                    </div>
                                                                    <form method="POST" action="apiz/delhi-updatemarket.php">
                                                                        <div class="modal-body">
                                                                            <div class="row clearfix">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="select_game">Select </label>
                                                                                    <select class="form-control show-tick" id="savetype<?php echo $i; ?>" name="savetype">
                                                                                        <option value="All">All</option>
                                                                                        <option value="One">One</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="row all_data">
                                                                                    <div class="col-sm-12">
                                                                                        <label for="market_open">Market Time</label>
                                                                                        <div class="form-group">
                                                                                            <div class="form-group">
                                                                                                <input type="text" id="market_open" name="market_open_all" class="form-control" placeholder="Enter Market Time" value="">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                                <div class="col-sm-12">
                                                                                    <label for="market_name">Market Name </label>
                                                                                    <div class="form-group">
                                                                                        <div class="form-group">
                                                                                            <input type="text" id="market_name" name="market_name" class="form-control" placeholder="Enter Market Name" value="<?php echo $row['market_name']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row one_data">
                                                                                    <?php
                                                                                    $marketId = $row["market_id"];
                                                                                    $getsql1 = "SELECT * FROM market_timemanagement WHERE market_Id = '$marketId'";
                                                                                    $getqry1 = mysqli_query($conn, $getsql1);

                                                                                    if (mysqli_num_rows($getqry1) > 0) {
                                                                                        while ($rowData = mysqli_fetch_assoc($getqry1)) {
                                                                                    ?>

                                                                                            <div class="col-md-12">
                                                                                                <h5 class="mb-4"><?= $rowData['dayname'] ?></h5>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <label for="market_open">Market Time</label>
                                                                                                <div class="form-group">
                                                                                                    <div class="form-group">
                                                                                                        <input type="text" id="market_open" name="market_open[]" class="form-control" placeholder="Enter Market Time" value="<?php echo $rowData['market_opentime']; ?>">
                                                                                                        <input type="hidden" name="market_game_id[]" value="<?php echo $rowData['Id']; ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group col-md-6">
                                                                                                <label for="select_game">Select Status</label>
                                                                                                <select class="form-control show-tick" id="selectgame" name="selectgame[]">
                                                                                                    <option value="">Select Status</option>
                                                                                                    <option value="Active" <?= $rowData['market_status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                                                                                    <option value="Inactive" <?= $rowData['market_status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                                                                                </select>
                                                                                            </div>

                                                                                    <?php }
                                                                                    } ?>


                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="market_id" class="form-control" value="<?php echo $row['market_id']; ?>">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                                                            <button type="submit" name="update-market" class="btn btn-raised btn-primary btn-round waves-effect">Update Market</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php $i++;
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addgameModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal_right_side" role="document">
                    <div class="modal-content col-12 col-md-5">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Game</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="theme-form" id="addgameFrm" name="addgameFrm" method="post">
                                <div class="row">
                                    <input type="hidden" name="game_id" value="">
                                    <div class="form-group col-12">
                                        <label for="game_name">Game Name</label>
                                        <input type="text" name="game_name" id="game_name" class="form-control" placeholder="Enter Game Name" />
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="game_name_hindi">Game Name Hindi</label>
                                        <input type="text" name="game_name_hindi" id="game_name_hindi" class="form-control" placeholder="Enter Game Name In Hindi" />
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="open_time">Open Time</label>
                                        <input name="open_time" id="open_time" class="form-control digits" type="time" value="">

                                    </div>
                                    <div class="form-group col-6">
                                        <label for="close_time">Close Time</label>
                                        <input name="close_time" id="close_time" class="form-control digits" type="time" value="">

                                    </div>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary waves-light mr-1" id="submitBtn" name="submitBtn">Submit</button>
                                        <button type="reset" class="btn btn-danger waves-light mr-1">Reset</button>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="msg"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updategameModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal_right_side" role="document">
                    <div class="modal-content col-12 col-md-5">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Game</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body modal_update_game_body">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="offdayModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal_right_side" role="document">
                    <div class="modal-content col-12 col-xl-4">
                        <div class="modal-header">
                            <h5 class="modal-title">Market Off Day</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body modal_off_day">
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
    <script src="adminassets/js/customjs.js?v=5557"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#gameList').DataTable();
        });

        $(document).ready(function() {
            $('.one_data').hide();
            $('[name="savetype"]').change(function() {
                var i = $(this).attr('id').match(/\d+/)[0];

                var saveType = $(this).val();
                // Hide all divs

                // Show the selected div
                if (saveType !== 'All') {
                    $('.one_data').show();
                    $('.all_data').hide();
                } else {
                    $('.all_data').show();
                    $('.one_data').hide();

                }
            });
        });
    </script>
</body>

</html>