<?php
include '../config.php';

//$star_line_bid = '{"openGame":[{"bet_num":"13","bet_amount":25},{"bet_num":"3","bet_amount":25},{"bet_num":"8","bet_amount":25}],"MemberId":"6","status":"Active","GameName":"Lottery_Number","GameId":"17","choice_id":"1","totalAmountGame":"75","star_line_bat_time":"09:00 pm"}';

$star_line_bid = $_POST['star_line_bid'];
$data = json_decode($star_line_bid);
$bet_date = date('y-m-d');
$bet_time = $time;
$member_id = $data->MemberId;
$game_id = $data->GameId;
$game_name = $data->GameName;
$total_amount = $data->totalAmountGame;

$statLineBatTime = $data->star_line_bat_time;
$date_transection = $date;

$b_game_cid = '0';
$betting_time_type = '';
$wallet_balance = '';

//get the member wallet amount from the member id

$query3 = "SELECT member_wallet_balance FROM member_wallet WHERE member_id = '$member_id'";
$result3 = mysqli_query($conn, $query3);
if (mysqli_num_rows($result3)) {
	$row3 = mysqli_fetch_array($result3);
	$wallet_balance = $row3[0];
}

if ($wallet_balance >= $total_amount) {
	$status = $data->status;
	$mbalance = 0;
	$lengthOfGame = sizeof($data->openGame);
	for ($i = $lengthOfGame; $i > 0; $i--) 
	{
		$openGameNumber =  $data->openGame[$i - 1]->bet_num;
		$openGameAmount = $data->openGame[$i - 1]->bet_amount;
		$msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id' ";
		$mquery = mysqli_query($conn, $msql);
		if ($mrow = mysqli_fetch_array($mquery)) {
			$mbalance = $mrow['member_wallet_balance'];
		}
		$balance = $mbalance - $openGameAmount;
		//todo how to check in amount in greter than zero solve isssue
		if ($mbalance >= $openGameAmount) {
			$query = "INSERT INTO colormarketbat(member_id, choice_id, game_name, game_id, bet_amount, bet_num,betting_date ,betting_time,statLineBatTime, active_status)VALUES ('$member_id','1','$game_name','$game_id','$openGameAmount','$openGameNumber','$bet_date','$bet_time','$statLineBatTime','Active')";
			$result = mysqli_query($conn, $query);
			if ($result) {
				$lastid = mysqli_insert_id($conn);
				$usql = "UPDATE member_wallet SET member_wallet_balance='$balance' WHERE member_id='$member_id'";
				if (mysqli_query($conn, $usql)) {
					$num = rand(10000, 100000);
					$pre = "BETOPEN";
					$trans = $pre . $num . $lastid;
					$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, game_name, bat_number) VALUES ('$trans','$openGameAmount','$member_id','$date_transection','openGameBat','$game_name','$openGameNumber')";
					if (mysqli_query($conn, $msql)) {
						$response = ["status" => 'success', "betid" => $lastid, "get_new_wallet_amt_openGame" => $balance];
					} else {
						$response = ["status" => 'Failure'];
					}
				} else {
					$response = ["status" => '1'];
				}
			} else {
				$response = ["status" => '2'];
			}
		}
	}
} else {
	$response = ["status" => 'Low Wallet Balance'];
}


echo json_encode($response);
