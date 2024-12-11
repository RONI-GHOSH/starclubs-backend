<?php
include '../includes/config.php';

	$mkid = $_POST['mkid'];
	$datee = $_POST['datee'];
	$type = $_POST['type'];
	$null = null;
	
	if($type == "Open"){
	    $sql = "UPDATE winningbetting_detail SET winning_number_first='$null' , winning_number_second='$null' WHERE market_id ='$mkid' AND opening_date = '$datee' ";
	}elseif($type == "Close"){
	    $sql = "UPDATE winningbetting_detail SET winning_number_third='$null' , winning_number_fouth='$null' WHERE market_id ='$mkid' AND opening_date = '$datee' ";
	}
	$qry = mysqli_query($conn,$sql);
	if (!$qry) {
		$response  =  "Fail to Update Market Status";
	}else {
		$response  =  "Success to Update Market Status";
	}
	
echo $response;

?>