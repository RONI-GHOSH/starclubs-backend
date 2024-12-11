<?php
include '../includes/config.php';

if (isset($_POST['update-amount'])) {
    $game_amount = $_POST['game_amount'];
    $id = $_POST['id'];
    // $dataid = explode(' ', $id);
    $size = sizeof($id);
    for ($i=0; $i < $size; $i++) { 
        $gemAmount = $game_amount[$i];
        $varId = $id[$i];
        $sql = "UPDATE `game_rate` SET `game_amount`='$gemAmount' WHERE id='$varId'";
        $out = mysqli_query($conn,$sql);        
    }

    if($out <= 0) {
       echo '<script>alert("Rate Update Failed");window.location = "../game-rate.php";</script>';
    }else{
        echo '<script>alert("Rate Update Successfully");window.location = "../game-rate.php";</script>';
    }
}

?>