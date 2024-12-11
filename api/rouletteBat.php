<?php
include '../config.php';
$response=array();

$member_id = $_POST['member_id'];
$bat_number = $_POST['bat_number'];
$bat_amount = $_POST['bat_amount'];
$bat_open_time = $_POST['bat_open_time'];
$bat_close_time = $_POST['bat_close_time'];
$gameid = $_POST['gameid'];
$active_status = "active";

$bet_date = $date;
$date_transection = $date;
 $bet_time = date("Y-m-d h:i");
$bet_status = "Active";



$con = $conn;
$mbalance=0;
$balance = 0;
$msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id'";
$mquery = mysqli_query($conn, $msql);
if ($mrow = mysqli_fetch_array($mquery)) {
	$mbalance = $mrow['member_wallet_balance'];
}
$balance = $mbalance - $bat_amount;

if($balance>='0')
{
	batRoulette($member_id,$bat_number,$bat_amount,$bat_open_time,$bat_close_time,$date_transection,$balance,$active_status,$gameid);
}
else 
{
	$response = ["status"=>"Low Wallet points"];
}
function batRoulette($member_id,$bat_number,$bat_amount,$bat_open_time,$bat_close_time,$date_transection,$balance,$active_status,$gameid){

    global $bet_time;
	$sql = "INSERT INTO roulettebat (member_id,bat_number,bat_amount,bat_open_time,bat_close_time,active_status,gameid) VALUES ('$member_id','$bat_number','$bat_amount','$bat_open_time','$bat_close_time','$active_status',$gameid)";
	if (mysqli_query($GLOBALS['con'],$sql)) 
	{
		$lastid = mysqli_insert_id($GLOBALS['con']);
		$usql = "UPDATE member_wallet SET member_wallet_balance ='$balance' WHERE member_id='$member_id'";
		if(mysqli_query($GLOBALS['con'],$usql)){
			$num = rand(10000,100000);
			$pre = "ROULETTEGAME";
			$trans = $pre.$num.$lastid;
			 $msql = "INSERT INTO roulettetransectionhistroy(transaction_id,transaction_amount, member_id, transaction_update_date, transaction_type, game_name , bat_number ,roulette_open_time,roulette_close_time)VALUES ('$trans','$bat_amount','$member_id','$bet_time','RouletteGame','RouletteGame','$bat_number','$bat_open_time','$bat_close_time')";
			if (mysqli_query($GLOBALS['con'], $msql)) {
				$GLOBALS['response'] = ["status"=>"success","betid"=>$lastid,"new_amout_wallet_after_game"=>$balance]; 
			}
		}else {
			$GLOBALS['response']=["status"=>"Failure"]; 
		}
	}




}


echo json_encode($response)
?>