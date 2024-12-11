<?php

include '../config.php';
include 'SendNotification.php';

sleep(5);

    $member_id = $_POST["member_id"];
    
      $qry="Select * from memberNotificaiton where member_id='$member_id'";
        $tbl=mysqli_query($conn,$qry);
        if($row=mysqli_fetch_array($tbl))
        {
        $content = $_POST["content"];
        $title = $_POST["title"];
        $profile_picture = $_POST["profile_picture"];

        $msg = ["NotificationType" => "MilanGames",
            "content" => $content,
            "title" => $title,
            "profile_picture" =>$profile_picture];
                
                 $token=$row["token"];        
                 SendMessage($token,$msg);

        $sql = "INSERT INTO storeNotification (member_id,cotent,title,profile_picture) VALUES ('$member_id','$content','$title','$profile_picture')";
        if (mysqli_query($conn,$sql)) 
        {
        	$response = ["status"=>"success"];
        }
        else
    	{
    	
    	}      
         $response = ["status"=>"success"];
        }
        else
        {
             $response = ["status"=>"failure2"];
        }
   

?>
