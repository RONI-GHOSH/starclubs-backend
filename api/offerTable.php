<?php
include '../config.php';

$BaseUrl = "https://garudaitsolution.in/satta/panel/";
$Offers=array();
$response=array();
$qry="select  * from offertable";
$result = mysqli_query($conn,$qry);
if(mysqli_num_rows($result))
{
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$offerid=$row["offerid"];
	    $offerimage=$row["offerimage"];
	    $OfferImageUrl=$BaseUrl.$offerimage;
		$temp = ['offerid'=>$offerid,'offerimages'=>$OfferImageUrl ];
		array_push($Offers, $temp);
	}
	$response = ['status'=>'success','Alloffercode'=>$Offers];
}
else {
	$response = ["status"=>"failure"];
}
echo json_encode($response);

?>