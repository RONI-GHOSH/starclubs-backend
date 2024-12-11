<?php

include '../config.php';
date_default_timezone_set('Asia/Kolkata');
$date = $date;

$timec = date('H:i');
 $sql = "SELECT * FROM starlinemarketlist WHERE active_status ='Active' ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) 
{
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) 
	{
	    
	     $market_id = $row['id'];
	      $market_time = $row['market_time'];
	      $market_name = $row['star_name'];
	    $digit1 = "*";
	    $pana1 = "***";
	     $sql = "SELECT * FROM starlinemarket where Date(betting_time)=Date('$date')";
        $result1 = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result1)) 
        {
           while ($row1 = mysqli_fetch_assoc($result1)) 
	       {
	          
               if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("10:00")))
        	    {
                      $digit1=empty($row1["A"])?"*":$row1["A"];
                      $pana1=empty($row1["A"])?"***":array_sum(str_split($row1["A"]));
                       IF(strlen($pana1)>1)
                       {
                         $pana1=  substr($pana1, -1);
                       }
                }
                
        	   else  if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("11:00")))
        	    {
                      $digit1=empty($row1["B"])?"*":$row1["B"];
                      $pana1=empty($row1["B"])?"***":array_sum(str_split($row1["B"]));
                       IF(strlen($pana1)>1)
                       {
                         $pana1=  substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("12:00")))
                {
                      $digit1=empty($row1["C"])?"*":$row1["C"];
                      $pana1=empty($row1["C"])?"***":array_sum(str_split($row1["C"]));
                       IF(strlen($pana1)>1)
                       {
                          $pana1= substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("13:00")))
                {
                      $digit1=empty($row1["D"])?"*":$row1["D"];
                      $pana1=empty($row1["D"])?"***":array_sum(str_split($row1["D"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=  substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("14:00")))
                {
                    $digit1=empty($row1["E"])?"*":$row1["E"];
                    $pana1=empty($row1["E"])?"***":array_sum(str_split($row1["E"]));
                    IF(strlen($pana1)>1)
                       {
                          $pana1= substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("15:00")))
                {
                    $digit1=empty($row1["F"])?"*":$row1["F"];
                    $pana1=empty($row1["F"])?"***":array_sum(str_split($row1["F"]));
                    IF(strlen($pana1)>1)
                       {
                         $pana1=  substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("16:00")))
                {
                    $digit1=empty($row1["G"])?"*":$row1["G"];
                    $pana1=empty($row1["G"])?"***":array_sum(str_split($row1["G"]));
                       IF(strlen($pana1)>1)
                       {
                         $pana1=  substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("17:00")))
                {
                    $digit1=empty($row1["H"])?"*":$row1["H"];
                    $pana1=empty($row1["H"])?"***":array_sum(str_split($row1["H"]));
                    IF(strlen($pana1)>1)
                       {
                         $pana1=  substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("18:00")))
                {
                    $digit1=empty($row1["I"])?"*":$row1["I"];
                    $pana1=empty($row1["I"])?"***":array_sum(str_split($row1["I"]));
                    IF(strlen($pana1)>1)
                       {
                          $pana1=   substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("19:00")))
                {
                    $digit1=empty($row1["J"])?"*":$row1["J"];
                    $pana1=empty($row1["J"])?"***":array_sum(str_split($row1["J"]));
                       IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("20:00")))
                {
                    $digit1=empty($row1["K"])?"*":$row1["K"];
                    $pana1=empty($row1["K"])?"***":array_sum(str_split($row1["K"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("21:00")))
                {
                    $digit1=empty($row1["L"])?"*":$row1["L"];
                    $pana1=empty($row1["L"])?"***":array_sum(str_split($row1["L"]));
                     IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("22:00")))
                {
                    $digit1=empty($row1["M"])?"*":$row1["M"];
                    $pana1=empty($row1["M"])?"***":array_sum(str_split($row1["M"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                } 
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("23:00")))
                {
                    $digit1=empty($row1["N"])?"*":$row1["N"];
                    $pana1=empty($row1["N"])?"***":array_sum(str_split($row1["N"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("24:00")))
                {
                    $digit1=empty($row1["O"])?"*":$row1["O"];
                    $pana1=empty($row1["O"])?"***":array_sum(str_split($row1["O"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("1:00")))
                {
                  $digit1=empty($row1["P"])?"*":$row1["P"];
                    $pana1=empty($row1["P"])?"***":array_sum(str_split($row1["P"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                    
                    
    
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("2:00")))
                {
                    
                                    $digit1=empty($row1["Q"])?"*":$row1["Q"];
                    $pana1=empty($row1["Q"])?"***":array_sum(str_split($row1["Q"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }

                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("3:00")))
                {
                                        
                    $digit1=empty($row1["R"])?"*":$row1["R"];
                    $pana1=empty($row1["R"])?"***":array_sum(str_split($row1["R"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                    
                    

                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("4:00")))
                {
                    $digit1=empty($row1["S"])?"*":$row1["S"];
                    $pana1=empty($row1["S"])?"***":array_sum(str_split($row1["S"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                    
                    

                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("5:00")))
                {
                    

                    $digit1=empty($row1["T"])?"*":$row1["T"];
                    $pana1=empty($row1["T"])?"***":array_sum(str_split($row1["T"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }   
 
                       
                       
                       
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("6:00")))
                {
                    
                    $digit1=empty($row1["U"])?"*":$row1["U"];
                    $pana1=empty($row1["U"])?"***":array_sum(str_split($row1["U"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                    
                    

                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("7:00")))
                {
                    
                   $digit1=empty($row1["V"])?"*":$row1["V"];
                    $pana1=empty($row1["V"])?"***":array_sum(str_split($row1["V"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }
                    
                    

                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("8:00")))
                {
                    

                                     
                                        $digit1=empty($row1["W"])?"*":$row1["W"];
                    $pana1=empty($row1["W"])?"***":array_sum(str_split($row1["W"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }   
                    

                       
                       
                       
                       
                }
                else if (date('h:i a',strtotime($market_time))==date('h:i a',strtotime("9:00")))
                {

                                                         $digit1=empty($row1["X"])?"*":$row1["X"];
                    $pana1=empty($row1["X"])?"***":array_sum(str_split($row1["X"]));
                      IF(strlen($pana1)>1)
                       {
                         $pana1=    substr($pana1, -1);
                       }   
                       
                    
                }
	       }    
        }
	    
	   $markettime= $row['market_time'];
	   $activestatus= $row['active_status'];
	   if(strtotime($timec)<=strtotime($markettime))
	   {
	     $activestatus="Active";  
	   }
	   else
	   {
	       $activestatus="close";
	   }

	    

            $d_t = $row['market_time']; 
            $d_time  = date('h:i a', strtotime($d_t));

		$winningNumberStarLine = $digit1."_".$pana1;
		$temp = 
		[
		    "market_id" => $market_id,
			"market_time"=>$d_time,
			"market_date"=>$date,
			"market_name"=>$market_name,
			"winningNumberStarLine"=>$winningNumberStarLine,
			"active_status"=>$activestatus
					];
		array_push($list, $temp);
	}
	$response = ["status"=>"success","starLineMarketList"=>$list];

}
else {
	$response = ["status"=>"failure"];
}
echo json_encode($response);

?>