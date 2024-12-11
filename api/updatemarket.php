<?php
include '../includes/config.php';

if (isset($_POST['update-market'])) {
	$market_name = $_POST['market_name'];
    $market_type = $_POST['market_type'];
    $market_open = $_POST['market_open'];
    $market_close = $_POST['market_close'];

    $motime = date("g:i a", strtotime($market_open));
    $mctime = date("g:i a", strtotime($market_close));
    
    $market_id = $_POST['market_id'];
    
    $sql = "UPDATE `market` SET `market_name`='$market_name', `market_type`='$market_type' , `market_open_time`='$motime', `market_close_time`='$mctime',`market_update_date`='$date'WHERE market_id='$market_id'";
    if(!mysqli_query($conn,$sql)) {
        echo '<script>alert("Market Update Failed");window.location = "../market-list.php";</script>';
    }else{
        echo '<script>alert("Market Update Successfully");window.location = "../market-list.php";</script>';
    }
}



?>