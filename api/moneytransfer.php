<?php
include '../config.php';


// Get id using mobile number
$member_id = $_POST['member_id'];
$r_mobile = $_POST['mobile'];
$amount = $_POST['amount'];

$msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
$mquery = mysqli_query($conn, $msql);
if ($mrow = mysqli_fetch_array($mquery)) {
	$mbalance = $mrow['member_wallet_balance'];
}

$mrsql = "SELECT * FROM member_wallet WHERE member_id IN ( SELECT member_id FROM member WHERE member_mobile ='$r_mobile') ";
$mrquery = mysqli_query($conn, $mrsql);
if ($mrrow = mysqli_fetch_array($mrquery))
{
	$mrbalance = $mrrow['member_wallet_balance'];
	$r_member_id = $mrrow['member_id'];
} 
else
{
	$mrbalance = "0";
	$r_member_id = "NAN";
}

if ($r_member_id != "NAN") {

	if ($r_member_id != $member_id) 
	{

		$balance = $mbalance - $amount;
		$mrbalance = $mrbalance + $amount;

		if ($balance >= '0') {

			$usql = "UPDATE member_wallet SET member_wallet_balance='$balance' WHERE member_id='$member_id'";
			if (mysqli_query($conn, $usql)) {
				$num = rand(10000, 100000);
				// TRS = Tranfer Request Send
				$pre = "TRS";
				$pre1 ="TRR";

				$trans = $pre . $num . $member_id;
				$trans1 = $pre1 . $num .$member_id;

			$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, r_member_id, transaction_update_date, transaction_type) VALUES ('$trans','$amount','$member_id','$r_member_id','$date','TransferAmt')";
				$trans = $pre . $num . $member_id;
				if (mysqli_query($conn, $msql)) {


						$usql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$r_member_id'";
						if (mysqli_query($conn, $usql)) {
							$response = ["status" => 'success', "newbalance" => $balance, "transaction_id" => $trans];
						} else {
							$response = ["status" => 'Failure'];
						}
			
				}
				else {
					$response = ["status" => 'Failure'];
				}
			} else {
				$response = ["status" => 'Failure'];
			}
		} else {
			$response = ["status" => 'Insuficient fund in wallet'];
		}
	} else {
		$response = ["status" => 'You Can not transfer point your self'];
	}
} else {
	$response = ["status" => 'Mobile does not exist'];
}

echo json_encode($response);
