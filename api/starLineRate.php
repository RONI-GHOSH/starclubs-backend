<?php
include '../config.php';

 $sql = "SELECT * FROM starLineRate";

$result = mysqli_query($conn,$sql);
if($result){
	$list = array();
	while($row = mysqli_fetch_assoc($result)){
		$gameName = $row['gameName'];
		$gameRate = "10 - " .$row['gameRate'];

		$temp = ["gameName"=>$gameName,
				"gameRate"=>$gameRate];
		array_push($list,$temp);
	}
	$response = ["status"=>"success","starLineRateList"=>$list];
}
else {
	$response = ["status"=>"Failure"];
}
echo json_encode($response);


?>