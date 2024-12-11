<?php
include '../includes/config.php';

$array = array();
$data['data'] = array();

// $marketid = $_POST['marketid'];
$bid_date = $_POST['betdate'];
// $type = $_POST['type'];
$msql = "SELECT * FROM wallet_transaction WHERE date(transaction_update_date) = date('$bid_date') AND transaction_type='WinningBat' AND status='1' ORDER BY w_transaction_id DESC ";
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
		$market_name = $row['market_name'];
		$game_name = $row['game_name'];
		$bat_number = $row['bat_number'];
		$bet_type = $row['bet_type'];
		
		$mkname = $market_name . '('. $game_name .')' ;

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
                    <td>$mkname</td>
                    <td>$bat_number</td>
                    <td>$bet_type</td>
                    <td>$tamount</td>";
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
