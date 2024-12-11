<?php 
include '../includes/config.php';

	$out = '';
	$name = trim($_POST['e']);
	$count = 0;

	if ($name == null) {
		$getsql = "SELECT *, m.status AS mstat, cr.status AS crstat, COUNT(cr.id) AS countnum FROM chat_room cr LEFT JOIN member m ON (cr.sender = m.member_id) OR(cr.receiver = m.member_id) WHERE cr.status = 0 AND ((cr.sender != 0) OR (cr.receiver != 0)) GROUP BY m.member_id";
	}else {
	$getsql = "SELECT * FROM `member` WHERE `member_name` LIKE '%$name%%' OR `member_mobile` LIKE '%$name%%' AND `status` = 'Active'";
	}
	$getqry = mysqli_query($conn, $getsql);
	$number = mysqli_num_rows($getqry);
	if ( $number > 0)
	{
		while ($row = mysqli_fetch_assoc($getqry)) {
			$count = $row['countnum'] ?? 0;
			$memberid = $row['member_id'];
			$mobile = $row['member_mobile'];

			$out .= '<li class="active" style="border-bottom: 1px solid #1814140d;">
	                    <a href="chat_room.php?member_id='.$memberid.'" target="_blank" class="getne" alt="'.$memberid.'">
	                        <div class="media" >
	                            <div class="align-self-center me-3">
	                                <img src="adminassets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="">
	                            </div>
	                            
	                            <div class="media-body overflow-hidden">
	                                <h5 class="text-truncate font-size-14 mb-1" style="padding:13px 13px 13px 13px;">'.$row['member_name']. ' - ' .$mobile.'</h5>
	                            </div>
	                            <div class="font-size-11">'.$count.'</div>
	                        </div>
	                    </a>
	                </li>';
		} 
	}else {
	    $out = "<div class='text text-center'>No New Message / No Member Found </div>";
	}

	echo $out;

?>