<?php
include '../includes/config.php';

if (isset($_POST['update-amount'])) {
    $game_amount = $_POST['game_amount'];
    
    $id = $_POST['id'];
    
    $sql = "UPDATE `game_rate` SET `game_amount`='$game_amount' WHERE id='$id'";
    if(!mysqli_query($conn,$sql)) {
       echo '<script>alert("Rate Update Failed");window.location = "../ratelist.php";</script>';
    }else{
        echo '<script>alert("Rate Update Successfully");window.location = "../ratelist.php";</script>';
    }
}



?>