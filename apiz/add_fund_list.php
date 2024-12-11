<?php
include '../includes/config.php';


$member_id = $_REQUEST['member_id'];

$array = array();

$msql = "SELECT * FROM wallet_transaction WHERE member_id='$member_id' AND (transaction_type='Add' || transaction_type='AddMoney') ORDER BY w_transaction_id DESC ";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 

		$tid = $row['w_transaction_id'];
		// $tmoneytype = $row['tmoneytype'];
		$tamount = $row['transaction_amount'];
		$treceipt = $row['transaction_id'];
		$tstatus = $row['transaction_type'];
		$tupdatedate = $row['transaction_update_date'];

		$ttstatus = "Money Added";

		// $act = '<td><button class="btn btn-primary btn-sm w-xs mr-1" data-withdraw_request_id="2" >Approve</button><button class="btn btn-danger btn-sm w-xs" data-withdraw_request_id="2" >Reject</button></td>';


		$data['data'][] = array(
			$i,
			$tamount,
			$treceipt,
			// $tmoneytype,
			$tupdatedate,
			// $tstatus,
			$ttstatus,
			// $act,
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
