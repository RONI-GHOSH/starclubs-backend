<?php
include '../config.php';
$timec =   date('H:i');
$timea =   trim(date('h:i a'));

$currentday = date('l');
 
$sql="";
if(date(date('H:i',strtotime('$timea'))>date('H:i',strtotime('08:00 am'))))
{
       $sql = " SELECT * FROM market mar left join winningbetting_detail wd on (wd.market_Id=mar.market_id  AND DATE(wd.opening_date) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)) WHERE active_status !='Removed'  AND market_type='Mumbai'  GROUP BY mar.market_name ORDER BY TIME(STR_TO_DATE(market_open_time, '%l:%i %p' ))";
}
else
{
      $sql = "SELECT * FROM market mar left join winningbetting_detail wd on (wd.market_Id=mar.market_id  AND DATE(wd.opening_date) = DATE('$date')) LEFT JOIN market_timemanagement mt ON mar.market_id = mt.market_Id WHERE mar.active_status !='Removed' AND mar.market_type='Mumbai' AND mt.dayname = '$currentday' GROUP BY mar.market_name ORDER BY TIME(STR_TO_DATE(market_open_time, '%l:%i %p' ))";
}
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$marketList = array();
	while ($row = mysqli_fetch_assoc($result))
	{
		$firstNumber = $row["winning_number_first"];
		$secondNumber = $row["winning_number_second"];
		$thirdNumber =$row["winning_number_third"];
		$fourthNumber = $row["winning_number_fouth"];
	    $opentime= $row["market_opentime"];
	    $closetime = $row["market_closetime"];
	    

		/** first number get */
		if ($firstNumber !=null) {$firstNumber = $row["winning_number_first"];}
		else{$firstNumber ="***";}
		/** second number get*/
		if($secondNumber !=null){$secondNumber = $row["winning_number_second"];}
		else{$secondNumber ="*";}
		/** third number get */
		if($thirdNumber !=null){$thirdNumber =$row["winning_number_third"];}
		else{$thirdNumber="*";}
		/** furth number get */
		if($fourthNumber !=null){$fourthNumber = $row["winning_number_fouth"];}
		else{$fourthNumber ="***";}

             
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
		$marketOpenNumber = $firstNumber." - ".$secondNumber."".$thirdNumber." - ".$fourthNumber;
		$delhiNumber = $secondNumber."".$thirdNumber;
	    $activestatus=$row["active_status"];
	    
	    $market_status = $row["market_status"];
	      
	      
	   if($activestatus=='Active')
	   {
	       if ($market_status == "Active") {

    	        if(strtotime($timec)>=strtotime($opentime) && strtotime($timec)<=strtotime($closetime))
    	        {
    	           	$activestatus="Active";
					$msg = "Close Time Bet Run!";
    	        }
    	        else if(strtotime($opentime)>=strtotime($timec) )
    	        {
    	           $activestatus="Active";
					$msg = "Bet Run Today!";
    	        }
    	        else if(strtotime($closetime)<strtotime($timec))
    	        {
    	           $activestatus="Betting" ;
					$msg = "Market Cosed!";
    	        }
    	   }else {
    	       $activestatus="Betting";
				$msg = "Market Cosed!";
    	   }
	       
	   }
	   else
	   {
	     $activestatus="Betting";
	   }
	        
	     
	   
		
		
		$temp = [
			"marketId"=>$row["market_id"],
			"marketName"=>$row["market_name"],
			"marketOpenTime"=>$row["market_opentime"],
			"marketCloseTime"=>$row["market_closetime"],
			"marketActiveStatus"=>$activestatus,
			"message" => $msg,
			"marketTodayOpenNumber"=>$marketOpenNumber,
			"market_type"=>$row['market_type'],
			"Duration"=>$duration,
			"delhiNumber"=>$delhiNumber
		];
		array_push($marketList, $temp);
	}
	$response = ["status"=>"success","marketList"=>$marketList];
}
else
{
	$response = ["status"=>"failure"];
}
echo json_encode($response);


?>