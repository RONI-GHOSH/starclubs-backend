<?php
include '../config.php';
include 'SendNotification.php';
$list = array();
sendNotification();

$time=date('d m Y h:i a');

function sendNotification()
{
	global $conn,$dateTime;
    $qry="Select * from wallet_transaction wt inner join memberNotificaiton mem on wt.member_id=mem.member_id where Date(wt.transaction_update_date)=Date('$dateTime') AND wt.transaction_type='WinningBat' AND wt.notification_status='Pending' ";
	  $tbl=mysqli_query($conn,$qry);
	  while($row=mysqli_fetch_array($tbl))
	  {
		  $token=$row["token"];
		  $member_id=$row["member_id"];
		  $w_transaction_id=$row["w_transaction_id"];
		  $transaction_amount=$row["transaction_amount"];
		  $game_name=$row["game_name"];
		  $title="Congratulation";;
		  $content="You have won $transaction_amount";
		  
		    echo $qry="INSERT INTO `storeNotification`( `member_id`, `cotent`, `title`, `created_at`) VALUES ('$member_id','$content','$title','$dateTime')";
		    mysqli_query($conn,$qry);
		 echo $qry="Update wallet_transaction set notification_status='Active' where w_transaction_id='$w_transaction_id'";
          mysqli_query($conn,$qry);
          $msg = ["NotificationType" => "",
            "content" => $content,
            "title" => $title,
            "profile_picture"=>""
            ];
          echo SendMessage($token,$msg);
	  }

}






?>