<?php



//   $msg=[
// 		"NotificationType" => "Message",
//                     "title" => "New Message",
//                     "profile_picture"=>"",
// 					"id"=>"$id",
// 					"room_id"=>"",
// 					"user_id"=>"$memberid",
// 					"user_name"=>'',
// 					"content"=>"$message",
// 					"timestamp"=>"$createdate",
// 					"type"=>"$messagetype"
//                     ];

// $token="dDvyua7TTFGb-G5tFD5ZyZ:APA91bEVZT6rVI_APpUudvbGRVxrejWwVsQVbPAE6gB5LzGHKyUoSUNJwGy2dK7o89ZuGsc9NmAUm1YCkBgsN0b2kIkjolfH7eKAVQ9haTxRGjgmKzLp1Gzg5GQYg-DA5KhuJ2RnM1Jl";
// SendMessage($token,$msg);

function SendMessage($token,$msg)
{

// echo "Rahul";
if (!defined('API_ACCESS_KEY')) define('API_ACCESS_KEY', 'AIzaSyDkTaH_RMRQWiChsrpBWGirc8hzdpM7bU4');
	
$fields = array
(
    'to'=>$token,
    'data'=>$msg


);
$headers = array
(
    'Authorization: key=' ."AAAAwK_SplU:APA91bES_j4J5HrqQF1NOyrM77qfTqZ13V_nYsE7gaRwQhF_LyP2P1ohduPlbJ-Vgo2jc0-AAmjqxEiSXYEvf3X1F2RP3vmx0EOpYEcfPGOlAsjK_9onS4LvdASZXKSlInNBoCejr2ru",
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_error($ch);
curl_close( $ch );

 return $result;
}
?>