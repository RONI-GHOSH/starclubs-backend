<?php

include '../config.php';

date_default_timezone_set('Asia/Kolkata');
$time=date("H:i");
$timec =   date('H:i');
// $sql = "SELECT * FROM routtetGame ORDER BY id ASC";
 $sql = "SELECT * FROM routtetgame WHERE Time(gameCloseTime)>Now()";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) 
{
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $openTime = $row['gameOpenTime'];
        $closeTime = $row['gameCloseTime'];
        $openTimeFull = date('h:i', strtotime($openTime));
        $closeTimeFull = date('H:i', strtotime($closeTime));
        $closeTimeFull = date('H:i', strtotime($closeTime));
        $gameid = $row['id'];
        // date('h:i', strtotime($closeTime));


             $time = date('H:i');
            //  $newdate = date( $closetime);
             $date_a = new DateTime($closeTimeFull);
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
    //        $RemainingTimeHr=getDateDayDifference($time,$timestamp,"%h");
              $interval->format('%h:%i:%s');
              $hours=$interval->format('%h')*3600;
              $minute=$interval->format('%i');
              $second=$interval->format('%s');
              $duration=$hours+$minute;  
             }
	   $activestatus= $row['gameActiveStatus'];
	   
	   if(strtotime($timec)<=strtotime($closeTime) )
	   {
	     $activestatus="Active";  
	   }
	   else
	   {
	       $activestatus="close";
	   }
             
             
        $temp = 
        ["gameOpenTime"=>$openTime,
        "gameCloseTime"=>$closeTime,
        "gameActiveStatus"=>$activestatus,
        "gameid"=>$gameid,
        "Duration"=>$duration];

        array_push($list, $temp);
    }

// $starttime = "13:00";
// for($i=0;$i<48;$i++)
// {

// $endTime = strtotime("+15 minutes", strtotime($starttime));
// $endTime = date("H:i",$endTime);
//    $qry="Insert into routtetgame(gameOpenTime,gameCloseTime,gameActiveStatus) VALUES('$starttime','$endTime','active')";
//   $result = mysqli_query($conn,$qry);

// if ($result) {
//      $response = ["status"=>"success"];
//  $starttime  =$endTime;
// }
// else 
// {
//  $response = ["status"=>"failure"];
// }
// }
    $response = ["status"=>"success","routtetGameList"=>$list];
}


else
{
    $response = ["status"=>"failure"];
}
echo json_encode($response);

// }


?>