<?php
include '../includes/config.php';
$array = array();
$data['data'] = array();

$marketid = $_GET['marketid'];
$bid_date = $_GET['betdate'];
$number = $_GET['number'];
$type = $_GET['type'];

$sumday = str_split($number);
$sm = array_sum($sumday);
$nsm = substr($sm , -1);

if ($type == 'Open') {
	 $msql = "SELECT * FROM betting bt  LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$bid_date')) AND b_market_id='$marketid' AND (betting_time_type  IN ('$type', '')) AND  (betting_number='$number' OR betting_number_second='$nsm' OR betting_number='$nsm' OR betting_number_second='$number' OR ( bt.b_game_cid = '1' AND betting_number LIKE '%$nsm')) AND bt.betting_status = 'Active'";
} else {

	$rsql = "SELECT * FROM winningbetting_detail WHERE market_Id = '$marketid' AND DATE(opening_date) = DATE('$bid_date') ";
	$rqry = mysqli_query($conn, $rsql);
	$rrow = mysqli_fetch_array($rqry);
	$lastnum = $rrow['winning_number_second'];

	$msql = "SELECT * FROM betting bt  LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$bid_date')) AND b_market_id='$marketid' AND (betting_time_type  IN ('$type', '')) AND  (betting_number='$number' OR betting_number_second='$nsm' OR betting_number='$nsm' OR betting_number_second='$number' OR betting_number = '$lastnum$nsm') AND bt.betting_status = 'Active'";
}


$mquery = mysqli_query($conn, $msql);

$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 



		$betting_id = $row['betting_id'] ?? ' ';
		$member_id = $row['member_id'] ?? ' ';

		$mmsql = "SELECT * FROM member WHERE member_id='$member_id'";
	    $mmqry = mysqli_query($conn, $mmsql);
	    $mmrow = mysqli_fetch_assoc($mmqry);
	    $mname = $mmrow['member_name'];
     	$mmname = $mmrow['member_mobile'];
		$betting_amount = $row['betting_amount'] ?? ' ';
		$market_name = $row['market_name'] ?? ' ';
		$gid = $row['b_game_cid'] ?? ' ';

		$mgsql = "SELECT * FROM game WHERE game_id ='$gid'";
        $mgqry = mysqli_query($conn, $mgsql);
        $mgrow = mysqli_fetch_assoc($mgqry);
        $game_name = $mgrow['game_name'] ?? ' ';
		$betting_number = $row['betting_number'] ?? ' ';
		$betting_number_second = $row['betting_number_second'] ?? ' ';
		$betting_time_type = $row['betting_time_type'] ?? ' ';

		$memberinfo = $mname . ' - ('. $mmname .')' ;		
		$mkname = $market_name . ' - ('. $game_name .')' ;

		$btnum = $betting_number . ' - ' . $betting_number_second;

		if ($betting_number_second != '') {
			// $btn = '<a href="#" class="demo-google-material-icon" data-toggle="modal" betnum="'.$betting_number.'" betnums="'.$betting_number_second.'" betid="'.$betting_id.'" onclick="editmodeltwo(this)" data-target="#editmodeltwo"> <i class="material-icons">create</i> <span class="icon-name"></span> </a>';

			$btn = '<a href="#" betnum="'.$betting_number.'" betnums="'.$betting_number_second.'" betid="'.$betting_id.'" onclick="editmodeltwo(this)" data-toggle="modal" data-target="#editmodeltwo"><i class="mdi mdi-pencil font-size-18"></i></a>';

			$btnDeleted = '<a href="#" alt="'.$betting_id.'" onclick="deletehis(this);" data-toggle="modal" data-target="#deletehistorymodel"><i class="bx bx-trash-alt font-size-18"></i></a>';

		}else {
			// $btn = '<a href="#" class="demo-google-material-icon" data-toggle="modal"  betnum="'.$betting_number.'"  betid="'.$betting_id.'" onclick="editmodel(this)" data-target="#editmodel"> <i class="material-icons">create</i> <span class="icon-name"></span> </a>';
			$btn = '<a href="#" betnum="'.$betting_number.'" betnums="'.$betting_number_second.'" betid="'.$betting_id.'"  onclick="editmodel(this);" data-toggle="modal" data-target="#editmodel"><i class="mdi mdi-pencil font-size-18"></i></a>';

			$btnDeleted = '<a href="#" alt="'.$betting_id.'" onclick="deletehis(this)" data-toggle="modal" data-target="#deletehistorymodel"><i class="bx bx-trash-alt font-size-18"></i></a>';
		}

		// $addwinbtn = '<a href="#" class="demo-google-material-icon" data-toggle="modal" memid="'.$member_id.'" onclick="winmodel(this)" data-target="#winmodel"> <i class="material-icons">add</i> <span class="icon-name"></span> </a>';


			$data['data'][] = array(
				$i,
				// $member_id,
				$memberinfo,
				$mkname,
				$btnum,
				$betting_amount,
				// $betting_number_second,
				$btn,
				$btnDeleted,
				// $addwinbtn,
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
