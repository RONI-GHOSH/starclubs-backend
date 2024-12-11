<?php
include '../includes/config.php';

$array = array();
$data['data'] = array();

$bid_date = $_POST['bid_date'];

$msql = "SELECT * FROM wallet_transaction WHERE transaction_type='WithdrawAmt' AND transaction_update_date='$bid_date' ORDER BY w_transaction_id DESC ";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 

		$tid = $row['w_transaction_id'];
		$tmember_id = $row['member_id'];

		$mmsql = "SELECT * FROM member WHERE member_id='$tmember_id'";
        $mmqry = mysqli_query($conn, $mmsql);
        $mmrow = mysqli_fetch_assoc($mmqry);




        $trid = $row['transaction_id'];
        $mname = $mmrow['member_name'];
        $mmname = $mmrow['member_mobile'];
		$tamount = $row['transaction_amount'];
		$tstatus = $row['withdrawl_status'];
		$tupdatedate = $row['transaction_update_date'];

		// if($tstatus == "Rejected" || $tstatus == "Success"){
		// 	$act = "No Actions";
		// }else{
		// 	$act = '<td><a href="#" class="btn btn-primary btn-sm w-xs mr-1 chngstatus" amount="'.$tamount.'" stat="approve" data-withdraw_request_id="'.$tid.'" member_id="'.$tmember_id.'">Approve</a><a href="#" class="btn btn-danger btn-sm w-xs chngstatus" amount="'.$tamount.'" stat="reject" data-withdraw_request_id="'.$tid.'" member_id="'.$tmember_id.'">Reject</a></td>';
		// }
				echo $response =  "
				 <tr>
                    <td>$i</td>
                    <td>$trid</td>
                    <td>$mname</td>
                    <td>$mmname</td>
                    <td>$tamount</td>
                    <td>$tupdatedate</td>
                    <td>$tstatus</td>";
                    $i++;
		


		// $data['data'][] = array(
		// 	$i,
		// 	$trid,
		// 	$mname,
		// 	$mmname,
		// 	$tamount,
		// 	$tstatus,
		// 	$tupdatedate,
		// 	// $act,
		// );
	}
}else {
	echo $response  =  "<tr><td colspan='7'>No Data found";
// 	if (empty($data)) {
// 	$data['data'] = array();
// }
}



// echo json_encode($data);



?>
