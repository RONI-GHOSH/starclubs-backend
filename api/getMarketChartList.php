<?php
include '../config.php';
$marketid=$_POST["market_id"];
$count=0;
$firstweelList = array();
$secondweekList = array();
$thirdweekList = array();
$fouthList = array();

$marketList = array();
   $sql = "SELECT * FROM   winningbetting_detail WHERE  Date(opening_date) <= NOW()  AND  market_Id='$marketid'";
$result = mysqli_query($conn,$sql);
$maxrows=mysqli_num_rows($result);
if (mysqli_num_rows($result)) {

while($row =mysqli_fetch_array($result))
{
      $openingdate=$row["opening_date"];
      $unixTimestamp = strtotime($openingdate);
      $dayOfWeek=date('D', $unixTimestamp);
      $date=date('d M y', $unixTimestamp);
      $date= "$dayOfWeek($date)";
      if($count==0)
      {
        $fifthList = array();  
      }
      
     $jodivalue=$row["winning_number_second"].$row["winning_number_third"];
     $temp =
     [
            "panelfirst"=>$row["winning_number_first"],
            "panelsecond"=>$jodivalue,
            "panelthird"=>$row["winning_number_fouth"],
            "Date"=>$date
         ]; 
                
        $count++;
    array_push($fifthList,$temp);  

        
        if($maxrows>7)
        {
            if($count==7)
            {
                       array_push($marketList,$fifthList);
                       $count=0;
                $maxrows= $maxrows-7;
            }
        }
        else
        {
            if($count==$maxrows)
                   array_push($marketList,$fifthList);   
        }
}
        $response = ["status"=>"success","MarketChartList"=>$marketList];
}
else
{
        $response = ["status"=>"failure"];
}
echo json_encode($response);


?>