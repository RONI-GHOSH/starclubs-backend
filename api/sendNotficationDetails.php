<?php 
include '../config.php';

$member_id = $_POST['member_id'];
$token = $_POST['token'];

$response = array();
$query ="SELECT COUNT(*) FROM memberNotificaiton WHERE member_id = '$member_id'";
$result = mysqli_query($conn,$query);
$r = mysqli_fetch_array($result);
$r1 = $r[0];
if($r1 != 0)
{
        $qry="Update memberNotificaiton set token='$token' where member_id = '$member_id'";
        if(mysqli_query($conn,$qry))
        {
          $response = ["status"=>"Success","Message"=>"all"];  
        }
        else
        {
          $response = ["status"=>"Failure","Message"=>"all"];    
        }
        
        
}
else
{

	$msql = "INSERT INTO memberNotificaiton(member_id,token) VALUES ('$member_id','$token')";

    $mquery = mysqli_query($conn, $msql);
    if ($mquery) 
    {
    	$response=["status"=>'success',"Message"=>"success"]; 
	}
	else {
		    	$response=["status"=>'failure',"Message"=>"failure"]; 

	}
   
}




echo json_encode($response);

?>