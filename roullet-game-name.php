<?php include 'includes/config.php';
// session_start();

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Roullet Game Name Managment</title>

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
                        <!-- Zero Configuration  Starts-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title d-flex align-items-center justify-content-between">Starline Game Name List <a class="btn btn-primary btn-sm btn-float" href="#addstarlinegameModal" role="button" data-toggle="modal">Add Game </a></h4> -->
                                    <table class="table table-striped table-bordered" id="sstarlinegameList">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Game Time</th>
                                                <th>On / Off</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $getsql = "SELECT * FROM routtetgame WHERE gameActiveStatus !='Removed' ";
                                            $getqry = mysqli_query($conn, $getsql);
                                            $i = 1;
                                            if (mysqli_num_rows($getqry) > 0) {
                                                while ($row = mysqli_fetch_assoc($getqry)) {
                                                    // $timec = date('h:i a', strtotime($row['market_time']));

                                                    $gameOpenTime = $row['gameOpenTime'];
                                                    $gameCloseTime = $row['gameCloseTime'];

                                                    $id = $row['id'];
                                                    $is = $row['id'];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $gameOpenTime . ' - ' . $gameCloseTime; ?></td>
                                                        <!--<td><?php echo $row['gameActiveStatus']; ?></td>-->
                                                        <td>
                                                            <?php

                                                            if ($row['gameActiveStatus'] == "Active") {
                                                                echo $hardStatus = "<div class='checkbox_select'>
                                                                    <input type='checkbox' id='hardstatus" . $is . "'  class='optin required checkbox-toggle' checked style='display: none; visibility: hidden;' onclick='userThreeChange_status(this);' alt='" . $is . "' data-normalone='" . $row['id'] . "'>
                                                                    <label for='hardstatus" . $is . "' class='optin required' name='threestatus" . $is . "'></label>
                                                                </div>";
                                                            } else {
                                                                echo $hardStatus = "<div class='checkbox_select'>
                                                                    <input type='checkbox' id='hardstatus" . $is . "' class='optin required checkbox-toggle'  style='display: none; visibility: hidden;' onclick='userThreeChange_status(this);' alt='" . $is . "' data-normalone='" . $row['id'] . "'>
                                                                    <label for='hardstatus" . $is . "' class='optin required' name='threestatus" . $is . "'></label>
                                                                </div>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <!-- <div class="modal fade show" id="starlineModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-modal="true" style="padding-right: 16px; ">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="title" id="largeModalLabel">Starline Game </h4>
                                                                    </div>
                                                                    <form method="POST" action="apiz/starline-updategame.php">
                                                                        <div class="modal-body">
                                                                            <div class="row clearfix">
                                                                                <div class="col-sm-12">
                                                                                    <label for="market_name">Starline Game Name </label>
                                                                                    <div class="form-group">
                                                                                        <div class="form-group">
                                                                                            <input type="text" name="starline_game_name" class="form-control" placeholder="Enter Game Name" value="<?php echo $row['star_name']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name="starline_id" class="form-control" value="<?php echo $row['id']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                                                            <button type="submit" name="update-starline" class="btn btn-raised btn-primary btn-round waves-effect">Update Market</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </tr>
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

            <div class="modal fade" id="addstarlinegameModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal_right_side" role="document">
                    <div class="modal-content col-12 col-md-5">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Game</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="theme-form" id="addstarlinegameFrm" name="addstarlinegameFrm" method="post">
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
                                    <div class="row col-12">
                                        <div class="form-group col-6">
                                            <label for="open_time">Open Time</label>
                                            <input name="open_time" id="open_time" class="form-control digits" type="time" value="">

                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary waves-light m-t-10" id="submitBtn" name="submitBtn">Submit</button>
                                        <button type="reset" class="btn btn-danger waves-light m-t-10">Reset</button>

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



            <div class="modal fade" id="starlineoffdayModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal_right_side" role="document">
                    <div class="modal-content col-12 col-xl-4">
                        <div class="modal-header">
                            <h5 class="modal-title">Market Off Day</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body starline_modal_off_day">
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
    <script src="adminassets/js/customjs.js?v=7584"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sstarlinegameList').DataTable();
        });
    </script>

    <script type="text/javascript">
        function userThreeChange_status(cp) {
            var label = $(cp).attr('alt');
            $.post("apiz/change-roullet-status.php", {
                    id: $(cp).data('normalone'),
                    gameActiveStatus: $(cp).is(':checked') == true ? 'Active' : 'Banned'
                },
                function(data) {
                    if (data == 'fail') {
                        $.notify("Status Not Changed", "error");

                    } else {
                        $("label[name=" + label + "]").text(data);
                    }
                });
        }
    </script>

</body>

</html>