<?php
include '../includes/config.php';

$getmember_id = $_POST['getmember_id'];

$name = "Admin";
$response = "";

$msql = "SELECT * FROM chat_room cr LEFT JOIN member m ON (cr.sender = m.member_id) OR (cr.receiver = m.member_id)  WHERE cr.sender='$getmember_id' OR cr.receiver='$getmember_id'";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) {

		$sender = $row['sender'];
		$receiver = $row['receiver'];
		$message = $row['message'];
		$msgtype = $row['msgtype'];
		$status = $row['status'];
		$createdate = $row['createdate'];

		$name = $row['member_name'] . "(" . $row['member_mobile'] . ")" ;


			if ($sender == $getmember_id) {
				if ($msgtype == "file"){ 
					$response = "<li><div class='ctext-wrap'><div class='conversation-list'>
							<a class='image-popup-vertical-fit' target='_blank' href='".$message."' title=''>
							<img class='img-fluid' alt='' src='".$message."'  height='100px' width='100px'>
						</a></div></div></li>";
				}else{
					$response .= "<br> <li>
								    <div class='conversation-list'>
								        <div class='ctext-wrap'>
								            <div class='conversation-name'>".$name."</div>
								            <p>
								              ".$message."  
								            </p>
								            <p class='chat-time mb-0'><i class='bx bx-time-five align-middle me-1'></i>" . " " . $createdate ."</p>
								        </div>
								    </div>
								</li><br>";
				}
				
			}else {
				$name = "Admin";
				if ($msgtype == "file"){ 
					$response .= "<li class='right'><div class='conversation-list'><div class='conversation-name'>".$name."</div>
							<a class='image-popup-vertical-fit' target='_blank' href='".$message."' title=''>
							<img class='img-fluid' alt='' src='".$message."'  height='100px' width='100px'>
						</a></div></div></li>";
				}else{
					$response .= "<br><li class='right'>
					    <div class='conversation-list'>
					        <div class='ctext-wrap'>
					            <div class='conversation-name'>".$name."</div>
					             <p>
					                $message
					            </p>

					            <p class='chat-time mb-0'><i class='bx bx-time-five align-middle me-1'></i>" . " " . $createdate ."</p>
					        </div>
					    </div>
					</li><br>";
				}
			}
		}

}else {
	$response = "No Messages Found";

}


echo $response;



?>
