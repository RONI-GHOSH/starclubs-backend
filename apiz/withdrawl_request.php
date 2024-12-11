<?php
include '../includes/config.php';


$member_id = $_REQUEST['member_id'];

$array = array();

$msql = "SELECT * FROM wallet_transaction WHERE member_id='$member_id' AND transaction_type='WithdrawAmt' ORDER BY w_transaction_id DESC ";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 

		$tid = $row['w_transaction_id'];
		$tmoneytype = $row['transaction_type'];
		$tamount = $row['transaction_amount'];
		$treceipt = $row['transaction_id'];
		$tstatus = $row['withdrawl_status'];
		$tupdatedate = $row['transaction_update_date'];

		if($tstatus == "approved" || $tstatus == "rejected"){
			$act = "No Actions";
		}else{
			$act = '<td><a href="#" class="btn btn-primary btn-sm w-xs mr-1 chngstatus" amount="'.$tamount.'" stat="approved" data-withdraw_request_id="'.$tid.'" >Approve</a><a href="#" class="btn btn-danger btn-sm w-xs chngstatus" amount="'.$tamount.'" stat="rejected" data-withdraw_request_id="'.$tid.'" >Reject</a></td>';
		}

		


		$data['data'][] = array(
			$i,
			$tamount,
			$treceipt,
			
			// $tmoneytype,
			$tupdatedate,
			$tstatus,
			$act,
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
