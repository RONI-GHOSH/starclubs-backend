<?php
include '../config.php';

$memberId = $_POST['memberId'];
$referdetaillist=array();
$sql = "Select * from refer_detail";
$result = mysqli_query($conn,$sql);
if ($row = mysqli_fetch_array($result))
{
	$firebase_link=$row["firebase_link"];
	$package_name=$row["package_name"];
	$app_url=$row["app_url"];
	$offer_title=$row["offer_title"];
	$offer_description=$row["offer_description"];
	$offer_image=$row["offer_image"];
	$youtubelink=$row["youtubelink"];
	
	$apprul="$firebase_link$app_url*memberid*$memberId&apn=$package_name&st=$offer_title&sd=$offer_description&si=$offer_image";
	
	$temp = ["status"=>'success',"appurl"=>$apprul,"OfferTitle"=>$offer_title,"OfferDescription"=>$offer_description,"Offerimage"=>$offer_image,"youtubelink"=>$youtubelink];
	array_push($referdetaillist,$temp);
	$response = ["status"=>"Failure","ReferDetailList"=>$referdetaillist];
	
}
else
{
	$response = ["status"=>"success","Message"=>"Incorrect Crdentials"];

}

echo json_encode($response);

?>