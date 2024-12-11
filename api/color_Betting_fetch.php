<?php
include '../includes/config.php';

// $betting_time_all = $_POST['valTime'];
// echo $betting_time_all;

// $main = explode("=", $betting_time_all);

// $minimunTime = $main[0];
// $maximumTime = $main[1];

$market_id = $_POST['valTime'];


// $sql = "SELECT * FROM roulettebat WHERE `bat_open_time` = '$minimunTime' AND `bat_close_time` = '$maximumTime' AND date(cretated_date) = date('$date')";

// echo $sql;die;
    $sql = "SELECT * FROM colormarketbat WHERE statLineBatTime = '$market_id' AND date(betting_date) = date('$date') ORDER BY id DESC"; 
    // echo $sql;die;
	$qry = mysqli_query($conn,$sql);
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) 
        {
	     	while ($row = mysqli_fetch_assoc($qry)) {
                 $betting_id = $row['id'];
	             $game_name = $row['game_name'];
	             $bet_amount = $row['bet_amount'];
	             $bet_num = $row['bet_num'];
	             $betting_time = $row['betting_time'];
	             $statLineBatTime = $row['statLineBatTime'];
                 $mid = $row['member_id'];
	   //          $betype = $row['betting_time_type'];
	   //          $betdate = $row['betting_date'];
				// $bettime = $row['betting_time'];
				// $betamt = $row['betting_amount'];

				// $msql = "SELECT * FROM market WHERE market_id ='$mkid'";
    //             $mqry = mysqli_query($conn, $msql);
    //             $mrow = mysqli_fetch_assoc($mqry);
    //             $mname = $mrow['market_name'];
                
                $mmsql = "SELECT * FROM member WHERE member_id ='$mid'";
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
                                <td>$bet_amount</td>
                                <td>$game_name($bet_num)</td>
                                <td>$betting_time</td>
                                <td>$statLineBatTime</td> 
                                <td><button type='button' alt='".$betting_id."' data-bat_number='".$bet_num."' onclick='idtrans(this);' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button></td>
                                </tr>";
                              $i++;
			}

		}

?>

<!-- <td><button type='button' alt='".$betting_id."' data-batting='".$betnum."' onclick='idtrans(this);' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button></td> -->

<!-- <td><button type='button' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button></td> -->

<!-- <td><button type='button' alt='".$betting_id."' data-bat_number='".$bat_number."' onclick='idtrans(this);' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#largeModal'>Edit</button></td> -->