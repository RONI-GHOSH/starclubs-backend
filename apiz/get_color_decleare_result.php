<?php
include '../includes/config.php';
$array = array();
$data['data'] = array();

$marketid = $_GET['marketid'];
$bid_date = $_GET['betdate'];
$number = $_GET['number'];
$game_name = $_GET['game_name'];

$sumday = str_split($number);
$sm = array_sum($sumday);
$nsm = substr($sm , -1);

// print_r($_GET);

 $msql = "SELECT * FROM colormarketbat st LEFT JOIN member m ON st.member_id = m.member_id WHERE date(trim(st.betting_date)) = date(trim('$bid_date')) AND st.active_status='Active' AND (st.bet_num='$number') AND (st.game_name='$game_name') AND st.statLineBatTime='$marketid'";

 // $msql = "SELECT * FROM starlinemarketbat bt LEFT JOIN member men ON bt.member_id = men.member_id WHERE date(trim(betting_date)) = date(trim('$bid_date')) AND time(statLineBatTime)=time('$marketid') AND bet_num='$number'"; 
$mquery = mysqli_query($conn,$msql);
// $row = mysqli_fetch_assoc($mquery);
// echo '<pre>';
// print_r($row);

$i = 1;
if (mysqli_num_rows($mquery) > 0) {
   while ($row = mysqli_fetch_assoc($mquery)) {
      $betting_id = $row['id'] ?? '';
      // $mname = $row['member_name']; 
      // $mmname = $row['member_mobile'];
      $betting_amount = $row['bet_amount'] ?? ' ';
      $gid = $row['game_id'] ?? ' ';
      $mid = $row['member_id'] ?? ' ';

      $ganme = $row['game_name'] ?? ' ';

      $gn = $bid_date . ' - ('. $ganme .')';

      $betting_number = $row['bet_num'] ?? ' ';
      $betting_time_type = $row['betting_time'] ?? ' ';

      // $memberinfo = $mname . ' - ('. $mmname .')' ;      

      $mmname = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$row['member_name'] ?? ' '."</a>";
      $mname = "<a href='view-user.php?member_id=".$mid."' target='_blank'>".$row['member_mobile'] ?? ' '."</a>";


      $btnum = $betting_number;

      $btn = '<a href="#" betnum="'.$betting_number.'"  betid="'.$betting_id.'"  onclick="editStarlineWin(this);" data-toggle="modal" data-target="#editStarlineWin"><i class="mdi mdi-pencil font-size-18"></i></a>';

         $btnDeleted = '<a href="#" alt="'.$betting_id.'" onclick="statlineDelete(this);" data-toggle="modal" data-target="#starlineDeleteModal"><i class="bx bx-trash-alt font-size-18"></i></a>';
      
         $data['data'][] = array(
            $i, 
            $mmname .'-' .$mname,
            $gn,
            $btnum, 
            $betting_amount,
            $btn,
            $btnDeleted, 
         );
         $i++; 
      }
   }else {
      // echo $response  =  "<tr><td colspan='7'>No Data found";
      if (empty($data)) {
            $data['data'] = array();
      }
}

   echo json_encode($data);

?>
