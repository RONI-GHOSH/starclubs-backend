<?php 
include '../config.php';       

$referralcode = $_POST['referralcode'];
$response = array();
$query ="SELECT * FROM member WHERE member_referral_code = '$referralcode'";
$result = mysqli_query($conn,$query);
$referralExists = mysqli_fetch_array($result);

if(!empty($referralExists)) {
    #Referral already exist
        $response = ["status"=> 200,"message"=>"Referral Exists"];
} else {
    $response = ["status"=> 204,"message"=>"Referral Does not Exists"];   
}

echo json_encode($response);

?>