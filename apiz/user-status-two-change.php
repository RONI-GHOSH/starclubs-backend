<?php

    include '../includes/config.php';

    $id = $_POST['id'];
    $status = $_POST['status'];

    unset($_POST['id']);
    // $data = $this->input->post();

    $sql = "UPDATE member SET status_second='$status' WHERE member_id ='$id' ";
    
    $qry = mysqli_query($conn,$sql);

    if($qry > 0)
        echo $status;
    else
        echo "fail";
?>