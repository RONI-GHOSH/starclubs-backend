<?php
include '../config.php';

$mobileNum = $_POST["mobileNum"];
$password = $_POST["password"];

 $sql = "SELECT * FROM member WHERE member_mobile = '$mobileNum' AND member_password = '$password'";
 $result = mysqli_query($conn,$sql);
if ($row = mysqli_fetch_array($result))
{
	$registerId = $row['member_id'];
	$sql2 = "SELECT * FROM member WHERE member_id = '$registerId'";
	$result2 = mysqli_query($conn,$sql2);
	if ($row1 = mysqli_fetch_array($result2)) {
		$name = $row1['member_name'];
		$mobile = $row1['member_mobile'];
		$member_id = $row1['member_id'];
		$response = ["status"=>"success","name"=>$name,"mobile"=>$mobile,"member_id"=>$member_id];
	}
}
else
{
	$response = ["status"=>"failure"];

}
echo json_encode($response);


?>