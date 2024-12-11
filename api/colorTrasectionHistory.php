<?php
include '../config.php';

$member_id = $_POST['member_id'];

$sql = "SELECT * FROM colormarketbat str inner join game gam on str.game_id=gam.game_id WHERE str.member_id = '$member_id' AND str.active_status='Active' order by str.id desc";

$result = mysqli_query($conn,$sql);
if($result){
	$list = array();
	while($row = mysqli_fetch_assoc($result)){
	            $transaction_id ="";
				$member_id= $row['member_id'];
				$betting_time = "Betting Time  : " . $row['betting_time'];
				$game_name = "Game Name:" . $row['statLineBatTime'] . "(" . $row['game_name'] . ")";
				$statLineBatTime = "Game Time  : " . $row['statLineBatTime'];
				$bet_amount ="Bet Amount  : " .$row['bet_amount'];           
	            $bat_number =$row['bet_num'];
	            $bat_date = "Bet Date :".$row['betting_date'] ." ". $row['betting_time'];

		$temp = [
			"transaction_id"=>$transaction_id,
			"member_id"=> $member_id,
			"betting_time" => $betting_time,
			"game_name" => $game_name,
			"statLineBatTime" => $statLineBatTime,
			"bet_amount"=> $bet_amount,
			"bat_number"=> $bat_number,
			"bat_date" => $bat_date
			];
		array_push($list,$temp);
	}
	$response = ["status"=>"success","starLineTransectionHistory"=>$list];
}
else {
	$response = ["status"=>"Failure"];
}
echo json_encode($response);


?>