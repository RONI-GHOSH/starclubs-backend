<?php 
include '../config.php';

$member_id = $_POST['member_id'];
$memberlist=array();
	$memsql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id left join member_payment_getway mpg ON m.member_id=mpg.member_id  WHERE m.member_id='$member_id' ";
	$memqry = mysqli_query($conn, $memsql);
	if ($memrow = mysqli_fetch_array($memqry)) 
	{
		$name = $memrow['member_name'];
		$username = $memrow['member_username'];
		$balance = $memrow['member_wallet_balance'];
		$temp=["status"=>'success',
		"member_id"=>$member_id,
		"name"=>$name,
		"username"=>$username,
		"wallet_balance"=>$balance,
		"account_no"=>$memrow['account_no'],
		"bank_name"=>$memrow['bank_name'],
		"ifsc_code"=>$memrow['ifsc_code'],
		"ac_holder_name"=>$memrow['ac_holder_name'],
		"branch_name"=>$memrow['branch_name'],
		"paytm_no"=>$memrow['paytm_no'],
		"google_pay_no"=>$memrow['google_pay_no'],
		"phone_pay_no"=>$memrow['phone_pay_no']];
        array_push($memberlist,$temp);
       	$response=["status"=>'Success',"MemberDetailList"=>$memberlist]; 
	}
	else
	{
		$response=["status"=>'Failure']; 
	}

echo json_encode($response);

?>
