<?php
include '../includes/config.php';
$array = array();
$data['data'] = array();

$marketid = $_GET['marketid'];
$bid_date = $_GET['betdate'];
$number = $_GET['number'];

$sumday = str_split($number);
//$sm = array_sum($sumday);
$sm = substr($number, 0, 1);
$nsm = substr($number , -1);

    $msql = "SELECT * FROM betting bt  LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$bid_date')) AND b_market_id='$marketid' AND betting_status='Active' AND (b_game_cid = 13 AND betting_number='$number' OR b_game_cid = 14 AND SUBSTRING(betting_number, 1, 1) ='$sm' OR b_game_cid = 15 AND SUBSTRING(betting_number, -1, 1) = '$nsm')";
 // $msql = "SELECT * FROM starlinemarketbat bt LEFT JOIN member men ON bt.member_id = men.member_id WHERE date(trim(betting_date)) = date(trim('$bid_date')) AND time(statLineBatTime)=time('$marketid') AND bet_num='$number'"; 
$mquery = mysqli_query($conn,$msql); 
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) {
		$betting_id = $row['betting_id'] ?? '';
		$mname = $row['member_name']; 
     	$mmname = $row['member_mobile'];
		$betting_amount = $row['betting_amount'] ?? ' ';
		$market_name = $row['market_name'] ?? ' ';
		$gid = $row['game_id'] ?? ' ';

		$betting_number = $row['betting_number'] ?? ' ';
		$betting_time_type = $row['betting_time'] ?? ' ';

		$memberinfo = $mname . ' - ('. $mmname .')' ;		
		$mkname = $market_name ;

		$btnum = $betting_number;

		$btn = '<a href="#" betnum="'.$betting_number.'"  betid="'.$betting_id.'"  onclick="editDelhiWin(this);" data-toggle="modal" data-target="#editDelhiWin"><i class="mdi mdi-pencil font-size-18"></i></a>';

			$btnDeleted = '<a href="#" alt="'.$betting_id.'" onclick="idBetDelete(this);" data-toggle="modal" data-target="#delhiDeleteModal"><i class="bx bx-trash-alt font-size-18"></i></a>';
		
			$data['data'][] = array(
				$i, 
				$memberinfo,
				$mkname,
				$btnum, 
				$betting_amount,
				$btn,
				$btnDeleted, 
			);
			$i++; 
		}
	}else {
		// echo $response  =  "<tr><td colspan='7'>No Data found";
		if (empty($data)) {
				$data['data'] = array();
		}
}

	echo json_encode($data);

?>
