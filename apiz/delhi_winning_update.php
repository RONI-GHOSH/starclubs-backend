<?php
include '../includes/config.php';

$betnum = $_POST['betnum'];
$betid = $_POST['betid'];

$sql = "UPDATE `betting` SET betting_number='$betnum' WHERE betting_id='$betid'";

if(!mysqli_query($conn,$sql)) 
{
    echo $response = "Winner List Not Updated Successfully"; 
}
else
{
    echo $response = "Winner List Updated Successfully"; 
}
?>