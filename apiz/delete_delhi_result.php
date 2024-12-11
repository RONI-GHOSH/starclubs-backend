<?php
include '../includes/config.php';

$memberid = $_POST['id'];

$sql = "SELECT * FROM betting WHERE betting_id ='$memberid'";
$query =mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$b_member_id = $row['b_member_id'];
$betting_amount = $row['betting_amount'];
$betting_number = $row['betting_number'];
$token = $row['token'];

$sql = "SELECT * FROM wallet_transaction WHERE token='$token'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$member_id = $row['member_id'];
$transaction_amount = $row['transaction_amount'];
$add_bonus = $row['add_bonus'];
$transaction_id = $row['transaction_id'];



$transection_id = 'RFND' . rand(0000, 9999);

$date_transaction = $dateTime;

$sql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
$query = mysqli_query($conn, $sql);
if ($mrow = mysqli_fetch_array($query)) {
     $member_wallet_balance = $mrow['member_wallet_balance'];
}

$member_wallet_balance = $member_wallet_balance + $transaction_amount;

$mpsql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date,transaction_type) VALUES ('$transection_id','$transaction_amount','$member_id','$date_transaction','REFUND')";
if (mysqli_query($conn, $mpsql)) {
    $upsql = "UPDATE member_wallet SET member_wallet_balance='$member_wallet_balance' WHERE member_id='$member_id'";
    $upsqli=mysqli_query($conn, $upsql);
}

$sql = "UPDATE betting SET betting_status='Delete' WHERE betting_id ='$memberid' ";

$qry = mysqli_query($conn,$sql);
if ($qry > 0) 
{
	echo '<div class="alert alert-success alert-dismissible alert-alt fade show text-center">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span>×</span>
                </button> Member Deleted Successfully !
            </div>';
}
else
{
	echo '<div class="alert alert-danger alert-dismissible alert-alt fade show text-center">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span>×</span>
                </button> Member Not Deleted Successfully !
            </div>';
}
// echo $response;

?>