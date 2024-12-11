<?php
include '../includes/config.php';

	$id = $_POST['id'];
	
    $sql = "SELECT *  FROM betting bet INNER JOIN market mar  ON bet.b_market_id = mar.market_id  left JOIN game gam  ON bet.b_game_cid = gam.game_id INNER JOIN member mem  ON bet.b_member_id = mem .member_id  WHERE bet.b_market_id='$id' AND bet.betting_status ='Active' AND date(trim(bet.betting_date)) = date(trim('$date')) ORDER BY betting_id DESC";
	$qry = mysqli_query($conn,$sql);
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) {
	     	while ($row = mysqli_fetch_assoc($qry)) {
                $betting_id = $row['betting_id'] ?? '';
	            $mkid = $row['b_market_id'] ?? '';
	            $mid = $row['b_member_id'] ?? '';
	            $gid = $row['b_game_id'] ?? '';
	            $cid = $row['b_game_cid'] ?? '';
	            $betnum = $row['betting_number'] ?? '';
	            $betnum2 = $row['betting_number_second'] ?? '';
	            $betype = $row['betting_time_type'] ?? '';
	            $betdate = $row['betting_date'] ?? '';
				$bettime = $row['betting_time'] ?? '';
				$betamt = $row['betting_amount'] ?? '';
                $mname = $row['market_name'] ?? '';

                // $mmname = $row['member_mobile'] ?? '';
                // $memberName = $row['member_name'] ?? '';

                $mmname = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$row['member_mobile'] ?? ' '."</a>";
                $memname = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$row['member_name'] ?? ' '."</a>";

                $mgname = $row['game_name'] ?? '';
                $gname = $row['game_name'] ?? '';
                

                // $gname = "-";

                // // if ($gid == '1') {
                // 	$gsql = "SELECT * FROM game WHERE game_id ='$cid'";
	               // $gqry = mysqli_query($conn, $gsql);
	               // $grow = mysqli_fetch_assoc($gqry);
	               // $gname = $grow['game_name'];
	               // $mgname = "-";
                // // }


                	$edit = "<button type='button' alt='".$betting_id."' data-batting='".$betnum."' onclick='idtrans(this);' class='btn btn-success waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button>";

                	$delete ="&nbsp <button type='button' alt='".$betting_id."'onclick='idBetDelete(this);' class='btn btn-danger waves-effect m-r-20' data-toggle='modal' data-target='#betDeleteModal'>Delete</button>";

                	$data['data'][] = array(
                        $i,
                        $mmname.'-'.$memname,
                        $mname . $mgname,
                        $betnum . ' - '. $betnum2 .($gname),
                        $betamt,
                        $betdate,
                        $bettime,
                        $betype,
                        $edit . $delete,
                    );
                    $i++;

                    // echo $response  =  "<tr>
                    // <td>$i</td>
                    // <td>$mmname</td>
                    // <td>$mname . $mgname </td>
                    // <td>$betnum $betnum2 ($gname)</td>
                    // <td>$betamt</td>
                    // <td>$betdate</td>
                    // <td>$bettime</td>
                    // <td>$betype</td>
                    // 	<td>
                    // 		<button type='button' alt='".$betting_id."' data-batting='".$betnum."' onclick='idtrans(this);' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button>

                    // 		<button type='button' alt='".$betting_id."'onclick='idBetDelete(this);' class='btn btn-danger waves-effect m-r-20' data-toggle='modal' data-target='#betDeleteModal'>Delete</button>
                    // 	</td>
                    // </tr>";
                    // $i++;
			}
		}
        else {
            if (empty($data)) {
                $data['data'] = array();
            }
		}
        echo json_encode($data);

?>