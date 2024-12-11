<?php
include '../includes/config.php';

if (isset($_POST['update-market'])) {

	$market_name = $_POST['market_name'];
    $market_id = $_POST['market_id'];

    // $market_type = $_POST['market_type'];
    $market_open = $_POST['market_open'];
    $market_close = $_POST['market_close'];
    $market_game_id = $_POST['market_game_id'];
    $selectgame = $_POST['selectgame'];
    
    // $motime = date("g:i a", strtotime($market_open[]));
    // $mctime = date("g:i a", strtotime($market_close[]));
    
    $marketGameId = sizeof($market_game_id);
    $mulSelectGame = sizeof($selectgame);
    $mulMoTime = sizeof($market_open);
    $mulMcTime = sizeof($market_close);

    for($i=0; $i < $marketGameId; $i++) {
        $data[] = array(
            "market_game_id" => $market_game_id[$i],
            "market_opentime" => date("g:i a", strtotime($market_open[$i])),
            "market_status" => $selectgame[$i],
        );
    }
    
    $jsonData = array(
        "market_name"=> $market_name,
        "market_Id"=> $market_id,
        "marketdaytype"=>$data,
    );
    $inputData = json_encode($jsonData);
    // echo "<pre>";
    // print_r($inputData);die;

    $marketUpdate = "call UpdateStarLineMarket('".$inputData."')";

    $data = mysqli_query($conn, $marketUpdate); 

    if(!empty($data))
    {
        echo '<script>alert("Market Updated Successfully");window.location = "../star-game-name.php";</script>';
    }
    else
    {
        echo '<script>alert("Market Not Updated Successfully");window.location = "../star-game-name.php";</script>';
    }

    
    // $sql = "UPDATE `market` SET `market_name`='$market_name', `market_open_time`='$motime', `market_close_time`='$mctime',`market_update_date`='$date'WHERE market_id='$market_id'";
    // if(!mysqli_query($conn,$sql)) {
    //     echo '<script>alert("Market Update Failed");window.location = "../star-game-name.php";</script>';
    // }else{
    //     echo '<script>alert("Market Update Successfully");window.location = "../star-game-name.php";</script>';
    // }
}
?>