<?php
include '../includes/config.php';

	$id = $_POST['member_id'];
	$stat = $_POST['atr'];	
	
    $sql = "UPDATE member SET status='$stat' WHERE member_id = '$id'";
	$qry = mysqli_query($conn,$sql);
	if (!$qry) {
		$response  =  "Fail to Update Member Status";
	}else {
		$response  =  "Success to Update Member Status";
	}
	
echo $response;

?>