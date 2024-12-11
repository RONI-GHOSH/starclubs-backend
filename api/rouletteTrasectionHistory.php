<?php
include '../config.php';

$member_id = $_POST['member_id'];

 $sql = "SELECT * FROM roulettetransectionhistroy WHERE member_id = '$member_id'";

$result = mysqli_query($conn,$sql);
if($result){
	$list = array();
	while($row = mysqli_fetch_assoc($result)){
	    $transaction_id = "TransctionId  " .$row['transaction_id'];
	    $member_id ="memberId" . $row['member_id'];
	    $transaction_amount ="BatAmount   " . $row['transaction_amount'];
	    $game_name =$row['game_name'];
	    $bat_number ="BatNumber   " . $row['bat_number'];
	    $roulette_open_time ="openTime  " . $row['roulette_open_time'];
	    $roulette_close_time ="CloseTime  ". $row['roulette_close_time'];
        // $rouletteDate = "Rulette Date :" . date( 'd-m-Y' , strtotime($row['transaction_update_date']));
        $rouletteDate = "Roulette Date :" .  $row['transaction_update_date'];
		$temp = [
		    "transaction_id"=>$transaction_id,
				"transaction_amount"=>$transaction_amount,
				"member_id"=>$member_id,
				"game_name"=>$game_name,
				"bat_number"=>$bat_number,
				"roulette_open_time"=>$roulette_open_time,
				"roulette_close_time"=>$roulette_close_time,
				"roulette_betting_date"=>$rouletteDate];
		array_push($list,$temp);
	}
	$response = ["status"=>"success","rouletteTransectionHistory"=>$list];
}
else {
	$response = ["status"=>"Failure"];
}
echo json_encode($response);


?>