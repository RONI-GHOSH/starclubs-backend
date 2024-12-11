<?php
include '../includes/config.php';

// 	$id = $_POST['id'];
// 	$betdate = $_POST['betdate'];
$totalamt = 0;
$betamt = 0;
$winamt = 0;

	$sql = "SELECT COUNT(w_transaction_id) as cont , SUM(transaction_amount) as amt FROM wallet_transaction WHERE transaction_type='WithdrawAmt' AND Date(transaction_update_date)=Date('$date') ORDER BY w_transaction_id DESC";

	$qry = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($qry);
    $winamt = $row['amt'];


    $sql1 = "SELECT COUNT(w_transaction_id) as cont , SUM(transaction_amount) as amt FROM wallet_transaction WHERE transaction_type='AddAmt' AND Date(transaction_update_date)=Date('$date') ORDER BY w_transaction_id DESC ";

	$qry1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($qry1);
    $betamt = $row1['amt'];

    $totalamt = $betamt - $winamt;

    if ($totalamt > 0) {
    	$type = "Profit";
    }elseif($totalamt == 0){
    	$type = "Noloss";
    }else{
    	$type = "Loss";
    }

    $data['data'] = array(
		"betamt" =>$betamt,
		"winamt" =>$winamt,
		"totalamt" =>$totalamt,
		"type" =>$type,
	);

echo json_encode($data);

?>


