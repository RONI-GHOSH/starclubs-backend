<?php
// Set the timezone to Asia/Kolkata
date_default_timezone_set("Asia/Kolkata");

// Include the file containing the checksum functions
require_once('checksum.php');

// Replace this with your actual secret key from the payment gateway
$secret = 'hYi0p0tDLZ';

// Payment Status and other POST parameters
$status = $_POST['status'];
$message = $_POST['message'];
$cust_Email = $_POST['cust_Email']; // This will be used as member_id
$hash = $_POST['hash'];
$checksum = $_POST['checksum'];

// Payment Status check
if ($status == "SUCCESS") {
    // Decrypt the hash to get parameters
    $paramList = hash_decrypt($hash, $secret);

    // Verify the checksum
    $verifySignature = RechPayChecksum::verifySignature($paramList, $secret, $checksum);

    if ($verifySignature) {
        // Parse the JSON data
        $array = json_decode($paramList);

        // Extract payment details
        $amount = $array->txnAmount;
        $transactionId = $array->txnId;
        $memberId = $cust_Email; // Use email as memberId
        $paymentType = "Other";  // Set your PaymentType

        // Prepare the data for the API call
        $postData = [
            'member_id' => $memberId,
            'amount' => $amount,
            'transection_id' => $transactionId,
            'PaymentType' => $paymentType
        ];

        // Initialize cURL session
        $ch = curl_init('https://hmroyal.online/betcircle/api/addMoney.php');

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Handle the response
        if ($response === false) {
            // Error handling
            echo "Error in API call: " . curl_error($ch);
        } else {
            // Redirect to a success page
            header("Location: https://dadyji.com/#/mine");
            exit;
        }

        // Close the cURL session
        curl_close($ch);

    } else {
        // Checksum verification failed
        echo "<pre>";
        echo "Payment Status: $status<br>";
        echo "Payment Message: $message<br>";
        echo '<h2><b style="color:red">Checksum Invalid!</b></h2>';
    }
} else {
    // Payment failed, display failure message
    $fail = "
    <html>
      <head>
        <link href='https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap' rel='stylesheet'>
      </head>
      <style>
        body {
          text-align: center;
          padding: 40px 0;
          background: #EBF0F5;
        }
        h1 {
          color: #f20101;
          font-family: 'Nunito Sans', 'Helvetica Neue', sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: 'Nunito Sans', 'Helvetica Neue', sans-serif;
          font-size:20px;
          margin: 0;
        }
        i {
          color: #9ABC66;
          font-size: 100px;
          line-height: 200px;
          margin-left:-15px;
        }
        .card {
          background: white;
          padding: 60px;
          border-radius: 4px;
          box-shadow: 0 2px 3px #C8D0D8;
          display: inline-block;
          margin: 0 auto;
        }
      </style>
      <body>
        <div class='card'>
          <div style='border-radius:200px; height:200px; width:200px; background: #f76565d4; margin:0 auto;'>
            <i class='checkmark'>❌</i>
          </div>
          <h1>Payment Failed $status</h1> 
          <p>Please Pay Again!!<br/>$message</p>
        </div>
      </body>
    </html>
    ";
    
    echo $fail;
    
}

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
