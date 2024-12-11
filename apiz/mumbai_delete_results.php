<?php
include '../includes/config.php'; // Include database connection

// Get selected parameters from AJAX request
$opening_date = $_POST['betdate'];
$market_id = $_POST['gameName'];
$session = $_POST['session'];

// Fetch declared results based on selected parameters
if ($session == "Open") 
{
    $sql = "SELECT * FROM winningbetting_detail WHERE opening_date = '$opening_date' AND market_id ='$market_id'";
    $result = mysqli_query($conn, $sql);
    // Prepare options for the dropdown
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $winning_number_first = $row['winning_number_first'];        
        echo $winning_number_first;
        exit;
    } else {
        echo $winning_number_first = "No Result Declared Yet!";
        exit;
    }
}
if ($session == "Close") {
    $sql = "SELECT * FROM winningbetting_detail WHERE opening_date = '$opening_date' AND market_id ='$market_id'";
    $result = mysqli_query($conn, $sql);
    // Prepare options for the dropdown
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $winning_number_fouth = $row['winning_number_fouth'];
        echo $winning_number_fouth;
        exit;
    } else {
        echo $winning_number_fouth = "No Result Declared Yet!";
        exit;
    }
}