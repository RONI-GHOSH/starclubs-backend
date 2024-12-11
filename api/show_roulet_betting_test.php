<?php
include '../includes/config.php';

$betting_time_all = $_POST['valTime'];
// echo $betting_time_all;

$main = explode("=", $betting_time_all);

$minimunTime = $main[0];
$maximumTime = $main[1];



$sql = "SELECT * FROM roulettebat WHERE `bat_open_time` = '$minimunTime' AND `bat_close_time` = '$maximumTime' AND date(cretated_date) = date('$date')";

// echo $sql;die;
    // $sql = "SELECT * FROM roulettebat WHERE b_market_id='$id' AND betting_date='$date' ORDER BY betting_id DESC";

	$qry = mysqli_query($conn,$sql);
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) 
        {
	     	while ($row = mysqli_fetch_assoc($qry)) {
                 $betting_id = $row['id'];
	             $bat_number = $row['bat_number']; 
	             $bat_open_time = $row['bat_open_time'];
	             $bat_close_time = $row['bat_close_time'];
	             $cretated_date = $row['cretated_date'];
	             $updated_date = $row['updated_date'];
	   //          $betype = $row['betting_time_type'];
	   //          $betdate = $row['betting_date'];
				// $bettime = $row['betting_time'];
				// $betamt = $row['betting_amount'];

				// $msql = "SELECT * FROM market WHERE market_id ='$mkid'";
    //             $mqry = mysqli_query($conn, $msql);
    //             $mrow = mysqli_fetch_assoc($mqry);
    //             $mname = $mrow['market_name'];
                
                $mmsql = "SELECT * FROM member WHERE member_id='$betting_id'";
                $mmqry = mysqli_query($conn, $mmsql);
                $mmrow = mysqli_fetch_assoc($mmqry);
                $mmname = $mmrow['member_mobile'];

                // $mgsql = "SELECT * FROM market_game WHERE market_game_id ='$gid'";
                // $mgqry = mysqli_query($conn, $mgsql);
                // $mgrow = mysqli_fetch_assoc($mgqry);
                // $mgname = $mgrow['game_name'];

                // $gname = "-";

                // if ($gid == '1') {
                // 	$gsql = "SELECT * FROM game WHERE game_id ='$cid'";
	               //  $gqry = mysqli_query($conn, $gsql);
	               //  $grow = mysqli_fetch_assoc($gqry);
	               //  $gname = $grow['game_name'];
	               //  $mgname = "-";
                // }

                echo $response  =  "<tr>
                                <td>$i</td>
                                <td>$mmname</td>
                                <td>$bat_number</td>
                                <td>$bat_open_time</td>
                                <td>$bat_close_time</td>
                                <td>$cretated_date</td>
                                <td>$updated_date</td> 
                                <td><button type='button' alt='".$betting_id."' data-bat_number='".$bat_number."' onclick='idtrans(this);' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button></td>
                              </tr>";
                              $i++;
			}

		}

?>

<!-- <td><button type='button' alt='".$betting_id."' data-batting='".$betnum."' onclick='idtrans(this);' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button></td> -->

<!-- <td><button type='button' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button></td> -->