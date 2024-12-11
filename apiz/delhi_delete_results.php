<?php
include '../includes/config.php'; // Include database connection

// Get selected parameters from AJAX request
$opening_date = $_POST['betdate'];
$market_id = $_POST['gameName'];


// 2024-02-11<br/>12:00 am<br/>5002<br/>Color 

// Fetch declared results based on selected parameters
$sql = "SELECT * FROM winningbetting_detail WHERE opening_date = '$opening_date' AND market_id ='$market_id'";
$result = mysqli_query($conn, $sql);
// Prepare options for the dropdown
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $winning_number_first = $row['winning_number_second'];
    $winning_number_second = $row['winning_number_third'];
    echo $winning_number = $winning_number_first. $winning_number_second;
    exit;
} else {
    echo $winning_number = "No Result Declared Yet!";
    exit;
}
