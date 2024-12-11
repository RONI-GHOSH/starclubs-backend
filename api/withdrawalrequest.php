<?php 
include '../config.php';
include './SendFast2Sms.php';

    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];
    
    $date_transection = $date;

    $query1 = "SELECT * FROM admin";
    $result1 = mysqli_query($conn,$query1);
    $rows1 = mysqli_fetch_assoc($result1);
    $admin_mobilenumber = $rows1['mobile'];
     $withdrawal_request = $rows1['withdraw_request_limit'];

    $query2 = "SELECT * FROM member WHERE member_id='$member_id' ";
    $result2 = mysqli_query($conn,$query2);
    $rows2 = mysqli_fetch_assoc($result2);
    $name = $rows2['member_name'];
    $mobilenumber = $rows2['member_mobile'];

    $walletquery = "SELECT * FROM wallet_transaction WHERE member_id='$member_id' AND transaction_update_date='$date_transection'  AND transaction_type = 'WithdrawAmt' "; 
    $result = mysqli_query($conn,$walletquery);
        
        // Check the number of rows
        
         $rowCount = mysqli_num_rows($result);
        
        if($rowCount < $withdrawal_request ) { 
                    
            $msql = "SELECT * FROM member_wallet WHERE member_id='$member_id' ";
            $mquery = mysqli_query($conn, $msql);
            
            if ($mrow = mysqli_fetch_array($mquery)) {
            	$mbalance = $mrow['member_wallet_balance'];
            }
        
            $balance = $mbalance - $amount;
        
            if ($balance >= '0') {
        
        	$usql = "UPDATE member_wallet SET member_wallet_balance='$balance' WHERE member_id='$member_id'";
        		if(mysqli_query($conn,$usql)){
            			$num = rand(10000,100000);
            			$pre = "WDR";
            
            			$trans = $pre.$num.$member_id;
            			
            			$data['status'] = 'Withdraw Fund';
                    	sendSmsWithMessage($data,$admin_mobilenumber);
            
            			$msql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, transaction_type) VALUES ('$trans','$amount','$member_id','$date_transection','WithdrawAmt')";
            			if (mysqli_query($conn, $msql)) {
            				$response=["status"=>'success',"newbalance"=>$balance,"transaction_id"=>$trans,"status"=>'Processing'];
            			}
            		} else {
            			$response=["status"=>'Failure']; 
            		}
        
                } else {
                	$response=["status"=>'Low Wallet Balance']; 
                }
                        
            } else {
                
                $response=["status"=>'Daily Withdraw Limit Reached'];
            }

    echo json_encode($response);

?>
