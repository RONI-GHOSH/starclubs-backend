<?php
    include '../config.php';
    $count=0;
    $StarLineChartList = array();
    $ChartList = array();
    $chartDateList = array();
    $isFirst=true;
    $sql = "SELECT * from colormarket WHERE  (betting_time between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)) {
        
    
    while($row =mysqli_fetch_array($result))
    {
    
        $digit1=empty($row["A"])?"*":$row["A"];
        $pana1=empty($row["A"])?"***":array_sum(str_split($row["A"]));
        $digit2=empty($row["B"])?"*":$row["B"];
        $pana2=empty($row["B"])?"***":array_sum(str_split($row["B"]));
        $digit3=empty($row["C"])?"*":$row["C"];
        $pana3=empty($row["C"])?"***":array_sum(str_split($row["C"]));
        $digit4=empty($row["D"])?"*":$row["D"];
        $pana4=empty($row["D"])?"***":array_sum(str_split($row["D"]));
        $digit5=empty($row["E"])?"*":$row["E"];
        $pana5=empty($row["E"])?"***":array_sum(str_split($row["E"]));
        $digit6=empty($row["F"])?"*":$row["F"];
        $pana6=empty($row["F"])?"***":array_sum(str_split($row["F"]));
        $digit7=empty($row["G"])?"*":$row["G"];
        $pana7=empty($row["G"])?"***":array_sum(str_split($row["G"]));
        $digit8=empty($row["H"])?"*":$row["H"];
        $pana8=empty($row["H"])?"***":array_sum(str_split($row["H"]));
        $digit9=empty($row["I"])?"*":$row["I"];
        $pana9=empty($row["I"])?"***":array_sum(str_split($row["I"]));
        $digit10=empty($row["J"])?"*":$row["J"];
        $pana10=empty($row["J"])?"***":array_sum(str_split($row["J"]));
        $digit11=empty($row["K"])?"*":$row["K"];
        $pana11=empty($row["K"])?"***":array_sum(str_split($row["K"]));
        $digit12=empty($row["L"])?"*":$row["L"];
        $pana12=empty($row["L"])?"***":array_sum(str_split($row["L"]));
        $digit13=empty($row["M"])?"*":$row["M"];
        $pana13=empty($row["M"])?"***":array_sum(str_split($row["M"]));
        $digit14=empty($row["N"])?"*":$row["N"];
        $pana14=empty($row["N"])?"***":array_sum(str_split($row["N"]));
       /* $digit15=empty($row["O"])?"*":$row["O"];
        $pana15=empty($row["O"])?"***":array_sum(str_split($row["O"]));*/
     
         $bettime=date("d-m-y", strtotime($row["betting_time"]));
   

            
     
            
        $date_chart_list = array(
                'digit1'=>"10:00 AM",
                'pana1'=>"",
                'digit2'=>"11:00 AM",
                'pana2'=>"",
                'digit3'=>"12:00 AM",
                'pana3'=>"",
                'digit4'=>"1:00 PM",
                'pana4'=>"",
                'digit5'=>"2:00 PM",
                'pana5'=>"",
                'digit6'=>"3:00 PM",
                'pana6'=>"",
                'digit7'=>"4:00 PM",
                'pana7'=>"",
                'digit8'=>"5:00 PM",
                'pana8'=>"",
                'digit9'=>"6:00 PM",
                'pana9'=>"",
                'digit10'=>"7:00 PM",
                'pana10'=>"",
                'digit11'=>"8:00 PM",
                'pana11'=>"",
                'digit12'=>"9:00 PM",
                'pana12'=>"",
                'digit13'=>"10:00 PM",
                'pana13'=>"",
                'digit14'=>"11:00 PM",
                'pana14'=>"",
                 "BatDate"=>"Date"
            );

            if($isFirst)
            {
                  array_push($chartDateList,$date_chart_list); 
                  $isFirst=false;
                  
            }

               $date_chart_list = array(
                'digit1'=>$digit1,
                'pana1'=>$pana1,
                'digit2'=>$digit2,
                'pana2'=>$pana2,
                'digit3'=>$digit3,
                'pana3'=>$pana3,
                'digit4'=>$digit4,
                'pana4'=>$pana4,
                'digit5'=>$digit5,
                'pana5'=>$pana5,
                'digit6'=>$digit6,
                'pana6'=>$pana6,
                'digit7'=>$digit7,
                'pana7'=>$pana7,
                'digit8'=>$digit8,
                'pana8'=>$pana8,
                'digit9'=>$digit9,
                'pana9'=>$pana9,
                'digit10'=>$digit10,
                'pana10'=>$pana10,
                'digit11'=>$digit11,
                'pana11'=>$pana11,
                'digit12'=>$digit12,
                'pana12'=>$pana12,
                'digit13'=>$digit13,
                'pana13'=>$pana13,
                'digit14'=>$digit14,
                'pana14'=>$pana14,
                "BatDate"=>$bettime
            );
       array_push($chartDateList,$date_chart_list);
        
    }
    	$response = ["status"=>"success","star_line_winning_date"=>$chartDateList];
    }
    else
    {
    	$response = ["status"=>"failure"];
    }
    echo json_encode($response);
    
    
    ?>