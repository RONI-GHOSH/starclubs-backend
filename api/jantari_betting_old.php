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


			$query = "INSERT INTO betting(b_member_id,b_market_id,b_game_id,b_game_cid,betting_number,betting_amount,betting_time_type,betting_date,betting_time,betting_status)
			VALUES ('$member_id','$market_id','$game_id','$b_game_cid','$lottrynumber',$Lottryamount,'$betting_time_type','$bet_date','$bet_time','$status')";
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
					$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, market_name, game_name, bat_number) VALUES ('$trans','$Lottryamount','$member_id','$date_transection','JodiBat','$market_name','$game_name','$lottrynumber')";
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


echo json_encode($response);


?>



