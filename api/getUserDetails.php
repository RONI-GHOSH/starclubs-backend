<?php 
include '../config.php';

$member_id = $_POST['member_id'];

$sql = "SELECT * FROM member WHERE member_id='$member_id' ";
$query = mysqli_query($conn, $sql);
if($row=mysqli_fetch_array($query))
{
	$registerid=$row["member_id"];
	$memsql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$registerid' ";
	$memqry = mysqli_query($conn, $memsql);
	if ($memrow = mysqli_fetch_array($memqry)) {
		$name = $memrow['member_name'];
		$username = $memrow['member_username'];
		$balance = $memrow['member_wallet_balance'];
		$response=["status"=>'success',"member_id"=>$registerid,"name"=>$name,"username"=>$username,"wallet_balance"=>$balance];
	}else {
		$response=["status"=>'Failure']; 
	}
} else {
	$response=["status"=>'Failure']; 
}
echo json_encode($response);

?>