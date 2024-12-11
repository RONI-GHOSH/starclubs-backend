<?php
include '../includes/config.php';

if (isset($_POST['status'])) {
    echo $status = $_POST['status'];    
    echo $member_id = $_POST['id'];
    
    $sql = "UPDATE `colorMarketList` SET active_status='$status' WHERE id='$member_id'";
    if(!mysqli_query($conn,$sql)) {
        // echo '<script>alert("Member Update Failed");window.location = "../member_list.php";</script>';
        echo $resp = "fail";
    }else{
        // echo '<script>alert("Member Update Successfully");window.location = "../member_list.php";</script>';
        echo $resp = "pass";
    }
}



?>