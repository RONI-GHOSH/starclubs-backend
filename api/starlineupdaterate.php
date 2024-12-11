<?php
include '../includes/config.php';

if (isset($_POST['update-amount'])) {
    $gameRate = $_POST['gameRate'];
    
    $id = $_POST['id'];
    
    $sql = "UPDATE `starlinerate` SET `gameRate`='$gameRate' WHERE id='$id'";
    if(!mysqli_query($conn,$sql)) {
       echo '<script>alert("Rate Update Failed");window.location = "../starline_rate.php";</script>';
    }else{
        echo '<script>alert("Rate Update Successfully");window.location = "../starline_rate.php";</script>';
    }
}



?>