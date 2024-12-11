<?php
include '../includes/config.php';
// Set the Content-Type to JSON
header('Content-Type: application/json');

// Query to get the QR code URL
$sql = "SELECT qr_code_url FROM payment_qr WHERE id = 1"; // Adjust the ID if needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the QR code URL
    $row = $result->fetch_assoc();
    $response = ['qr_code_url' => $row['qr_code_url']];
} else {
    $response = ['qr_code_url' => null];
}

echo json_encode($response);

$conn->close();

?>

