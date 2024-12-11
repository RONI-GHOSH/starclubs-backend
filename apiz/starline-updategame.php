<?php
include '../includes/config.php';

if (isset($_POST['update-starline'])) { 
    $starline_game_name = $_POST['starline_game_name']; 
    $starline_id = $_POST['starline_id'];
    
    $sql = "UPDATE `starLineMarketList` SET `star_name`='$starline_game_name' WHERE id ='$starline_id'";
    if(!mysqli_query($conn,$sql)) {
        echo '<script>alert("Starline Update Failed");window.location = "../starline-game-name.php";</script>';
    }else{
        echo '<script>alert("Starline Update Successfully");window.location = "../starline-game-name.php";</script>';
    }
}

?>