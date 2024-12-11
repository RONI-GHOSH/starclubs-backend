    <?php 
    include '../config.php';
    $response=array();
    $member_id = $_POST['member_id'];
    $game_name =$_POST['game_name'];
    $game_id = $_POST['game_id'];
    $choice_id = $_POST['choice_id'];
    $bet_num = $_POST['bet_num'];
    $bet_amount = $_POST['bet_amount'];
    
    $statLineBatTime = $_POST["star_line_bat_time"];
    
    $betting_date = $date;
    $date_transection = $date;
    
    $t=time();
    $bet_time= date("Y-m-d h:i");
    $bet_status = "Active";	
    $con = $conn;
    $mbalance=0;
    $balance = 0;
    $msql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id=mw.member_id WHERE m.member_id='$member_id'";
    $mquery = mysqli_query($conn, $msql);
    if ($mrow = mysqli_fetch_array($mquery)) {
    	$mbalance = $mrow['member_wallet_balance'];
    }
    else {
    				$GLOBALS['response']=["status"=>"Failure"]; 
    			}
    $balance = $mbalance - $bet_amount;
    
    if ($balance >= '0') 
    {
           //set bet here
    		setBet($member_id,$choice_id,$game_name,$game_id,$bet_amount,$bet_num,$betting_date,$bet_time,$statLineBatTime,$bet_status,$balance,$date_transection);
    	
    }
    else
    {
    	$response=["status"=>"Low Wallet Balance"]; 
    }
    
    function setBet($member_id,$choice_id,$game_name,$game_id,$bet_amount,$bet_num,$betting_date,$bet_time,$statLineBatTime,$bet_status,$balance,$date_transection){
            $sql = "INSERT INTO starlinemarketbat(member_id, choice_id, game_name, game_id, bet_amount, bet_num,betting_date ,betting_time,statLineBatTime, active_status)VALUES ('$member_id','$choice_id','$game_name','$game_id','$bet_amount','$bet_num','$betting_date','$bet_time','$statLineBatTime','$bet_status')";
    		if (mysqli_query($GLOBALS['con'], $sql)) 
    		{
    		    $lastid = mysqli_insert_id($GLOBALS['con']);
    
    			$usql = "UPDATE member_wallet SET member_wallet_balance ='$balance' WHERE member_id='$member_id'";
    			if(mysqli_query($GLOBALS['con'],$usql)){
    				$num = rand(10000,100000);
    				$pre = "StarGame";
    
    				$trans = $pre.$num.$lastid;
    
    				$msql = "INSERT INTO starlinebattrasectionhistory(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type, game_name,bat_number)
    			VALUES ('$trans','$bet_amount','$member_id','$bet_time','StarLineBat','$game_name','$bet_num')";
    				if (mysqli_query($GLOBALS['con'], $msql)) 
    				{
    					$GLOBALS['response']=["status"=>"success","betid"=>$lastid,"new_amout_wallet_after_game"=>$balance]; 
    				}
    				else {
    				$GLOBALS['response']=["status"=>"Failure1"]; 
    			}
    			}else {
    				$GLOBALS['response']=["status"=>"Failure2"]; 
    			}
    		}
    		else {
    				$GLOBALS['response']=["status"=>"Failure"]; 
    			}
    }
    
    echo json_encode($response);
    
    ?>