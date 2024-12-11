<?php 
//     header('Access-Control-Allow-Origin: *');
//     header('Access-Control-Allow-Methods: GET, POST');
//     header("Access-Control-Allow-Headers: X-Requested-With");
//     header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: x-requested-with, content-type, authorization');


// Handle OPTIONS method
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Just return the headers and exit
    exit(0);
}
// DB credentials.
	session_start();
    $host = "localhost";
//old db
//       $user = "u212039010_hmrOyal";
// 	$password = "u212039010_hmrOyal1";
// 	$db_name = "u212039010_hmrOyal";
// Establish database connection.
//new db
   $user = "u328068492_bet";
	$password = "Swap@4129";
	$db_name = "u328068492_bet";
	

	$conn =  mysqli_connect($host,$user,$password,$db_name);
	if(mysqli_connect_error()){
		echo 'connect to database failed';
	}
	
	$base_url = "https://starclubs.in/betcircle/";
	$base_api = "https://starclubs.in/betcircle/api/";
//Time Zone
	date_default_timezone_set('Asia/Kolkata');
	$date = date('Y-m-d');
	$time = date('H:i');
	$dateTime = $date." ".$time;
	$timec = date('h:i a' , strtotime($time)) ;
	
	$websitename = "betcircle";
	$roulletwinamt = 10;