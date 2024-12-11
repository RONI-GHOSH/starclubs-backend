<?php
include '../includes/config.php';


$member_id = $_REQUEST['member_id'];

$array = array();

$msql = "SELECT * FROM wallet_transaction WHERE member_id='$member_id' ORDER BY w_transaction_id DESC";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 



		$tid = $row['w_transaction_id'];
		$tmoneytype = $row['transaction_type'];
		$tamount = $row['transaction_amount'];
		$treceipt = $row['transaction_id'];
		 $tstatus = $row['tstatus'];
		$tupdatedate = $row['transaction_update_date'];

		if ($tmoneytype == "Add" || $tmoneytype == "AddAmt") {
			$td = "<span class='badge badge-pill badge-success font-size-12 '>Money Added</span>";
		}elseif ($tmoneytype == "Sub") {
			$td = "<span class='badge badge-pill badge-danger font-size-12 '>Withdraw</span>";
		}elseif ($tmoneytype == "WithdrawAmt") {
			$td = "<span class='badge badge-pill badge-danger font-size-12 '>Withdraw</span>";
		}elseif ($tmoneytype == "WinningBat") {
			$td = "<span class='badge badge-pill badge-success font-size-12 '>Bet Winning</span>";
		}else{
			$td = "<span class='badge badge-pill badge-danger font-size-12 '>Game Bet</span>";
		}
		$data['data'][] = array(
			$i,
			$treceipt,
			$tamount,
			$td,
			// $tstatus,
			$tupdatedate,
		);
		$i++;
	}
}else {
	if (empty($data)) {
	$data['data'] = array();
}
}



echo json_encode($data);



?>
