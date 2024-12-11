<?php
include '../includes/config.php';

if (isset($_POST['status'])) {
    $status = $_POST['status'];    
    $member_id = $_POST['member_id'];
    
    $sql = "UPDATE `member` SET status='$status' , `update_date`='$date'WHERE member_id='$member_id'";
    if(!mysqli_query($conn,$sql)) {
        echo '<script>alert("Member Update Failed");window.location = "../member_list.php";</script>';
    }else{
        echo '<script>alert("Member Update Successfully");window.location = "../member_list.php";</script>';
    }
}



?>