<?php
include '../includes/config.php';

    $betnum = $_POST['betnum'];
    $betid = $_POST['betid'];
    
    $sql = "UPDATE `starlinemarketbat` SET bet_num='$betnum' WHERE id='$betid'";
    
    if(!mysqli_query($conn,$sql)) 
    {
        echo $response = "Number Not Update Successfully"; 
    }
    else
    {
         echo $response = "Number Update Successfully"; 
    }
?>