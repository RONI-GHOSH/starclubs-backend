<?php 
include '../includes/config.php';

$member_id = $_POST['member_id'];
$amount = $_POST['amount'];
$transection_id = 'ORD'.rand(0000,9999);
$img= $base_url."/gameImage/logo.png";


 $msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
    $mquery = mysqli_query($conn, $msql);
    if ($mrow = mysqli_fetch_array($mquery)) {
    	$mbalance = $mrow['member_wallet_balance'];
    }
    
     $mrbalance = $mbalance + $amount;

$date_transection = $dateTime;

$sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type) VALUES ('$transection_id','$amount','$member_id','$date_transection','AddAmt')";
if (mysqli_query($conn, $sql)) {
	$lastid = mysqli_insert_id($conn);

	$usql = "UPDATE wallet_transaction SET transaction_id='$transection_id' WHERE w_transaction_id='$lastid'";
	if(mysqli_query($conn,$usql)){
		$lastid = mysqli_insert_id($conn);

		$mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, m_update_date) VALUES ('$lastid','$transection_id','$amount','$member_id','$date_transection')";
		if(mysqli_query($conn,$mpsql)){
		    $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$member_id'";
		    if(mysqli_query($conn,$upsql)){
		        $content = "Your Wallet  ".$amount." Rs  Added Successfully";
		        $title = "Welcome To Matka Bazzar";
		        $query4 = "INSERT INTO storeNotification(member_id,cotent,title,profile_picture) VALUES('$member_id','$content','$title','$img')";
		        $result4 = mysqli_query($conn,$query4);
		        if($result4)
		        {
    			$response='Money Added Successfully'; 
		        }
		}else {
			$response='Fail To Add Money'; 
		}
		}else {
			$response='Fail To Add Money'; 
		}
	}else {
		$response='Fail To Add Money'; 
	}
}else {
	$response='Fail To Add Money'; 
}
echo json_encode($response);

?>