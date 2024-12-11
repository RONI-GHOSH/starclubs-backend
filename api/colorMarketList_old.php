<?php

include '../config.php';
date_default_timezone_set('Asia/Kolkata');
$date = $date;

$timec = date('H:i');
$sql = "SELECT * FROM colorMarketList WHERE active_status ='Active' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) 
{
  $list = array();
  while ($row = mysqli_fetch_assoc($result)) 
  {
    $market_id = $row['id'];
    $market_time = $row['market_time'];
    $market_name = $row['star_name'];
    $digit1 = "*";
    $pana1 = "***";
    $sql = "SELECT * FROM colormarket where Date(betting_time)=Date('$date') AND game_name='Color'";
    $result1 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result1)) 
    {
      while ($row1 = mysqli_fetch_assoc($result1)) 
      {
        if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:00"))) 
        {
          $digit2 = $row1["A"];
        }
        else  if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:00"))) 
        {
          $digit2 = $row1["B"];
        }
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:00"))) 
        {
          $digit2 = $row1["C"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:00"))) 
        {
          $digit2 = $row1["D"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:00"))) 
        {
          $digit2 = $row1["E"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:00"))) 
        {
          $digit2 = $row1["F"];
        }
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:00"))) 
        {
          $digit2 = $row1["G"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:00"))) 
        {
          $digit2 = $row1["H"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:00"))) 
        {
          $digit2 = $row1["I"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:00"))) 
        {
          $digit2 = $row1["J"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:00"))) 
        {
          $digit2 = $row1["K"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:00"))) 
        {
          $digit2 = $row1["L"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:00"))) 
        {
          $digit2 = $row1["M"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:00"))) 
        {
          $digit2 = $row1["N"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("24:00"))) 
        {
          $digit2 = $row1["O"];        
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("1:00"))) {
          $digit2 = $row1["P"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("2:00"))) 
        {
          $digit2 = $row1["Q"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("3:00"))) 
        {
          $digit2 = $row1["R"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("4:00"))) 
        {
          $digit2 = $row1["S"];
        }   
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("5:00"))) 
        {
          $digit2 = $row1["T"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("6:00"))) 
        {
          $digit2 = $row1["U"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("7:00"))) 
        {
          $digit2 = $row1["V"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("8:00"))) 
        {
          $digit2 = $row1["W"];
        } 
        else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("9:00"))) 
        {
          $digit2 = $row1["X"];
        }
      }
    }

    $sql = "SELECT * FROM colormarket where Date(betting_time)=Date('$date') AND game_name='Lottery_Number'";
    $result1 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result1)) {
      while ($row1 = mysqli_fetch_assoc($result1)) {
        if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:00"))) {
          $digit3 = $row1["A"];
        } else  if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:00"))) {
          $digit3 = $row1["B"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:00"))) {
          $digit3 = $row1["C"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:00"))) {
          $digit3 = $row1["D"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:00"))) {
          $digit3 = $row1["E"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:00"))) {
          $digit3 = $row1["F"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:00"))) {
          $digit3 = $row1["G"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:00"))) {
          $digit3 = $row1["H"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:00"))) {
          $digit3 = $row1["I"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:00"))) {
          $digit3 = $row1["J"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:00"))) {
          $digit3 = $row1["K"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:00"))) {
          $digit3 = $row1["L"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:00"))) {
          $digit3 = $row1["M"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:00"))) {
          $digit3 = $row1["N"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("24:00"))) {
          $digit3 = $row1["O"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("1:00"))) {
          $digit3 = $row1["P"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("2:00"))) {
          $digit3 = $row1["Q"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("3:00"))) {
          $digit3 = $row1["R"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("4:00"))) {
          $digit3 = $row1["S"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("5:00"))) {
          $digit3 = $row1["T"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("6:00"))) {
          $digit3 = $row1["U"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("7:00"))) {
          $digit3 = $row1["V"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("8:00"))) {
          $digit3 = $row1["W"];
        } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("9:00"))) {
          $digit3 = $row1["X"];
        }
      }
    }

    $markettime = $row['market_time'];
    $activestatus = $row['active_status'];
    if (strtotime($timec) <= strtotime($markettime)) {
      $activestatus = "Active";
    } else {
      $activestatus = "close";
    }



    $d_t = $row['market_time'];
    $d_time  = date('h:i a', strtotime($d_t));

    $winningNumberStarLine = $digit2;
    $color_code = '*';
    $color_name = '*';
    if ($winningNumberStarLine > 5000) {
      $sqlcolor = "SELECT * FROM color where color_id=$winningNumberStarLine";
      $resultcolor = mysqli_query($conn, $sqlcolor);
      $rowcolor = mysqli_fetch_array($resultcolor);
      $color_code = $rowcolor['color_code'];
      $color_name = $rowcolor['color_name'];
      $winningNumberColor = $winningNumberStarLine;
      $winningNumberLottery_number = '*';
    } else {
      $winningNumberLottery_number = $winningNumberStarLine;
      $color_code = '*';
      $color_name = '*';
      $winningNumberColor = '*';
    }
    if (!isset($digit2)) {
      $winningNumberLottery_number = $digit3;
      $winningNumberColor = '*';
      $color_code = '*';
      $color_name = '*';
    }
    if (!isset($digit2)) {
      $winningNumberLottery_number = $digit3;
      $winningNumberColor = '*';
      $color_code = '*';
      $color_name = '*';
    }
    $temp =
      [
        "market_time" => $d_time,
        "market_date" => $date,
        "market_name" => $market_name,
        "winningNumberLottery_number" => $winningNumberLottery_number,
        "winningNumberColor" => $winningNumberColor,
        "color_code" => $color_code,
        "color_name" => $color_name,
        "active_status" => $activestatus
      ];
    array_push($list, $temp);
  }
  $response = ["status" => "success", "starLineMarketList" => $list];
} else {
  $response = ["status" => "failure"];
}
echo json_encode($response);
