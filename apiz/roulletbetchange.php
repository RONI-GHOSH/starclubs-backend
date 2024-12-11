<?php
include '../includes/config.php';

$maib_bet_id = $_REQUEST['get_id'];
$betting_number = $_POST['bet_number'];

$sql = "UPDATE `roulettebat` SET bat_number='$betting_number' WHERE id='$maib_bet_id'";

if (!mysqli_query($conn, $sql)) {
    $response = "Yes";
} else {
    $response = "No";
}

echo $response;
