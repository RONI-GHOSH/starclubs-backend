<?php
include '../includes/config.php';

if (isset($_POST['status'])) {
	$status = $_POST['status'];    
    $market_id = $_POST['market_id'];
    
    $sql = "UPDATE `market` SET active_status='$status' , `market_update_date`='$date'WHERE market_id='$market_id'";
    if(!mysqli_query($conn,$sql)) {
        echo '<script>alert("Market Update Failed");window.location = "../star-game-name.php";</script>';
    }else{
        echo '<script>alert("Market Update Successfully");window.location = "../star-game-name.php";</script>';
    }
}



?>