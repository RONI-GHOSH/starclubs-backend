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


if (isset($_POST['delete-alloted'])) {
	$market_id = $_POST['marketid'];
	$betdate = $_POST['betdate'];
	$type = $_POST['type'];
	$lotterynumber = $_POST['declaredResults'];

	$sumday = str_split($lotterynumber);
	$sm = array_sum($sumday);
	$nsm = substr($sm, -1);

	//Return Winning Amount 
	$returnQuery = "SELECT * FROM wallet_transaction WHERE transaction_update_date=date('$betdate') AND market_Id ='$market_id' AND 
	bet_type ='$type' ORDER BY w_transaction_id DESC";
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

			$mrbalance = $mbalance - $amount;

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


	if ($type == "Open") {
		$get = "UPDATE winningbetting_detail SET winning_number_first='', winning_number_second='' WHERE opening_date=date('$betdate') AND market_Id ='$market_id'";
	}
	if ($type == "Close") {
		$get = "UPDATE winningbetting_detail SET winning_number_third='', winning_number_fouth='' WHERE opening_date=date('$betdate') AND market_Id ='$market_id'";
	}

	$gql = mysqli_query($conn, $get);
	if (isset($gql)) {
		echo '<script>alert("Number Deletion Successfull!");window.location = "declare-result.php";</script>';
	} else {
		echo '<script>alert("Number Deletion Failed");window.location = "declare-result.php";</script>';
	}
	exit();
}








if (isset($_POST['update'])) {
	$market_id = $_POST['marketid'];
	$betdate = $_POST['betdate'];
	$lotterynumber = $_POST['number'];
	$type = $_POST['type'];
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

			if ($type == "Open") {
				$sql2 = "UPDATE winningbetting_detail SET winning_number_first='$lotterynumber' , winning_number_second='$nsm' WHERE Id = '$hid' AND market_Id ='$sts'";
			} elseif ($type == "Close") {
				$sql2 = "UPDATE winningbetting_detail SET winning_number_fouth='$lotterynumber' , winning_number_third='$nsm' WHERE Id = '$hid' AND market_Id ='$sts'";
			}
		} else {
			$sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_first,winning_number_second,market_Id) values('$betdate','$lotterynumber','$nsm','$market_id')";
		}
	} else {
		$sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_first,winning_number_second,market_Id) values('$betdate','$lotterynumber','$nsm','$market_id')";
	}

	if (!mysqli_query($conn, $sql2)) {
		echo '<script>alert("Number Update Failed");window.location = "declare-result.php";</script>';
	} else {
		$sql_refer_type = "SELECT refer_type FROM admin";
		$query_refer_type = mysqli_query($conn, $sql_refer_type);
		$row_refer_type = mysqli_fetch_array($query_refer_type);
		$refer_type = $row_refer_type['refer_type'];


		//LOSS Bet Referall Earnings Transactions
		if ($refer_type = 'Loss Betting') {
			if ($type == "Open") {
				$lossbetmsqlold = "SELECT * FROM betting bt LEFT JOIN market mk ON bt.b_market_id = mk.market_id 
				LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$betdate')) 
				AND b_market_id='$market_id' AND betting_status='Active' AND bt.betting_time_type='$type'  
				AND (b_game_cid = 3 AND betting_number !='$lotterynumber' 
				OR b_game_cid = 4 AND betting_number !='$lotterynumber' 
				OR b_game_cid = 5 AND betting_number != '$lotterynumber'
				OR b_game_cid = 1 AND betting_number != '$nsm')";

				$lossbetmsql = "SELECT bt.*, m.*, mk.*, IFNULL(mr.referrer_id, '') AS referrer_id FROM betting bt 
				LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id 
				LEFT JOIN member_referral mr ON m.member_id = mr.referrer_id WHERE DATE(TRIM(betting_date)) = DATE(TRIM('$betdate'))
				AND b_market_id = '$market_id' AND betting_status = 'Active' AND bt.betting_time_type = '$type'
				AND (
				(b_game_cid = 3 AND betting_number != '$lotterynumber')
				OR (b_game_cid = 4 AND betting_number != '$lotterynumber')
				OR (b_game_cid = 5 AND betting_number != '$lotterynumber')
				OR (b_game_cid = 1 AND betting_number != '$nsm')
				)";
			} else {
				$query3 = "SELECT * FROM winningbetting_detail WHERE opening_date=date('$betdate') AND market_Id ='$market_id' ORDER BY Id DESC";
				$result3 = mysqli_query($conn, $query3);
				$rows3 = mysqli_fetch_assoc($result3);
				$jodinumber = $rows3['winning_number_second'] . $rows3['winning_number_second'];

				$lossbetmsqlold = "SELECT * FROM betting bt  LEFT JOIN market mk ON bt.b_market_id = mk.market_id  
				LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$betdate')) 
				AND b_market_id='$market_id' AND betting_status='Active' AND bt.betting_time_type='$type'  
				AND (b_game_cid = 3 AND betting_number !='$lotterynumber' OR b_game_cid = 4 AND betting_number !='$lotterynumber' 
				OR b_game_cid = 5 AND betting_number != '$lotterynumber'OR b_game_cid = 1 AND betting_number != '$nsm'
				OR b_game_cid = 2 AND betting_number != '$jodinumber'OR b_game_cid = 6 AND betting_number != '$lotterynumber'
				OR b_game_cid = 7 AND betting_number != '$lotterynumber')";

				$lossbetmsql = "SELECT bt.*, m.*, mk.*, IFNULL(mr.referrer_id, '') AS referrer_id FROM betting bt 
				LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id
				LEFT JOIN member_referral mr ON m.member_id = mr.referrer_id WHERE DATE(TRIM(betting_date)) = DATE(TRIM('$betdate'))
				AND b_market_id = '$market_id' AND betting_status = 'Active' AND bt.betting_time_type = '$type' AND (
				(b_game_cid = 3 AND betting_number != '$lotterynumber') OR (b_game_cid = 4 AND betting_number != '$lotterynumber')
				OR (b_game_cid = 5 AND betting_number != '$lotterynumber') OR (b_game_cid = 1 AND betting_number != '$nsm')
				OR (b_game_cid = 2 AND betting_number != '$jodinumber') OR (b_game_cid = 6 AND betting_number != '$lotterynumber')
				OR (b_game_cid = 7 AND betting_number != '$lotterynumber'))";
			}
			$lossbetquery = mysqli_query($conn, $lossbetmsql);
			// Check if the query was successful
			if ($lossbetquery) {
				// Fetch and process each row
				while ($row = mysqli_fetch_assoc($lossbetquery)) {
					if (isset($row['referrer_id']) && !empty($row['referrer_id'])) {
						$referrerid = $row['referrer_id'];
						$sqlrefer = "SELECT member_id FROM member_referral WHERE referrer_id=$referrerid";
						$queryrefer = mysqli_query($conn, $sqlrefer);
						$rowrefer = mysqli_fetch_array($queryrefer);
						$referrerid = $rowrefer['member_id'];

						$bettingid = $row['betting_id'];
						$bettingamount = $row['betting_amount'];
						$b_game_cid = $row['b_game_cid'];
						$sql = "INSERT INTO betting_loss_referral (betting_id, amount, referrer_user_id, b_game_cid, created_at, updated_at, status)
						VALUES ($bettingid,$bettingamount,$referrerid,$b_game_cid,current_timestamp(), '0000-00-00 00:00:00', '0')";
						$insertresult = mysqli_query($conn, $sql);
						if ($referrerid) {
							$amount = $bettingamount * $refer_percentage / 100;
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
		} else if ($refer_type = 'Flat') {
			//LOSS Bet Referall Earnings Transactions

			if ($type == "Open") {
				$lossbetmsqlold = "SELECT * FROM betting bt LEFT JOIN market mk ON bt.b_market_id = mk.market_id 
				LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$betdate')) 
				AND b_market_id='$market_id' AND betting_status='Active'";

				$lossbetmsql = "SELECT bt.*, m.*, mk.*, IFNULL(mr.referrer_id, '') AS referrer_id FROM betting bt 
				LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id 
				LEFT JOIN member_referral mr ON m.member_id = mr.referrer_id WHERE DATE(TRIM(betting_date)) = DATE(TRIM('$betdate'))
				AND b_market_id = '$market_id' AND betting_status = 'Active'";
			} else {
				$query3 = "SELECT * FROM winningbetting_detail WHERE opening_date=date('$betdate') AND market_Id ='$market_id' ORDER BY Id DESC";
				$result3 = mysqli_query($conn, $query3);
				$rows3 = mysqli_fetch_assoc($result3);
				$jodinumber = $rows3['winning_number_second'] . $rows3['winning_number_second'];

				$lossbetmsqlold = "SELECT * FROM betting bt  LEFT JOIN market mk ON bt.b_market_id = mk.market_id  
				LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$betdate')) 
				AND b_market_id='$market_id' AND betting_status='Active'";

				// $lossbetmsql = "SELECT bt.*, m.*, mk.*, IFNULL(mr.referrer_id, '') AS referrer_id FROM betting bt 
				// LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id
				// LEFT JOIN member_referral mr ON m.member_id = mr.referrer_id WHERE DATE(TRIM(betting_date)) = DATE(TRIM('$betdate'))
				// AND b_market_id = '$market_id' AND betting_status = 'Active' AND bt.betting_time_type = '$type' AND (
				// (b_game_cid = 3 AND betting_number != '$lotterynumber') OR (b_game_cid = 4 AND betting_number != '$lotterynumber')
				// OR (b_game_cid = 5 AND betting_number != '$lotterynumber') OR (b_game_cid = 1 AND betting_number != '$nsm')
				// OR (b_game_cid = 2 AND betting_number != '$jodinumber') OR (b_game_cid = 6 AND betting_number != '$lotterynumber')
				// OR (b_game_cid = 7 AND betting_number != '$lotterynumber'))";

				$lossbetmsql = "SELECT bt.*, m.*, mk.*, IFNULL(mr.referrer_id, '') AS referrer_id FROM betting bt 
				LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id
				LEFT JOIN member_referral mr ON m.member_id = mr.referrer_id WHERE DATE(TRIM(betting_date)) = DATE(TRIM('$betdate'))
				AND b_market_id = '$market_id' AND betting_status = 'Active'";
			}
			$lossbetquery = mysqli_query($conn, $lossbetmsql);
			// Check if the query was successful
			if ($lossbetquery) {
				// Fetch and process each row
				while ($row = mysqli_fetch_assoc($lossbetquery)) {
					if (isset($row['referrer_id']) && !empty($row['referrer_id'])) {
						$referrerid = $row['referrer_id'];
						$sqlrefer = "SELECT member_id FROM member_referral WHERE referrer_id=$referrerid";
						$queryrefer = mysqli_query($conn, $sqlrefer);
						$rowrefer = mysqli_fetch_array($queryrefer);
						$referrerid = $rowrefer['member_id'];

						$bettingid = $row['betting_id'];
						$bettingamount = $row['betting_amount'];
						$b_game_cid = $row['b_game_cid'];
						$sql = "INSERT INTO betting_loss_referral (betting_id, amount, referrer_user_id, b_game_cid, created_at, updated_at, status)
						VALUES ($bettingid,$bettingamount,$referrerid,$b_game_cid,current_timestamp(), '0000-00-00 00:00:00', '0')";
						$insertresult = mysqli_query($conn, $sql);
						if ($referrerid) {
							$amount = $bettingamount * $refer_percentage / 100;
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
		}
		calldeclaresendnotificationapi($market_id);
		echo '<script>alert("Number Update Successfully");window.location = "declare-result.php";</script>';
	}
	exit();
}

if (isset($_POST['update-allot'])) {
	$market_id = $_POST['marketid'];
	$betdate = $_POST['betdate'];
	$lotterynumber = $_POST['number'];
	$type = $_POST['type'];

	$sumday = str_split($lotterynumber);
	$sm = array_sum($sumday);
	$nsm = substr($sm, -1);

	//Return Winning Amount 
	$returnQuery = "SELECT * FROM wallet_transaction WHERE transaction_update_date=date('$betdate') AND market_Id ='$market_id' AND 
	bet_type ='$type' ORDER BY w_transaction_id DESC";
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

			$mrbalance = $mbalance - $amount;

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

			if ($type == "Open") {
				$sql2 = "UPDATE winningbetting_detail SET winning_number_first='$lotterynumber' , winning_number_second='$nsm' WHERE Id = '$hid' AND market_Id ='$sts'";
			} elseif ($type == "Close") {
				$sql2 = "UPDATE winningbetting_detail SET winning_number_fouth='$lotterynumber' , winning_number_third='$nsm' WHERE Id = '$hid' AND market_Id ='$sts'";
			}
		} else {
			$sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_first,winning_number_second,market_Id) values('$betdate','$lotterynumber','$nsm','$market_id')";
		}
	} else {
		$sql2 = "INSERT into winningbetting_detail(opening_date,winning_number_first,winning_number_second,market_Id) values('$betdate','$lotterynumber','$nsm','$market_id')";
	}

	if (!mysqli_query($conn, $sql2)) {
		echo mysqli_error($conn);
	} else {
		if ($type == "Open") {
			$type = 1;
		} else {
			$type = 2;
		}
		echo $dsql = "CALL Poc_SetttingWinningAmount('$market_id','$type','$betdate')";
		if (!mysqli_query($conn, $dsql)) {
			echo '<script>alert("Number Update Failed");window.location = "declare-result.php";</script>';
		} else {
			//  calldeclaresendnotificationapi($market_id);
			callsendnotificationapi();
			echo '<script>alert("Number Update Successfully");window.location = "declare-result.php";</script>';
		}
	}
	// echo '<script>alert("Number Post Successfully");window.location = "declare-result.php";</script>';
	exit();
}

function calldeclaresendnotificationapi($marketId)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://mbofficial.xyz/mainbazzar/api/memberNotificationData.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "marketId=$marketId");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($ch);
	curl_close($ch);
}



function callsendnotificationapi()
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://mbofficial.xyz/mainbazzar/api/MemberWinningNotification.php");
	curl_setopt($ch, CURLOPT_POST, 1); // set post data to true
	curl_setopt($ch, CURLOPT_POSTFIELDS, "number=myname&marketId=mypass");   // post data
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($ch);
	curl_close($ch);
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
													<div class="form-group col-md-3">
														<label>Result Date</label>
														<div class="date-picker">
															<div class="input-group">
																<input required="" class="form-control digits" type="date" value="<?php echo $date ?>" name="betdate" id="betdate">
															</div>
														</div>
													</div>

													<div class="form-group col-md-3">
														<label>Game Name </label>
														<select required="" class="form-control" name="marketid" id="marketid">
															<option value="">Select Name</option>
															<?php
															$getsql = "SELECT * FROM market WHERE active_status !='Removed' AND market_type != 'delhi'";
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
														<label>Session</label>
														<select id="type" required="" name="type" class="form-control">
															<option value="">Select Session</option>
															<option value="Open">Open</option>
															<option value="Close">Close</option>
														</select>
													</div>

													<div class="form-group col-md-2">
														<label for="market_close">Number</label>
														<div class="form-group">
															<input type="text" maxlength="3" required class="form-control" placeholder="Number" id="number" name="number">
														</div>
													</div>
 
													<div class="form-group col-md-2">
														<label for="market_close">Declared Result</label>
														<div class="form-group">
															<input type="text" class="form-control" style="background-color:azure" readonly placeholder="No Result Declared Yet!" name="declaredResults" id="declaredResults">
														</div>
													</div>

													<div class="form-group col-md-3">
														<label>&nbsp;</label>
														<button type="submit" class="btn btn-primary btn-block submybtn" name="update">Share Commission</button>
													</div>

													<div class="form-group col-md-3">
														<label>&nbsp;</label>
														<button type="submit" class="btn btn-success btn-block submybtn" name="update-allot">Declare Result</button>
													</div>

													<div class="form-group col-md-3">
														<label>&nbsp;</label>
														<button type="button" class="btn btn-warning btn-block" onclick="getResult(this);">Show Winner List</button>
													</div>

													<div class="form-group col-md-3">
														<label>&nbsp;</label>
														<button type="submit" class="btn btn-danger btn-block submybtn" name="delete-alloted">Delete Result</button>
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
									<span id='deleteHistoryMsg'></span>
									<div class="table-responsive">
										<table class="table table-striped table-bordered" id="win-member">
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
											<tbody id="resultTable">
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
													<th>Open Pana</th>
													<th>Open Action</th>
													<th>Close Pana</th>
													<th>Close Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												// 			$getsql = "SELECT * FROM winningbetting_detail wb LEFT JOIN market m ON wb.market_Id = m.market_id WHERE opening_date LIKE '%$date%' ";
												// 								$getsql = '';
												$timec =   date('h:i a');
												// $timea =   trim(date('h:i a'));
												$date =   trim(date('Y-m-d h:i a'));
												// $sql="";
												$today = date('Y-m-d');
												$previousDate = date('Y-m-d', strtotime("-1 days"));
												$checkTime = date('H:i a', strtotime('06:00 am'));
												if (date('H:i a') > date('H:i a', strtotime('06:00 am'))) {
													$getsql = " SELECT * FROM market mar left join winningbetting_detail wd on mar.market_id=wd.market_Id  WHERE mar.active_status !='Removed' AND mar.market_type='Mumbai' AND wd.opening_date='$today' GROUP BY mar.market_name ORDER BY mar.market_Id asc";
												} else {
													$getsql = " SELECT * FROM market mar left join winningbetting_detail wd on mar.market_id=wd.market_Id  WHERE mar.active_status !='Removed' AND mar.market_type='Mumbai' AND wd.opening_date='$previousDate' GROUP BY mar.market_name ORDER BY mar.market_Id asc";
												}
												// if(date('H:i a',strtotime($timec))<=date('H:i a',strtotime('05:00 am')))
												// {
												//       $getsql = " SELECT * FROM market mar left join winningbetting_detail wd on (wd.market_Id=mar.market_id  AND DATE(wd.opening_date) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)) WHERE active_status !='Removed'  AND market_type='Mumbai'  GROUP BY mar.market_name ORDER BY mar.market_Id asc";
												// }
												// else
												// {
												//      $getsql = "SELECT * FROM market mar left join winningbetting_detail wd on (wd.market_Id=mar.market_id  AND DATE(wd.opening_date) = DATE('$date')) WHERE active_status !='Removed' AND market_type='Mumbai'  GROUP BY mar.market_name ORDER BY mar.market_Id asc";
												// }
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
			<div class="modal fade" id="editmodel" tabindex="-1" role="dialog">
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
											<input type="text" id="betnumFirst" class="form-control betnum" value="" placeholder="Bet Number" name="betnum">
											<input type="hidden" id="betidFirst" class="form-control betid" value="" name="betid">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" onClick="men(this)" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
									<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Large Size -->
			<div class="modal fade" id="editmodeltwo" tabindex="-1" role="dialog">
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
											<input type="text" id="betnumSecond" class="form-control betnum" minlength="3" maxlength="3" value="" placeholder="Bet Number" name="betnum">
											<br>
											<input type="text" id="betnumsSecond" class="form-control betnums" minlength="3" maxlength="3" value="" placeholder="Bet Number 2" name="betnums">

											<input type="hidden" id="betidSecond" class="form-control betid" value="" name="betid">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" onClick="menSecond(this)" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
									<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>

			<!-- Large Size -->
			<!-- <div class="modal fade" id="winmodel" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="title" id="largeModalLabel1">Add Winning Money to User Account</h4>
</div>
<div class="modal-body">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
</div>
</div>
</div>
</div> -->


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







	<script>
		$(document).ready(function() {
			// Function to send AJAX request to populate declared results dropdown
			function populateDeclaredResults() {
				var betdate = $('#betdate').val();
				var gameName = $('#marketid').val();
				var session = $('#type').val();
				// alert(gameName);
				// AJAX request
				$.ajax({
					url: 'apiz/mumbai_delete_results.php',
					type: 'POST',
					data: {
						betdate: betdate,
						gameName: gameName,
						session: session,
					},
					success: function(response) {
						// alert(response);
						// Populate the declared results dropdown
						$('#declaredResults').val(response);
					}
				});
			}

			// Trigger populateDeclaredResults function when date, game name, or color changes
			$('#betdate, #marketid, #type').change(function() {
				populateDeclaredResults();
			});

			// Call the function initially when the page loads
			populateDeclaredResults();
		});
	</script>














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
				var type = $(this).attr('type');
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
			});
		});
	</script>

	<script>
		function getResult(el) {
			var marketid = $('#marketid').val();
			var betdate = $('#betdate').val();
			var number = $('#number').val();
			var type = $('#type').val();

			if (marketid != '') {
				if (betdate != '') {
					if (number != '' && number.length >= 3) {
						if (type != '') {
							$('#win-member').DataTable({
								destroy: true,
								"ajax": "apiz/get_result.php?marketid=" + marketid + "&betdate=" + betdate + "&number=" + number + "&type=" + type,
								"data": [],
							});
						} else {
							alert("Type required")
						}
					} else {
						alert("Number required and must have 3 digit")
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

	<!-- <script>
$(document).ready(function(){
$('.clear-result').on('click', function() {

var mkid = $('#market_id').val();
var datee = $('#market_id').val();
var type = $('#market_id').val();
var type = $('#market_id').val();
// console.log(mkid + datee);
$.ajax({ //create an ajax request to display.php
type: "POST",
url: "apiz/clear-winning.php",
data : {
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
</script> -->

</body>

</html>