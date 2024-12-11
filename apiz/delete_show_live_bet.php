<?php
include '../includes/config.php';

	$betid = $_POST['id'];
	
	$sql = "UPDATE betting SET betting_status='Delete' WHERE betting_id ='$betid' ";

	$qry = mysqli_query($conn,$sql);
	if ($qry > 0) 
	{
		echo '<div class="alert alert-success alert-dismissible alert-alt fade show text-center">
	                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span>×</span>
	                </button> Bet List Detail Deleted Successfully !
	            </div>';
    }
	else
	{
		echo '<div class="alert alert-danger alert-dismissible alert-alt fade show text-center">
	                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span>×</span>
	                </button> Bet List Not Deleted Successfully !
	            </div>';
	}
	        
	
// echo $response;

?>