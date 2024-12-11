<?php 
include '../includes/config.php';


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET ,POST , OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



 $json = file_get_contents('php://input');
 $data = json_decode($json);

$getmember_id = $_POST['getmember_id'];
$sender = 0;
$status = 0;

$timewala = time();

$Image=strtolower($_FILES['file']['name']);
$ext = pathinfo($Image, PATHINFO_EXTENSION);
$ImageName="file$timewala.$ext";
$ImagePath="ChatImages/$ImageName";
$allowTypes = array('jpg','png','jpeg'); 
if(in_array($ext, $allowTypes))
{ 
	if (move_uploaded_file($_FILES["file"]["tmp_name"],"../$ImagePath" )) 
	{
		 $sql ="INSERT INTO chat_room (`sender`, `receiver`, `message`, `msgtype`, `status`, `createdate`) VALUES ('$sender','$getmember_id ','$ImagePath','file','$status','$dateTime')";
		 $qry = mysqli_query($conn , $sql);
		if (!$qry) {
			$response = "Fail";
		}else{
			$response = "Send";
		}

	}
}

// $sql = "INSERT INTO chat_room (`sender`, `receiver`, `message`, `msgtype`, `status`, `createdate`) VALUES ('$sender','$getmember_id ','$message','message','$status','$dateTime')";
// $qry = mysqli_query($conn , $sql);

// if (!$qry) {
// 	$response = "Fail";
// }else{
// 	$response = "Send";
// }

echo $response;

?>