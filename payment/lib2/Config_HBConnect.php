<?php
error_reporting(0);
include '../../config.php';
$server=$_SERVER['SERVER_NAME'];
$upiuid= "paytmqr2810050501011g80t7vbutg2@paytm";
$secret= "hYi0p0tDLZ";
$token = "60e01f-879424-138ed8-56e48a-921fb8";
$orderId = time();
// $txnAmount = $_POST['amount'];
// $txnNote =   $_POST['email'];
// $txnAmount = "500";
// $txnNote =   "roni@gmail.com";
$cust_Mobile = "9858758698";
$cust_Email =  "test@gmail.com";
$callback_url = "https://hmroyal.online/betcircle/payment/pgResponse2.php";
$RECHPAY_ENVIRONMENT = 'PROD'; 
$RECHPAY_TXN_URL='https://paytome.in/order/process';
$RECHPAY_STATUS_URL='https://paytome.in/order/status';
if($RECHPAY_ENVIRONMENT == 'PROD') {
$RECHPAY_TXN_URL='https://paytome.in/order/paytm';
$RECHPAY_STATUS_URL='https://paytome.in/order/status';
}
?>