<?php 
include '../config.php';

    $mobile = $_POST['mobile'];
    $mpin = $_POST['password'];
    $id = $_POST['id'];
    
            // Update the member's mobile number and MPIN in the database
        	echo $usql = "UPDATE member SET member_mobile='$mobile', member_passcode='$mpin' WHERE member_id='$id'";

        	if(mysqli_query($conn,$usql)) {
        		$lastid = mysqli_insert_id($conn);

            // Return success response
            echo json_encode(['status' => 'success', 'message' => 'User details updated successfully']);

        } else {
        // Return error response if accessed through a method other than POST
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }