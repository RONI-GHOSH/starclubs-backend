<?php
include '../includes/config.php';

if (isset($_POST['gameActiveStatus'])) {
    $status = $_POST['gameActiveStatus'];
    $member_id = $_POST['id'];

    $sql = "UPDATE `routtetgame` SET gameActiveStatus='$status' WHERE id='$member_id'";
    if (!mysqli_query($conn, $sql)) {
        // echo '<script>alert("Member Update Failed");window.location = "../member_list.php";</script>';
        echo $resp = "fail";
    } else {
        // echo '<script>alert("Member Update Successfully");window.location = "../member_list.php";</script>';
        echo $resp = "pass";
    }
}
