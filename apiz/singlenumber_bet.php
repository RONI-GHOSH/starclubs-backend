<?php
include '../includes/config.php';

	$game_id = $_REQUEST['game_id'];
	$market_open = $_REQUEST['market_open'];
	
	$response = array();
	$temp = array();
	$betlist = array();
	
	if($game_id == 'All'){
	    $sql = "SELECT betting_amount , betting_number , COUNT(betting_number) AS betnum FROM betting WHERE betting_time_type = '$market_open' AND date(betting_date) = date('$date') AND b_game_cid ='1' GROUP BY betting_number ";
	}else{
	    $sql = "SELECT betting_amount , betting_number , COUNT(betting_number) AS betnum FROM betting WHERE b_market_id = '$game_id' AND betting_time_type = '$market_open' AND date(betting_date) = date('$date') AND b_game_cid ='1' GROUP BY betting_number ";
	}
	
    

	$qry = mysqli_query($conn,$sql);
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) {
	     	while ($row = mysqli_fetch_assoc($qry)) {
				$betamt = $row['betting_amount'];
				$digit = $row['betting_number'];
				$betnum = $row['betnum'];
				$temp=['count'=> $i , 'amount'=>$betamt , 'number'=>$digit , 'betnum'=> $betnum ];
				array_push($betlist, $temp);
				// print_r($betlist);
				$i++;
			}
        $response=['list'=>$betlist];
		}else {
		   if (empty($betlist)) {
				$response=['list'=>"No Bet"];
			}
		}
echo json_encode($response);
?>