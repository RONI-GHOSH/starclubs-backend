<?php include 'includes/config.php';

    echo $startdate = $_POST['startdate'];
    echo $enddate = $_POST['enddate'];

        // DELETE FROM betting WHERE betting_date >= '2023-10-01' AND betting_date <= '2023-12-08';

        // DELETE FROM wallet_transaction WHERE transaction_update_date >= '2023-10-01' BETWEEN transaction_update_date <= '2023-12-08';
     echo   $deleteQuery = "DELETE FROM `betting` WHERE `betting_date` BETWEEN '$startdate' AND  '$enddate'";
     
    
       echo $deleteQuery2 = "DELETE FROM `wallet_transaction` WHERE `transaction_update_date` BETWEEN '$startdate' AND  '$enddate'";
        
        if (mysqli_query($conn, $deleteQuery)) {
            $message .= 'Betting Data Cleared. ';
        }
        
        if (mysqli_query($conn, $deleteQuery2)) {
            $message .= 'Wallet History Data Cleared. ';
        }
        
        echo json_encode(['status' => 'success', 'message' => rtrim($message)]);
?>