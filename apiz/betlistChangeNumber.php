<?php
include '../includes/config.php';


// if (isset($_POST['bet_submit'])) {
// 	$maib_bet_id = $_REQUEST['get_id'];
// 	$betting_number = $_POST['bet_number']; 
    
//     $sql = "UPDATE `betting` SET betting_number='$betting_number' WHERE betting_id='$maib_bet_id'";
    
//     if(!mysqli_query($conn,$sql)) 
//     {
//         echo '<script>alert("Market Update Failed");window.location = "../user-bid-history.php";</script>';
//     }
//     else
//     {
//         echo '<script>alert("Market Update Successfully");window.location = "../user-bid-history.php";</script>';
//     }
// }
    $maib_bet_id = $_POST['get_id'];
    $betting_number = $_POST['bet_number'];
    $betting_amount = $_POST['betting_amount']; 

    $sql = "UPDATE `betting` SET betting_amount='$betting_amount', betting_number='$betting_number' WHERE betting_id='$maib_bet_id'";

    if(!mysqli_query($conn,$sql)) 
    {
        "Yes";
    }
    else
    {
        "No";
    }

?>