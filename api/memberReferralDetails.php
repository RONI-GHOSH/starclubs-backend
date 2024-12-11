<?php 
include '../config.php';       

//$member_id ="1";
$member_id = $_POST['member_id'];
$memberquery ="SELECT * FROM member WHERE member_id = '$member_id'";
$memberresult = mysqli_query($conn,$memberquery);
$referralExists = mysqli_fetch_array($memberresult);
$referallcode = isset($referralExists['member_referral_code']) ? $referralExists['member_referral_code'] : '';

$sql = "SELECT 
    mr.referrer_id AS referrer_id,
    m2.member_name AS referrer_name
FROM 
    member m1
JOIN 
    member_referral mr ON m1.member_id = mr.member_id
JOIN 
    member m2 ON mr.referrer_id = m2.member_id
WHERE 
    m1.member_id = '$member_id'";
$result= mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
	$lists = array();
	while ($row = mysqli_fetch_assoc($result)) {
     

        $lists[] = $row;
    }
	$response = ["status"=>200,"referreralcode"=>$referallcode,"member_details"=>$lists];
} else {

    $response = ["status"=>204,"message" =>"No Referrals","referreralcode"=>$referallcode,"member_details"=>$lists];
}

echo json_encode($response);
?>