<?php

include '../config.php';

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// Get parameters from request
$member_id = $_POST['member_id'] ?? '';
$transaction_date = $_POST['transaction_date'] ?? '';
$screenshot_url = $_POST['screenshot_url'] ?? '';
$upi_id = $_POST['upi_id'] ?? '';
$payment_mode = $_POST['payment_mode'] ?? '';
$amount = $_POST['amount'] ?? '';
$created_at = date("jS M g:iA"); // Outputs like: 19Jul 1PM
// Explicit cast to string


// Validate parameters
if (empty($member_id) || empty($transaction_date) || empty($screenshot_url) || empty($upi_id) || empty($payment_mode) || empty($amount)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    exit();
}

// Set the default timezone
date_default_timezone_set('Asia/Kolkata');

// // Prepare and bind
// $stmt = $conn->prepare("INSERT INTO payment_proof (member_id, transaction_date, screenshot_url, upi_id, payment_mode, amount) VALUES (?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("sssssd", $member_id, $dateTime, $screenshot_url, $upi_id, $payment_mode, $amount);
// $stmt = $conn->prepare("INSERT INTO payment_proof (member_id, transaction_date, screenshot_url, upi_id, payment_mode, amount, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
// $stmt->bind_param("sssssd", $member_id, $transaction_date, $screenshot_url, $upi_id, $payment_mode, $amount);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO payment_proof (member_id, transaction_date, screenshot_url, upi_id, payment_mode, amount, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssds", $member_id, $transaction_date, $screenshot_url, $upi_id, $payment_mode, $amount, $created_at); // Bind transaction_date for created_at



// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Record inserted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to insert record']);
}

// Close statement and connection
$stmt->close();
$conn->close();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
