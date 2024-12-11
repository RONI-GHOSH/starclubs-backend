<?php
include '../config.php';
$sql = "SELECT * FROM game_rate WHERE  ORDER BY id";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$gameRateList = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = ["gameName"=>$row['game_name'],"gameAmount"=>$row['game_amount']];
		array_push($gameRateList, $temp);
	}
	$response = ["status"=>"success","gameRateList"=>$gameRateList];
}
else {
	$response = ["status"=>"failure"];
}
echo json_encode($response);

?>


