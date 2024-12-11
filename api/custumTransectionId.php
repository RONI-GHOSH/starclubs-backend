<?php 
    date_default_timezone_set('Asia/Kolkata');
    $memberId = $_POST['member_id'];
    
    $additionalString = "ADD";
    $trsString = "TRS";
    
    $year = date("y");
    $month = date("m");
    $date = date("d");
    $hour = date("h");
    $minute = date("i");
    $seconds = date("s");
    
    $finalTransectionId = $trsString.$memberId.$additionalString.$date.$month.$year.$hour.$minute.$seconds;
    // $response = ["status"=>"success","transection_id"=>$finalTransectionId];
    // echo json_encode($response);
    
?>