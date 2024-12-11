<?php
include '../includes/config.php';

	$id = $_POST['id'];
	$betdate = $_POST['betdate'];
	$game_id = $_POST['game_id'];

	if($game_id == "All"){
	   $sql = "SELECT * FROM betting WHERE b_market_id='$id' AND betting_date='$betdate' ORDER BY betting_id DESC";
	}else {
    $sql = "SELECT * FROM betting WHERE b_market_id='$id' AND betting_date='$betdate' AND b_game_cid='$game_id' ORDER BY betting_id DESC";
	}

	// echo $response = "
 //    <tr>
 //        <th>Sr No</th>
 //        <th>User Mobile</th>
 //        <th style='width:15%'>Game Name</th>
 //        <th>Paana and Digit</th>
 //        <th>Points</th>
 //        <th>Date</th>
 //        <th>Time</th>
 //        <th>Type</th>
 //    </tr>";

	$qry = mysqli_query($conn,$sql);
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) {
	     	while ($row = mysqli_fetch_assoc($qry)) {
                $betting_id = $row['betting_id'] ?? ' ';
	            $mkid = $row['b_market_id'] ?? ' ';
	            $mid = $row['b_member_id'] ?? ' ';
	            $gid = $row['b_game_id'] ?? ' ';
	            $cid = $row['b_game_cid'] ?? ' ';
	            $betnum = $row['betting_number'] ?? ' ';
	            $betnum2 = $row['betting_number_second'] ?? ' ';
	            $betype = $row['betting_time_type'] ?? ' ';
	            $betdate = $row['betting_date'] ?? ' ';
				$bettime = $row['betting_time'] ?? ' ';
				$betamt = $row['betting_amount'] ?? ' ';
				$memberName = $row['member_name'] ?? ' ';

				$msql = "SELECT * FROM market WHERE market_id ='$mkid'";
                $mqry = mysqli_query($conn, $msql);
                $mrow = mysqli_fetch_assoc($mqry);
                $mname = $mrow['market_name'] ?? ' ';
                
                $mmsql = "SELECT * FROM member WHERE member_id='$mid'";
                $mmqry = mysqli_query($conn, $mmsql);
                $mmrow = mysqli_fetch_assoc($mmqry);
                $mmname = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$mmrow['member_mobile'] ?? ' '."</a>";
                $membername = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$mmrow['member_name'] ?? ' '."</a>";
                
                $mgsql = "SELECT * FROM market_game WHERE market_game_id ='$gid'";
                $mgqry = mysqli_query($conn, $mgsql);
                $mgrow = mysqli_fetch_assoc($mgqry);
                $mgname = $mgrow['game_name'] ?? ' ';

                $gname = "-";

                if ($gid == '1') {
                	$gsql = "SELECT * FROM game WHERE game_id ='$cid'";
	                $gqry = mysqli_query($conn, $gsql);
	                $grow = mysqli_fetch_assoc($gqry);
	                $gname = $grow['game_name'] ?? ' ';
	                $mgname = "-";
                }

                 $mmgname = $mname . $mgname;
                 $btdt = $betdate . ' ( ' . $bettime . ' )';

				 echo $response =  "
				 <tr>
                    <td>$i</td>
                    <td>$mmname($membername)</td>
                    <td>$mname . $mgname </td>
                    <td>$betnum $betnum2 ($gname)</td>
                    <td>$betamt</td>
                    <td>$betdate</td>
                    <td>$bettime</td>
                    <td>$betype</td>
<td><a href='#' alt='".$betting_id."' data-bat_number='".$betnum."' onclick='idtrans(this);' data-toggle='modal' data-target='#largeModal' ><i class='mdi mdi-pencil font-size-18' ></i></a></td>
                    </tr>";
                    $i++;

    //             $data['data'][] = array(
				// 	$i,
				// 	$mname,
				// 	$mgname,
				// 	$betype,
				// 	$betnum2,
				// 	$betnum,
				// 	$betamt,
				// 	$btdt
    //                 );
				// $i++;
}
		}else {
		 //   if (empty($data)) {
			// 	$data['data'] = array();
			// }
			echo $response  =  "<tr> <td colspan='9'> No Data Found </td> </tr>";

		}
// echo json_encode($data);



 //    echo $sql = "SELECT *  FROM betting bet INNER JOIN market mar  ON bet.b_market_id = mar.market_id  left JOIN game gam  ON bet.b_game_cid = gam.game_id INNER JOIN member mem  ON bet.b_member_id = mem .member_id   WHERE bet.betting_date='$bid_date' ORDER BY betting_id DESC";
	// $qry = mysqli_query($conn,$sql);
	// $i = 1;
	//   	if (mysqli_num_rows($qry) > 0) {
	//      	while ($row = mysqli_fetch_assoc($qry)) {
 //                $betting_id = $row['betting_id']; 
	//             $mkid = $row['b_market_id']; 
	//             $mid = $row['b_member_id'];
	//             $gid = $row['b_game_id'];
	//             $cid = $row['b_game_cid'];
	//             $betnum = $row['betting_number'];
	//             $betnum2 = $row['betting_number_second'];
	//             $betype = $row['betting_time_type'];
	//             $betdate = $row['betting_date'];
	// 			$bettime = $row['betting_time'];
	// 			$betamt = $row['betting_amount'];
 //                $mname = $row['market_name'];
 //                $mmname = $row['member_mobile'];
 //                $mgname = $row['game_name'];
 //                $gname = $row['game_name'];

 //                $mmgname = $mname . $mgname;
 //                $btdt = $betdate . ' ( ' . $bettime . ' )';
                

 //                $data['data'][] = array(
	// 				$i,
	// 				$mname,
	// 				$mgname,
	// 				$betype,
	// 				$betnum2,
	// 				$betnum,
	// 				$betamt,
	// 				$btdt
 //                    );
	// 			$i++;
	// 		}

?>


