<?php 
include '../includes/config.php';

// $message = strip_tags(trim($_POST['message']));
$sender = $_POST['member_id'];
$status = 0;
$response=array();
$timewala = date('dmyhi');

$Image=strtolower($_FILES['file']['name']);
$ext = pathinfo($Image, PATHINFO_EXTENSION);
$ImageName="file$timewala.$ext";
$ImagePath="ChatImages/$ImageName";
$allowTypes = array('jpg','png','jpeg'); 
if(in_array($ext, $allowTypes))
{ 
	if (move_uploaded_file($_FILES["file"]["tmp_name"],"../$ImagePath" )) 
	{
		 $sql ="INSERT INTO chat_room (`sender`, `receiver`, `message`, `msgtype`, `status`, `createdate`) VALUES ('$sender','0','$ImagePath','file','$status','$dateTime')";
		 $qry = mysqli_query($conn , $sql);
		if (!$qry) {
			$response = ["status"=>"Failure"];
		}else{
			$response = ["status"=>"Success"];
		}

	}
	else{
			$response = ["status"=>"Failure"];
		}
}
echo json_encode($response );


?>