<?php
include '../includes/config.php';

	$id = $_POST['id'];
	$betdate = $_POST['betdate'];
	$endbetdate = $_POST['endbetdate'];

    $sql = "SELECT * , SUM(betting_amount) as amt , COUNT(betting_id) as cont FROM betting WHERE Date(betting_date) BETWEEN Date('$betdate') AND Date('$endbetdate') ORDER BY betting_id DESC";
    $starLinesql = "SELECT SUM(bet_amount) as idc FROM starlinemarketbat WHERE DATE(betting_date) BETWEEN Date('$betdate') AND Date('$endbetdate') ORDER BY id DESC"; 
    $starqry = mysqli_query($conn, $starLinesql);
    $starrow = mysqli_fetch_assoc($starqry);
    $starnum = $starrow['idc'] ?: '0';

    $qry = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($qry);
    $betamt = $row['amt'] ? : '0' + $starnum;
    


    $sql1 = "SELECT * , SUM(transaction_amount) as amt , COUNT(w_transaction_id) as cont FROM `wallet_transaction` WHERE transaction_type='WinningBat' AND Date(transaction_update_date) BETWEEN Date('$betdate') AND Date('$endbetdate')";

	$qry1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($qry1);
    $winamt = $row1['amt'];
    
    $refersql = "SELECT * , SUM(transaction_amount) as amt , COUNT(w_transaction_id) as cont FROM `wallet_transaction` WHERE transaction_type='ReferAmt' AND Date(transaction_update_date) BETWEEN Date('$betdate') AND Date('$endbetdate')";
    $referqry = mysqli_query($conn, $refersql);
    $referrow = mysqli_fetch_assoc($referqry);
    $totalreferr = $referrow['amt'] ?: '0';
    $totalMinus = $winamt+$totalreferr;
    $totalamt = $betamt - $totalMinus;

    if ($totalamt > 0) {
    	$type = "Profit";
    }elseif($totalamt == 0){
    	$type = "Noloss";
    }else{
    	$type = "Loss";
    }

    $data['data'] = array(
		"betamt" => number_format($betamt, 2),
		"winamt" => number_format($winamt, 2),
		"totalamt" => number_format($totalamt, 2) ,
		"totalreferramt" => number_format($totalreferr, 2) ,
		"type" =>$type,
	);

echo json_encode($data);

?>


