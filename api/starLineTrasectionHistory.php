<?php
include '../config.php';

$member_id = $_POST['member_id'];

$sql = "SELECT * FROM starlinemarketbat str inner join game gam on str.game_id=gam.game_id WHERE str.member_id = '$member_id' AND str.active_status='Active' order by str.id desc";

$result = mysqli_query($conn,$sql);
if($result){
	$list = array();
	while($row = mysqli_fetch_assoc($result)){
	            $transaction_id ="";
	            $bidAmount ="BidAmount  : " .$row['bet_amount'];
	            $game_name ="Game Name:". $row['statLineBatTime'] ."(".$row['game_name'].")";
	            $bat_number ="Bat Number  : " .$row['bet_num'];
	           // $bat_date = "Bet Date :" . date( 'd-m-Y' , strtotime($row['transaction_update_date']));
	             $bat_date = "Bet Date :".$row['betting_date'] ." ". $row['betting_time'];

		$temp = ["transaction_id"=>$transaction_id,
				"transaction_amount"=>$bidAmount,
				"member_id"=>$row['member_id'],
				"game_name"=>$game_name,
				"bat_number"=>$bat_number,
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