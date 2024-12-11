<?php
include '../config.php';

$sql = "SELECT * FROM game";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
	$list = array();
	while ($rows = mysqli_fetch_assoc($result)) {
		$temp = ["game_name"=>$rows['game_name'],
				"game_id"=>$rows['game_id'],
				"game_icon"=>$rows['game_icon']
					];
					array_push($list,$temp);
	}
$response = ["status"=>"success","gameList"=>$list];	
}
else {
	$response = ["status"=>"failure"];
}
echo json_encode($response);
?>