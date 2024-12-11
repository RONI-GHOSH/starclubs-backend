<?php 
include '../config.php';
/*include './SendFast2Sms.php';*/

    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];	
    $transection_id = 'TRANS'.rand(0000,9999);
    $img="";
    
 
    
    $query1 = "SELECT * FROM admin";
    $result1 = mysqli_query($conn,$query1);
    $rows1 = mysqli_fetch_assoc($result1);
    $admin_mobilenumber = $rows1['mobile'];
	

	$amb1 = $rows1['amb1'];
	$amb2 = $rows1['amb2'];
	$amb3 = $rows1['amb3'];	
	function calculatePercentage($value, $percentage)
	{
		$result = $value * ($percentage / 100);
		return $result;
	}
	if ($amount <500) {
		$amountPercentage = 0;
	}
	if($amount>=500 AND $amount<=1000)
	{
	$amountPercentage = calculatePercentage($amount, $amb1);
	}
	if ($amount > 1000 AND $amount <= 2000) {
	$amountPercentage = calculatePercentage($amount, $amb2);
	}
	if ($amount > 2000) {
	$amountPercentage = calculatePercentage($amount, $amb3);
	}

	$transactionamount = $amountPercentage + $amount;
	
	
	
	    
    $query2 = "SELECT * FROM member WHERE member_id='$member_id' ";
    $result2 = mysqli_query($conn,$query2);
    $rows2 = mysqli_fetch_assoc($result2);
    $name = $rows2['member_name'];
    $mobilenumber = $rows2['member_mobile'];

    $msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
    $mquery = mysqli_query($conn, $msql);
        if ($mrow = mysqli_fetch_array($mquery)) {
        $mbalance = $mrow['member_wallet_balance'];
        }
    
    $mrbalance = $mbalance + $transactionamount;
    
    
    
    $date_transection = $dateTime;
    
    

$sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type,add_bonus) VALUES ('$transection_id','$amount','$member_id','$date_transection','AddAmt','$amountPercentage')";
if (mysqli_query($conn, $sql)) {
	$lastid = mysqli_insert_id($conn);
    
	$usql = "UPDATE wallet_transaction SET transaction_id='$transection_id' WHERE w_transaction_id='$lastid'";
	if(mysqli_query($conn,$usql)){
		$lastid = mysqli_insert_id($conn);
     
		$mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, m_update_date) VALUES ('$lastid','$transection_id','$transactionamount','$member_id','$date_transection')";
		if(mysqli_query($conn,$mpsql)){
		    $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$member_id'";
	
		    if(mysqli_query($conn,$upsql)){
		        $data['status'] = 'New Fund';
				// sendSmsWithMessage($data,$admin_mobilenumber);
		        $content = "Your Wallet  ".$amount." Rs  Added Successfully";
		        $title = "Welcome To Matka Bazzar";
		        $query4 = "INSERT INTO storenotification(member_id,cotent,title,profile_picture) VALUES('$member_id','$content','$title','$img')";
		        $result4 = mysqli_query($conn,$query4);
		        if($result4)
		        {
    			$response=["status"=>'success',"amount"=>$amount,"transaction_id"=>$transection_id]; 
		        }
		}else {
			$response=["status"=>'Failure4']; 
		}
		}else {
			$response=["status"=>'Failure3']; 
		}
	}else {
		$response=["status"=>'Failure2']; 
	}
}else {
	$response=["status"=>'Failure']; 
}
echo json_encode($response);

?>