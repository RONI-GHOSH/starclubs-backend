<?php
include '../config.php';
$mobileNum = $_POST["mobileNum"];
$coutry_code = "91";
$mobile = $coutry_code.$mobileNum;
$status = $_POST["status"];


$authkey = "#";
$route = "otp";

$newotp = rand(1111,9999);


$response=array();
if ($status== "0"){
$sql = "SELECT * FROM member WHERE member_mobile = '$mobileNum'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows( $result)>0) {
	$row = mysqli_fetch_array($result);
	$mobileNo = $row['member_mobile'];
		if($mobileNo == $mobileNum) {
			$response = ["status"=>"allReadyExist"];
		}else{
			$csql = "SELECT otp_mobile, otp_status , otp_digit FROM send_otp WHERE otp_mobile = '$mobileNum' AND otp_status ='Pending' ORDER BY DESC";
			$cqry = mysqli_query($conn , $csql);
				if(mysqli_num_rows($cqry)>0) {
					$crow = mysqli_fetch_array($cqry);
					$newotp = $crow['otp_digit'];
				}else{
					$osql = "INSERT INTO send_otp(otp_mobile, otp_digit, otp_status) VALUES ('$mobileNum','$newotp','Pending')";
					if(!mysqli_query($conn, $osql)){
				// 		echo $newotp ."Not Done";
				        $newotp;
					}else {
				// 		echo $newotp ."Done";
				        $newotp;
					}
				}

			$fields = array(
			    "variables_values" => $newotp,
			    "route" => $route,
			    "numbers" => $mobileNum,
			);

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode($fields),
			  CURLOPT_HTTPHEADER => array(
			    "authorization: $authkey",
			    "accept: */*",
			    "cache-control: no-cache",
			    "content-type: application/json"
			  ),
			));

			$res = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			 // echo "cURL Error #:" . $err;
			  $result_otp = 'Incorrect';
			} else {
			 // echo $res;
			  $result_otp = 'success';
			}

			// if ($res['return'] == true){
			// 	$result_otp = 'success'
			// }else {
			// 	$result_otp = 'Incorrect'
			// }

			$response=['otp'=>$result_otp,'status'=>'success'];
			}
		}else{
		    $csql = "SELECT otp_mobile, otp_status , otp_digit FROM send_otp WHERE otp_mobile = '$mobileNum' AND otp_status ='Pending' ORDER BY otp_id DESC";
			$cqry = mysqli_query($conn , $csql);
				if(mysqli_num_rows($cqry)>0) {
					$crow = mysqli_fetch_array($cqry);
					$newotp = $crow['otp_digit'];
				}else{
					$osql = "INSERT INTO send_otp(otp_mobile, otp_digit, otp_status) VALUES ('$mobileNum','$newotp','Pending')";
					if(!mysqli_query($conn, $osql)){
				// 		echo $newotp ."Not Done";
				        $newotp;
					}else {
				// 		echo $newotp ."Done";
				        $newotp;
					}
				}

			$fields = array(
			    "variables_values" => $newotp,
			    "route" => $route,
			    "numbers" => $mobileNum,
			);

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode($fields),
			  CURLOPT_HTTPHEADER => array(
			    "authorization: $authkey",
			    "accept: */*",
			    "cache-control: no-cache",
			    "content-type: application/json"
			  ),
			));

			$res = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			 // echo "cURL Error #:" . $err;
			  $result_otp = 'Incorrect';
			} else {
			 // echo $res;
			  $result_otp = 'success';
			}

			$response=['otp'=>$result_otp,'status'=>'success'];
			}
	} else {

	$otp = $_POST["otp"];

	$checksql = "SELECT otp_mobile, otp_status , otp_digit FROM send_otp WHERE otp_mobile = '$mobileNum' AND otp_digit='$otp' AND otp_status ='Pending' ORDER BY otp_id DESC ";
	$checkqry = mysqli_query($conn , $checksql);
		if(mysqli_num_rows($checkqry)>0) {
			$upsql = "UPDATE send_otp SET otp_status = 'Verified'";
			if(mysqli_query($conn, $upsql)){
				$otpsts = 'otp_verified';
			}else {
				$otpsts = 'issue';
			}
		}else{
			$otpsts = 'issue';
		}


	if ($otpsts == "otp_verified")
	{
			$response=['mobile'=>$mobileNum,
					'status'=>'success'
				];
	}
	else if($otpsts == "already_verified")
	{
		$response=['mobile'=>$mobileNum,'status'=>'already_verified'];
	}
	else{
		$response=['mobile'=>$mobileNum,'status'=>'Incorrect'];;
	}
}
echo json_encode($response);
?>