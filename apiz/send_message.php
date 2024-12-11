<?php 
include '../includes/config.php';
include '../api/SendNotification.php';

$message = strip_tags(trim($_POST['message']));
$getmember_id = $_POST['getmember_id'];
$sender = 0;
$status = 1;

$sql = "INSERT INTO chat_room (`sender`, `receiver`, `message`, `msgtype`, `status`, `createdate`) VALUES ('$sender','$getmember_id ','$message','message','$status','$dateTime')";
$qry = mysqli_query($conn , $sql);

if (!$qry) {
	$response = "Fail";
}else{
    
    $lastid=mysqli_insert_id($conn);

    $qry="Select * from chat_room cr inner join memberNotificaiton mem on cr.receiver=mem.member_id where cr.id='$lastid'";
    $tbl=mysqli_query($conn,$qry);
    if($row=mysqli_fetch_array($tbl))
    {
      
        $memberid=$row["receiver"];;
        $message=$row["message"];;
        $id=$row["id"];;
        $createdate=$row["createdate"];;
        $token=$row["token"];;
     
        

  $msg=[
		"NotificationType" => "Message",
                    "title" => "New Message",
                    "profile_picture"=>"",
					"id"=>"$id",
					"room_id"=>"",
					"user_id"=>"$memberid",
					"username"=>"",
					"content"=>"$message",
					"timestamp"=>"$createdate",
					"type"=>"3"
                    ];


SendMessage($token,$msg);   
    }
    
    
    
    
	$response = "Send";
}

echo $response;

?>