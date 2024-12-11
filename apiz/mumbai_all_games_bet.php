<?php
include '../includes/config.php';

	$betdate = $_POST['betdate'];
    $null = null;
	
	$sql = "SELECT * FROM betting bet inner join market mar on bet.b_market_id=mar.market_id WHERE bet.betting_date='$betdate' AND bet.betting_status = 'Active' AND mar.market_type = 'mumbai' ORDER BY bet.betting_id DESC";
	$qry = mysqli_query($conn,$sql);
    // $row = mysqli_num_rows($qry);
    // print_r($row);die;
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) {
	  	    $betamt = 0;
	  	    $totalamt = 0;
            $response = '';
            // $row = mysqli_fetch_assoc($qry);
            // print_r($row);die;
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

				$msql = "SELECT * FROM market WHERE market_id ='$mkid'";
                $mqry = mysqli_query($conn, $msql);
                $mrow = mysqli_fetch_assoc($mqry);
                $mname = $mrow['market_name'] ?? '';
                
                $mmsql = "SELECT * FROM member WHERE member_id='$mid'";
                $mmqry = mysqli_query($conn, $mmsql);
                $mmrow = mysqli_fetch_assoc($mmqry);
                // $mmname = $mmrow['member_mobile'] ?? '';
                // $memname = $mmrow['member_name'] ?? '';

                $mmname = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$mmrow['member_mobile'] ?? ' '."</a>";
                $memname = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$mmrow['member_name'] ?? ' '."</a>";


                $mgsql = "SELECT * FROM market_game WHERE market_game_id ='$gid'";
                $mgqry = mysqli_query($conn, $mgsql);
                $mgrow = mysqli_fetch_assoc($mgqry);
                $mgname = $mgrow['game_name'] ?? '';

                $gname = "-";

                if ($gid == '1') {
                	$gsql = "SELECT * FROM game WHERE game_id ='$cid'";
	                $gqry = mysqli_query($conn, $gsql);
	                $grow = mysqli_fetch_assoc($gqry);
	                $gname = $grow['game_name'] ?? '';
	                $mgname = "-";
                }
                            
                    $edit = "<button type='button' alt='".$betting_id."' data-batting='".$betnum."' onclick='idtrans(this);' class='btn btn-success waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button>";

                    $delete ="&nbsp <button type='button' alt='".$betting_id."'onclick='idMemberDelete(this);' class='btn btn-danger waves-effect m-r-20' data-toggle='modal' data-target='#memberDeleteModal'>Delete</button>";

                    $totalamt = $betamt + $totalamt;
                    $data['data'][] = array(
                        $i,
                        $mmname . "-". $memname,
                        $mname . $mgname,
                        $betnum . ' - '. $betnum2 .($gname),
                        $betamt,
                        $betdate,
                        $bettime,
                        $betype,
                        $edit . $delete,
                    );
                    $i++;
			}
                $data['data'][] = array(
                    $i =  "-",
                    $til =  "All Member",
                    $til1 =  "Total Game Bet",
                    $til2 =  "-",
                    $til3 = $totalamt,
                    $til4 = $betdate,
                    $til5 =  "-",
                    $til6 =  "-",
                    $til7 =  "-",
                );

		}else {
            if (empty($data)) {
                $data['data'] = array();
            }
		}
        echo json_encode($data);
?>
