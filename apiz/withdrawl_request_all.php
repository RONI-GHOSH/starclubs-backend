<?php
include '../includes/config.php';

$array = array();

$msql = "SELECT * FROM wallet_transaction WHERE tmoneytype='WithdrawAmt' ORDER BY tid DESC ";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 

		$tid = $row['tid'];
		$tmoneytype = $row['tmoneytype'];
		$tamount = $row['tamount'];
		$tmember_id = $row['tmember_id'];
		$treceipt = $row['treceipt'];
		$tstatus = $row['tstatus'];
		$tupdatedate = $row['tupdatedate'];

		if($tstatus == "Rejected" || $tstatus == "Success"){
			$act = "No Actions";
		}else{
			$act = '<td><a href="#" class="btn btn-primary btn-sm w-xs mr-1 chngstatus" amount="'.$tamount.'" stat="approve" data-withdraw_request_id="'.$tid.'" member_id="'.$tmember_id.'">Approve</a><a href="#" class="btn btn-danger btn-sm w-xs chngstatus" amount="'.$tamount.'" stat="reject" data-withdraw_request_id="'.$tid.'" member_id="'.$tmember_id.'">Reject</a></td>';
		}

		


		$data['data'][] = array(
			$i,
			$treceipt,
			$tamount,
			// $tmoneytype,
			$tstatus,
			$tupdatedate,
			$act,
		);
		$i++;
	}
}else {
	// $response  =  "<tr><td>No Data found</td></tr>";
	if (empty($data)) {
	$data['data'] = array();
}
}



echo json_encode($data);



?>
