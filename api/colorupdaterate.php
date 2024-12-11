<?php
include '../includes/config.php';

if (isset($_POST['update-amount'])) {
    $gameRate = $_POST['gameRate'];
    
    $id = $_POST['id'];
    
    $sql = "UPDATE `colorrate` SET `gameRate`='$gameRate' WHERE id='$id'";
    if(!mysqli_query($conn,$sql)) {
       echo '<script>alert("Rate Update Failed");window.location = "../color_rate.php";</script>';
    }else{
        echo '<script>alert("Rate Update Successfully");window.location = "../color_rate.php";</script>';
    }
}



?>