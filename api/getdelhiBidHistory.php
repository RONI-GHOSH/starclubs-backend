<?php
include '../config.php';
$member_id = $_POST['member_id'];
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];

$sql = "SELECT *  FROM betting bet INNER JOIN market mar  ON bet.b_market_id = mar.market_id  left JOIN game gam  ON bet.b_game_cid = gam.game_id INNER JOIN member mem  ON bet.b_member_id = mem .member_id  WHERE bet.betting_date BETWEEN Date('$date_from') AND Date('$date_to') AND bet.b_member_id ='$member_id' AND mar.market_type='delhi' AND bet.betting_status = 'Active'  ORDER BY bet.betting_id DESC";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($rows = mysqli_fetch_assoc($result))
	{
	 
	    $sendermemberId=$rows['member_id'];
	    $sendername=$rows['member_name'];
        $marketname= $rows['market_name'];
	    $game_name= $rows['game_name'];
	    $b_game_cid= $rows['b_game_cid'];
	    $b_game_id= $rows['b_game_id'];
	    
	     $bet_type = $rows['betting_time_type'];
	    $bat_number="";
	    $transaction_title="";
	    $receivername="";
	    if($b_game_cid=="0")
	    {
	        $qry="Select * from market_game where market_game_id='$b_game_id'";
	        $result1 = mysqli_query($conn,$qry);
	        $rows1 = mysqli_fetch_assoc($result1);
	        $game_name= $rows1["game_name"];
	    }
	    
	    



	      $transaction_title="$marketname ($game_name)";  
	       $transaction_title="$marketname ($game_name) $bet_type";  
	       $bat_number="Bat Number ".$rows['betting_number'];
	      $newtransaction_type="Sub";
	    

	    
	$temp = ["transaction_title"=>$transaction_title,
		     "SenderName"=>$rows['member_name'],
		     "ReciverName"=>$receivername,
			"transaction_id"=>"",
			"transaction_amount"=>$rows['betting_amount'],
			"transaction_update_date"=>$rows['betting_date']." ".$rows['betting_time'],
			"transaction_type"=>$newtransaction_type,
			"market_name"=>$rows['market_name'],
			"bat_number"=>$bat_number,
			"game_name"=>$rows['game_name'],
			"bet_type" =>$rows['betting_time_type']

		];
		array_push($list, $temp);
	}
		$response = ["status"=>"success","TransectionHistoryList"=>$list];
	}
	else
	{
		$response = ["status"=>"failure"];
	}
	echo json_encode($response);


?>