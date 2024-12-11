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
    $new_date = date('y-m-d', strtotime($bid_date));
    $time = date('h:i a', strtotime($marketid));




    $msql = "SELECT starlinemarketbat.bet_num,starlinemarketbat.game_id,CAST(starlinemarketbat.bet_num AS SIGNED) AS adjusted_betting_number, SUM(starlinemarketbat.bet_amount) AS total_amount
        FROM starlinemarketbat
        LEFT JOIN member ON starlinemarketbat.member_id = member.member_id
        WHERE DATE(TRIM(starlinemarketbat.betting_date)) = DATE(trim('$new_date'))
        AND starlinemarketbat.statLineBatTime = '$time'
        AND starlinemarketbat.active_status = 'Active'
        GROUP BY starlinemarketbat.statLineBatTime, adjusted_betting_number";

    $mquery = mysqli_query($conn, $msql);
    $totalamount = 0;
    $i = 1;
    if (mysqli_num_rows($mquery) > 0) {
        while ($row = mysqli_fetch_assoc($mquery)) {
            $betting_number = $row['adjusted_betting_number'] ?? ' ';
            $type = $row['game_id'] ?? ' ';
            $total_amount = $row['total_amount'] ?? ' ';
            $data[$betting_number][$type] = $total_amount;
            $i++;
            $totalamount = $total_amount + $totalamount;
        }
        $j = $i - 1;
    } else {
        if (empty($data)) {
            $data = array();
        }
    }
    /*print_r($data);*/
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
                                                            $getsql = "SELECT * FROM starLineMarketList WHERE active_status='Active'";
                                                            $getqry = mysqli_query($conn, $getsql);
                                                            $i = 1;
                                                            if (mysqli_num_rows($getqry) > 0) {
                                                                while ($row = mysqli_fetch_assoc($getqry)) {
                                                            ?>
                                                                    <option value="<?php echo $row['market_time']; ?>"><?php echo $row['market_time']; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>

                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary btn-block">Search List</button>
                                                    </div>

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

                        <div style="padding:10px;font-size:15px;">
                            <span style="color:white;">No. of Betting : <?php echo $j; ?></span>&nbsp;&nbsp;
                            <span style="color:yellow;">|</span>&nbsp;&nbsp;
                            <span style="color:white">Total Betting Amount: <?php echo $totalamount; ?> INR</span>&nbsp;&nbsp;

                        </div>
                        <div class="row mt-4 px-2 px-md-4">
                            <div class="col-10 col-md-11">
                                <div class="row">

                                    <h2>Single Digit</h2>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">0</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[0][1]) ? $data[0][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">1</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[1][1]) ? $data[1][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">2</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[2][1]) ? $data[2][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">3</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[3][1]) ? $data[3][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">4</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[4][1]) ? $data[4][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">5</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[5][1]) ? $data[5][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">6</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[6][1]) ? $data[6][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">7</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[7][1]) ? $data[7][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">8</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[8][1]) ? $data[8][1] : '0'; ?></h3>
                                    </div>
                                    <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                        <h3 class="fs-24  text_red text-center">9</h3>
                                        <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[9][1]) ? $data[9][1] : '0'; ?></h3>
                                    </div>
                                    <div class="row">
                                        <h2>Single Panna</h2>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">128</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[128][3]) ? $data[128][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">137</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[137][3]) ? $data[137][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">146</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[146][3]) ? $data[146][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">236</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[236][3]) ? $data[236][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">245</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[245][3]) ? $data[245][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">290</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[290][3]) ? $data[290][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">380</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[380][3]) ? $data[380][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">470</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[470][3]) ? $data[470][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">489</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[489][3]) ? $data[489][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">560</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[560][3]) ? $data[560][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">579</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[579][3]) ? $data[579][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">678</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[678][3]) ? $data[678][3] : '0'; ?></h3>
                                        </div>
                                        <!-- ========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">129</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[129][3]) ? $data[129][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">138</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[138][3]) ? $data[138][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">147</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[147][3]) ? $data[147][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">156</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[156][3]) ? $data[156][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">237</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[237][3]) ? $data[237][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">246</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[246][3]) ? $data[246][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">345</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[345][3]) ? $data[345][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">390</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[390][3]) ? $data[390][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">480</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[480][3]) ? $data[480][3] : '0'; ?></h3>
                                        </div>
                                        <!-- ========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">570</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[570][3]) ? $data[570][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">589</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[589][3]) ? $data[589][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">679</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[679][3]) ? $data[679][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">120</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[120][3]) ? $data[120][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">139</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[139][3]) ? $data[139][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">148</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[148][3]) ? $data[148][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">157</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[157][3]) ? $data[157][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">238</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[238][3]) ? $data[238][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">247</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[247][3]) ? $data[247][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">256</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[256][3]) ? $data[256][3] : '0'; ?></h3>
                                        </div>
                                        <!-- ============= -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">346</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[346][3]) ? $data[346][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">490</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[490][3]) ? $data[490][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">580</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[580][3]) ? $data[580][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">670</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[670][3]) ? $data[670][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">689</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[689][3]) ? $data[689][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">130</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[130][3]) ? $data[130][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">149</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[149][3]) ? $data[149][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">158</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[158][3]) ? $data[158][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">167</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[167][3]) ? $data[167][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">239</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[239][3]) ? $data[239][3] : '0'; ?></h3>
                                        </div>
                                        <!-- =========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">248</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[248][3]) ? $data[248][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">257</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[157][3]) ? $data[157][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">347</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[347][3]) ? $data[347][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">356</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[356][3]) ? $data[356][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">590</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[590][3]) ? $data[590][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">680</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[680][3]) ? $data[680][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">789</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[789][3]) ? $data[789][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">140</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[140][3]) ? $data[140][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">159</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[159][3]) ? $data[159][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">168</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[168][3]) ? $data[168][3] : '0'; ?></h3>
                                        </div>
                                        <!-- =========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">230</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[230][3]) ? $data[230][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">249</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[249][3]) ? $data[249][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">258</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[258][3]) ? $data[258][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">267</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[267][3]) ? $data[267][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">348</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[348][3]) ? $data[348][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">357</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[357][3]) ? $data[357][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">456</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[456][3]) ? $data[456][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">690</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[690][3]) ? $data[690][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">780</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[780][3]) ? $data[780][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">123</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[123][3]) ? $data[123][3] : '0'; ?></h3>
                                        </div>
                                        <!-- =========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">150</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[150][3]) ? $data[150][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">169</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[169][3]) ? $data[169][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">178</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[178][3]) ? $data[178][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">240</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[240][3]) ? $data[240][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">259</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[259][3]) ? $data[259][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">268</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[268][3]) ? $data[268][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">349</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[349][3]) ? $data[349][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">358</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[358][3]) ? $data[358][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">457</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[457][3]) ? $data[457][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">367</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[367][3]) ? $data[367][3] : '0'; ?></h3>
                                        </div>
                                        <!-- =========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">790</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[790][3]) ? $data[790][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">124</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[124][3]) ? $data[124][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">160</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[160][3]) ? $data[160][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">179</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[179][3]) ? $data[179][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">250</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[250][3]) ? $data[250][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">269</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[269][3]) ? $data[269][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">278</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[278][3]) ? $data[278][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">340</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[340][3]) ? $data[340][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">359</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[359][3]) ? $data[359][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">368</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[368][3]) ? $data[368][3] : '0'; ?></h3>
                                        </div>
                                        <!-- ======= -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">458</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[458][3]) ? $data[458][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">467</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[467][3]) ? $data[467][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">890</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[890][3]) ? $data[890][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">125</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[125][3]) ? $data[125][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">134</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[134][3]) ? $data[134][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">170</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[170][3]) ? $data[170][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">189</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[189][3]) ? $data[189][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">260</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[260][3]) ? $data[260][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">279</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[279][3]) ? $data[279][3] : '0'; ?></h3>
                                        </div>

                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">350</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[350][3]) ? $data[350][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">369</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[369][3]) ? $data[369][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">378</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[378][3]) ? $data[378][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">459</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[459][3]) ? $data[459][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">567</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[567][3]) ? $data[567][3] : '0'; ?></h3>
                                        </div>
                                        <!-- ======= -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">468</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[468][3]) ? $data[468][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">126</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[126][3]) ? $data[126][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">135</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[135][3]) ? $data[135][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">180</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[180][3]) ? $data[180][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">234</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[234][3]) ? $data[234][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">270</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[270][3]) ? $data[270][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">289</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[289][3]) ? $data[289][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">360</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[360][3]) ? $data[360][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">379</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[379][3]) ? $data[379][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">450</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[450][3]) ? $data[450][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">469</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[469][3]) ? $data[469][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">478</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[478][3]) ? $data[478][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">568</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[568][3]) ? $data[568][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">127</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[127][3]) ? $data[127][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">136</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[136][3]) ? $data[136][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">145</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[145][3]) ? $data[145][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">190</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[190][3]) ? $data[190][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">235</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[235][3]) ? $data[235][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">280</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[280][3]) ? $data[280][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">370</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[370][3]) ? $data[370][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">389</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[389][3]) ? $data[389][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">460</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[460][3]) ? $data[460][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">479</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[479][3]) ? $data[479][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">569</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[569][3]) ? $data[569][3] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">578</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[578][3]) ? $data[578][3] : '0'; ?></h3>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <h2>Double Panna</h2>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">100</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[100][4]) ? $data[100][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">119</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[119][4]) ? $data[119][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">155</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[155][4]) ? $data[155][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">227</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[119][4]) ? $data[119][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">335</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[335][4]) ? $data[335][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">344</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[244][4]) ? $data[344][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">399</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[399][4]) ? $data[399][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">588</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[399][4]) ? $data[399][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">669</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[669][4]) ? $data[669][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">110</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[110][4]) ? $data[110][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">200</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[200][4]) ? $data[200][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">228</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[228][4]) ? $data[228][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">255</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[255][4]) ? $data[255][4] : '0'; ?></h3>
                                        </div>
                                        <!-- ========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">336</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[336][4]) ? $data[336][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">499</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[499][4]) ? $data[499][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">660</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[660][4]) ? $data[660][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">688</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[668][4]) ? $data[668][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">778</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[778][4]) ? $data[778][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">166</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[166][4]) ? $data[166][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">229</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[229][4]) ? $data[229][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">300</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[300][4]) ? $data[300][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">337</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[337][4]) ? $data[337][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">355</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[355][4]) ? $data[355][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">445</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[445][4]) ? $data[445][4] : '0'; ?></h3>
                                        </div>
                                        <!-- ========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">599</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[599][4]) ? $data[599][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">799</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[799][4]) ? $data[799][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">788</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[788][4]) ? $data[788][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">112</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[112][4]) ? $data[112][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">220</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[220][4]) ? $data[220][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">266</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[226][4]) ? $data[266][4] : '0'; ?></h3>
                                            </h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">338</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[338][4]) ? $data[338][4] : '0'; ?></h3>
                                            </h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">446</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[446][4]) ? $data[446][4] : '0'; ?></h3>
                                            </h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">455</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[455][4]) ? $data[455][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">699</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[699][4]) ? $data[699][4] : '0'; ?></h3>
                                        </div>
                                        <!-- ============= -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">770</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[770][4]) ? $data[770][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">113</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[113][4]) ? $data[113][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">122</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[122][4]) ? $data[122][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">177</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[177][4]) ? $data[177][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">339</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[339][4]) ? $data[339][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">366</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[366][4]) ? $data[366][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">447</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[447][4]) ? $data[447][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">500</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[500][4]) ? $data[500][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">799</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[799][4]) ? $data[799][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">889</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[889][4]) ? $data[899][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">114</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[114][4]) ? $data[114][4] : '0'; ?></h3>
                                        </div>
                                        <!-- =========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">277</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[227][4]) ? $data[227][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">330</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[330][4]) ? $data[330][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">448</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[448][4]) ? $data[448][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">466</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[466][4]) ? $data[466][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">556</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[556][4]) ? $data[556][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">880</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[880][4]) ? $data[880][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">899</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[899][4]) ? $data[899][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">115</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[115][4]) ? $data[115][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">133</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[133][4]) ? $data[133][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">188</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[188][4]) ? $data[188][4] : '0'; ?></h3>
                                        </div>
                                        <!-- =========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">223</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[223][4]) ? $data[223][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">377</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[377][4]) ? $data[377][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">449</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[449][4]) ? $data[449][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">557</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[557][4]) ? $data[557][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">566</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[566][4]) ? $data[566][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">700</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[700][4]) ? $data[700][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">116</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[116][4]) ? $data[116][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">224</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[224][4]) ? $data[224][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">233</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[233][4]) ? $data[233][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">288</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[288][4]) ? $data[288][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">440</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[440][4]) ? $data[440][4] : '0'; ?></h3>
                                        </div>
                                        <!-- =========== -->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">477</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[477][4]) ? $data[477][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">558</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[558][4]) ? $data[558][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">800</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[800][4]) ? $data[800][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">990</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[990][4]) ? $data[990][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">117</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[117][4]) ? $data[117][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">144</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[144][4]) ? $data[144][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">199</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[199][4]) ? $data[199][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">225</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[225][4]) ? $data[225][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">388</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[388][4]) ? $data[388][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">559</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[559][4]) ? $data[559][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">577</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[577][4]) ? $data[577][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">667</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[667][4]) ? $data[667][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">900</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[900][4]) ? $data[900][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">118</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[118][4]) ? $data[118][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">226</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[226][4]) ? $data[226][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">244</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[244][4]) ? $data[244][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">299</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[299][4]) ? $data[299][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">334</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[334][4]) ? $data[334][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">488</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[488][4]) ? $data[488][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">550</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[550][4]) ? $data[550][4] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">668</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[668][4]) ? $data[668][4] : '0'; ?></h3>
                                        </div>
                                        <!-- ======= -->

                                    </div>
                                    <div class="row">

                                        <h2>Triple Panna</h2>
                                        <!--<div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                            <h3 class="fs-24  text_red text-center">222</h3>
                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[222][5]) ? $data[222][5] : '0'; ?></h3>
                        </div>-->
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">000</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[000][5]) ? $data[000][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">111</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[111][5]) ? $data[111][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">222</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[222][5]) ? $data[222][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">333</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[333][5]) ? $data[333][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">444</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[444][5]) ? $data[444][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">555</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[555][5]) ? $data[555][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">666</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[666][5]) ? $data[666][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">777</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[777][5]) ? $data[777][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">888</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[888][5]) ? $data[888][5] : '0'; ?></h3>
                                        </div>
                                        <div class="col-4 col-md-2 col-lg-2 col-xl-2 px-2 col-xxl-1">
                                            <h3 class="fs-24  text_red text-center">999</h3>
                                            <h3 class="fs-24 text_green bg_grey text-center"><?php echo isset($data[999][5]) ? $data[999][5] : '0'; ?></h3>
                                        </div>
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
                    </script> ©RSMatka.
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