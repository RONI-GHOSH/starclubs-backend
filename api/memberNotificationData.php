<?php
include '../config.php';
include 'SendNotification.php';
$list = array();
$marketId=$_POST["marketId"];

sleep(5);

sendNotification($marketId);

function sendNotification($marketId)
{
	global $conn,$dateTime;
	
	$sql="";
    $sql = " SELECT * FROM market mar left join winningbetting_detail wd on (wd.market_Id=mar.market_id  AND DATE(wd.opening_date) = DATE('$dateTime')) WHERE mar.market_id='$marketId'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)) 
    {
         if($row1=mysqli_fetch_array($result))
    	  {
    	      	$market_name = $row1["market_name"];
            	$firstNumber = $row1["winning_number_first"];
        		$secondNumber = $row1["winning_number_second"];
        		$thirdNumber =$row1["winning_number_third"];
        		$fourthNumber = $row1["winning_number_fouth"];
        		
                if ($firstNumber !=null) {$firstNumber = $row1["winning_number_first"];}
        		else{$firstNumber ="***";}
        		/** second number get*/
        		if($secondNumber !=null){$secondNumber = $row1["winning_number_second"];}
        		else{$secondNumber ="*";}
        		/** third number get */
        		if($thirdNumber !=null){$thirdNumber =$row1["winning_number_third"];}
        		else{$thirdNumber="*";}
        		/** furth number get */
        		if($fourthNumber !=null){$fourthNumber = $row1["winning_number_fouth"];}
        		else{$fourthNumber ="***";}
               $marketOpenNumber = $firstNumber." - ".$secondNumber."".$thirdNumber." - ".$fourthNumber;
               
               
               $qry="Insert into storeNotification(cotent,title,created_at) Values('$marketOpenNumber','$market_name','$dateTime')";
               $tbl=mysqli_query($conn,$qry);
               
            $qry="Select * from memberNotificaiton mn  Inner join member mem on mem.member_id=mn.member_id where mem.status='Active'";
        	  $tbl=mysqli_query($conn,$qry);
        	  while($row=mysqli_fetch_array($tbl))
        	  {
        		  $token=$row["token"];
        		  $title=$market_name;;
        		  $content="$marketOpenNumber";
                  $msg = ["NotificationType" => "",
                    "content" => $content,
                    "title" => $title,
                    "profile_picture"=>""
                    ];
                   SendMessage($token,$msg);
        	  }
    	  }
    }

}






?>