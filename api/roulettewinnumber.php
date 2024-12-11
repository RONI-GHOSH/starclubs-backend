<?php
include '../config.php';

 $query = "SELECT * FROM `rouletteWinningNumber` rw RIGHT JOIN routtetgame rg ON rw.winning_time = rg.id WHERE winning_date = date(NOW())";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)) {
        $list = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $gameOpenTime = $row['gameOpenTime'];
             $gameCloseTime = $row['gameCloseTime'];
             $winningTime = $gameOpenTime . " - " . $gameCloseTime;
            
            
                $temp = [
                "winning_number"=>$row['winning_number'],
                "winning_time" =>$winningTime,
                "winning_date" =>$row['winning_date']
               
                ];
                array_push($list,$temp);
        }
        $response = ["status"=>"success","winningNumber"=>$list];
        }
        else{
                $response = ["status"=>"failure"];
        }
        echo json_encode($response);



?>

