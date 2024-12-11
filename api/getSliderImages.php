<?php

header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers

// Handle preflight (OPTIONS) request
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     http_response_code(200);
//     exit;
// }

include '../config.php';
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Get the domain
$domain = $_SERVER['HTTP_HOST'];

// Get the base URL
 $base_url = $protocol . '://' . $domain;

$getsql = "SELECT * FROM offertable where status='Active'";
$result = mysqli_query($conn,$getsql);
if (mysqli_num_rows($result)) {
	$sliderImagesList = array();
	while ($row = mysqli_fetch_assoc($result))
	{
        $sliderImagesList[] = $base_url.'/betcircle/'.$row['offerimage'].'?not-from-cache-please';
	}    
	
	$response = ["status"=>200,"sliderImagesList"=>$sliderImagesList];
}
else
{
	$response = ["status"=>"failure"];
}
echo json_encode($response);


?>