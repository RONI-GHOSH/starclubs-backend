<?php

include '../config.php';

$mobileNum = $_POST['mobileNum'];
$password = $_POST['password'];
$current_date_time = $date." ".$time;

 $sql = "UPDATE member SET member_password ='$password',update_date = '$current_date_time' WHERE member_mobile = '$mobileNum'";
$result = mysqli_query($conn,$sql);

if($result)
{

	$response = ["status"=>"success"];

}
else 
{
	$response = ["status"=>"mobilNumDoesNotExist"];
}
echo json_encode($response);










?>