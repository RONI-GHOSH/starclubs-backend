<?php
include '../includes/config.php';

$memberid = $_POST['id'];

$sql = "UPDATE colormarketbat SET active_status='Delete' WHERE id ='$memberid' ";

$qry = mysqli_query($conn,$sql);
if ($qry > 0) 
{
	echo '<div class="alert alert-success alert-dismissible alert-alt fade show text-center">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span>×</span>
                </button> color Deleted Successfully !
            </div>';
}
else
{
	echo '<div class="alert alert-danger alert-dismissible alert-alt fade show text-center">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span>×</span>
                </button> color Not Deleted Successfully !
            </div>';
}
// echo $response;

?>