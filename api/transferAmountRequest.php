<?php
include '../config.php';

$member_id = $_POST['member_id'];
$amount = $_POST['amount'];

$date_transection = $date;

$msql = "SELECT * from member_wallet WHERE member_id='$member_id'";
$result = mysqli_query($conn,$msql);
if($row = mysqli_fetch_array($result)){
   $member_wallet_amount = $row['member_wallet_balance'];
  }
   $newAmount = $member_wallet_amount - $amount;
  if ($newAmount >= '0') {
    $usql = "UPDATE member_wallet SET member_wallet_balance ='$newAmount',member_id='$member_id'";
   $UpdateResult = mysqli_query($conn,$usql);
   if ($UpdateResult) {
    $num = rand(10000,100000);
    $pre ="TRANS";
    $trans = $pre.$num.$member_id;

    $sql2 = "INSERT INTO wallet_transaction (transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type) VALUES ('$trans','$amount','$member_id','$date_transection','Sub')";
    if (mysqli_query($conn,$sql2)) {
      $response=["status"=>'success',"newbalance"=>$newAmount,"transaction_id"=>$trans,"statusPayment"=>'Processing'];
    }

   }else {
      $response=["status"=>'Failure']; 
    }

  }
  else{
    $response=["status"=>'Low Wallet Balance']; 
  }
 echo json_encode($response);


?>