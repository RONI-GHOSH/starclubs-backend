<?php
include '../includes/config.php';

$dt = $_POST['dt'];
$market_id = $_POST['valTime'];

// $sql = "SELECT * FROM roulettebat WHERE `bat_open_time` = '$minimunTime' AND `bat_close_time` = '$maximumTime' AND date(cretated_date) = date('$date')";
if ($market_id == 'All') {
    $sql = "SELECT * FROM roulettebat WHERE date(cretated_date) = date('$dt') ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM roulettebat WHERE gameid = '$market_id' AND date(cretated_date) = date('$dt') ORDER BY id DESC";
}

// echo $sql;die;
$qry = mysqli_query($conn, $sql);
$i = 1;
if (mysqli_num_rows($qry) > 0) {
    while ($row = mysqli_fetch_assoc($qry)) {
        $betting_id = $row['id'] ?? ' ';
        $game_name = $row['bat_open_time'] . '-' . $row['bat_close_time'] ?? ' ';
        $bet_amount = $row['bat_amount'] ?? ' ';
        $bet_num = $row['bat_number'] ?? ' ';
        $betting_time = $row['cretated_date'] ?? ' ';
        $mid = $row['member_id'] ?? ' ';


        $mmsql = "SELECT * FROM member WHERE member_id ='$mid'";
        $mmqry = mysqli_query($conn, $mmsql);
        $mmrow = mysqli_fetch_assoc($mmqry);
        //  $mmname = $mmrow['member_mobile'] ?? ' ';
        // $mname = $mmrow['member_name'] ?? ' ';

        $mmname = "<a href='view-user.php?member_id=" . $mid . "' target='_blank'>" . $mmrow['member_mobile'] ?? ' ' . "</a>";
        $mname = "<a href='view-user.php?member_id=" . $mid . "' target='_blank'>" . $mmrow['member_name'] ?? ' ' . "</a>";

        echo $response  =  "<tr>
                                <td>$i</td>
                                <td>($mname) $mmname</td>
                                <td>$bet_num</td>
                                <td>$bet_amount</td>                                
                                <td>$betting_time</td>
                                <td>$game_name</td>
                                <td><a href='#' alt='" . $betting_id . "' data-bat_number='" . $bet_num . "' onclick='idtrans(this);' data-toggle='modal' data-target='#largeModal' ><i class='mdi mdi-pencil font-size-18' ></i></a></td>
                                
                                </tr>";
        $i++;
    }
} else {
    echo $response = "<tr><td colspan='9'>No Data Found</td></tr>";
}
