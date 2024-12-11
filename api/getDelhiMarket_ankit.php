
<?php
include '../config.php';
$datec = $date;

$timec =   date('H:i');
$sql = " SELECT * FROM market mar left join winningbetting_detail wd on (wd.market_Id=mar.market_id  AND DATE(wd.opening_date) = DATE('$date')) WHERE active_status !='Removed' AND market_type='delhi'  GROUP BY mar.market_name ORDER BY mar.market_Id asc";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$marketList = array();
	while ($row = mysqli_fetch_assoc($result))
	{
		echo $market_Id= $row["market_Id"];
		echo $firstNumber = $row["winning_number_first"];
		echo $secondNumber = $row["winning_number_second"];
		echo $thirdNumber =$row["winning_number_third"];
		echo $fourthNumber = $row["winning_number_fouth"];
	    echo $closetime =	$row["market_close_time"];
	    $opentime=$row["market_open_time"];
		$market_status = $row["active_status"];
		
		$sql_winningbetting_detail = "SELECT market_Id FROM winningbetting_detail WHERE opening_date='$datec' AND market_Id='$market_Id'";
		$query_winningbetting_detail = mysqli_query($conn, $sql_winningbetting_detail);
		$num_winningbetting_detail = mysqli_num_rows($query_winningbetting_detail);

		/** first number get */
// 		if ($firstNumber !=null) {$firstNumber = $row["winning_number_first"];}
// 		else{$firstNumber ="***";}
		/** second number get*/
		if($secondNumber !=null){$secondNumber = $row["winning_number_second"];}
		else{$secondNumber ="*";}
		/** third number get */
		if($thirdNumber !=null){$thirdNumber =$row["winning_number_third"];}
		else{$thirdNumber="*";}
		/** furth number get */
// 		if($fourthNumber !=null){$fourthNumber = $row["winning_number_fouth"];}
// 		else{$fourthNumber ="***";}

             
             $time = date('H:i');
            //  $newdate = date( $closetime);
		  	 $date_a = new DateTime($closetime);
             $date_b = new DateTime($time);
    
             if($date_b>$date_a)
             {

               $duration=0;  
             }
             else
             {
            //   echo "Datea=". $date_a->format('%h:%i:%s');
            //   echo "Dateb=" .$date_b->format('%h:%i:%s');
              $interval = date_diff($date_a,$date_b);
    // 		  $RemainingTimeHr=getDateDayDifference($time,$timestamp,"%h");
    		  $interval->format('%h:%i:%s');
    		  $hours=$interval->format('%h')*3600;
    		  $minute=$interval->format('%i');
    		  $second=$interval->format('%s');
    		  $duration=$hours+$minute;  
             }
		//$marketOpenNumber = $firstNumber." - ".$secondNumber."".$thirdNumber." - ".$fourthNumber;
		$marketOpenNumber = $secondNumber."".$thirdNumber;
		$delhiNumber = $secondNumber."".$thirdNumber;
	    $activestatus=$row["active_status"];
	      
	    
		if($market_status=="Betting")
		{
			$activestatus = "Betting";
			$msg = "Market Cosed!";
		}
		else{
	        if(strtotime($timec)>=strtotime($opentime) && strtotime($timec)<=strtotime($closetime))
	        {
	           $activestatus="Close" ;
	        }
	        else if (strtotime($opentime) >= strtotime($timec)) {
					$activestatus = "Active";
					$msg="Bet Run Today!";
				}
			else if (strtotime($closetime) < strtotime($timec)) {
				if ($num_winningbetting_detail==0){
					$activestatus = "Betting";
					$msg = "Market Closed!";
				} else if ($num_winningbetting_detail != 0) {
				$activestatus = "Active";
					$msg="Next Day Bet Running!";
			}
			}
		}
					
		
		$temp = [
			"marketId"=>$row["market_id"],
			"marketName"=>$row["market_name"],
			"marketOpenTime"=>$row["market_open_time"],
			"marketCloseTime"=>$row["market_close_time"],
			"marketActiveStatus"=>$activestatus,
			"message"=>$msg,
			"marketTodayOpenNumber"=>$marketOpenNumber,
			"opening_date" =>$date,
			"market_type"=>$row['market_type'],
			"Duration"=>$duration,
			"delhiNumber"=>$delhiNumber
		];
		array_push($marketList, $temp);
	}
	
	$delhirate= '';
	$qry="Select * from game_rate where game_name IN ('Delhi Jodi', 'Single Andar', 'Single Bahar')";
	$result = mysqli_query($conn,$qry);
    if (mysqli_num_rows($result))
    {
        while ($row = mysqli_fetch_assoc($result))
        {
           $delhirate .= ' '.$row["game_name"]." : 10-". $row["game_amount"];
        }
    }
        
	
	$response = ["status" => "success","marketList"=>$marketList,'DelhiRate'=>$delhirate];
}
else
{
	$response = ["status"=>"failure"];
}
echo json_encode($response);


?>