<?php 
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection
include '../includes/config.php';

// Validate input data
if (!isset($_POST['member_id']) || !isset($_POST['amount'])) {
    echo json_encode("Invalid input data");
    exit;
}

$member_id = $_POST['member_id'];
$amount = $_POST['amount'];

// Generate a unique transaction ID
$transection_id = 'TRANS' . rand(0000, 9999);
$img = ""; // No image specified

// Fetch the current wallet balance for the member
$msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
$mquery = mysqli_query($conn, $msql);

// Check for errors in the query
if (!$mquery) {
    echo json_encode("Database query failed: " . mysqli_error($conn));
    exit;
}

if ($mrow = mysqli_fetch_array($mquery)) {
    $mbalance = $mrow['member_wallet_balance'];
} else {
    echo json_encode("Member not found");
    exit;
}

// Calculate the remaining balance after withdrawal
$mrbalance = $mbalance - $amount;
$date_transection = $dateTime; // Assuming $dateTime is already set

// Ensure sufficient balance for withdrawal
if ($mrbalance >= 0) {

    // Start the transaction process
    $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, withdrawl_status) 
            VALUES ('$transection_id','$amount','$member_id','$date_transection','WithdrawAmt','approved')";
    
    if (!mysqli_query($conn, $sql)) {
        echo json_encode("Transaction insertion failed: " . mysqli_error($conn));
        exit;
    }

    // Get the last inserted ID for the transaction
    $lastid = mysqli_insert_id($conn);

    // Update the transaction ID in the wallet_transaction table
    $usql = "UPDATE wallet_transaction SET transaction_id='$transection_id' WHERE w_transaction_id='$lastid'";
    if (!mysqli_query($conn, $usql)) {
        echo json_encode("Transaction update failed: " . mysqli_error($conn));
        exit;
    }

    // Insert payment record into member_payment table
    $mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, m_update_date) 
              VALUES ('$lastid','$transection_id','$amount','$member_id','$date_transection')";
    
    if (!mysqli_query($conn, $mpsql)) {
        echo json_encode("Payment insertion failed: " . mysqli_error($conn));
        exit;
    }

    // Update the wallet balance for the member
    $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$member_id'";
    if (!mysqli_query($conn, $upsql)) {
        echo json_encode("Wallet balance update failed: " . mysqli_error($conn));
        exit;
    }

    // Insert a notification for the member
    // $content = "Your Wallet ₹" . $amount . " Withdrawal Successfully";
    // $title = "Welcome To Savera Games";
    // $query4 = "INSERT INTO storeNotification(member_id, cotent, title, profile_picture) 
    //           VALUES('$member_id','$content','$title','$img')";
    
    // if (mysqli_query($conn, $query4)) {
     
    // } else {
    //     $response = "Error sending notification: " . mysqli_error($conn);
    // }
    
       $response = 'Money Deduction Success'; 

} else {
    // Insufficient wallet balance
    $response = 'Wallet Balance Low'; 
}

// Return the response as JSON
echo json_encode($response);
?>



// include '../includes/config.php';

// $member_id = $_POST['member_id'];
// $amount = $_POST['amount'];
// $transection_id = 'TRANS'.rand(0000,9999);
// $img="";


//  $msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
//     $mquery = mysqli_query($conn, $msql);
//     if ($mrow = mysqli_fetch_array($mquery)) {
//     	$mbalance = $mrow['member_wallet_balance'];
//     }
    
//      $mrbalance = $mbalance - $amount;

// $date_transection = $dateTime;

// if ($mrbalance >= '0') {

// $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type , withdrawl_status) VALUES ('$transection_id','$amount','$member_id','$date_transection','WithdrawAmt' , 'approved')";
// if (mysqli_query($conn, $sql)) {
// 	$lastid = mysqli_insert_id($conn);

// 	$usql = "UPDATE wallet_transaction SET transaction_id='$transection_id' WHERE w_transaction_id='$lastid'";
// 	if(mysqli_query($conn,$usql)){
// 		$lastid = mysqli_insert_id($conn);

// 		$mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, m_update_date) VALUES ('$lastid','$transection_id','$amount','$member_id','$date_transection')";
// 		if(mysqli_query($conn,$mpsql)){
// 		    $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$member_id'";
// 		    if(mysqli_query($conn,$upsql)){
// 		        $content = "Your Wallet  ".$amount." Rs  Withdrwal Successfully";
// 		        $title = "Welcome To Savera Games";
// 		        $query4 = "INSERT INTO storeNotification(member_id,cotent,title,profile_picture) VALUES('$member_id','$content','$title','$img')";
// 		        $result4 = mysqli_query($conn,$query4);
// 		        if($result4)
// 		        {
//     			$response='Money Deduction Success'; 
// 		        }
// 		}else {
// 			$response= "Money Fail Due to internet issue ";
// 		}
// 		}else {
// 			$response= "Money Fail Due to internet issue ";
// 		}
// 	}else {
// 		$response= "Money Fail Due to internet issue ";
// 	}
// }else {
// 	$response= "Money Fail Due to internet issue ";
// }}else{
// 	$response='Wallet Balance Low'; 
// }
// echo json_encode($response);

// 