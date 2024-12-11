<?php
include '../includes/config.php';

$array = array();

$msql = "SELECT m.member_id, m.member_name, m.member_mobile, m.member_password, m.status,m.status_second,m.status_third, mw.member_wallet_balance FROM member m LEFT JOIN member_wallet mw ON m.member_id = mw.member_id WHERE m.status != 'Active' ORDER BY m.member_id DESC";
$mquery = mysqli_query($conn, $msql);
$i = 1;
if (mysqli_num_rows($mquery) > 0) {
	while ($row = mysqli_fetch_assoc($mquery)) { 

		$id = $row['member_id'];
		$member_name = $row['member_name'];
		$member_mobile = $row['member_mobile'];
		$fullname = $member_mobile . ' (' .$row['member_name'] . ')';
		$usr = '<td><a href="view-user.php?member_id='.$id.'" target="_blank">'.$fullname.'</a></td>';
		$member_wallet = $row['member_wallet_balance'] ?? '0';
		$status = $row['status'];
		$status_second = $row['status_second'];
		$status_third = $row['status_third'];

		// if ($status != "Active") {
		// 	$ac = '<td>
		// 		<a role="button" class="chngstt" atr="Active" mid='.$id.' id="success-348-tb_user-user_id-status">
		// 			<span class="badge badge-pill  badge-danger font-size-12">No</span>
		// 		</a>
		// 	</td>';
		// }else {
		// 	$ac = '<td>
		// 		<a role="button" class="chngstt" atr="Banned" mid='.$id.' id="danger-348-tb_user-user_id-betting_status"><span class="badge badge-pill badge-success font-size-12">Yes</span>
		// 		</a>
		// 	</td>';
		// } 

		if ($status == "Active") {
			$normalStatus = "<div class='checkbox_select'>
	            <input type='checkbox' id='candidateDetail".$i."'  class='optin required checkbox-toggle' checked style='display: none; visibility: hidden;' onclick='userOneChange_status(this);' alt='onestatus".$i."' data-normalone='".$id."'>
	            <label for='candidateDetail".$i."' class='optin required' name='onestatus".$i."'>".$status."</label>
	        </div>";
		}else {
			$normalStatus = "<div class='checkbox_select'>
	            <input type='checkbox' id='candidateDetail".$i."' class='optin required checkbox-toggle' style='display: none; visibility: hidden;' onclick='userOneChange_status(this);' alt='onestatus".$i."' data-normalone='".$id."'>
	            <label for='candidateDetail".$i."' class='optin required' name='onestatus".$i."'>".$status."</label>
	        </div>";
		}

		if ($status_second == "Active") {
			$softStatus = "<div class='checkbox_select'>
	            <input type='checkbox' id='softstatus".$i."'  class='optin required checkbox-toggle' checked style='display: none; visibility: hidden;' onclick='userTwoChange_status(this);' alt='twostatus".$i."' data-normalone='".$id."'>
	            <label for='softstatus".$i."' class='optin required' name='twostatus".$i."'>".$status_second."</label>
	        </div>";
		}else {
			$softStatus = "<div class='checkbox_select'>
	            <input type='checkbox' id='softstatus".$i."' class='optin required checkbox-toggle' style='display: none; visibility: hidden;' onclick='userTwoChange_status(this);' alt='twostatus".$i."' data-normalone='".$id."'>
	            <label for='softstatus".$i."' class='optin required' name='twostatus".$i."'>".$status_second."</label>
	        </div>";
		}

		if ($status_third == "Active") {
			$hardStatus = "<div class='checkbox_select'>
	            <input type='checkbox' id='hardstatus".$i."'  class='optin required checkbox-toggle' checked style='display: none; visibility: hidden;' onclick='userThreeChange_status(this);' alt='threestatus".$i."' data-normalone='".$id."'>
	            <label for='hardstatus".$i."' class='optin required' name='threestatus".$i."'>".$status_third."</label>
	        </div>";
		}else {
			$hardStatus = "<div class='checkbox_select'>
	            <input type='checkbox' id='hardstatus".$i."' class='optin required checkbox-toggle' style='display: none; visibility: hidden;' onclick='userThreeChange_status(this);' alt='threestatus".$i."' data-normalone='".$id."'>
	            <label for='hardstatus".$i."' class='optin required' name='threestatus".$i."'>".$status_third."</label>
	        </div>";
		}

		$act = '<td><a href="view-user.php?member_id='.$id.'" target="_blank"><i class="mdi mdi-eye font-size-18" ></i></a></td>';
		
		$data['data'][] = array(
			$i,
			$usr,
			$member_mobile,
			$member_wallet,
			$normalStatus,
			$softStatus,
			$hardStatus,
			$act,
		);
		$i++;
	}
}else {
	if (empty($data)) {
	$data['data'] = array();
}
}



echo json_encode($data);



?>
