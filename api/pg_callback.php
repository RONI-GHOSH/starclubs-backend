<?php
date_default_timezone_set("Asia/Kolkata");

// Callback file for UPI Gateway
if (isset($_POST['id']) && isset($_POST['client_txn_id'])) {
    $id = $_POST['id']; // UPI gateway transaction ID
    $customer_vpa = $_POST['customer_vpa']; // UPI ID from which payment is made
    $amount = $_POST['amount']; // Transaction amount
    $client_txn_id = $_POST['client_txn_id']; // Client transaction ID set while creating order
    $customer_name = $_POST['customer_name']; // Customer name
    $customer_email = $_POST['customer_email']; // Customer email
    $customer_mobile = $_POST['customer_mobile']; // Customer mobile
    $p_info = $_POST['p_info']; // Product info
    $upi_txn_id = $_POST['upi_txn_id']; // UTR or Merchant App Transaction ID
    $status = $_POST['status']; // Transaction status
    $remark = $_POST['remark']; // Remark of the transaction
    $udf1 = $_POST['udf1']; // Member ID (user-defined data)
    $txnAt = $_POST['txnAt']; // Transaction date
    $createdAt = $_POST['createdAt']; // Created date

    // If the transaction is successful
    if ($_POST['status']) {
        echo "Transaction Successful";

        // Prepare data for API call
        $hkb_date = date('d/m/Y g:i:s'); // Current date and time
        $postData = [
            'member_id' => $udf1, // Member ID from udf1
            'amount' => $amount,  // Transaction amount
            'transection_id' => $upi_txn_id, // Transaction ID
            'PaymentType' => "Others" // Payment type
        ];

        // Make the API call to add money
        $ch = curl_init('https://starclubs.in/betcircle/api/addMoney.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        // Handle the API response
        if ($response === false) {
            // Log or display cURL error
            echo "Error in API call: " . curl_error($ch);
        } else {
            // Parse the response (optional: based on your API structure)
            $apiResponse = json_decode($response, true);
            if ($apiResponse['status'] == 'success') {
                echo "Amount successfully added to user account.";
            } else {
                echo "Error in adding amount: " . $apiResponse['message'];
            }
        }

        // Close cURL session
        curl_close($ch);
    } elseif ($status == 'failure') {
        echo "Transaction Failed";
    } else {
        echo "Unknown transaction status.";
    }
} else {
    echo "Invalid callback request.";
}


// This is the callback file which will be called after payment is done directly from UPI gateway server.
// you can set the webhook url at https://merchant.upigateway.com/user/api_credentials
// You can also use IP check to prevent unauthorized access.
// $ip = $_SERVER['REMOTE_ADDR'];
// if($ip != '101.53.134.70'){
// 	die('Unauthorized Access');
// }

// if(isset($_POST['id']) && $_POST['client_txn_id']){
// 	$id = $_POST['id']; // upi gateway transaction id
// 	$customer_vpa = $_POST['customer_vpa']; // upi id from which payment is made
// 	$amount = $_POST['amount']; // 1
// 	$client_txn_id = $_POST['client_txn_id']; // client_txn_id set while creating order 
// 	$customer_name = $_POST['customer_name']; // 
// 	$customer_email = $_POST['customer_email']; // 
// 	$customer_mobile = $_POST['customer_mobile']; // 
// 	$p_info = $_POST['p_info']; // p_info set while creating order 
// 	$upi_txn_id = $_POST['upi_txn_id']; // UTR or Merchant App Transaction ID
// 	$status = $_POST['status']; // failure
// 	$remark = $_POST['remark']; // Remark of Transaction
// 	$udf1 = $_POST['udf1']; // user defined data added while creating order
// 	$udf2 = $_POST['udf2']; // user defined data added while creating order
// 	$udf3 = $_POST['udf3']; // user defined data added while creating order
// 	$redirect_url = $_POST['redirect_url']; // redirect_url added while creating order
// 	$txnAt = $_POST['txnAt']; // 2023-05-11 date of transaction
// 	$createdAt = $_POST['createdAt']; // 2023-05-11T12%3A15%3A23.000Z

// 	if($_POST['status']){
// 		echo "Transaction Successful";
// 		// All the Process you want to do after successfull payment
// 		// Please also check the txn is already success in your database.
// 	}

// 	if($_POST['status'] == 'failure'){
// 		echo "Transaction Failed";
// 	}
// }
?>