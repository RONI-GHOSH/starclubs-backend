  <?php
 include '../config.php';
 $count=0;
 $response= array();
 $isFirst=true;
     

  $sql = "SELECT * from rouletteWinningNumber WHERE  Date(winning_date)=Date($date) Order By id Desc ";
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result)) 
  {
	if($row =mysqli_fetch_array($result))
    {
       $winningnumber=$row["winning_number"];    
	   $response = ["status"=>"success","roulettwinningbat"=>$winningnumber];
    }
	  
   
  }
  else
  {
  	$response = ["status"=>"failure"];
  }
  echo json_encode($response);
    
    
    ?>