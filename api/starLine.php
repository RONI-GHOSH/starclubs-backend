<?php

include '../config.php';
 $sql = "SELECT * FROM starlinemarket ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$singleDigite = $row['starLineMarktDigite'];
		$panaNumber = $row['startLineMarketPana'];

		/** first number get */
		if ($singleDigite !=null) {$singleDigite = $row["starLineMarktDigite"];}
		else{$singleDigite ="*";}
		/** first number get */
		if($panaNumber !=null){$panaNumber = $row["startLineMarketPana"];}
		else{$panaNumber ="***";}
		

		$winningNumberStarLine = $singleDigite." - ".$panaNumber;
		$temp = 
		[
			"betting_time"=>$row['betting_time'],
			"winningNumberStarLine"=>$winningNumberStarLine,
			"active_status"=>$row['active_status']
					];
		array_push($list, $temp);
	}
	$response = ["status"=>"success","starLineMarketList"=>$list];

}
else {
	$response = ["status"=>"failure"];
}
echo json_encode($response);

?>