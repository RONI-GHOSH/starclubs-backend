<?php
include '../includes/config.php';

$array = array();

$msql = "SELECT * FROM wallet_transaction WHERE tmoneytype='Add' ORDER BY tid DESC ";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 

		$tid = $row['tid'];
		// $tmoneytype = $row['tmoneytype'];
		$tamount = $row['tamount'];
		$treceipt = $row['treceipt'];
		$tstatus = $row['tstatus'];
		$tupdatedate = $row['tupdatedate'];

		// $act = '<td><button class="btn btn-primary btn-sm w-xs mr-1" data-withdraw_request_id="2" >Approve</button><button class="btn btn-danger btn-sm w-xs" data-withdraw_request_id="2" >Reject</button></td>';


		$data['data'][] = array(
			$i,
			$treceipt,
			$tamount,
			// $tmoneytype,
			$tstatus,
			$tupdatedate,
			// $act,
		);
		$i++;
	}
}else {
	// echo $response  =  "<tr><td>No Data found</td></tr>";
	if (empty($data)) {
	$data['data'] = array();
}
}



echo json_encode($data);



?>
