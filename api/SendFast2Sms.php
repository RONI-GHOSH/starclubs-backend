<?php

    function sendSmsWithMessage($data,$mobileNum) {
    
        $authkey = "#";
        $route = "otp";
        if($data['status'] == 'New User') {
                $newotp = '1111';
        } elseif($data['status'] == 'New Fund') {
             $newotp = '2222';
        } else {
            $newotp = '3333';
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
			  $result_otp = 'Message Not Sent '.$err;
			} else {
			  $result_otp = 'Message Sent';
			}

			$response=['message'=>$result_otp,'status'=>'success'];
			//echo json_encode($response);
           
    }
?>