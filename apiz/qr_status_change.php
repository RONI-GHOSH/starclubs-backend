<?php

include '../includes/config.php';

$newStatus = $_POST['newValue'];
$id=$_POST['id'];

if ($newStatus == "3") {
    $sql = "UPDATE wallet_transaction SET status='3' WHERE w_transaction_id ='$id' ";
    $qry = mysqli_query($conn, $sql);
    if ($qry) {
        echo "Success";
    } else
        echo "fail";
}
elseif($newStatus=="1"){
    $sql = "UPDATE wallet_transaction SET status='1' WHERE w_transaction_id ='$id' ";
    $qry = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM wallet_transaction WHERE w_transaction_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $member_id = $row['member_id'];
    $transaction_amount = $row['transaction_amount'];
    $add_bonus = $row['add_bonus'];
    $transaction_id = $row['transaction_id'];

    $date_transaction = $dateTime;

    $sql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
    $query = mysqli_query($conn, $sql);
    if ($mrow = mysqli_fetch_array($query)) {
        $member_wallet_balance = $mrow['member_wallet_balance'];
    }
    $member_wallet_balance = $member_wallet_balance + $transaction_amount + $add_bonus;
    $transactionamount = $transaction_amount + $add_bonus;

    $mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, m_update_date) VALUES ('$id','$transaction_id','$transactionamount','$member_id','$date_transaction')";
    if (mysqli_query($conn, $mpsql)) {
        $upsql = "UPDATE member_wallet SET member_wallet_balance='$member_wallet_balance' WHERE member_id='$member_id'";
        if (mysqli_query($conn, $upsql)) {
            echo "Success";
        } else
            echo "fail";
    }
}

?>