<?php 
include '../config.php';
include 'SendNotification.php';
$message = strip_tags(trim($_POST['message']));
$member_id = $_POST['member_id'];

$response=array();
$messagelist=array();


 $sql = "INSERT INTO chat_room (`sender`, `receiver`, `message`, `msgtype`, `status`, `createdate`) 
VALUES ($member_id,0,'$message','message','0','$dateTime')";
$qry = mysqli_query($conn , $sql);

if (!$qry)
{
	$response = ["status"=>"failure"];	
}
else
{
	$lastid=mysqli_insert_id($conn);
	$sql = "SELECT * FROM chat_room  where id='$lastid'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result))
	{
		while ($row = mysqli_fetch_array($result))
		{
			$id=$row["id"];
			$message=$row["message"];
			$msgtype=$row["msgtype"];
			$createdate=$row["createdate"];
			$sender=$row["sender"];
			$messagetype="";
			if($sender==$memberid)
			{
				if($msgtype=='message')
				{
					$messagetype="1";
				}
				else
				{
				$messagetype="2";	
				}

			}
			else
			{
				if($msgtype=='message')
				{
					$messagetype="3";
				}
				else
				{
				$messagetype="4";	
				}	
			}
		
			
			   $msg=[
				    "NotificationType" => "Message",
                    "title" => "New Message",
                    "profile_picture"=>"",
					"id"=>$id,
					"room_id"=>"",
					"user_id"=>$memberid,
					"user_name"=>'',
					"content"=>$message,
					"timestamp"=>$createdate,
					"type"=>$messagetype
                    ];
			  	array_push($messagelist,$msg);	
			
//		       SendMessage($token,$msg);


		}
	    $response = ["status"=>"success","MessageList"=>$messagelist];
	}
	else
	{
	   $response = ["status"=>"failure","MessageList"=>$messagelist];	
	}
}
echo json_encode($response);
