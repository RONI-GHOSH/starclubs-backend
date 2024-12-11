<?php 
include '../config.php';
$memberId = $_POST['memberId'];
$passcode = $_POST['passcode'];

$sql = "SELECT * FROM member WHERE member_id = '$memberId'";
$result = mysqli_query($conn,$sql);
if ($row = mysqli_fetch_array($result)) 
{
	$passcode1 = $row['member_passcode'];
	if ($passcode1 != $passcode) 
	{
	    $response = ["status"=>"failure"];
	
	}
	else 
	{
			$response = ["status"=>"success"];
	}
}
	else 
{
			$response = ["status"=>"failure"];

}

echo json_encode($response);


?>