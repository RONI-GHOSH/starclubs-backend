<?php
include '../includes/config.php'; // Include database connection

// Get selected parameters from AJAX request
$opening_date = $_POST['betdate'];
$betting_date = date('y-m-d', strtotime($opening_date));
$market_id = $_POST['gameName'];


// 2024-02-11<br/>12:00 am<br/>5002<br/>Color 
$sql = "SELECT bet_num, SUM(bet_amount) AS total_bet_amt FROM colormarketbat WHERE statLineBatTime='$market_id' AND betting_date='$betting_date' AND game_name='Color' GROUP BY bet_num";
// Execute the query
$result = mysqli_query($conn, $sql);
// Check if query was successful
if ($result) {
    $min_total_bet_amt = PHP_INT_MAX; // Initialize minimum total amount to a large value
    // Initialize variable to store bet_num with minimum total amount
    $bet_num_min_total = null;
    // Fetch the results and iterate through them
    while ($row = mysqli_fetch_assoc($result)) {
        $bet_num = $row['bet_num'];
        $total_bet_amt = $row['total_bet_amt'];
        // Check if current total amount is less than minimum total amount
        if ($total_bet_amt < $min_total_bet_amt) {
            $min_total_bet_amt = $total_bet_amt; // Update minimum total amount
            $bet_num_min_total = $bet_num; // Update bet_num with minimum total amount
        }
    }
    // Print the bet_num with minimum total amount
    $minnumber = $bet_num_min_total;
    $sqlcolor = "SELECT color_name FROM color WHERE color_id='$minnumber'";
    $querycolor = mysqli_query($conn, $sqlcolor);
    $rowcolor_name = mysqli_fetch_array($querycolor);
    $color_name = $rowcolor_name['color_name'];
}
$sql = "SELECT bet_num, SUM(bet_amount) AS total_bet_amt FROM colormarketbat WHERE statLineBatTime='$market_id' AND betting_date='$betting_date' AND game_name='Lottery Type' GROUP BY bet_num";
// Execute the query
$result = mysqli_query($conn, $sql);
// Check if query was successful
if ($result) {
    $min_total_bet_amt = PHP_INT_MAX; // Initialize minimum total amount to a large value
    // Initialize variable to store bet_num with minimum total amount
    $bet_num_min_total = null;
    // Fetch the results and iterate through them
    while ($row = mysqli_fetch_assoc($result)) {
        $bet_num = $row['bet_num'];
        $total_bet_amt = $row['total_bet_amt'];
        // Check if current total amount is less than minimum total amount
        if ($total_bet_amt < $min_total_bet_amt) {
            $min_total_bet_amt = $total_bet_amt; // Update minimum total amount
            $bet_num_min_total = $bet_num; // Update bet_num with minimum total amount
        }
    }
    // Print the bet_num with minimum total amount
    $minnumber = $bet_num_min_total;
}
if ($color_name != '' and $minnumber != '') {
    echo $color_name . " - " . $minnumber;
}
if ($color_name != '' and $minnumber == '') {
    echo $color_name . " - No Bat for Lottery Number";
}
if ($color_name == '' and $minnumber != '') {
    echo "No Bat for Color - " . $minnumber;
}
if ($color_name == '' and $minnumber == '') {
    echo "Select Result Date and Game Name First!";
}
exit;
