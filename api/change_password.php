<?php
include '../config.php';

$member_id = $_POST['member_id'];
$member_password_old = $_POST['member_password_old'];
$new_password = $_POST['new_password'];

$sql = "SELECT * FROM member WHERE member_id='$member_id'";
$result = mysqli_query($conn, $sql);
if ($mrow = mysqli_fetch_array($result)) {
	$mpassword = $mrow['member_password'];
}

if($member_password_old == $mpassword){
	if($member_password_old == $new_password){
	$response = ["status"=>"Please Choose New Password"];
	}
	
	else{
		$sql2 = "UPDATE member SET member_password = $new_password WHERE member_id=$member_id";
	$result2 = mysqli_query($conn,$sql2);
	if ($result) {
		$response = ["status"=>"success"];
	}
	else{
		$response = ["status"=>"failure"];
	}
	}
}
else{
	$response = ["status"=>"Old password is wrong"];
}
echo json_encode($response);

?>