<?php
include '../config.php';

 $sql = "SELECT title,sub_title,member_status_text FROM game_offers ORDER BY id DESC";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_array($result);
$response = ["status"=>"success","title"=>$row['title'],"sub_title"=>$row['sub_title'],"padding_ac_txt"=>$row['member_status_text']];
	}
	else{
		$response = ["status"=>"failure"];

	}
	echo json_encode($response);

?>