<?php
include '../includes/config.php';

if (isset($_POST['update-member'])) {
    $market_name = $_POST['member_name'];
    $market_open = $_POST['member_mobile'];
    $market_close = $_POST['member_username'];
    
    $market_id = $_POST['member_id'];
    
    $sql = "UPDATE `member` SET `member_name`='$market_name', `member_mobile`='$market_open', `member_username`='$market_close' WHERE member_id='$market_id'";
    if(!mysqli_query($conn,$sql)) {
       echo '<script>alert("Member Update Failed");window.location = "../member_list.php";</script>';
    }else{
        echo '<script>alert("Member Update Successfully");window.location = "../member_list.php";</script>';
    }
}



?>