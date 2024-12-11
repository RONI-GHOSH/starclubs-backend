<?php
include '../config.php';

$market_id = $_POST['market_id'];
$market_name = $_POST['market_name'];

 $query = "SELECT * FROM game_choice gc INNER JOIN market_game mg ON gc.market_game_id = mg.market_game_id INNER JOIN market mi ON mi.market_id = gc.market_id WHERE gc.market_id ='$market_id'";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)) {
        $list = array();
        while ($row = mysqli_fetch_assoc($result)) {
                $temp = [
                "market_game_id"=>$row['market_game_id'],
                "game_name"=>$row['game_name']
                ];
                array_push($list,$temp);

        }
        $response = ["status"=>"success",
        "market_id"=>$market_id,
        "market_name"=>$market_name,
        "tab_game_list"=>$list
        ];
        }
        else{
                $response = ["status"=>"failure"];
        }
        echo json_encode($response);



?>

