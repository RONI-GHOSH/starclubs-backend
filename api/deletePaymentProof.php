<?php
// Include database connection
include '../includes/config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);  // Get the payment proof ID from the URL

    // SQL to update the status to 'Rejected'
    $update_sql = "UPDATE payment_proof SET status = 'Rejected' WHERE id = $id";

    if (mysqli_query($conn, $update_sql)) {
        // If successful, redirect back to the page
         echo json_encode(['status' => 'success']);
        exit;
    } else {
        // If an error occurs, redirect back with an error message
         echo json_encode(['status' => 'failed']);
        exit;
    }
} else {
    // If no id was provided, redirect back with an error message
     echo json_encode(['status' => 'failed']);
    exit;
}
?>
