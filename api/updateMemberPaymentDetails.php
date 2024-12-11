<?php
include '../config.php';
$member_id = $_POST['member_id'];
$status = $_POST['status'];

if ($status == "bank") 
{
	$name = $_POST['ac_holder_name'];
	$account_no = $_POST['account_no'];
	$ifsc_code = $_POST['ifsc_code'];
	$bank_name = $_POST['bank_name'];
	$branch_name = $_POST['branch_name'];

	 $sql = "UPDATE member_payment_getway SET ac_holder_name = '$name',account_no = '$account_no',ifsc_code = '$ifsc_code',bank_name='$bank_name',branch_name = '$branch_name' WHERE member_id = '$member_id'";
		$result = mysqli_query($conn,$sql);
		$response = ["status"=>"Banksuccess"];
}

elseif ($status == "paytmNo") 
{
	$paytm_no = $_POST['paytm_no'];
	$sql1 = "UPDATE member_payment_getway SET paytm_no = '$paytm_no' WHERE member_id = '$member_id'";
		$result1 = mysqli_query($conn,$sql1);
		$response = ["status"=>"Paytmsuccess"];

}

elseif ($status == "googlePay") 
{
	 $google_pay_no = $_POST['google_pay_no'];
	 $sql2 = "UPDATE member_payment_getway SET google_pay_no = '$google_pay_no' WHERE member_id = '$member_id'";
		$result2 = mysqli_query($conn,$sql2);
		$response = ["status"=>"GooglePaysuccess"];	
}
elseif ($status == "phonepeNo") 
{
	$phone_pay_no = $_POST['phone_pay_no'];
	 $sql3 = "UPDATE member_payment_getway SET phone_pay_no = '$phone_pay_no' WHERE member_id = '$member_id'";
		$result3 = mysqli_query($conn,$sql3);
		$response = ["status"=>"Phonepesuccess"];
}

else
{
	$response = ["status"=>"failure"];
}
echo json_encode($response);




?>