<?php
include '../includes/config.php';

    $betnums = $_POST['betnums'] ?? '';
	$betnum = $_POST['betnum'];
	$ebetid = $_POST['betid'];
    
    
    $sql = "UPDATE `betting` SET betting_number='$betnum', betting_number_second='$betnums' WHERE betting_id='$ebetid'";
    
    if(!mysqli_query($conn,$sql)) {
        echo $response = "Fail";
        // echo '<script>alert("Market Update Failed");window.location = "../bet_pergame.php";</script>';
    }
    else
    {
        echo $response = "Pass";
        // echo '<script>alert("Market Update Successfully");window.location = "../bet_pergame.php";</script>';
    }



?>