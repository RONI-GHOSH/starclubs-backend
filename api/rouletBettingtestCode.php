<?php
include '../includes/config.php';
 
if (isset($_POST['bet_submit'])) {
	$maib_bet_id = $_REQUEST['get_id'];
	$betting_number = $_POST['bet_number'];
	// echo $bet_number;die;  
    // $market_id = $_POST['market_id'];
    
    $sql = "UPDATE `roulettebat` SET bat_number='$betting_number' WHERE id='$maib_bet_id'";
    
    if(!mysqli_query($conn,$sql)) {
        echo '<script>alert("Market Update Failed");window.location = "../rouletBettingtest.php";</script>';
    }
    else
    {
        echo '<script>alert("Market Update Successfully");window.location = "../rouletBettingtest.php";</script>';
    }
}



?>