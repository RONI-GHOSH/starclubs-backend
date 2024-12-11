<?php
include '../includes/config.php';

	$member_id = $_REQUEST['member_id'];
	
    $sql = "SELECT *  FROM betting bet INNER JOIN market mar  ON bet.b_market_id = mar.market_id  left JOIN game gam  ON bet.b_game_cid = gam.game_id INNER JOIN member mem  ON bet.b_member_id = mem.member_id  WHERE mem.member_id = '$member_id' ORDER BY bet.betting_id DESC";

	$qry = mysqli_query($conn,$sql);
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) {
	     	while ($row = mysqli_fetch_assoc($qry)) {
                $betting_id = $row['betting_id']; 
	            $mkid = $row['b_market_id']; 
	            $mid = $row['b_member_id'];
	            $gid = $row['b_game_id'];
	            $cid = $row['b_game_cid'];
	            $betnum = $row['betting_number'];
	            $betnum2 = $row['betting_number_second'];
	            $betype = $row['betting_time_type'];
	            $betdate = $row['betting_date'];
				$bettime = $row['betting_time'];
				$betamt = $row['betting_amount'];
                $mname = $row['market_name'];
                $mmname = $row['member_mobile'];
                $mgname = $row['game_name'];
                $gname = $row['game_name'];

				// $msql = "SELECT * FROM market WHERE market_id ='$mkid'";
    //             $mqry = mysqli_query($conn, $msql);
    //             $mrow = mysqli_fetch_assoc($mqry);
    //             $mname = $mrow['market_name'];
                
    //             $mmsql = "SELECT * FROM member WHERE member_id='$mid'";
    //             $mmqry = mysqli_query($conn, $mmsql);
    //             $mmrow = mysqli_fetch_assoc($mmqry);
    //             $mmname = $mmrow['member_mobile'];

    //             $mgsql = "SELECT * FROM market_game WHERE market_game_id ='$gid'";
    //             $mgqry = mysqli_query($conn, $mgsql);
    //             $mgrow = mysqli_fetch_assoc($mgqry);
    //             $mgname = $mgrow['game_name'];

    //             $gname = "-";

    //             if ($gid == '1') {
    //             	$gsql = "SELECT * FROM game WHERE game_id ='$cid'";
	   //              $gqry = mysqli_query($conn, $gsql);
	   //              $grow = mysqli_fetch_assoc($gqry);
	   //              $gname = $grow['game_name'];
	   //              $mgname = "-";
    //             }

                	$mmgname = $mname . $mgname;
                	$btdt = $betdate . ' ( ' . $bettime . ' )';

                    // echo $data  =  "<tr>
                    // <td>$i</td>
                    // <td>$mmname</td>
                    // <td>$mname . $mgname </td>
                    // <td>$betnum $betnum2 ($gname)</td>
                    // <td>$betamt</td>
                    // <td>$betdate</td>
                    // <td>$bettime</td>
                    // <td>$betype</td>";
                    // $i++;

                    $data['data'][] = array(
					$i,
					$mname,
					$mgname,
					$betype,
					$betnum2,
					$betnum,
					$betamt,
					$btdt
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