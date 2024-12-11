<?php include 'includes/config.php';

// session_start();

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];


$query1 = "SELECT * FROM admin";
$result1 = mysqli_query($conn, $query1);
$rows1 = mysqli_fetch_assoc($result1);
$refer_percentage = $rows1['refer_amount'];

if (isset($_POST['update'])) {

    $market_id = $_POST['market_id'];
    $betdate = $_POST['betdate'];
    $lotterynumber = $_POST['number'];
    $num1 = $lotterynumber[0];
    $num2 = $lotterynumber[1];

    $sumday = str_split($lotterynumber);
    $sm = array_sum($sumday);
    $nsm = substr($sm, -1);

    $get = "SELECT * FROM winningbetting_detail WHERE opening_date=date('$betdate') AND market_Id ='$market_id' ORDER BY Id DESC";
    $gql = mysqli_query($conn, $get);

    if (mysqli_num_rows($gql) > 0) {
        if ($gre = mysqli_fetch_array($gql)) {
            $gdt = $gre['opening_date'];
            $hid = $gre['Id'];
            $sts = $gre['market_Id'];

            $sql2 = "UPDATE winningbetting_detail SET winning_number_second='$num1' , winning_number_third='$num2' WHERE Id = '$hid' AND market_Id ='$sts'";
        } else {
            $sql2 = "INSERT INTO winningbetting_detail(opening_date,winning_number_second,winning_number_third,market_Id) values('$betdate','$num1', '$num2' ,'$market_id')";
        }
    } else {
        $sql2 = "INSERT INTO winningbetting_detail(opening_date,winning_number_second,winning_number_third,market_Id) values('$betdate','$num1', '$num2' ,'$market_id')";
    }

    if (!mysqli_query($conn, $sql2)) {
        echo '<script>alert("Number Update Failed");window.location = "delhi-results.php";</script>';
    } else {
        //LOSS Bet Referall Earnings Transactions
        $lossbetmsql = "SELECT
    bt.*,
    m.*,
    mk.*,
    IFNULL(mr.referrer_id, '') AS referrer_id
FROM
    betting bt
    LEFT JOIN market mk ON bt.b_market_id = mk.market_id
    LEFT JOIN member m ON bt.b_member_id = m.member_id
    LEFT JOIN member_referral mr ON m.member_id = mr.referrer_id
WHERE
    DATE(TRIM(betting_date)) = DATE(TRIM('$betdate'))
    AND b_market_id = '$market_id'
    AND betting_status = 'Active'
    AND (
        (b_game_cid = 13 AND betting_number != '$lotterynumber')
        OR (b_game_cid = 14 AND SUBSTRING(betting_number, 1, 1) != '$num1')
        OR (b_game_cid = 15 AND SUBSTRING(betting_number, -1, 1) != '$num2')
    )";

        $lossbetquery = mysqli_query($conn, $lossbetmsql);
        // Check if the query was successful
        if ($lossbetquery) {
            // Fetch and process each row
            while ($row = mysqli_fetch_assoc($lossbetquery)) {

                if (isset($row['referrer_id']) && !empty($row['referrer_id'])) {
                    $referrerid = $row['referrer_id'];
                    $bettingid = $row['betting_id'];
                    $bettingamount = $row['betting_amount'];
                    $b_game_cid = $row['b_game_cid'];
                    $sql = "INSERT INTO betting_loss_referral (betting_id, amount, referrer_user_id, b_game_cid, created_at, updated_at, status)
                                        VALUES ($bettingid,$bettingamount,$referrerid,$b_game_cid,current_timestamp(), '0000-00-00 00:00:00', '0')";
                    $insertresult = mysqli_query($conn, $sql);

                    if ($referrerid) {
                        $amount = round($bettingamount * $refer_percentage / 100);
                        $transection_id = 'TRANS' . rand(0000, 9999);
                        $msql = "SELECT * FROM member_wallet WHERE member_id='$referrerid' ";
                        $mquery = mysqli_query($conn, $msql);

                        if ($mrow = mysqli_fetch_array($mquery)) {
                            $mbalance = $mrow['member_wallet_balance'];
                        }

                        $mrbalance = $mbalance + $amount;
                        $date_transection = $dateTime;

                        $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type) VALUES ('$transection_id','$amount','$referrerid','$date_transection','ReferAmt')";

                        if (mysqli_query($conn, $sql)) {
                            $lastid = mysqli_insert_id($conn);
                            $mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, m_update_date) VALUES ('$lastid','$transection_id','$amount','$referrerid','$date_transection')";
                            if (mysqli_query($conn, $mpsql)) {

                                $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$referrerid'";
                                if (mysqli_query($conn, $upsql)) {
                                    $lastid = mysqli_insert_id($conn);
                                } else {
                                    $response = ["status" => 'Failure4'];
                                }
                            } else {
                                $response = ["status" => 'Failure3'];
                            }
                        }
                    }
                }
            }
        }
        echo '<script>alert("Number Update Successfully");window.location = "delhi-results.php";</script>';
    }

    exit();
}

if (isset($_POST['update-allot'])) {

    $market_id = $_POST['market_id'];
    $betdate = $_POST['betdate'];
    $lotterynumber = $_POST['number'];
    $firstdigit = substr($lotterynumber, 0, 1);
    $seconddigit = substr($lotterynumber, -1);
    $num1 = $lotterynumber[0];
    $num2 = $lotterynumber[1];
    // $sumday = str_split($lotterynumber);
    // $sm = array_sum($sumday);
    // $nsm = substr($sm , -1);

    //Return Winning Amount 
    $returnQuery = "SELECT * FROM wallet_transaction WHERE transaction_update_date=date('$betdate') AND market_Id ='$market_id' ORDER BY w_transaction_id DESC";
    $Returngql = mysqli_query($conn, $returnQuery);

    if (mysqli_num_rows($Returngql) > 0) {

        while ($Returngre = mysqli_fetch_array($Returngql)) {

            $memberid = $Returngre['member_id'];
            $amount = $Returngre['transaction_amount'];

            $msql = "SELECT * FROM member_wallet WHERE member_id='$memberid' ";
            $mquery = mysqli_query($conn, $msql);

            if ($mrow = mysqli_fetch_array($mquery)) {
                $mbalance = $mrow['member_wallet_balance'];
            }

            $mrbalance = round($mbalance - $amount);

            $updsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$memberid'";
            if (mysqli_query($conn, $updsql)) {
                $lastid = mysqli_insert_id($conn);
                $upsql = "UPDATE wallet_transaction SET status='2' WHERE transaction_update_date=date('$betdate') AND member_id='$memberid' AND market_Id ='$market_id' ORDER BY w_transaction_id DESC";
                if (mysqli_query($conn, $upsql)) {
                }
            } else {
                $response = ["status" => 'Failure4'];
            }
        }
    }

    //Return Winning Amount 
    $get = "SELECT * FROM winningbetting_detail WHERE opening_date=date('$betdate') AND market_Id ='$market_id' ORDER BY Id DESC";
    $gql = mysqli_query($conn, $get);

    if (mysqli_num_rows($gql) > 0) {
        if ($gre = mysqli_fetch_array($gql)) {
            $gdt = $gre['opening_date'];
            $hid = $gre['Id'];
            $sts = $gre['market_Id'];


            // $sql2 = "UPDATE winningbetting_detail SET winning_number_fouth='$lotterynumber' , winning_number_third='$nsm' WHERE Id = '$hid' AND market_Id ='$sts'";

            $sql2 = "UPDATE winningbetting_detail SET winning_number_second='$firstdigit' , winning_number_third='$seconddigit' WHERE Id = '$hid' AND market_Id ='$sts'";
        } else {
            // $sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_first,winning_number_second,market_Id) values('$date','$lotterynumber','$nsm','$market_id')";

            $sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_second,winning_number_third,market_Id) values('$betdate','$firstdigit', '$seconddigit' ,'$market_id')";
        }
    } else {
        $sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_second,winning_number_third, market_Id) values('$betdate','$firstdigit', '$seconddigit' ,'$market_id')";

        // $sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_first,winning_number_second,market_Id) values('$date','$lotterynumber','$nsm','$market_id')";
    }

    if (!mysqli_query($conn, $sql2)) {
        echo mysqli_error($conn);
        echo '<script>alert("Number Update Failed");window.location = "delhi-results.php";</script>';
    } else {
        $dsql = "CALL Poc_SetttingWinningAmount('$market_id','2','$betdate')";
        if (!mysqli_query($conn, $dsql)) {
            echo '<script>alert("Number Update Failed");window.location = "delhi-results.php";</script>';
        } else {
            echo '<script>alert("Number Update Successfully");window.location = "delhi-results.php";</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Declare Result</title>

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
                                            <h4 class="card-title">Select Game</h4>
                                            <form name="gameSrchFrm" method="post">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label>Result Date</label>

                                                        <div class="date-picker">

                                                            <div class="input-group">

                                                                <input required="" class="form-control digits" type="date" value="<?php echo $date ?>" name="betdate" id="betdate">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label>Game Name </label>
                                                        <select required="" class="form-control" name="market_id" id="marketid">
                                                            <option value="">Select Name</option>
                                                            <?php
                                                            $getsql = "SELECT * FROM market WHERE active_status !='Removed' AND market_type = 'delhi'";
                                                            $getqry = mysqli_query($conn, $getsql);
                                                            $i = 1;
                                                            if (mysqli_num_rows($getqry) > 0) {
                                                                while ($row = mysqli_fetch_assoc($getqry)) {
                                                            ?>
                                                                    <option value="<?php echo $row['market_id']; ?>"><?php echo $row['market_name']; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label for="market_close">Number</label>
                                                        <div class="form-group">
                                                            <input required="" type="text" maxlength="2" required="" class="form-control" placeholder="Number" name="number" id="number">
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
                                                        <button type="button" onclick="delhiGetResult(this);" class="btn btn-primary btn-block">Winner List</button>
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Win Member</h4>
                                    <span id="deleteBetListMsg"></span>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="delhi-win-member">
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Game Result History</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="list-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Game Name</th>
                                                    <th>Single Andar </th>
                                                    <th>Open Action</th>
                                                    <th>Single Bahar</th>
                                                    <th>Close Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                /*$getsql = "SELECT * FROM winningbetting_detail wb LEFT JOIN market m ON wb.market_Id = m.market_id WHERE opening_date LIKE '%$date%' ";*/
                                                $timec =   date('h:i a');
                                                // $timea =   trim(date('h:i a'));
                                                $date =   trim(date('Y-m-d h:i a'));
                                                // $sql="";
                                                $today = date('Y-m-d');
                                                $previousDate = date('Y-m-d', strtotime("-1 days"));
                                                $checkTime = date('H:i a', strtotime('06:00 am'));
                                                if (date('H:i a') > date('H:i a', strtotime('06:00 am'))) {
                                                    $getsql = " SELECT * FROM market mar left join winningbetting_detail wd on mar.market_id=wd.market_Id  WHERE mar.active_status !='Removed' AND mar.market_type='Delhi' AND wd.opening_date='$today' GROUP BY mar.market_name ORDER BY mar.market_Id asc";
                                                } else {
                                                    $getsql = " SELECT * FROM market mar left join winningbetting_detail wd on mar.market_id=wd.market_Id  WHERE mar.active_status !='Removed' AND mar.market_type='Delhi' AND wd.opening_date='$previousDate' GROUP BY mar.market_name ORDER BY mar.market_Id asc";
                                                }
                                                $getqry = mysqli_query($conn, $getsql);
                                                $i = 1;
                                                if (mysqli_num_rows($getqry) > 0) {
                                                    while ($row = mysqli_fetch_assoc($getqry)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['market_name']; ?></td>
                                                            <td><?php echo $row['winning_number_first'] . ' - ' . $row['winning_number_second']; ?></td>
                                                            <td class="clear-result" mkid="<?php echo $row['market_Id'] ?>" type="Open" datee="<?php echo $row['opening_date'] ?>"><a href="#">Clear</a></td>
                                                            <td><?php echo $row['winning_number_third'] . ' - ' . $row['winning_number_fouth']; ?></td>
                                                            <td class="clear-result" mkid="<?php echo $row['market_Id'] ?>" type="Close" datee="<?php echo $row['opening_date'] ?>"><a href="#">Clear</a></td>
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

            <!-- Large Size -->
            <div class="modal fade" id="editDelhiWin" tabindex="-1" role="dialog">
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
            <div class="modal fade show" id="delhiDeleteModal" style=" padding-right: 16px;" aria-modal="true">
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
                                <button type="button" data-dismiss="modal" id="betListDel" style="padding: 5px 15px 5px 15px;" class="btn light btn-warning">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- delete model end is here -->


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
    <script src="adminassets/js/customjs.js?v=7732"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#delhi-win-member').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.clear-result').on('click', function() {
                // setInterval(function() 
                // {
                var mkid = $(this).attr('mkid');
                var datee = $(this).attr('datee');
                var type = $(this).attr('type');
                // console.log(mkid + datee);
                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "apiz/clear-winning.php",
                    data: {
                        mkid,
                        datee,
                        type,
                    },
                    success: function(dataResult) {
                        alert(dataResult)
                        window.location.reload()
                    }
                });
                // },5000);
            });
        });
    </script>

    <script>
        function delhiGetResult(el) {
            var marketid = $('#marketid').val();
            var betdate = $('#betdate').val();
            var number = $('#number').val();

            if (marketid != '') {
                if (betdate != '') {
                    if (number != '' && number.length >= 2) {
                        $('#delhi-win-member').DataTable({
                            destroy: true,
                            "ajax": "apiz/get_delhi_winning_result.php?marketid=" + marketid + "&betdate=" + betdate + "&number=" + number,
                            "data": [],
                        });
                    } else {
                        alert("Number required and must have 2 digit")
                    }
                } else {
                    alert("Date required")
                }
            } else {
                alert("Market required")
            }
        }
    </script>

    <script type="text/javascript">
        function editDelhiWin(ss) {
            var betnum = $(ss).attr('betnum');
            var betid = $(ss).attr('betid');

            $("#betnum").attr('alt', betnum).val(betnum);
            $("#betid").attr('alt', betid).val(betid);

            $('#editDelhiWin').modal({
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
                url: "apiz/delhi_winning_update.php",
                data: {
                    betnum,
                    betid
                },
                success: function(dataResult) {
                    alert(dataResult);
                    $('#delhi-win-member').DataTable().ajax.reload();
                    // $('#delhi-win-member').DataTable().ajax.reload();
                }
            });
        }
    </script>

    <script type="text/javascript">
        function idBetDelete(cd) {
            var id = $(cd).attr('alt');
            $("#betListDel").attr('alt', id);
        }
    </script>

    <script type="text/javascript">
        $("#betListDel").on('click', function() {
            var id = $(this).attr('alt');
            $.ajax({
                type: "POST",
                url: "apiz/delete_delhi_result.php",
                data: {
                    id
                },
                success: function(data) {
                    $("#deleteBetListMsg").html(data);
                    setTimeout(function() {
                        $("#deleteBetListMsg").html(null);
                    }, 4000);
                    $('#delhi-win-member').DataTable().ajax.reload();
                }
            });
        });
    </script>



</body>

</html>