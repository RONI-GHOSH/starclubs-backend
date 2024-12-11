<?php include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) 
{
  echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Game Rate</title>

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
        
         <?php include 'includes/header.php';?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-8 mr-auto ml-auto">
                            <div class="row">
                                <div class="col-sm-12 col-12 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add Games Rate</h4>
                                            <form class="theme-form mega-form" action="apiz/star-line-betting-update.php" name="gameRatesFrm" method="post">
                                                <input type="hidden" name="game_rate_id" value="1">
                                                <div class="row">
                                        <?php 
                                            $getsql = "SELECT * FROM starLineRate";
                                            $getqry = mysqli_query($conn, $getsql);
                                            $i = 1;
                                            if (mysqli_num_rows($getqry) > 0) {
                                             while ($row = mysqli_fetch_assoc($getqry)) {
                                        ?>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label"><?php echo $row['gameName']; ?></label>
                                                    <input class="form-control" type="number" name="game_amount[]" id="single_digit_1" value="<?php echo $row['gameRate']; ?>" >
                                                    <input type="hidden" name="id[]" value="<?php echo $row['id'];?>">
                                                </div>

                                        <?php } }?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary waves-light m-t-10" id="submitBtn" name="update-amount">Update</button>
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


    <div class="modal fade " id="open-img-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" style="text-align:right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <img class="my_image" />
                </div>
            </div>
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


    <script>
        $(document).ready(function() {
            $(".open-img-modal").click(function() {
                var imgsrc = $(this).data('id');
                $('.my_image').attr('src', imgsrc);
                $("#open-img-modal").modal('show');
            });

            $(".categor_select_2").select2({
                placeholder: "Select Category",
                allowClear: true
            });

            $(".select_digit").select2({
                placeholder: "Select Digit",
                allowClear: true
            });

        });

        Date.prototype.toShortFormat = function() {

            var month_names = ["Jan", "Feb", "Mar",
                "Apr", "May", "Jun",
                "Jul", "Aug", "Sep",
                "Oct", "Nov", "Dec"
            ];

            var day = this.getDate();
            var month_index = this.getMonth();
            var year = this.getFullYear();
            var hours = this.getHours();
            var minutes = this.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;

            return "" + day + "-" + month_names[month_index] + "-" + year + " " + strTime;
        }
        var today = new Date();
        var exceldate = today.toShortFormat()
    </script>
    <script>
        //$('.timepicker').val('')

        var options = {
            twentyFour: false,
            upArrow: 'wickedpicker__controls__control-up',
            downArrow: 'wickedpicker__controls__control-down',
            close: 'wickedpicker__close',
            showSeconds: false,
            secondsInterval: 1,
            minutesInterval: 1,
            beforeShow: null,
            show: null,
            clearable: false,

        };
        var seridevi_open_time = $('#seridevi_open_time').val();;
        var seridevi_close_time = $('#seridevi_close_time').val();;
        var madhur_m_open_time = $('#madhur_m_open_time').val();;
        var madhur_m_close_time = $('#madhur_m_close_time').val();;
        var gold_d_open_time = $('#gold_d_open_time').val();;
        var gold_d_close_time = $('#gold_d_close_time').val();;
        var madhur_d_open_time = $('#madhur_d_open_time').val();;
        var madhur_d_close_time = $('#madhur_d_close_time').val();;
        var super_milan_open = $('#super_milan_open').val();;
        var super_milan_close = $('#super_milan_close').val();;
        var rajdhani_d_open = $('#rajdhani_d_open').val();;
        var rajdhani_d_close = $('#rajdhani_d_close').val();;
        var supreme_d_open = $('#supreme_d_open').val();;
        var supreme_d_close = $('#supreme_d_close').val();;
        var sridevi_night_open = $('#sridevi_night_open').val();;
        var sridevi_night_close = $('#sridevi_night_close').val();;
        var gold_night_open = $('#gold_night_open').val();;
        var gold_night_close = $('#gold_night_close').val();;
        var madhure_night_open = $('#madhure_night_open').val();;
        var madhure_night_close = $('#madhure_night_close').val();;
        var supreme_night_open = $('#supreme_night_open').val();;
        var supreme_night_close = $('#supreme_night_close').val();;
        var rajhdhani_night_open = $('#rajhdhani_night_open').val();;
        var rajhdhani_night_close = $('#rajhdhani_night_close').val();;

        $('.timepicker').wickedpicker(options);



        $('#seridevi_open_time').val(seridevi_open_time);;
        $('#seridevi_close_time').val(seridevi_close_time);;
        $('#madhur_m_open_time').val(madhur_m_open_time);;
        $('#madhur_m_close_time').val(madhur_m_close_time);;
        $('#gold_d_open_time').val(gold_d_open_time);;
        $('#gold_d_close_time').val(gold_d_close_time);;
        $('#madhur_d_open_time').val(madhur_d_open_time);;
        $('#madhur_d_close_time').val(madhur_d_close_time);;
        $('#super_milan_open').val(super_milan_open);;
        $('#super_milan_close').val(super_milan_close);;
        $('#rajdhani_d_open').val(rajdhani_d_open);;
        $('#rajdhani_d_close').val(rajdhani_d_close);;
        $('#supreme_d_open').val(supreme_d_open);;
        $('#supreme_d_close').val(supreme_d_close);;
        $('#sridevi_night_open').val(sridevi_night_open);;
        $('#sridevi_night_close').val(sridevi_night_close);;
        $('#gold_night_open').val(gold_night_open);;
        $('#gold_night_close').val(gold_night_close);;
        $('#madhure_night_open').val(madhure_night_open);;
        $('#madhure_night_close').val(madhure_night_close);;
        $('#supreme_night_open').val(supreme_night_open);;
        $('#supreme_night_close').val(supreme_night_close);;
        $('#rajhdhani_night_open').val(rajhdhani_night_open);;
        $('#rajhdhani_night_close').val(rajhdhani_night_close);;
    </script>
    <script>
        dataTable.on('page.dt', function() {
            $('html, body').animate({
                scrollTop: $(".dataTables_wrapper").offset().top - 50
            }, 'slow');
        });
    </script>


</body>

</html>