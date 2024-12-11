<?php
include '../config.php';

$member_id = $_POST['memberid'];

 $sql ="SELECT * FROM storeNotification WHERE member_id = '$member_id'";
$result  = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) 
{
	$NotificationList = array();
	while ($row = mysqli_fetch_assoc($result)) 
	{
	$temp = ["content"=>$row['cotent'],"title"=>$row['title'],"profile_picture"=>$row['profile_picture']];
	array_push($NotificationList, $temp);

	}
	$response = ["status"=>"success","Notificationlist"=>$NotificationList];
}
else
{
		$response = ["status"=>"failure"];

}
echo json_encode($response);





?>