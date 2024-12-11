<?php
include '../config.php';
$jantari_bet_details = $_POST['jantari_bet_details'];
$data = json_decode($jantari_bet_details);
$bet_date = $date;
$bet_time = $time;
$member_id = $data->Memberid; 
 $market_id = $data->MarketId; 
$game_id = $data->GameId;
$total_amount = $data->totalLotteriesAmount;
$market_name = $data->MarketName;
$game_name = $data->GameName;
$date_transection = $date;
$wallet_balance = ''; 
$b_game_cid='0';
$betting_time_type='';
if($game_name == 'Single Bahar') {
    $b_game_cid='15';
} elseif($game_name == 'Single Andar'){
    $b_game_cid='14';
} else {
    $b_game_cid ='13';
}
//get the member wallet amount from the member id

 $query3 = "SELECT member_wallet_balance FROM member_wallet WHERE member_id = '$member_id'";
$result3 = mysqli_query($conn,$query3);
if(mysqli_num_rows($result3)){
	$row3 = mysqli_fetch_array($result3);
    $wallet_balance = $row3["member_wallet_balance"];
}

$checkQuery = "SELECT * FROM market WHERE market_id = '$market_id'";
	$checkResult = mysqli_query($conn,$checkQuery);
	$checkRow = mysqli_fetch_array($checkResult);
	$closetime =	$checkRow["market_close_time"];
	$opentime  =     $checkRow["market_open_time"];
	$activestatus="";


	$sql_winningbetting_detail = "SELECT market_Id FROM winningbetting_detail WHERE opening_date='$date' AND market_Id='$market_id'";
	$query_winningbetting_detail = mysqli_query($conn, $sql_winningbetting_detail);
	$num_winningbetting_detail = mysqli_num_rows($query_winningbetting_detail);
	$row_winningbetting_detail = mysqli_fetch_assoc($query_winningbetting_detail);
	$opening_date = $row_winningbetting_detail['$opening_date'];
	$bet_date_new = date('Y-m-d', strtotime($opening_date . ' +1 day'));
	$bet_time_new = "00:01";
	
	// Referral logic: Check for the referrer and calculate bonus dynamically
$referrer_id = 0; // Default value
$referral_bonus = 0;

// Fetch the referral percentage from the admin table
$referral_percentage_query = "SELECT refer_amount FROM admin WHERE id = '1'";
$referral_percentage_result = mysqli_query($conn, $referral_percentage_query);
if ($referral_percentage_result && mysqli_num_rows($referral_percentage_result) > 0) {
    $referral_percentage_row = mysqli_fetch_assoc($referral_percentage_result);
    $referral_percentage = (float)$referral_percentage_row['refer_amount']; // Assume refer_amount is stored as a percentage (e.g., 10 for 10%)

    // Fetch the referrer ID
    $referral_query = "SELECT member_id FROM member_referral WHERE referrer_id = '$member_id' ORDER BY created_at DESC LIMIT 1";
    $referral_result = mysqli_query($conn, $referral_query);
    if (mysqli_num_rows($referral_result) > 0) {
        $referral_row = mysqli_fetch_assoc($referral_result);
        $referrer_id = $referral_row['member_id'];

        // Calculate the referral bonus based on the percentage
        $referral_bonus = $total_amount * ($referral_percentage / 100);

        // Add the bonus to the referrer's wallet
        $referrer_query = "SELECT member_wallet_balance FROM member_wallet WHERE member_id = '$referrer_id'";
        $referrer_result = mysqli_query($conn, $referrer_query);
        if (mysqli_num_rows($referrer_result) > 0) {
            $referrer_row = mysqli_fetch_assoc($referrer_result);
            $referrer_balance = $referrer_row['member_wallet_balance'];
            $new_referrer_balance = $referrer_balance + $referral_bonus;

            // Update the referrer's wallet balance
            $update_referrer_balance = "UPDATE member_wallet SET member_wallet_balance = '$new_referrer_balance' WHERE member_id = '$referrer_id'";
            mysqli_query($conn, $update_referrer_balance);
        }
    }
}

	
	
// 	// Referral logic: Check for the referrer and add 10% of the bet amount
// $referrer_id = 0; // Default value
// $referral_bonus = 0;

// $referral_query = "SELECT member_id FROM member_referral WHERE referrer_id = '$member_id' ORDER BY created_at DESC LIMIT 1";
// $referral_result = mysqli_query($conn, $referral_query);
// if (mysqli_num_rows($referral_result) > 0) {
//     $referral_row = mysqli_fetch_assoc($referral_result);
//     $referrer_id = $referral_row['member_id'];
    
//     // Calculate 10% of the bet amount for the referrer
//     $referral_bonus = $total_amount * 0.10;
    
//     // Add the bonus to the referrer's wallet
//     $referrer_query = "SELECT member_wallet_balance FROM member_wallet WHERE member_id = '$referrer_id'";
//     $referrer_result = mysqli_query($conn, $referrer_query);
//     if (mysqli_num_rows($referrer_result) > 0) {
//         $referrer_row = mysqli_fetch_assoc($referrer_result);
//         $referrer_balance = $referrer_row['member_wallet_balance'];
//         $new_referrer_balance = $referrer_balance + $referral_bonus;
        
//         // Update referrer's wallet balance
//         $update_referrer_balance = "UPDATE member_wallet SET member_wallet_balance = '$new_referrer_balance' WHERE member_id = '$referrer_id'";
//         mysqli_query($conn, $update_referrer_balance);
//     }
// }

    // 	if(strtotime($timec) >= strtotime($opentime))
    // 	{
    // 	   $activestatus="Close" ;
    // 	  $response=["status"=>'closed'];
    // 	} 9:04 PM  9:05PM

    
	if(strtotime($opentime) > strtotime($timec) )
	{
	   $activestatus="Active"; 
        if($wallet_balance>=$total_amount)
        {
           $checkQuery = "SELECT active_status FROM market WHERE market_id = '$market_id'";
        	$checkResult = mysqli_query($conn,$checkQuery);
        	$checkRow = mysqli_fetch_array($checkResult);
        	 $checkRow['active_status'];
        	if($checkRow['active_status'] == 'Active' | $checkRow['active_status'] == 'active' ){
        		$status =$data->status;
        		$mbalance=0;
        		$lengthoflotties=sizeof($data->Lottries);
        		for($i= 0;$i<$lengthoflotties; $i++)
        		{	
        			$lottrynumber=  $data->Lottries[$i]->LottryNumber;
        			$Lottryamount= $data->Lottries[$i]->Lottryamount;
        			 $msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id' ";
        			$mquery = mysqli_query($conn, $msql);
        			if ($mrow = mysqli_fetch_array($mquery)) 
        			{
        				 $mbalance = $mrow['member_wallet_balance'];
        			} 
        			$balance = $mbalance - $Lottryamount;


					$timestamp = microtime(true);
					// Convert to millisecond precision
					$milliseconds = round($timestamp * 1000);
					// Generate a random number between 0 and 999 to append to the milliseconds
					$random = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
					// Concatenate milliseconds and random number to create a unique token
					
					if($market_id<='40' AND $market_id>='11' AND $market_id!='37')
					{
						$token1 = $milliseconds . $random . $market_id;
					}
					else
					{
						$token = $milliseconds . $random . $market_id;
					}
        
        
        			$query = "INSERT INTO betting(betting_date_old,betting_time_old,b_member_id,b_market_id,b_game_id,b_game_cid,betting_number,betting_amount,betting_time_type,betting_date,betting_time,betting_status,token,token1)
        			VALUES ('$bet_date','$bet_time','$member_id','$market_id','$game_id','$b_game_cid','$lottrynumber',$Lottryamount,'$betting_time_type','$bet_date','$bet_time','$status','$token','$token1')";
        			$result = mysqli_query($conn, $query);
        			if ($result)
        			{
        				$lastid = mysqli_insert_id($conn);
        				
						$response=["status"=>'success',"betid"=>$lastid,"get_new_wallet_amt_jantari"=>$balance]; 
						$usql = "UPDATE member_wallet SET member_wallet_balance='$balance' WHERE member_id='$member_id'";
        				if(mysqli_query($conn,$usql))
        				{
        					$num = rand(10000,100000);
        					$pre = "BETJAN";
        					$trans = $pre.$num.$lastid;
        					$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, market_name, game_name, bat_number,token,token1) VALUES ('$trans','$Lottryamount','$member_id','$date_transection','JodiBat','$market_name','$game_name','$lottrynumber','$token','$token1')";
        					if (mysqli_query($conn, $msql)) 
        					{
        						$response=["status"=>'success',"betid"=>$lastid,"get_new_wallet_amt_jantari"=>$balance]; 
        					}
        					else 
        					{
        						$response=["status"=>'Failure']; 
        					}
        
        				}
        			}
        			
        		}
        	}
        	else{
        	    $response = ["status"=>'closed'];
        	}
        }
        else {
        	$response=["status"=>'Low Wallet Balance'];
        }
	}
	
	else if ($num_winningbetting_detail != 0) 
	{
		$bet_date_old = $date;
		$bet_time_old = $time;
		$activestatus = "Active";
		if ($wallet_balance >= $total_amount) {
			$checkQuery = "SELECT active_status FROM market WHERE market_id = '$market_id'";
			$checkResult = mysqli_query($conn, $checkQuery);
			$checkRow = mysqli_fetch_array($checkResult);
			$checkRow['active_status'];
			if ($checkRow['active_status'] == 'Active' | $checkRow['active_status'] == 'active') {
				$status = $data->status;
				$mbalance = 0;
				$lengthoflotties = sizeof($data->Lottries);
				for ($i = 0; $i < $lengthoflotties; $i++) {
					$lottrynumber =  $data->Lottries[$i]->LottryNumber;
					$Lottryamount = $data->Lottries[$i]->Lottryamount;
					$msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id' ";
					$mquery = mysqli_query($conn, $msql);
					if ($mrow = mysqli_fetch_array($mquery)) {
						$mbalance = $mrow['member_wallet_balance'];
					}
					$balance = $mbalance - $Lottryamount;


					$query = "INSERT INTO betting(betting_date_old,betting_time_old,b_member_id,b_market_id,b_game_id,b_game_cid,betting_number,betting_amount,betting_time_type,betting_date,betting_time,betting_status)
						VALUES ('$bet_date_old','$bet_time_old','$member_id','$market_id','$game_id','$b_game_cid','$lottrynumber',$Lottryamount,'$betting_time_type','$bet_date_new','$bet_time_new','$status')";
					$result = mysqli_query($conn, $query);
					if ($result) {
						$lastid = mysqli_insert_id($conn);

						$response = ["status" => 'success', "betid" => $lastid, "get_new_wallet_amt_jantari" => $balance];
						$usql = "UPDATE member_wallet SET member_wallet_balance='$balance' WHERE member_id='$member_id'";
						if (mysqli_query($conn, $usql)) {
							$num = rand(10000, 100000);
							$pre = "BETJAN";
							$trans = $pre . $num . $lastid;
							$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, market_name, game_name, bat_number) VALUES ('$trans','$Lottryamount','$member_id','$date_transection','JodiBat','$market_name','$game_name','$lottrynumber')";
							if (mysqli_query($conn, $msql)) {
								$response = ["status" => 'success', "betid" => $lastid, "get_new_wallet_amt_jantari" => $balance];
							} else {
								$response = ["status" => 'Failure'];
							}
						}
					}
				}
			} else {
				$response = ["status" => 'closed'];
			}
		} else {
			$response = ["status" => 'Low Wallet Balance'];
		}
	}

	else	{
	   $activestatus="Betting" ;
	   $response=["status"=>'closed'];
	} 


echo json_encode($response);


?>