<?php
include '../config.php';

$member_id = $_POST['member_id'];
$sql ="SELECT * FROM member_payment_getway WHERE member_id = '$member_id'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
	//it means we have got the rows
	$list = array();
	while($row = mysqli_fetch_assoc($result)){
		$temp = [
				"account_no"=>$row['account_no'],
				"bank_name"=>$row['bank_name'],
				"ifsc_code"=>$row['ifsc_code'],
				"ac_holder_name"=>$row['ac_holder_name'],
				"branch_name"=>$row['branch_name'],
				"paytm_no"=>$row['paytm_no'],
				"google_pay_no"=>$row['google_pay_no'],
				"phone_pay_no"=>$row['phone_pay_no']
			];
		array_push($list,$temp);
	}
	$response = ["status"=>"success","member_payment_details"=>$list];
}
else{
	$response = ["status"=>"failure"];
}
echo json_encode($response);
?>