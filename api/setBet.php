<?php 
include '../config.php';
$response=array();
$member_id = $_POST['member_id'];
$market_id = $_POST['market_id'];
$market_name = $_POST["market_name"];
$game_name =$_POST['game_name'];
$game_id = $_POST['game_id'];
$choice_id = $_POST['choice_id'];
$bet_num = $_POST['bet_num'];
$bet_type = $_POST['bet_type'];
$bet_amount = $_POST['bet_amount'];

$bet_date = $date;
$date_transection = $date;
$bet_time = $time;
$bet_status = "Active";




$con = $conn;
$mbalance=0;
$balance = 0;


if($game_name=="Single Digite")
{
  $choice_id=  1;
}
else if($game_name=="Double digite")
{
  $choice_id=  2;
  $bet_type="";
}
else if($game_name=="Single Pana")
{
  $choice_id=  3;
}
else if($game_name=="Double Pana")
{
  $choice_id=  4;
}
else if($game_name=="Triple Pana")
{
  $choice_id=  5;
}
else if($game_name=="Half Sangam")
{
  $choice_id=  6;
   $bet_type="";
}
else if($game_name=="FullSangam")
{
  $choice_id=  7;
   $bet_type="";
}


$msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id'";
$mquery = mysqli_query($conn, $msql);
if ($mrow = mysqli_fetch_array($mquery)) {
	$mbalance = $mrow['member_wallet_balance'];
}
$balance = $mbalance - $bet_amount;

if ($balance >= '0') 
{
	$checkQuery = "SELECT active_status FROM market WHERE market_id = '$market_id'";
	$checkResult = mysqli_query($conn,$checkQuery);
	$checkRow = mysqli_fetch_array($checkResult);
	
	if($choice_id==2 || $choice_id==6 || $choice_id==7)
	{
        if($checkRow['active_status'] == 'Betting' | $checkRow['active_status'] == 'betting' ){
    		$response=["status"=>"closed"]; 
    	}
    	else if($checkRow['active_status'] == 'Removed' | $checkRow['active_status'] == 'removed'){
    	    $response = ["status"=>"removed"];
    	}
    	else if($checkRow['active_status'] == 'Close' | $checkRow['active_status'] == 'close' ){
  
    	    	$response = ["status"=>"closed"];
    		
    	}
    	else{
           //set bet here
    		setBet($member_id,$market_id,$game_id,$choice_id,$bet_num,$bet_amount,$bet_type,$bet_date,$bet_time,$bet_status,$balance,$market_name,$game_name,$date_transection);
    	}  
	}
	else
	{
	         if($checkRow['active_status'] == 'Betting' | $checkRow['active_status'] == 'betting' ){
    		$response=["status"=>"closed"]; 
    	}
    	else if($checkRow['active_status'] == 'Removed' | $checkRow['active_status'] == 'removed'){
    	    $response = ["status"=>"removed"];
    	}
    	else if($checkRow['active_status'] == 'Close' | $checkRow['active_status'] == 'close' ){
  
    	    if($bet_type == 'Close' | $bet_type == 'close'){
		    //set the bet
            setBet($member_id,$market_id,$game_id,$choice_id,$bet_num,$bet_amount,$bet_type,$bet_date,$bet_time,$bet_status,$balance,$market_name,$game_name,$date_transection);
		}
		else{
	    	$response = ["status"=>"only close"];
		}
    		
    	}
    	else{
           //set bet here
    		setBet($member_id,$market_id,$game_id,$choice_id,$bet_num,$bet_amount,$bet_type,$bet_date,$bet_time,$bet_status,$balance,$market_name,$game_name,$date_transection);
    	}     
	    
	}
	
	
	

}
else
{
	$response=["status"=>"Low Wallet Balance"]; 
}
function setBet($member_id,$market_id,$game_id,$choice_id,$bet_num,$bet_amount,$bet_type,$bet_date,$bet_time,$bet_status,$balance,$market_name,$game_name,$date_transection){
         $sql = "INSERT INTO betting(b_member_id, b_market_id, b_game_id, b_game_cid, betting_number, betting_amount, betting_time_type, betting_date, betting_time, betting_status) VALUES ('$member_id','$market_id','$game_id','$choice_id','$bet_num','$bet_amount','$bet_type','$bet_date','$bet_time','$bet_status')";
		if (mysqli_query($GLOBALS['con'], $sql)) 
		{
		    $lastid = mysqli_insert_id($GLOBALS['con']);

			$usql = "UPDATE member_wallet SET member_wallet_balance ='$balance' WHERE member_id='$member_id'";
			if(mysqli_query($GLOBALS['con'],$usql)){
				$num = rand(10000,100000);
				$pre = "BETGAME";

				$trans = $pre.$num.$lastid;

			 $msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, market_name, game_name, bet_type , bat_number) VALUES ('$trans','$bet_amount','$member_id','$date_transection','GameBat','$market_name','$game_name','$bet_type','$bet_num')";
				if (mysqli_query($GLOBALS['con'], $msql)) {
					$GLOBALS['response']=["status"=>"success","betid"=>$lastid,"new_amout_wallet_after_game"=>$balance]; 
				}
			}else {
				$GLOBALS['response']=["status"=>"Failure"]; 
			}
		}
}

echo json_encode($response);

?>