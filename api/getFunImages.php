<?php

include '../config.php';
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Get the domain
$domain = $_SERVER['HTTP_HOST'];

// Get the base URL
 $base_url = $protocol . '://' . $domain;

$getsql = "SELECT * FROM funimage where status='Active'";
$result = mysqli_query($conn,$getsql);
if (mysqli_num_rows($result)) {
	$sliderImagesList = array();
	while ($row = mysqli_fetch_assoc($result))
	{
        $ImagesList[] = $base_url.'/betcircle/'.$row['offerimage'];
	}    
	
	$response = ["status"=>200,"ImagesList"=>$ImagesList];
}
else
{
	$response = ["status"=>"failure"];
}
echo json_encode($response);


?>