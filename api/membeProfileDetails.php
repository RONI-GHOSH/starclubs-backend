<?php
include '../config.php';

// $member_id ="19";
$member_id = $_POST['member_id'];

$sql = "SELECT * FROM member m INNER JOIN member_wallet mw ON m.member_id = mw.member_id WHERE m.member_id='$member_id'";
$result= mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
	$list =array();
	while ($row = mysqli_fetch_assoc($result)) {
	 
	    
	    $phone = $row['member_mobile'];
	   // $phone = "09350943256";
        $result1 = substr($phone, 0, 2);
        $result1 .= "******";
        $result1 .= substr($phone, 7, 2);
        
        $wallet_balance = (float)$row['member_wallet_balance']; // Cast to float for comparison
        if ($wallet_balance < 0) {
            $wallet_balance = 0; // Set to 0 if negative
        }
		$temp = [
		        "member_status"=>$row['status'],
		        "member_transferstatus"=>$row['status_second'],
		        "member_bettingstatus"=>$row['status_third'],
		        "member_status"=>$row['status'],
				"member_name"=>$row['member_name'],
				"member_mobile"=>$result1,
				"member_wallet_balance"=>$row['member_wallet_balance']
				];
	array_push($list, $temp);
	}
	$response = ["status"=>"success","profile_details"=>$list];
}
else{$response = ["status"=>"Failure"];}

echo json_encode($response);
?>