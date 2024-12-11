<?php
// include '../includes/config.php';
 
// if (isset($_POST['bet_submit'])) {
// 	$maib_bet_id = $_REQUEST['get_id'];
// 	$betting_number = $_POST['bet_number']; 
    
//     $sql = "UPDATE `colormarketbat` SET bet_num='$betting_number' WHERE id='$maib_bet_id'";
    
//     if(!mysqli_query($conn,$sql)) 
//     {
//         echo '<script>alert("Bid Update Failed");window.location = "../color-user-bid-history.php";</script>';
//     }
//     else
//     {
//         echo '<script>alert("Bid Update Successfully");window.location = "../color-user-bid-history.php";</script>';
//     }
// }


include '../includes/config.php';
  
    $maib_bet_id = $_REQUEST['get_id'];
    $betting_number = $_POST['bet_number']; 
    
    $sql = "UPDATE `colormarketbat` SET bet_num='$betting_number' WHERE id='$maib_bet_id'";
    
    if(!mysqli_query($conn,$sql))
    {
        "Yes";
    }
    else
    {
        "No";
    }

?>