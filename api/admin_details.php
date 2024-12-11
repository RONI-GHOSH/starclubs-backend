<?php 
// Get the protocol (http or https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Get the server name (domain name)
$serverName = $_SERVER['SERVER_NAME'];

// Get the base URL
$baseUrl = $protocol . '://' . $serverName . '/';

include '../config.php';
$query = "SELECT * FROM admin";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result)) {
        $list = array();
        while ($rows = mysqli_fetch_assoc($result))
        {
            
            
                 $temp = ["name"=>$rows['name'],
                         "mobile"=>$rows['mobile'],
                         "whatsapp_number"=>$rows['whatsapp_number'],
                         "upi_id"=>$rows['upi_payment_id'],
                         "qr_status"=> $rows['qr_status'],
                         "qr_code"=> $baseUrl.'hmroyal/qrcode/'.$rows['qr_code'],
                         "paytm_upiid"=>$rows['upi_paytm_id'],
                         "phonpe_upiid"=>$rows['upi_phonepay_id'],
                         "googlepay_upiid"=>$rows['upi_googlePay_id'],
                         "otherupi_id"=>$rows['upi_payment_id'],
                         "paytm_upinote"=>$rows['paytm_upinote'],
                         "phonepe_upinote"=>$rows['phonepe_upinote'],
                         "google_paynote"=>$rows['google_paynote'],
                         "other_paynote"=>$rows['other_paynote'],
                              
                         "slider_status"=> $rows['slider_status'],
                         "notification_status"=> $rows['notification_status'],
                         "call_status"=> $rows['call_status'],
                         "whatsapp_status"=> $rows['whatsapp_status'],
                         "game_mode"=> $rows['game_mode'],
                         "starline_status"=> $rows['starline_status'],
                         "front_game_status"=> $rows['front_game_status'],
                         "second_game_status"=> $rows['second_game_status'],
                         "third_game_status"=> $rows['third_game_status'],
                         "fourth_game_status"=> $rows['fourth_game_status'],
                         "OTP_status"=> $rows['OTP_status'],
                          "jantri_status"=> $rows['jantri_status'],
                          "withdrawal_start_time"=>$rows['withdrawal_start_time'],
                          "withdrawal_end_time"=>$rows['withdrawal_end_time'],
                               "maximum_bid_ank"=>$rows['maximum_bid_ank'],
                                "maximum_bid_jodi"=>$rows['maximum_bid_jodi'],
                                 "maximum_bid_panna"=>$rows['maximum_bid_panna'],
                                  "maximum_bid_sangam"=>$rows['maximum_bid_sangam'],
                                   "upi_id"=>$rows['upi_id'],
                                   "hold_amount_request"=>$rows['hold_amount_request'],
                                   
                              
                         "marchant_code"=>$rows['marchant_code'],
                          "contact_email"=>$rows['contact_email'], 
                          "app_url"=>$rows['app_url'],
                          "offer_description"=>$rows['offer_description'],
                          "min_betting_rate"=>$rows['min_betting_rate'],
                          "min_deposit_rate"=>$rows['min_deposit_rate'],
                          "min_withdreal_rate"=>$rows['min_withdreal_rate'],
                          "max_deposite_rate"=>$rows['max_deposite_rate'],
                          "max_withdrawal_rate"=>$rows['max_withdrawal_rate'],
                          "minimum_transfer"=>$rows['minimum_transfer'],
                          "maximum_transfer"=>$rows['maximum_transfer'],
                          "minimum_bid_money"=>$rows['minimum_bid_money'],
                          "maximum_bid_amount"=>$rows['maximum_bid_amount'],
                          "welcome_bonus"=>$rows['welcome_bonus'],
                          "youtube_link"=>$rows['youtube_link'],
                          "youtube_description"=>$rows['youtube_description'],
                          "refer_description"=>$rows['refer_description'],
                          "refer_amount"=>$rows['refer_amount'],
                          "welcome_title"=>$rows['welcome_title'],
                          "welcome_description"=>$rows['welcome_description'],
                          "home_title_message1"=>$rows['home_title_message1'],
                          "home_title_message2"=>$rows['home_title_message2'],
                          "pending_account_message"=>$rows['pending_account_message'],

                  ];
                array_push($list,$temp);
        } 
        $response = ["status"=>"success","admin Details"=>$list];
}
else{
        $response = ["status"=>"failure"];
}
echo json_encode($response);
?>
