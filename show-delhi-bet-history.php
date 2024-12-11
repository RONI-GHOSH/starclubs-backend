<?php include 'includes/config.php';

// session_start();

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];

$data = array();


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $marketid = $_POST['marketid'];
    $bid_date = $_POST['betdate'];
    $type = $_POST['type'];


    if ($type == 'Open') {

        $msql = "SELECT betting.betting_number, SUM(betting.betting_amount) AS total_amount
        FROM betting
        LEFT JOIN market ON betting.b_market_id = market.market_id
        LEFT JOIN member ON betting.b_member_id = member.member_id
        WHERE DATE(TRIM(betting.betting_date)) = DATE(trim('$bid_date'))
        AND betting.b_market_id = '$marketid'
        AND betting.betting_status = 'Active'
        GROUP BY betting.betting_number";
    } elseif ($type == 'Close') {

        $rsql = "SELECT * FROM winningbetting_detail WHERE market_Id = '$marketid' AND DATE(opening_date) = DATE('$bid_date') ";
        $rqry = mysqli_query($conn, $rsql);
        $rrow = mysqli_fetch_array($rqry);
        $lastnum = $rrow['winning_number_second'];

        $msql = "SELECT * FROM betting bt  LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$bid_date')) AND b_market_id='$marketid' AND  (betting_number='$number' OR betting_number_second='$nsm' OR betting_number='$nsm' OR betting_number_second='$number' OR betting_number = '$lastnum$nsm') AND bt.betting_status = 'Active'";
    } else {

        $msql = "SELECT betting.betting_number,betting.b_game_cid,CAST(betting.betting_number AS SIGNED) AS adjusted_betting_number, SUM(betting.betting_amount) AS total_amount
        FROM betting
        LEFT JOIN market ON betting.b_market_id = market.market_id
        LEFT JOIN member ON betting.b_member_id = member.member_id
        WHERE DATE(TRIM(betting.betting_date)) = DATE(trim('$bid_date'))
        AND betting.b_market_id = '$marketid'
        AND betting.betting_status = 'Active'
        GROUP BY betting.b_game_cid, adjusted_betting_number";
    }


    $mquery = mysqli_query($conn, $msql);
    $totalamount = 0;
    $i = 1;
    if (mysqli_num_rows($mquery) > 0) {
        while ($row = mysqli_fetch_assoc($mquery)) {
            $betting_number = $row['adjusted_betting_number'] ?? ' ';
            $type = $row['b_game_cid'] ?? ' ';
            $total_amount = $row['total_amount'] ?? ' ';
            $data[$betting_number][$type] = $total_amount;
            $i++;
            $totalamount = $total_amount + $totalamount;

            // echo $i++."->";
            // echo $totalamount = ($total_amount + $totalamount)."/";
        }
        $j = $i - 1;
    } else {
        if (empty($data)) {
            $data = array();
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
    <style>
        .input_search,
        .input_search:focus {
            background-color: black;
            color: white;
            height: 48px;
        }

        .fs-24 {
            font-size: 24px;
        }

        .bg_grey {
            background-color: #87859B;
            width: 100%;
            height: 35px;
            border-radius: 3px;
        }

        .text_red {
            color: rgb(236, 66, 66);
        }

        .text_green {
            color: green;
        }

        .text_vertical {
            writing-mode: tb;

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
                                            <form name="gameSrchFrm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label>Date</label>

                                                        <div class="date-picker">

                                                            <div class="input-group">
                                                                <input required="" class="form-control digits" type="date" value="<?php echo $date ?>" name="betdate" id="betdate">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-2">

                                                        <label>Game Name </label>
                                                        <select required="" class="form-control" name="marketid" id="marketid">
                                                            <option value="">Select Name</option>
                                                            <?php
                                                            $getsql = "SELECT * FROM market WHERE active_status !='Removed' AND market_type != 'Mumbai'";
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

                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary btn-block">Search List</button>
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


                    <section class="py-5">

                        <div class="container">
                            <div class="row" style="background-color:black;">
                                <div style="padding:10px;font-size:15px;">
                                    <span style="color:white;">No. of Betting : <?php echo $j; ?></span>&nbsp;&nbsp;
                                    <span style="color:yellow;">|</span>&nbsp;&nbsp;
                                    <span style="color:white">Total Betting Amount: <?php echo $totalamount; ?> INR</span>&nbsp;&nbsp;
                                    
                                </div>
                            </div>

                            <div class="row mt-4 px-2 px-md-4">

                                <div class="col-10 col-md-11">
                                    <div class="row">
                                        <h2>Single Andar</h2>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">0</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[0][14]) ? $data[0][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">1</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[1][14]) ? $data[1][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">2</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[2][14]) ? $data[2][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">3</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[3][14]) ? $data[3][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">4</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[4][14]) ? $data[4][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">5</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[5][14]) ? $data[5][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">6</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[6][14]) ? $data[6][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">7</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[7][14]) ? $data[7][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">8</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[8][14]) ? $data[8][14] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">9</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[9][14]) ? $data[9][14] : '0'; ?></h3>
                                        </div>

                                        <h2>Single Bahar</h2>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">0</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[0][15]) ? $data[0][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">1</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[1][15]) ? $data[1][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">2</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[2][15]) ? $data[2][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">3</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[3][15]) ? $data[3][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">4</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[4][15]) ? $data[4][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">5</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[5][15]) ? $data[5][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">6</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[6][15]) ? $data[6][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">7</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[7][15]) ? $data[7][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">8</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[8][15]) ? $data[8][15] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">9</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[9][15]) ? $data[9][15] : '0'; ?></h3>
                                        </div>

                                        <!-- =========== -->
                                        <div class="row mt-4 px-2 px-md-4">
                                            <div class="col-10 col-md-11">
                                                <h2>Jodi Digit</h2>
                                                <div class="row">
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">00</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[0][13] === null ? '0' : $data[0][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">01</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[1][13] === null ? '0' : $data[1][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">02</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[2][13] === null ? '0' : $data[2][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">03</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[3][13] === null ? '0' : $data[3][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">04</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[4][13] === null ? '0' : $data[4][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">05</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[5][13] === null ? '0' : $data[5][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">06</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[6][13] === null ? '0' : $data[6][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">07</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[7][13] === null ? '0' : $data[7][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">08</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[8][13] === null ? '0' : $data[8][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">09</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[9][13] === null ? '0' : $data[9][13]; ?></h3>
                                                    </div>
                                                    <!-- ========== -->
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">10</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[10][13] === null ? '0' : $data[10][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">11</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[11][13] === null ? '0' : $data[11][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">12</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[12][13] === null ? '0' : $data[12][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">13</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[13][13] === null ? '0' : $data[13][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">14</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[14][13] === null ? '0' : $data[14][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">15</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[15][13] === null ? '0' : $data[15][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">16</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[16][13] === null ? '0' : $data[16][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">17</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[17][13] === null ? '0' : $data[17][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">18</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[18][13] === null ? '0' : $data[18][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">19</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[19][13] === null ? '0' : $data[19][13]; ?></h3>
                                                    </div>
                                                    <!-- ========== -->
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">20</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[20][13] === null ? '0' : $data[20][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">21</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[21][13] === null ? '0' : $data[21][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">22</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[22][13] === null ? '0' : $data[22][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">23</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[23][13] === null ? '0' : $data[23][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">24</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[24][13] === null ? '0' : $data[24][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">25</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[25][13] === null ? '0' : $data[25][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">26</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[26][13] === null ? '0' : $data[26][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">27</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[27][13] === null ? '0' : $data[27][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">28</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[28][13] === null ? '0' : $data[28][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">29</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[29][13] === null ? '0' : $data[29][13]; ?></h3>
                                                    </div>
                                                    <!-- ============= -->
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">30</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[30][13] === null ? '0' : $data[30][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">31</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[31][13] === null ? '0' : $data[31][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">32</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[32][13] === null ? '0' : $data[32][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">33</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[33][13] === null ? '0' : $data[33][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">34</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[34][13] === null ? '0' : $data[34][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">35</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[35][13] === null ? '0' : $data[35][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">36</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[36][13] === null ? '0' : $data[36][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">37</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[37][13] === null ? '0' : $data[37][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">38</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[38][13] === null ? '0' : $data[38][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">39</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[39][13] === null ? '0' : $data[39][13]; ?></h3>
                                                    </div>
                                                    <!-- =========== -->
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">40</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[40][13] === null ? '0' : $data[40][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">41</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[41][13] === null ? '0' : $data[41][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">42</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[42][13] === null ? '0' : $data[42][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">43</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[43][13] === null ? '0' : $data[43][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">44</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[44][13] === null ? '0' : $data[44][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">45</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[45][13] === null ? '0' : $data[45][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">46</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[46][13] === null ? '0' : $data[46][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">47</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[47][13] === null ? '0' : $data[47][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">48</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[48][13] === null ? '0' : $data[48][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">49</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[49][13] === null ? '0' : $data[49][13]; ?></h3>
                                                    </div>
                                                    <!-- =========== -->
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">50</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[50][13] === null ? '0' : $data[50][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">51</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[51][13] === null ? '0' : $data[51][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">52</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[52][13] === null ? '0' : $data[52][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">53</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[53][13] === null ? '0' : $data[53][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">54</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[54][13] === null ? '0' : $data[54][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">55</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[55][13] === null ? '0' : $data[55][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">56</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[56][13] === null ? '0' : $data[56][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">57</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[57][13] === null ? '0' : $data[57][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">58</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[58][13] === null ? '0' : $data[58][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">59</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[59][13] === null ? '0' : $data[59][13]; ?></h3>
                                                    </div>
                                                    <!-- =========== -->
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">60</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[60][13] === null ? '0' : $data[60][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">61</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[61][13] === null ? '0' : $data[61][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">62</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[62][13] === null ? '0' : $data[62][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">63</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[63][13] === null ? '0' : $data[63][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">64</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[64][13] === null ? '0' : $data[64][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">65</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[65][13] === null ? '0' : $data[65][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">66</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[66][13] === null ? '0' : $data[66][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">67</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[67][13] === null ? '0' : $data[67][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">68</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[68][13] === null ? '0' : $data[68][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">69</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[69][13] === null ? '0' : $data[69][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">70</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[70][13] === null ? '0' : $data[70][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">71</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[71][13] === null ? '0' : $data[71][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">72</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[72][13] === null ? '0' : $data[72][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">73</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[73][13] === null ? '0' : $data[73][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">74</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[74][13] === null ? '0' : $data[74][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">75</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[75][13] === null ? '0' : $data[75][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">76</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[76][13] === null ? '0' : $data[76][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">77</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[77][13] === null ? '0' : $data[77][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">78</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[78][13] === null ? '0' : $data[38][13]; ?></h3>
                                                    </div>

                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">79</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[79][13] === null ? '0' : $data[79][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">80</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[80][13] === null ? '0' : $data[80][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">81</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[81][13] === null ? '0' : $data[81][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">82</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[82][13] === null ? '0' : $data[82][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">83</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[83][13] === null ? '0' : $data[38][13]; ?></h3>
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">84</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[84][13] === null ? '0' : $data[85][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">85</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[85][13] === null ? '0' : $data[85][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">86</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[86][13] === null ? '0' : $data[86][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">87</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[87][13] === null ? '0' : $data[87][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">88</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[88][13] === null ? '0' : $data[88][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">89</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[89][13] === null ? '0' : $data[89][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">90</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[90][13] === null ? '0' : $data[90][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">91</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[91][13] === null ? '0' : $data[91][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">92</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[92][13] === null ? '0' : $data[92][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">93</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[93][13] === null ? '0' : $data[93][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">94</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[94][13] === null ? '0' : $data[94][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">95</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[95][13] === null ? '0' : $data[95][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">96</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[96][13] === null ? '0' : $data[96][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">97</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[97][13] === null ? '0' : $data[97][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">98</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[98][13] === null ? '0' : $data[98][13]; ?></h3>
                                                    </div>
                                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                                        <h3 class="fs-24  text_red text-center">99</h3>
                                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo $data[99][13] === null ? '0' : $data[99][13]; ?></h3>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                    </section>


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

    <!-- delete model work is here -->
    <div class="modal fade show" id="deletehistorymodel" style="display: none; padding-right: 17px;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete History !!</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body" style="padding: 20px 10px 10px 10px; text-align: center;">
                        <p style="font-size: 15px;">Are you sure ? You want to delete this Data !!</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" style="padding: 5px 15px 5px 15px;" class="btn light btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" id="catHistoryDel" style="padding: 5px 15px 5px 15px;" class="btn light btn-warning" data-dismiss="modal">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete model work end is here -->

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
            $('#list-table').DataTable();
        });
    </script>

    <script type="text/javascript">
        $(".submybtn").on('click', function() {
            var marketId = $('#marketid').val();

            var formdata = new FormData();
            formdata.append("marketId", marketId);

            var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
            };

            fetch("https://mbofficial.xyz/mainbazzar/api/memberNotificationData.php", requestOptions)
                .then(response => response.text())
                .then(result => console.log(result))
                .catch(error => console.log('error', error));
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.clear-result').on('click', function() {
                //var id = $('#market_id').val();

                // setInterval(function() 
                // {
                var mkid = $(this).attr('mkid');
                var datee = $(this).attr('datee');
                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "apiz/clear-winning.php",
                    data: {
                        mkid,
                        datee,
                    },
                    success: function(dataResult) {
                        alert(dataResult)
                        window.location.reload()
                    }
                });
            });
        });
    </script>

    <script>
        function getResult(el) {
            var marketid = $('#marketid').val();
            var betdate = $('#betdate').val();
            //var type = $('#type').val();

            if (marketid != '') {
                if (betdate != '') {
                    //if (type != '') {
                    $('#bid-history').DataTable({
                        destroy: true,
                        "ajax": "apiz/get_bidhistory.php?marketid=" + marketid + "&betdate=" + betdate,
                        "data": [],
                    });

                } else {
                    alert("Date required")
                }
            } else {
                alert("Market required")
            }
        }
    </script>

    <script type="text/javascript">
        function editmodel(ss) {
            var betnum = $(ss).attr('betnum');
            var betid = $(ss).attr('betid');

            $(".betnum").attr('alt', betnum).val(betnum);
            $(".betid").attr('alt', betid).val(betid);

            $('#editmodel').modal({
                show: true
            });
        }
    </script>

    <script type="text/javascript">
        function editmodeltwo(ss) {
            var betnum = $(ss).attr('betnum');
            var betnums = $(ss).attr('betnums');
            var betid = $(ss).attr('betid');

            $(".betnum").attr('alt', betnum).val(betnum);
            $(".betnums").attr('alt', betnums).val(betnums);
            $(".betid").attr('alt', betid).val(betid);

            $('#editmodeltwo').modal({
                show: true
            });
        }
    </script>

    <script>
        function men(e) {
            var betnums = null;
            var betnum = $('#betnumFirst').val();
            var betid = $('#betidFirst').val();

            $.ajax({ //create an ajax request to display.php
                type: "POST",
                url: "apiz/bet_num_update.php",
                data: {
                    betnums,
                    betnum,
                    betid
                },
                success: function(dataResult) {
                    alert(dataResult);
                    getResult()
                }
            });
        }
    </script>

    <script>
        function menSecond(e) {
            var betnums = null;
            var betnum = $('#betnumSecond').val();
            var betid = $('#betidSecond').val();
            var betnums = $('#betnumsSecond').val();

            $.ajax({ //create an ajax request to display.php
                type: "POST",
                url: "apiz/bet_num_update.php",
                data: {
                    betnums,
                    betnum,
                    betid
                },
                success: function(dataResult) {
                    alert(dataResult);
                    getResult()
                }
            });
        }
    </script>



    <script type="text/javascript">
        function deletehis(ct) {
            var id = $(ct).attr('alt');
            $('#catHistoryDel').attr('alt', id);
        }
    </script>

    <script type="text/javascript">
        $("#catHistoryDel").on('click', function() {
            var id = $(this).attr('alt');
            $.ajax({
                type: "POST",
                url: "apiz/deleteDeclareResult.php",
                data: {
                    id
                },
                success: function(data) {
                    $("#deleteHistoryMsg").show();
                    setTimeout(function() {
                        $("#deleteHistoryMsg").hide();
                    }, 3000);
                    // $('#categoryTbl').DataTable().ajax.reload(); 
                }
            });
        });
    </script>

</body>

</html>