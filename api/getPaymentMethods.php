<?php
// Include the configuration file
include '../config.php';

// Establish database connection
// $conn = mysqli_connect($host, $user, $password, $db_name);

// if (mysqli_connect_error()) {
//     echo json_encode(['status' => 'error', 'message' => 'Connection to database failed']);
//     exit();
// }

// Get the method name from request
$method_name = $_GET['method_name'] ?? '';

if (empty($method_name)) {
    echo json_encode(['status' => 'error', 'message' => 'Method name is required']);
    exit();
}

// Prepare and execute the query
$stmt = $conn->prepare("SELECT upi_id FROM payment_methods WHERE method_name = ?");
$stmt->bind_param("s", $method_name);
$stmt->execute();
$stmt->bind_result($upi_id);

if ($stmt->fetch()) {
    echo json_encode(['status' => 'success', 'upi_id' => $upi_id]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'UPI ID not found for the given payment method']);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
