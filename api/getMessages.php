<?php
include '../config.php';
$memberid = $_POST['memberid'];
$response=array();
$messagelist=array();

	 $sql = "SELECT * FROM chat_room  where sender='$memberid' OR receiver='$memberid'";
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
					$message=$base_url.$message;
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
				     $message=$base_url.$message;
				}	
			}

		 $temp=[
			"id"=>$id,
			"room_id"=>"",
			"user_id"=>$memberid,
			"user_name"=>'',
			"content"=>$message,
			"timestamp"=>$createdate,
			"type"=>$messagetype];
			
		array_push($messagelist,$temp);	
	 

		}
		   $response = ["status"=>"success","MessageList"=>$messagelist];
	}
	else
	{
	   $response = ["status"=>"Failure","MessageList"=>$messagelist];  
	}
	
	echo json_encode($response);
	
?>