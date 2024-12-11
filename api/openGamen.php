<?php
include '../config.php';
$openGame_bet_datails = $_POST['openGame_bet_datails'];
$data = json_decode($openGame_bet_datails);
$bet_date = $date;
$bet_time = $time;
$member_id = $data->MemberId; 
$market_id = $data->MarketId;
$game_id = $data->GameId;
$GamechoiceId = $data->GamechoiceId;
 $market_name = $data->MarketName;
 $game_name = $data->GameName;
 $total_amount = $data->totalAmountGame;
 $BetType = $data->BetType;
$date_transection = $date;

$b_game_cid ='0';
$betting_time_type== $data->BetType;
$wallet_balance = ''; 
$timec =   date('H:i');;


//get the member wallet amount from the member id

$query3 = "SELECT member_wallet_balance FROM member_wallet WHERE member_id = '$member_id'";
$result3 = mysqli_query($conn,$query3);
if(mysqli_num_rows($result3)){
	$row3 = mysqli_fetch_array($result3);
	$wallet_balance = $row3[0];
}

if($wallet_balance>=$total_amount)
{
	$checkQuery = "SELECT * FROM market WHERE market_id = '$market_id'";
	$checkResult = mysqli_query($conn,$checkQuery);
	$checkRow = mysqli_fetch_array($checkResult);
    $closetime =	$checkRow["market_close_time"];
	$opentime=$checkRow["market_open_time"];
	$activestatus="";
	if(strtotime($timec)>=strtotime($opentime) && strtotime($timec)<=strtotime($closetime))
	{
	   $activestatus="Close" ;
	}
	else if(strtotime($opentime)>=strtotime($timec) )
	{
	   $activestatus="Active"; 
	}
	else if(strtotime($closetime)<strtotime($timec))
	{
	   $activestatus="Betting" ; 
	}
	
	if($activestatus == 'Active' | $activestatus== 'active' )
	{
		$status =$data->status;
		$mbalance=0;
		$lengthOfGame=sizeof($data->openGame);
		for($i= $lengthOfGame;$i>0; $i--)
		{	
			$openGameNumber=  $data->openGame[$i-1]->number;
			$openGameAmount= $data->openGame[$i-1]->amount;
			if($game_id==2)
			{
			   if($openGameNumber==1 || $openGameNumber==2 || $openGameNumber==3 || $openGameNumber==4 || $openGameNumber==5 || $openGameNumber==6 || $openGameNumber==7 || $openGameNumber==8 ||  $openGameNumber==9 || $openGameNumber==0)
			   {
			       $openGameNumber="0$openGameNumber";
			   }
			}
			
			
			
			if($game_id==5)
            {
                if($openGameNumber==0)
                {
                    $openGameNumber='000';
                }
            }

			
			
			
			$msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id' ";
			$mquery = mysqli_query($conn, $msql);
			if ($mrow = mysqli_fetch_array($mquery)) 
			{
				$mbalance = $mrow['member_wallet_balance'];
			}
			if($mbalance>=$openGameAmount)
			{
    			$balance = $mbalance - $openGameAmount;

				$timestamp = microtime(true);
				// Convert to millisecond precision
				$milliseconds = round($timestamp * 1000);
				// Generate a random number between 0 and 999 to append to the milliseconds
				$random = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
				// Concatenate milliseconds and random number to create a unique token

				$token1 = $milliseconds . $random . $market_id;

    			$query = "INSERT INTO betting(b_member_id,b_market_id,b_game_id,b_game_cid,betting_number,betting_amount,betting_time_type,betting_date,betting_time,betting_status,token1)
    			VALUES ('$member_id','$market_id','$game_id','$GamechoiceId','$openGameNumber','$openGameAmount','$BetType','$bet_date','$bet_time','$status', '$token1')";
    			$result = mysqli_query($conn, $query);
    			if ($result)
    			{
    				$lastid = mysqli_insert_id($conn);
    				$usql = "UPDATE member_wallet SET member_wallet_balance='$balance' WHERE member_id='$member_id'";
    				if(mysqli_query($conn,$usql))
    				{
    					$num = rand(10000,100000);
    					$pre = "BETOPEN";
    					$trans = $pre.$num.$lastid;
    					$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, market_name, game_name, bat_number, token1) VALUES ('$trans','$openGameAmount','$member_id','$date_transection','openGameBat','$market_name','$game_name','$openGameNumber', '$token1')";
    					if (mysqli_query($conn, $msql)) 
    					{
    						$response=["status"=>'success',"betid"=>$lastid,"get_new_wallet_amt_openGame"=>$balance]; 
    					}
    					else 
    					{
    						$response=["status"=>'Failure']; 
    					}
    
    				}else {
    					$response=["status"=>'1'];
    				}
    			}else {
    				$response=["status"=>'2'];
    			}
			}
		}
	}
	else if($activestatus == 'Close' | $activestatus== 'close' )
	{
	    if($game_id==2 || $game_id==7 ||  $BetType=='Open' || $BetType=='open')
	    {
	      $response = ["status"=>'closed'];
	    }
	    else
	    {
	       $status =$data->status;
		$mbalance=0;
		$lengthOfGame=sizeof($data->openGame);
		for($i= $lengthOfGame;$i>0; $i--)
		{	
			$openGameNumber=  $data->openGame[$i-1]->number;
			$openGameAmount= $data->openGame[$i-1]->amount;
			if($game_id==5)
            {
                if($openGameNumber==0)
                {
                    $openGameNumber='000';
                }
            }

			
			
			
			$msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id' ";
			$mquery = mysqli_query($conn, $msql);
			if ($mrow = mysqli_fetch_array($mquery)) 
			{
				$mbalance = $mrow['member_wallet_balance'];
			} 
			$balance = $mbalance - $openGameAmount;
	        //todo how to check in amount in greter than zero solve isssue
    		if($mbalance>=$openGameAmount)
    		{
					$timestamp = microtime(true);
					// Convert to millisecond precision
					$milliseconds = round($timestamp * 1000);
					// Generate a random number between 0 and 999 to append to the milliseconds
					$random = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
					// Concatenate milliseconds and random number to create a unique token

					$token1 = $milliseconds . $random . $market_id;

    			$query = "INSERT INTO betting(b_member_id,b_market_id,b_game_id,b_game_cid,betting_number,betting_amount,betting_time_type,betting_date,betting_time,betting_status,token1)
    			VALUES ('$member_id','$market_id','$game_id','$GamechoiceId','$openGameNumber','$openGameAmount','$BetType','$bet_date','$bet_time','$status','$token1')";
    			$result = mysqli_query($conn, $query);
    			if ($result)
    			{
    				$lastid = mysqli_insert_id($conn);
    				$usql = "UPDATE member_wallet SET member_wallet_balance='$balance' WHERE member_id='$member_id'";
    				if(mysqli_query($conn,$usql))
    				{
    					$num = rand(10000,100000);
    					$pre = "BETOPEN";
    					$trans = $pre.$num.$lastid;
    					$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, market_name, game_name, bat_number,token1) VALUES ('$trans','$openGameAmount','$member_id','$date_transection','openGameBat','$market_name','$game_name','$openGameNumber','$token1')";
    					if (mysqli_query($conn, $msql)) 
    					{
    						$response=["status"=>'success',"betid"=>$lastid,"get_new_wallet_amt_openGame"=>$balance]; 
    					}
    					else 
    					{
    						$response=["status"=>'Failure']; 
    					}
    
    				}else {
    					$response=["status"=>'1'];
    	}
    			}
    			else
    			{
    				$response=["status"=>'2'];
    			}
    		}
		} 
	    }
	}
}
else {
	$response=["status"=>'Low Wallet Balance'];
}


echo json_encode($response);


?>



