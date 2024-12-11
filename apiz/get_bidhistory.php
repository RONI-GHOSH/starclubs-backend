<?php

include '../includes/config.php';
$array = array();
$data['data'] = array();

$marketid = $_GET['marketid'];
$bid_date = $_GET['betdate'];
$type = $_GET['type'];


if ($type == 'Open') {
    
	$msql ="SELECT betting.betting_number, SUM(betting.betting_amount) AS total_amount
    FROM betting
    LEFT JOIN market ON betting.b_market_id = market.market_id
    LEFT JOIN member ON betting.b_member_id = member.member_id
    WHERE DATE(TRIM(betting.betting_date)) = DATE(trim('$bid_date'))
        AND betting.b_market_id = '$marketid'
        AND (betting.betting_time_type IN ('$type', ''))
        AND betting.betting_status = 'Active'
    GROUP BY betting.betting_number";
    
} elseif($type == 'Close' ) {

	$rsql = "SELECT * FROM winningbetting_detail WHERE market_Id = '$marketid' AND DATE(opening_date) = DATE('$bid_date') ";
	$rqry = mysqli_query($conn, $rsql);
	$rrow = mysqli_fetch_array($rqry);
	$lastnum = $rrow['winning_number_second'];

	$msql = "SELECT * FROM betting bt  LEFT JOIN market mk ON bt.b_market_id = mk.market_id LEFT JOIN member m ON bt.b_member_id = m.member_id WHERE date(trim(betting_date)) = date(trim('$bid_date')) AND b_market_id='$marketid' AND (betting_time_type  IN ('$type', '')) AND  (betting_number='$number' OR betting_number_second='$nsm' OR betting_number='$nsm' OR betting_number_second='$number' OR betting_number = '$lastnum$nsm') AND bt.betting_status = 'Active'";
} else {
    
    $msql ="SELECT betting.betting_number, SUM(betting.betting_amount) AS total_amount
    FROM betting
    LEFT JOIN market ON betting.b_market_id = market.market_id
    LEFT JOIN member ON betting.b_member_id = member.member_id
    WHERE DATE(TRIM(betting.betting_date)) = DATE(trim('$bid_date'))
        AND betting.b_market_id = '$marketid'
        AND (betting.betting_time_type IN ('$type', ''))
        AND betting.betting_status = 'Active'
    GROUP BY betting.betting_number";
}


$mquery = mysqli_query($conn, $msql);

$i = 1;
if (mysqli_num_rows($mquery) > 0) {
        while ($row = mysqli_fetch_assoc($mquery)) { 
           // print_r($row);
           $betting_number = $row['betting_number'] ?? ' ';
           $total_amount = $row['total_amount'] ?? ' ';
           $data['data'][] = array(
            $i,
            $betting_number,
            $total_amount
            );
        $i++; 
        }
	} else {
		// echo $response  =  "<tr><td colspan='7'>No Data found";
		if (empty($data)) {
		$data['data'] = array();
    }
}


echo json_encode($data);



?>
