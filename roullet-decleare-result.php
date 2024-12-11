<?php include 'includes/config.php';
// session_start();

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];


if (isset($_POST['update'])) {

    $market_id = $_POST['starlinemarkettype'];
    $betdate = $_POST['betdate'];
    $number = $_POST['number'];

    $dsql = "SELECT * FROM roulettewinningnumber WHERE winning_date = '$betdate' AND winning_status='Active'";
    $getqry = mysqli_query($conn, $dsql);
    if (mysqli_num_rows($getqry) > 0) {
        $row = mysqli_fetch_assoc($getqry);
        $exid = $row['id'];

        $usql = "UPDATE roulettewinningnumber SET winning_number='$number' WHERE id='$exid'";
    } else {
        $usql = "INSERT INTO roulettewinningnumber(winning_date,winning_time,winning_number,winning_status) VALUES ('$betdate','$market_id','$number','active')";
    }

    if (!mysqli_query($conn, $usql)) {
            echo "<script>alert('Number Update Failed');window.location = 'roullet-decleare-result.php';</script>";
        } else {
        	calldeclaresendnotificationapi($market_id);
            echo '<script>alert("Number Update Successfully");window.location = "roullet-decleare-result.php";</script>';
        }
}
if (isset($_POST['update-allot'])) {

    $market_id = $_POST['starlinemarkettype'];
    $betdate = $_POST['betdate'];
    $number = $_POST['number'];

    $dsql = "SELECT * FROM roulettewinningnumber WHERE winning_date = '$betdate' AND winning_status='Active'";
    $getqry = mysqli_query($conn, $dsql);
    if (mysqli_num_rows($getqry) > 0) {
        $row = mysqli_fetch_assoc($getqry);
        $exid = $row['id'];

           $usql = "UPDATE roulettewinningnumber SET winning_number='$number' WHERE id='$exid'";
    } else {
        $usql = "INSERT INTO roulettewinningnumber(winning_date,winning_time,winning_number,winning_status) VALUES ('$betdate','$market_id','$number','active')";
    }

    	if(allotmoney($betdate , $market_id , $number) == "Fail"){
    		echo "<script>alert('Number Update Failed');window.location = 'roullet-decleare-result.php';</script>";
        } else {
        	callsendnotificationapi();
            echo '<script>alert("Number Update Successfully");window.location = "roullet-decleare-result.php";</script>';
        }
}

function allotmoney($betdate , $market_id , $number){
	global $conn;
	global $roulletwinamt;
	global $date;
	global $time;
	$betdate  = $betdate;
	$market_id  = $market_id;
	$number = $number;

	$sql = "SELECT * FROM roulettebat WHERE DATE(cretated_date) = DATE('$betdate') AND gameid = '$market_id' AND  bat_number ='$number' ";
	$qry = mysqli_query($conn, $sql);
	if (mysqli_num_rows($qry) > 0) {
		while ($row = mysqli_fetch_assoc($qry)) {
			$member_id = $row['member_id'];
			$bat_amount = $row['bat_amount'];
			$bat_open_time = $row['bat_open_time'];
			$bat_close_time = $row['bat_close_time'];

			$gmname = $bat_open_time . ' - ' . $bat_close_time;

			$msql = "SELECT * FROM member_wallet WHERE member_id = '$member_id'";
			$mqry = mysqli_query($conn, $msql);
			$mrow = mysqli_fetch_assoc($mqry);
			$mwalletamt = $mrow['member_wallet_balance'];

			$moneytoadd = $bat_amount * $roulletwinamt;
			$newbalance = $mwalletamt + $moneytoadd;

			$transaction_id = "ROUL" . $member_id . time();


			$wsql = "INSERT INTO wallet_transaction (transaction_id , transaction_amount , member_id , transaction_update_date , transaction_type , market_name , bat_number ) VALUES ('$transaction_id','$moneytoadd' , '$member_id' , '$date $time' , 'WinningBat' , '$gmname' , '$number')";

			if (!mysqli_query($conn, $wsql)) {
	            $response = "Fail";
	        } else {
	        	$uwsql = "UPDATE member_wallet SET member_wallet_balance='$newbalance' WHERE member_id = '$member_id'";

	        	if (!mysqli_query($conn, $uwsql)) {
	            $response = "Fail";
		        } else {
		            $response = "Pass";
		        }
	        }
		}
	}else {
		$response = "Fail";
	}

	return $response;

}

function calldeclaresendnotificationapi($marketId)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $base_url+"memberNotificationData.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"marketId=$marketId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close ($ch);
}



function callsendnotificationapi()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $base_url+"MemberWinningNotification.php");
    curl_setopt($ch, CURLOPT_POST, 1);// set post data to true
    curl_setopt($ch, CURLOPT_POSTFIELDS,"number=myname&marketId=mypass");   // post data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close ($ch);
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Roullet Declare Result</title>

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

    <style type="text/css">
        .model-footer-change {
            padding: 0px 20px 14px 0px;
            text-align: right;
        }
    </style>

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
                                            <h5>Select Game</h5>

                                            <form class="theme-form mega-form" method="post">

                                                <input type="hidden" name="id" id="id">

                                                <div class="row">
                                                    <div class="form-group col-md-3">

                                                        <label>Result Date</label>

                                                        <label>Result Date</label>

                                                        <div class="date-picker">

                                                            <div class="input-group">

                                                                <input class="form-control digits" type="date" value="<?php echo $date ?>" name="betdate" id="starline_betdate">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="form-group col-md-3">

                                                        <label>Game Name </label>

                                                        <select class="form-control" name="starlinemarkettype" id="starlinemarkettype">
                                                            <option value="">-- Please Select Market Name --</option>
                                                            <?php

                                                            $getsql = "SELECT * FROM routtetgame WHERE gameActiveStatus !='Removed' ";
                                                            $getqry = mysqli_query($conn, $getsql);
                                                            $i = 1;
                                                            if (mysqli_num_rows($getqry) > 0) {
                                                                while ($row = mysqli_fetch_assoc($getqry)) {

                                                                    $gameOpenTime = $row['gameOpenTime'];
                                                                    $gameCloseTime = $row['gameCloseTime'];
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $gameOpenTime . ' - ' . $gameCloseTime; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label for="market_close">Number</label>
                                                        <div class="form-group">
                                                            <input type="text" maxlength="1" class="form-control" placeholder="Number" name="number" id="number">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary btn-block" name="update">Declare Result</button>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary btn-block" name="update-allot">Declare Allot</button>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" onclick="starlineBtn(this);" class="btn btn-primary btn-block">Show Winner List</button>
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
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Win Bid History List</h4>
                                    <span id="deleteBetListMsg"></span>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="starline-win-member">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Member</th>
                                                    <th>Game Name</th>
                                                    <th>Bet Digit</th>
                                                    <th>Bet Amount</th>
                                                    <th>Edit Bet</th>
                                                    <th>Delete Bet</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Game Result History</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="startable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Declare Date</th>
                                                <th>Declare Time</th>
                                                <th>Winning Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $getsql = "SELECT * FROM roulettewinningnumber rw LEFT JOIN routtetgame rg ON rw.winning_time = rg.id  WHERE winning_date LIKE '%$date%' ";
                                            $getqry = mysqli_query($conn, $getsql);
                                            $i = 1;
                                            if (mysqli_num_rows($getqry) > 0) {
                                                while ($row = mysqli_fetch_assoc($getqry)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row['winning_date']; ?></td>
                                                        <td><?php echo $row['gameOpenTime'] . ' - ' . $row['gameCloseTime'] ; ?></td>
                                                        <td><?php echo $row['winning_number'] ?? '-'; ?></td>
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

        </div>
        <style>
            .select2-container {
                width: 398.984px !important;
            }
        </style>
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


    <!-- Large Size -->
    <div class="modal fade" id="editStarlineWin" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Edit Bet Number</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" name="ebetmodel" action="">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <label for="market_name">Bet Number</label>
                                <div class="form-group">
                                    <input type="text" id="betnum" class="form-control" minlength="3" maxlength="3" value="" placeholder="Bet Number" name="betnum">
                                    <input type="hidden" id="betid" class="form-control" value="" name="betid">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onClick="men(this);" class="btn btn-primary btn-round waves-effect" data-dismiss="modal">SAVE CHANGES</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete model start is here -->
    <div class="modal fade show" id="starlineDeleteModal" style=" padding-right: 16px;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Member !!</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body" style="padding: 20px 10px 10px 10px; text-align: center;">
                        <p style="font-size: 15px;">Are you sure ? You want to delete this Member !!</p>
                    </div>

                    <div class="model-footer-change">
                        <button type="button" style="padding: 5px 15px 5px 15px;" class="btn light btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" data-dismiss="modal" id="starlineListDel" style="padding: 5px 15px 5px 15px;" class="btn light btn-warning">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete model end is here -->

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
    <script src="adminassets/js/customjs.js?v=8842"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#starline-win-member').DataTable();
        });
    </script>

    <script>
        function starlineBtn(el) {
            var betdate = $('#starline_betdate').val();
            var marketid = $('#starlinemarkettype').val();
            var number = $('#number').val();

            if (marketid != '') {
                if (betdate != '') {
                    if (number != '' && number.length >= 1) {
                        $('#starline-win-member').DataTable({
                            destroy: true,
                            "ajax": "apiz/get_roullet_result.php?marketid=" + marketid + "&betdate=" + betdate + "&number=" + number,
                            "data": [],
                        });
                    } else {
                        alert("Number required and must have 3 digit");
                    }
                } else {
                    alert("Date required");
                }
            } else {
                alert("Market required");
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#startable').DataTable();
        });
    </script>


    <script type="text/javascript">
        function editStarlineWin(ss) {
            var betnum = $(ss).attr('betnum');
            var betid = $(ss).attr('betid');

            $("#betnum").attr('alt', betnum).val(betnum);
            $("#betid").attr('alt', betid).val(betid);

            $('#editStarlineWin').modal({
                show: true
            });
        }
    </script>

    <script>
        function men(e) {
            var betnum = $('#betnum').val();
            var betid = $('#betid').val();
            $.ajax({
                type: "POST",
                url: "apiz/roullet-decleare-result-update.php",
                data: {
                    betnum,
                    betid
                },
                success: function(dataResult) {
                    alert(dataResult);
                    $('#starline-win-member').DataTable().ajax.reload();
                }
            });
        }
    </script>


    <script type="text/javascript">
        function statlineDelete(cd) {
            var id = $(cd).attr('alt');
            $("#starlineListDel").attr('alt', id);
        }
    </script>

    <script type="text/javascript">
        $("#starlineListDel").on('click', function() {
            var id = $(this).attr('alt');
            $.ajax({
                type: "POST",
                url: "apiz/roullet_starline_result.php",
                data: {
                    id
                },
                success: function(data) {
                    $("#deleteBetListMsg").html(data);
                    setTimeout(function() {
                        $("#deleteBetListMsg").html(null);
                    }, 4000);
                    $('#starline-win-member').DataTable().ajax.reload();
                }
            });
        });
    </script>

</body>

</html>