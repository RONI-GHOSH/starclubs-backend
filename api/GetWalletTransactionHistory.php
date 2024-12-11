<?php
include '../config.php';
$member_id = $_POST['member_id'];
	$list = array();

   $sql = "SELECT wt.*, mem0.member_name AS sendername FROM wallet_transaction wt INNER JOIN member mem0 ON wt.member_id = mem0.member_id WHERE (wt.transaction_type='AddAmt' OR wt.transaction_type='WithdrawAmt' OR wt.transaction_type='TransferAmt' OR wt.transaction_type='ReferAmt' ) AND  ( wt.member_id ='$member_id' OR wt.r_member_id ='$member_id') ORDER BY w_transaction_id DESC";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	while ($rows = mysqli_fetch_assoc($result))
	{
	    $rmember=$rows['r_member_id'];
	    $sendermemberId=$rows['member_id'];
	    $sendername=$rows['sendername'];
        $marketname= $rows['market_name'];
	    $game_name= $rows['game_name'];
	    $bet_type = $rows['bet_type'];
	    $bat_number="";
	    $transaction_type = $rows['transaction_type'];
	    $transaction_title="";
	    $receivername="";
	    $sqll = "SELECT member_name , member_id  FROM member WHERE member_id = '$rmember'";
		$resultt = mysqli_query($conn,$sqll);

		if (mysqli_num_rows($resultt) > 0) 
		{
		    $rowss = mysqli_fetch_assoc($resultt);
		    $receivername=  $rowss['member_name'];
	    }
	    $newtransaction_type="";
	    if($transaction_type=="AddAmt")
	    {
	        $transaction_title="Add money to wallet";
	        $newtransaction_type="Add";
	    }
	    else if($transaction_type=="WithdrawAmt")
	    {
	       $transaction_title="Withdrawl Request Amount";
	       $newtransaction_type="Sub";
	    }
	    else if($transaction_type=="ReferAmt")
	    {
	       $transaction_title="Referral Request Amount";
	       $newtransaction_type="Sub";
	    }
	    
	    else if($transaction_type=="TransferAmt")
	    {
	        if($sendermemberId==$member_id)
	        {
	           $transaction_title="you sent money to $receivername"; 
	           $newtransaction_type="Sub";
	        }
	        else
	        {
	            $transaction_title="Money Recived from $sendername";
	            $newtransaction_type="Add";
	        }
	    }
	    
	   // $newtransaction_type;
	    
	$temp = ["transaction_title"=>$transaction_title,
		     "SenderName"=>$rows['sendername'],
		     "ReciverName"=>$receivername,
			"transaction_id"=>$rows['transaction_id'],
			"transaction_amount"=>$rows['transaction_amount'],
			"transaction_update_date"=>$rows['transaction_update_date'],
			"transaction_type"=>$newtransaction_type,
			"transferTo"=>$rows['transferTo'],
			"market_name"=>$rows['market_name'],
			"bat_number"=>$bat_number,
			"game_name"=>$rows['game_name'],
			"bet_type" =>$rows['bet_type']

		];
		array_push($list, $temp);
	}
		$response = ["status"=>"success","TransectionHistoryList"=>$list];
	}
	else
	{
		$response = ["status"=>"failure"];
	}
	echo json_encode($response);


?>