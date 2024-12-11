<?php 
include '../config.php';
$response=array();
$member_id = $_POST['member_id'];
$market_id = $_POST['market_id'];
$market_name = $_POST["market_name"];
$game_name =$_POST['game_name'];
$game_id = $_POST['game_id'];
$choice_id = $_POST['choice_id'];
$bat_number_sangam_one = $_POST['bat_number_sangam_one'];
$bat_number_sangam_second = $_POST['bat_number_sangam_second'];
$bet_type = $_POST['bet_type'];
$bat_amount = $_POST['bat_amount'];
$timec =   date('H:i');

$bet_date = $date;
$date_transection = $date;
$bet_time = $time;
$bet_status = "Active";

$con = $conn;
$mbalance=0;
$balance = 0;

 if($game_name=="Half Sangam")
{
  $choice_id=  6;
  $bet_type="Close";
}
else if($game_name=="FullSangam")
{
  $choice_id=  7;
  $bet_type="Close";
}

$msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id'";
$mquery = mysqli_query($conn, $msql);
if ($mrow = mysqli_fetch_array($mquery)) {
	$mbalance = $mrow['member_wallet_balance'];
}
$balance = $mbalance - $bat_amount;


$timestamp = microtime(true);
// Convert to millisecond precision
$milliseconds = round($timestamp * 1000);
// Generate a random number between 0 and 999 to append to the milliseconds
$random = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
// Concatenate milliseconds and random number to create a unique token

$token1 = $milliseconds . $random . $market_id;



if ($balance >= '0') 
{
	$checkQuery = "SELECT * FROM market WHERE market_id = '$market_id'";
	$checkResult = mysqli_query($conn,$checkQuery);
	$checkRow = mysqli_fetch_array($checkResult);

	$closetime =	$checkRow["market_close_time"];
	$opentime  =     $checkRow["market_open_time"];
	$activestatus="";
	if(strtotime($timec)>=strtotime($opentime) && strtotime($timec)<=strtotime($closetime))
	{
	   $activestatus="Close" ;
	}
	else if(strtotime($opentime)>=strtotime($timec) )
	{
	   $activestatus="Active"; 
	   setBet($member_id,$market_id,$game_id,$choice_id,$bat_number_sangam_one,$bat_number_sangam_second,$bat_amount,$bet_type,$bet_date,$bet_time,$bet_status,$balance,$market_name,$game_name,$date_transection,$token1);
	}
	else if(strtotime($closetime)<strtotime($timec))
	{
	   $activestatus="Betting" ; 
	}

	// if($checkRow['active_status'] == 'Betting' | $checkRow['active_status'] == 'betting' ){
	// 	$response=["status"=>"closed"]; 
	// }
	// else if($checkRow['active_status'] == 'Removed' | $checkRow['active_status'] == 'removed'){
	//     $response = ["status"=>"removed"];
	// }
	// else if($checkRow['active_status'] == 'Close' | $checkRow['active_status'] == 'close' ){
	// 	$response=["status"=>"closed"]; 
	// }
	// else {
    //    //set bet here
	// 	setBet($member_id,$market_id,$game_id,$choice_id,$bat_number_sangam_one,$bat_number_sangam_second,$bat_amount,$bet_type,$bet_date,$bet_time,$bet_status,$balance,$market_name,$game_name,$date_transection);
	// }
}
else
{
	$response=["status"=>"Low Wallet Balance"]; 
}
function setBet($member_id,$market_id,$game_id,$choice_id,$bat_number_sangam_one,$bat_number_sangam_second,$bat_amount,$bet_type,$bet_date,$bet_time,$bet_status,$balance,$market_name,$game_name,$date_transection,$token1){
         $sql = "INSERT INTO betting(b_member_id, b_market_id, b_game_id, b_game_cid, betting_number,betting_number_second, betting_amount, betting_time_type, betting_date, betting_time, betting_status,token1) VALUES ('$member_id','$market_id','1','$choice_id','$bat_number_sangam_one','$bat_number_sangam_second','$bat_amount','$bet_type','$bet_date','$bet_time','$bet_status', '$token1')";
		if (mysqli_query($GLOBALS['con'], $sql)) 
		{
		    $lastid = mysqli_insert_id($GLOBALS['con']);

			$usql = "UPDATE member_wallet SET member_wallet_balance ='$balance' WHERE member_id='$member_id'";
			if(mysqli_query($GLOBALS['con'],$usql)){
				$num = rand(10000,100000); 
				$pre = "SANGAMBAT";

				$trans = $pre.$num.$lastid;

				$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, market_name, game_name, bet_type , bat_number, token1) VALUES ('$trans','$bat_amount','$member_id','$date_transection','SangamBat','$market_name','$game_name','$bet_type','$bat_number_sangam_one', 'token1')";
				if (mysqli_query($GLOBALS['con'], $msql)) {
					$GLOBALS['response']=["status"=>"success","betid"=>$lastid,"new_amout_wallet_after_game"=>$balance]; 
				}
			} else {
				$GLOBALS['response']=["status"=>"Failure"]; 
			}
		}
		else {
				$GLOBALS['response']=["status"=>"Failure"]; 
			}
}

echo json_encode($response);

?>