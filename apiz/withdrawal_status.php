<?php
include '../includes/config.php';

$action = $_POST['action'];


if ($action == 'rejected') {

    $member_id = $_POST['member_id'];
    $trans_id = $_POST['trans_id'];
    $amount = $_POST['amount'];

    $msql = "SELECT * FROM member m LEFT JOIN member_wallet mw ON m.member_id = mw.member_id WHERE m.member_id='$member_id' ";
    $mquery = mysqli_query($conn, $msql);
    if ($mrow = mysqli_fetch_array($mquery)) {
        $mbalance = $mrow['member_wallet_balance'];
    }

    $newbal = $mbalance + $amount ;

    $sql = "UPDATE member_wallet SET member_wallet_balance='$newbal' WHERE member_id='$member_id'";
    if(!mysqli_query($conn,$sql)) {
       $response = "Payment Failed";
    }else{
        $qry = "UPDATE wallet_transaction SET withdrawl_status='rejected' WHERE w_transaction_id='$trans_id'";
        if(!mysqli_query($conn,$qry)) {
           $response = "Payment Failed";
        }else{
            $response = "Payment Refunded";
        }
    }
}elseif ($action == 'approved') {
    $member_id = $_POST['member_id'];
    $trans_id = $_POST['trans_id'];
    $sql = "UPDATE wallet_transaction SET withdrawl_status='approved' WHERE w_transaction_id='$trans_id'";
    if(!mysqli_query($conn,$sql)) {
       $response = "Payment Failed";
    }else{
        $response = "Payment Approved";
    }
}

echo $response;




?>
