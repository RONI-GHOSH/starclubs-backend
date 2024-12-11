
<?php 
include '../config.php';
include './SendFast2Sms.php';

function generateNumberCode($length) {
    $length = max(1, min($length, PHP_INT_MAX - 1));
    $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
    return $randomNumber;
}
        
$name = $_POST['name'];
$mobileNum = $_POST['mobileNum'];
$password = $_POST['password'];
$member_psasscode = $_POST['member_passcode'];
$referralcode = isset($_POST['referralcode']) ? $_POST['referralcode'] : '';
$response = array();
$query ="SELECT COUNT(*) FROM member WHERE member_mobile = '$mobileNum'";
$result = mysqli_query($conn,$query);
$r = mysqli_fetch_array($result);

$query1 = "SELECT * FROM admin";
$result1 = mysqli_query($conn,$query1);
$rows1 = mysqli_fetch_assoc($result1);
$bonus = $rows1['welcome_bonus'];
$admin_mobilenumber = $rows1['mobile'];
$member_referral_code = generateNumberCode(6);

$msssql = "SELECT member_status as idc FROM admin WHERE id='1'";
$mssqry = mysqli_query($conn, $msssql);
$mssrow = mysqli_fetch_assoc($mssqry);
$mssnum = $mssrow['idc'] ?: 'Pending';


$r1 = $r[0];
if($r1 != 0) {
    #member already exist
        $response = ["status"=>"User Are All ready exist"];
}
else { 
        $sql = "INSERT INTO member(member_name, member_mobile, member_password,member_passcode , member_referral_code , status , status_second , status_third) VALUES ('$name' , '$mobileNum' , '$password','$member_psasscode','$member_referral_code', '$mssnum', '$mssnum' ,'$mssnum')";
        if(mysqli_query($conn, $sql)) {
                
                    $lastid = mysqli_insert_id($conn);
                    
                        $data['status'] = 'New User';
                    
                        sendSmsWithMessage($data,$admin_mobilenumber);

                if(!empty($referralcode)) {
                    
                    $referralsql = "SELECT member_id,member_referral_code FROM member WHERE member_referral_code='$referralcode'";
                    $referralqry = mysqli_query($conn, $referralsql);
                    $referralrow = mysqli_fetch_assoc($referralqry);
                    
                    $referralrownum = $referralrow['member_id'] ;
                    if(!empty($referralrownum) && isset($referralrownum)) {

                         $memberreferralsql = "INSERT INTO member_referral(member_id, referrer_id) VALUES ('$referralrownum','$lastid')"; 
                        if(mysqli_query($conn, $memberreferralsql)) {
                             $memberreferrallastid=mysqli_insert_id($conn);
                        }

                    }
                }

                $sql3="INSERT INTO member_payment_getway(member_id) VALUES ('$lastid')";
                if(mysqli_query($conn,$sql3)){
                        $sql2 = "INSERT INTO member_wallet(member_id, member_wallet_balance) VALUES ('$lastid','$bonus')";
                        if(mysqli_query($conn, $sql2)) 
                        {
                            $query ="SELECT * FROM member WHERE member_mobile = '$mobileNum'";
                            $result = mysqli_query($conn,$query);
                            $r = mysqli_fetch_array($result);
                            $memberstatus=  $r["status"];
                            $response=["status"=>"success","member_id"=>$lastid,"MemberStatus"=>$memberstatus];
                        }
                }
        }
        else {
                $response=["status"=>"failure"];
        }
}
echo json_encode($response);
?>

