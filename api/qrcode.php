<?php 
include '../config.php';
/*include './SendFast2Sms.php';*/

    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];
    $transaction_id = $_POST['transaction_id'];
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
    if ($amount < 500) {
        $amountPercentage = 0;
    }
    if ($amount >= 500 and $amount <= 1000) {
        $amountPercentage = calculatePercentage($amount, $amb1);
    }
    if ($amount > 1000 and $amount <= 2000) {
        $amountPercentage = calculatePercentage($amount, $amb2);
    }
    if ($amount > 2000) {
        $amountPercentage = calculatePercentage($amount, $amb3);
    }       
    
    $date_transaction = $dateTime;

    $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type,add_bonus,status) VALUES ('$transaction_id','$amount','$member_id','$date_transaction','AddAmtQrcode','$amountPercentage','2')";
    if (mysqli_query($conn, $sql)) {
    	$lastid = mysqli_insert_id($conn);
    	$response=["status"=>200 ,"message"=>'Waiting Approval from Admin'];
    } else {
    	$response=["status"=>204 , "message"=>'Failure']; 
    }
    echo json_encode($response);

?>