<?php
include '../includes/config.php';

if (isset($_POST['update-market'])) {
	$market_name = $_POST['member_wallet_balance'];
    
    $market_id = $_POST['member_wallet_id'];
    
    $sql = "UPDATE `member_wallet` SET `member_wallet_balance`='$market_name' WHERE member_wallet_id='$market_id'";
    if(!mysqli_query($conn,$sql)) {
       echo '<script>alert("Market Update Failed");window.location = "../member_wallet.php";</script>';
    }else{
        echo '<script>alert("Market Update Successfully");window.location = "../member_wallet.php";</script>';
    }
}



?>