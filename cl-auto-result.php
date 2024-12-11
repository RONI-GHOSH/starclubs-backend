<?php include 'includes/config.php';
// session_start();
date_default_timezone_set('Asia/Kolkata');
$betdate = $date;

$timec = date('H:i');
// $timec = date('00:00');

if ($timec <= "00:05") {
    $betdate = date('Y-m-d', strtotime($betdate . ' -1 day'));
}

$betting_date = date('y-m-d', strtotime($betdate));

$timestamp = strtotime($timec);
$recent = $timestamp - (5 * 60); // 10 minutes * 60 seconds per minute
$recent = date('H:i', $recent);

$sql_marketlist = "SELECT * FROM colorMarketList WHERE active_status ='Active' AND market_time <='$recent' ORDER BY id DESC LIMIT 1";
$result_marketlist = mysqli_query($conn, $sql_marketlist);
$row_marketlist = mysqli_fetch_assoc($result_marketlist);
$market_time = $row_marketlist['market_time'];
$market_id = date('h:i a', strtotime($row_marketlist['market_time']));

$sql_unique = "SELECT color_id FROM color WHERE status='1' AND NOT EXISTS (SELECT 1 FROM colormarketbat
            WHERE statLineBatTime='$market_id' AND betting_date='$betting_date' AND colormarketbat.bet_num = color.color_id )";
$result_unique = mysqli_query($conn, $sql_unique);
while ($row = mysqli_fetch_assoc($result_unique)) {
    $number = $row['color_id'];
}
if ($number == '') {
    // SQL query to get the sum of bet_amount for each unique bet_num
    $sql = "SELECT bet_num, SUM(bet_amount) AS total_bet_amt FROM colormarketbat WHERE statLineBatTime='$market_id' AND game_name='Color' GROUP BY bet_num";
    // Execute the query
    $result = mysqli_query($conn, $sql);
    // Check if query was successful
    if ($result) {
        $min_total_bet_amt = PHP_INT_MAX; // Initialize minimum total amount to a large value
        // Initialize variable to store bet_num with minimum total amount
        $bet_num_min_total = null;
        // Fetch the results and iterate through them
        while ($row = mysqli_fetch_assoc($result)) {
            $bet_num = $row['bet_num'];
            $total_bet_amt = $row['total_bet_amt'];
            // Check if current total amount is less than minimum total amount
            if ($total_bet_amt < $min_total_bet_amt) {
                $min_total_bet_amt = $total_bet_amt; // Update minimum total amount
                $bet_num_min_total = $bet_num; // Update bet_num with minimum total amount
            }
        }
        // Print the bet_num with minimum total amount
        $number = $bet_num_min_total;
    }
}


echo "<br/>";
echo "<br/>";
echo "<br/>";
echo $market_id = $market_id;
echo "<br/>";
echo $betdate = $betdate;
echo "<br/>";
echo $number = $number; //result number
echo "<br/>";
echo $game_name = 'Color';
// exit;
$game_name = 'Color';

$dsql = "SELECT * FROM colormarket WHERE betting_time = '$betdate' AND game_name ='$game_name' AND active_status='Active'";
$getqry = mysqli_query($conn, $dsql);
if (mysqli_num_rows($getqry) > 0) {
    $row = mysqli_fetch_assoc($getqry);
    $exid = $row['id'];

    if ($market_id == date('h:i a', strtotime("00:00:00"))) {
        $usql = "UPDATE colormarket SET C1='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:05:00"))) {
        $usql = "UPDATE colormarket SET C2='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:10:00"))) {
        $usql = "UPDATE colormarket SET C3='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:15:00"))) {
        $usql = "UPDATE colormarket SET C4='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:20:00"))) {
        $usql = "UPDATE colormarket SET C5='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:25:00"))) {
        $usql = "UPDATE colormarket SET C6='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:30:00"))) {
        $usql = "UPDATE colormarket SET C7='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:35:00"))) {
        $usql = "UPDATE colormarket SET C8='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:40:00"))) {
        $usql = "UPDATE colormarket SET C9='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:45:00"))) {
        $usql = "UPDATE colormarket SET C10='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:50:00"))) {
        $usql = "UPDATE colormarket SET C11='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:55:00"))) {
        $usql = "UPDATE colormarket SET C12='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:00:00"))) {
        $usql = "UPDATE colormarket SET C13='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:05:00"))) {
        $usql = "UPDATE colormarket SET C14='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:10:00"))) {
        $usql = "UPDATE colormarket SET C15='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:15:00"))) {
        $usql = "UPDATE colormarket SET C16='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:20:00"))) {
        $usql = "UPDATE colormarket SET C17='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:25:00"))) {
        $usql = "UPDATE colormarket SET C18='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:30:00"))) {
        $usql = "UPDATE colormarket SET C19='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:35:00"))) {
        $usql = "UPDATE colormarket SET C20='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:40:00"))) {
        $usql = "UPDATE colormarket SET C21='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:45:00"))) {
        $usql = "UPDATE colormarket SET C22='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:50:00"))) {
        $usql = "UPDATE colormarket SET C23='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:55:00"))) {
        $usql = "UPDATE colormarket SET C24='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:00:00"))) {
        $usql = "UPDATE colormarket SET C25='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:05:00"))) {
        $usql = "UPDATE colormarket SET C26='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:10:00"))) {
        $usql = "UPDATE colormarket SET C27='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:15:00"))) {
        $usql = "UPDATE colormarket SET C28='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:20:00"))) {
        $usql = "UPDATE colormarket SET C29='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:25:00"))) {
        $usql = "UPDATE colormarket SET C30='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:30:00"))) {
        $usql = "UPDATE colormarket SET C31='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:35:00"))) {
        $usql = "UPDATE colormarket SET C32='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:40:00"))) {
        $usql = "UPDATE colormarket SET C33='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:45:00"))) {
        $usql = "UPDATE colormarket SET C34='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:50:00"))) {
        $usql = "UPDATE colormarket SET C35='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:55:00"))) {
        $usql = "UPDATE colormarket SET C36='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:00:00"))) {
        $usql = "UPDATE colormarket SET C37='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:05:00"))) {
        $usql = "UPDATE colormarket SET C38='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:10:00"))) {
        $usql = "UPDATE colormarket SET C39='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:15:00"))) {
        $usql = "UPDATE colormarket SET C40='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:20:00"))) {
        $usql = "UPDATE colormarket SET C41='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:25:00"))) {
        $usql = "UPDATE colormarket SET C42='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:30:00"))) {
        $usql = "UPDATE colormarket SET C43='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:35:00"))) {
        $usql = "UPDATE colormarket SET C44='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:40:00"))) {
        $usql = "UPDATE colormarket SET C45='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:45:00"))) {
        $usql = "UPDATE colormarket SET C46='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:50:00"))) {
        $usql = "UPDATE colormarket SET C47='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:55:00"))) {
        $usql = "UPDATE colormarket SET C48='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:00:00"))) {
        $usql = "UPDATE colormarket SET C49='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:05:00"))) {
        $usql = "UPDATE colormarket SET C50='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:10:00"))) {
        $usql = "UPDATE colormarket SET C51='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:05:00"))) {
        $usql = "UPDATE colormarket SET C52='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:10:00"))) {
        $usql = "UPDATE colormarket SET C53='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:15:00"))) {
        $usql = "UPDATE colormarket SET C54='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:20:00"))) {
        $usql = "UPDATE colormarket SET C55='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:35:00"))) {
        $usql = "UPDATE colormarket SET C56='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:40:00"))) {
        $usql = "UPDATE colormarket SET C57='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:45:00"))) {
        $usql = "UPDATE colormarket SET C58='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:50:00"))) {
        $usql = "UPDATE colormarket SET C59='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:55:00"))) {
        $usql = "UPDATE colormarket SET C60='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:00:00"))) {
        $usql = "UPDATE colormarket SET C61='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:05:00"))) {
        $usql = "UPDATE colormarket SET C62='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:10:00"))) {
        $usql = "UPDATE colormarket SET C63='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:15:00"))) {
        $usql = "UPDATE colormarket SET C64='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:20:00"))) {
        $usql = "UPDATE colormarket SET C65='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:25:00"))) {
        $usql = "UPDATE colormarket SET C66='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:30:00"))) {
        $usql = "UPDATE colormarket SET C67='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:35:00"))) {
        $usql = "UPDATE colormarket SET C68='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:40:00"))) {
        $usql = "UPDATE colormarket SET C69='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:45:00"))) {
        $usql = "UPDATE colormarket SET C70='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:50:00"))) {
        $usql = "UPDATE colormarket SET C71='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:55:00"))) {
        $usql = "UPDATE colormarket SET C72='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:00:00"))) {
        $usql = "UPDATE colormarket SET C73='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:05:00"))) {
        $usql = "UPDATE colormarket SET C74='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:10:00"))) {
        $usql = "UPDATE colormarket SET C75='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:15:00"))) {
        $usql = "UPDATE colormarket SET C76='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:20:00"))) {
        $usql = "UPDATE colormarket SET C77='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:25:00"))) {
        $usql = "UPDATE colormarket SET C78='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:30:00"))) {
        $usql = "UPDATE colormarket SET C79='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:35:00"))) {
        $usql = "UPDATE colormarket SET C80='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:40:00"))) {
        $usql = "UPDATE colormarket SET C81='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:45:00"))) {
        $usql = "UPDATE colormarket SET C82='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:50:00"))) {
        $usql = "UPDATE colormarket SET C83='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:55:00"))) {
        $usql = "UPDATE colormarket SET C84='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:00:00"))) {
        $usql = "UPDATE colormarket SET C85='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:05:00"))) {
        $usql = "UPDATE colormarket SET C86='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:10:00"))) {
        $usql = "UPDATE colormarket SET C87='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:15:00"))) {
        $usql = "UPDATE colormarket SET C88='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:20:00"))) {
        $usql = "UPDATE colormarket SET C89='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:25:00"))) {
        $usql = "UPDATE colormarket SET C90='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:30:00"))) {
        $usql = "UPDATE colormarket SET C91='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:35:00"))) {
        $usql = "UPDATE colormarket SET C92='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:40:00"))) {
        $usql = "UPDATE colormarket SET C93='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:45:00"))) {
        $usql = "UPDATE colormarket SET C94='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:50:00"))) {
        $usql = "UPDATE colormarket SET C95='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:55:00"))) {
        $usql = "UPDATE colormarket SET C96='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:00:00"))) {
        $usql = "UPDATE colormarket SET C97='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:05:00"))) {
        $usql = "UPDATE colormarket SET C98='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:10:00"))) {
        $usql = "UPDATE colormarket SET C99='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:15:00"))) {
        $usql = "UPDATE colormarket SET C100='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:20:00"))) {
        $usql = "UPDATE colormarket SET C101='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:25:00"))) {
        $usql = "UPDATE colormarket SET C012='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:30:00"))) {
        $usql = "UPDATE colormarket SET C103='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:35:00"))) {
        $usql = "UPDATE colormarket SET C104='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:40:00"))) {
        $usql = "UPDATE colormarket SET C105='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:45:00"))) {
        $usql = "UPDATE colormarket SET C106='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:50:00"))) {
        $usql = "UPDATE colormarket SET C107='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:55:00"))) {
        $usql = "UPDATE colormarket SET C108='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:00:00"))) {
        $usql = "UPDATE colormarket SET C109='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:05:00"))) {
        $usql = "UPDATE colormarket SET C110='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:10:00"))) {
        $usql = "UPDATE colormarket SET C111='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:15:00"))) {
        $usql = "UPDATE colormarket SET C112='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:20:00"))) {
        $usql = "UPDATE colormarket SET C113='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:25:00"))) {
        $usql = "UPDATE colormarket SET C114='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:30:00"))) {
        $usql = "UPDATE colormarket SET C115='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:35:00"))) {
        $usql = "UPDATE colormarket SET C116='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:40:00"))) {
        $usql = "UPDATE colormarket SET C117='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:45:00"))) {
        $usql = "UPDATE colormarket SET C118='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:50:00"))) {
        $usql = "UPDATE colormarket SET C119='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:55:00"))) {
        $usql = "UPDATE colormarket SET C120='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:00:00"))) {
        $usql = "UPDATE colormarket SET C121='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:05:00"))) {
        $usql = "UPDATE colormarket SET C122='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:10:00"))) {
        $usql = "UPDATE colormarket SET C123='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:15:00"))) {
        $usql = "UPDATE colormarket SET C124='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:20:00"))) {
        $usql = "UPDATE colormarket SET C125='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:25:00"))) {
        $usql = "UPDATE colormarket SET C126='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:30:00"))) {
        $usql = "UPDATE colormarket SET C127='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:35:00"))) {
        $usql = "UPDATE colormarket SET C128='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:40:00"))) {
        $usql = "UPDATE colormarket SET C129='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:45:00"))) {
        $usql = "UPDATE colormarket SET C130='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:50:00"))) {
        $usql = "UPDATE colormarket SET C131='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:55:00"))) {
        $usql = "UPDATE colormarket SET C132='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:00:00"))) {
        $usql = "UPDATE colormarket SET C133='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:05:00"))) {
        $usql = "UPDATE colormarket SET C134='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:10:00"))) {
        $usql = "UPDATE colormarket SET C135='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:15:00"))) {
        $usql = "UPDATE colormarket SET C136='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:20:00"))) {
        $usql = "UPDATE colormarket SET C137='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:25:00"))) {
        $usql = "UPDATE colormarket SET C138='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:30:00"))) {
        $usql = "UPDATE colormarket SET C139='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:35:00"))) {
        $usql = "UPDATE colormarket SET C140='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:40:00"))) {
        $usql = "UPDATE colormarket SET C141='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:45:00"))) {
        $usql = "UPDATE colormarket SET C142='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:50:00"))) {
        $usql = "UPDATE colormarket SET C143='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:55:00"))) {
        $usql = "UPDATE colormarket SET C144='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:00:00"))) {
        $usql = "UPDATE colormarket SET C145='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:05:00"))) {
        $usql = "UPDATE colormarket SET C146='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:10:00"))) {
        $usql = "UPDATE colormarket SET C147='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:15:00"))) {
        $usql = "UPDATE colormarket SET C148='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:20:00"))) {
        $usql = "UPDATE colormarket SET C149='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:25:00"))) {
        $usql = "UPDATE colormarket SET C150='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:30:00"))) {
        $usql = "UPDATE colormarket SET C151='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:35:00"))) {
        $usql = "UPDATE colormarket SET C152='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:40:00"))) {
        $usql = "UPDATE colormarket SET C153='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:45:00"))) {
        $usql = "UPDATE colormarket SET C154='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:50:00"))) {
        $usql = "UPDATE colormarket SET C155='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:55:00"))) {
        $usql = "UPDATE colormarket SET C156='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:00:00"))) {
        $usql = "UPDATE colormarket SET C157='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:05:00"))) {
        $usql = "UPDATE colormarket SET C158='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:10:00"))) {
        $usql = "UPDATE colormarket SET C159='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:15:00"))) {
        $usql = "UPDATE colormarket SET C160='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:20:00"))) {
        $usql = "UPDATE colormarket SET C161='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:25:00"))) {
        $usql = "UPDATE colormarket SET C162='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:30:00"))) {
        $usql = "UPDATE colormarket SET C163='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:35:00"))) {
        $usql = "UPDATE colormarket SET C164='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:40:00"))) {
        $usql = "UPDATE colormarket SET C165='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:45:00"))) {
        $usql = "UPDATE colormarket SET C166='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:50:00"))) {
        $usql = "UPDATE colormarket SET C167='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:55:00"))) {
        $usql = "UPDATE colormarket SET C168='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:00:00"))) {
        $usql = "UPDATE colormarket SET C169='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:05:00"))) {
        $usql = "UPDATE colormarket SET C170='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:10:00"))) {
        $usql = "UPDATE colormarket SET C171='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:15:00"))) {
        $usql = "UPDATE colormarket SET C172='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:20:00"))) {
        $usql = "UPDATE colormarket SET C173='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:25:00"))) {
        $usql = "UPDATE colormarket SET C174='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:30:00"))) {
        $usql = "UPDATE colormarket SET C175='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:35:00"))) {
        $usql = "UPDATE colormarket SET C176='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:40:00"))) {
        $usql = "UPDATE colormarket SET C177='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:45:00"))) {
        $usql = "UPDATE colormarket SET C178='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:50:00"))) {
        $usql = "UPDATE colormarket SET C179='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:55:00"))) {
        $usql = "UPDATE colormarket SET C180='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:00:00"))) {
        $usql = "UPDATE colormarket SET C181='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:05:00"))) {
        $usql = "UPDATE colormarket SET C182='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:10:00"))) {
        $usql = "UPDATE colormarket SET C183='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:15:00"))) {
        $usql = "UPDATE colormarket SET C184='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:20:00"))) {
        $usql = "UPDATE colormarket SET C185='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:25:00"))) {
        $usql = "UPDATE colormarket SET C186='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:30:00"))) {
        $usql = "UPDATE colormarket SET C187='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:35:00"))) {
        $usql = "UPDATE colormarket SET C188='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:40:00"))) {
        $usql = "UPDATE colormarket SET C189='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:45:00"))) {
        $usql = "UPDATE colormarket SET C190='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:50:00"))) {
        $usql = "UPDATE colormarket SET C191='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:55:00"))) {
        $usql = "UPDATE colormarket SET C192='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:00:00"))) {
        $usql = "UPDATE colormarket SET C193='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:05:00"))) {
        $usql = "UPDATE colormarket SET C194='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:10:00"))) {
        $usql = "UPDATE colormarket SET C195='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:15:00"))) {
        $usql = "UPDATE colormarket SET C196='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:20:00"))) {
        $usql = "UPDATE colormarket SET C197='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:25:00"))) {
        $usql = "UPDATE colormarket SET C198='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:30:00"))) {
        $usql = "UPDATE colormarket SET C199='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:35:00"))) {
        $usql = "UPDATE colormarket SET C200='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:40:00"))) {
        $usql = "UPDATE colormarket SET C201='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:45:00"))) {
        $usql = "UPDATE colormarket SET C202='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:50:00"))) {
        $usql = "UPDATE colormarket SET C203='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:55:00"))) {
        $usql = "UPDATE colormarket SET C204='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:00:00"))) {
        $usql = "UPDATE colormarket SET C205='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:05:00"))) {
        $usql = "UPDATE colormarket SET C206='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:10:00"))) {
        $usql = "UPDATE colormarket SET C207='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:15:00"))) {
        $usql = "UPDATE colormarket SET C208='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:20:00"))) {
        $usql = "UPDATE colormarket SET C209='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:25:00"))) {
        $usql = "UPDATE colormarket SET C210='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:30:00"))) {
        $usql = "UPDATE colormarket SET C211='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:35:00"))) {
        $usql = "UPDATE colormarket SET C212='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:40:00"))) {
        $usql = "UPDATE colormarket SET C213='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:45:00"))) {
        $usql = "UPDATE colormarket SET C214='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:50:00"))) {
        $usql = "UPDATE colormarket SET C215='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:55:00"))) {
        $usql = "UPDATE colormarket SET C216='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:00:00"))) {
        $usql = "UPDATE colormarket SET C217='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:05:00"))) {
        $usql = "UPDATE colormarket SET C218='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:10:00"))) {
        $usql = "UPDATE colormarket SET C219='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:15:00"))) {
        $usql = "UPDATE colormarket SET C220='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:20:00"))) {
        $usql = "UPDATE colormarket SET C221='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:25:00"))) {
        $usql = "UPDATE colormarket SET C222='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:30:00"))) {
        $usql = "UPDATE colormarket SET C223='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:35:00"))) {
        $usql = "UPDATE colormarket SET C224='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:40:00"))) {
        $usql = "UPDATE colormarket SET C225='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:45:00"))) {
        $usql = "UPDATE colormarket SET C226='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:50:00"))) {
        $usql = "UPDATE colormarket SET C227='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:55:00"))) {
        $usql = "UPDATE colormarket SET C228='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:00:00"))) {
        $usql = "UPDATE colormarket SET C229='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:05:00"))) {
        $usql = "UPDATE colormarket SET C230='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:10:00"))) {
        $usql = "UPDATE colormarket SET C231='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:15:00"))) {
        $usql = "UPDATE colormarket SET C232='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:20:00"))) {
        $usql = "UPDATE colormarket SET C233='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:25:00"))) {
        $usql = "UPDATE colormarket SET C234='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:30:00"))) {
        $usql = "UPDATE colormarket SET C235='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:35:00"))) {
        $usql = "UPDATE colormarket SET C236='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:40:00"))) {
        $usql = "UPDATE colormarket SET C237='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:45:00"))) {
        $usql = "UPDATE colormarket SET C238='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:50:00"))) {
        $usql = "UPDATE colormarket SET C239='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:55:00"))) {
        $usql = "UPDATE colormarket SET C240='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:00:00"))) {
        $usql = "UPDATE colormarket SET C241='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:05:00"))) {
        $usql = "UPDATE colormarket SET C242='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:10:00"))) {
        $usql = "UPDATE colormarket SET C243='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:15:00"))) {
        $usql = "UPDATE colormarket SET C244='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:20:00"))) {
        $usql = "UPDATE colormarket SET C245='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:25:00"))) {
        $usql = "UPDATE colormarket SET C246='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:30:00"))) {
        $usql = "UPDATE colormarket SET C247='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:35:00"))) {
        $usql = "UPDATE colormarket SET C248='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:40:00"))) {
        $usql = "UPDATE colormarket SET C249='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:45:00"))) {
        $usql = "UPDATE colormarket SET C250='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:50:00"))) {
        $usql = "UPDATE colormarket SET C251='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:55:00"))) {
        $usql = "UPDATE colormarket SET C252='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:00:00"))) {
        $usql = "UPDATE colormarket SET C253='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:05:00"))) {
        $usql = "UPDATE colormarket SET C254='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:10:00"))) {
        $usql = "UPDATE colormarket SET C255='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:15:00"))) {
        $usql = "UPDATE colormarket SET C256='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:20:00"))) {
        $usql = "UPDATE colormarket SET C257='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:25:00"))) {
        $usql = "UPDATE colormarket SET C258='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:30:00"))) {
        $usql = "UPDATE colormarket SET C259='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:35:00"))) {
        $usql = "UPDATE colormarket SET C260='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:40:00"))) {
        $usql = "UPDATE colormarket SET C261='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:45:00"))) {
        $usql = "UPDATE colormarket SET C262='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:50:00"))) {
        $usql = "UPDATE colormarket SET C263='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:55:00"))) {
        $usql = "UPDATE colormarket SET C264='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:00:00"))) {
        $usql = "UPDATE colormarket SET C265='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:05:00"))) {
        $usql = "UPDATE colormarket SET C266='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:10:00"))) {
        $usql = "UPDATE colormarket SET C267='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:15:00"))) {
        $usql = "UPDATE colormarket SET C268='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:20:00"))) {
        $usql = "UPDATE colormarket SET C269='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:25:00"))) {
        $usql = "UPDATE colormarket SET C270='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:30:00"))) {
        $usql = "UPDATE colormarket SET C271='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:35:00"))) {
        $usql = "UPDATE colormarket SET C272='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:40:00"))) {
        $usql = "UPDATE colormarket SET C273='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:45:00"))) {
        $usql = "UPDATE colormarket SET C274='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:50:00"))) {
        $usql = "UPDATE colormarket SET C275='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:55:00"))) {
        $usql = "UPDATE colormarket SET C276='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:00:00"))) {
        $usql = "UPDATE colormarket SET C277='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:05:00"))) {
        $usql = "UPDATE colormarket SET C278='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:10:00"))) {
        $usql = "UPDATE colormarket SET C279='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:15:00"))) {
        $usql = "UPDATE colormarket SET C280='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:20:00"))) {
        $usql = "UPDATE colormarket SET C281='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:25:00"))) {
        $usql = "UPDATE colormarket SET C282='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:30:00"))) {
        $usql = "UPDATE colormarket SET C283='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:35:00"))) {
        $usql = "UPDATE colormarket SET C284='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:40:00"))) {
        $usql = "UPDATE colormarket SET C285='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:45:00"))) {
        $usql = "UPDATE colormarket SET C286='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:50:00"))) {
        $usql = "UPDATE colormarket SET C287='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:55:00"))) {
        $usql = "UPDATE colormarket SET C288='$number' WHERE id='$exid'";
    }

    $market_id =   date('h:i a', strtotime($market_id));

    // $usql = "UPDATE winningbetting_detail SET winning_number_first='$number1', winning_number_second='$number2', winning_number_third='$number3' , winning_number_fouth='$number4' WHERE Id='$exid'";

    if (!mysqli_query($conn, $usql)) {
        // exit;
        // echo "<script>alert('Number Update Failed');window.location = 'color-declare-result-auto.php';</script>";
    } else {
        $dsql = "CALL Poc_colorWinningAmount('$market_id')";
        if (!mysqli_query($conn, $dsql)) {
            // exit;
            // echo '<script>alert("Number Update Failed");window.location = "color-declare-result-auto.php";</script>';
        } else {
            // exit;
            // echo '<script>alert("Number Update Successfully");window.location = "color-declare-result-auto.php";</script>';
        }
        // echo "<script>alert('Number Update Successfully');window.location = 'color-declare-result-auto.php';</script>";
    }
} else {
    if ($market_id == date('h:i a', strtotime("00:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C1,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C2,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C3,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C4,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C5,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C6,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C7,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C8,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C9,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C10,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C11,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C12,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C13,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C14,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C15,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C16,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C17,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C18,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C19,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C20,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C21,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C22,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C23,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C24,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C25,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C26,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C27,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C28,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C29,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C30,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C31,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C32,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C33,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C34,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C35,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C36,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C37,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C38,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C39,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C40,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C41,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C42,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C43,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C44,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C45,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C46,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C47,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C48,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C49,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C50,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C51,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C52,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C53,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C54,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C55,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C56,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C57,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C58,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C59,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C60,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C61,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C62,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C63,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C64,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C65,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C66,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C67,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C68,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C69,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C70,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C71,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C72,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C73,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C74,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C75,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C76,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C77,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C78,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C79,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C80,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C81,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C82,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C83,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C84,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C85,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C86,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C87,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C88,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C89,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C90,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C91,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C92,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C93,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C94,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C95,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C96,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C97,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C98,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C99,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C100,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C101,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C102,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C203,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C104,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C105,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C106,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C107,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C108,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C109,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C110,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C111,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C112,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C113,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C114,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C115,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C116,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C117,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C118,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C119,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C120,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C121,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C122,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C123,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C124,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C124,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C126,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C127,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C128,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C129,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C130,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C131,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C132,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C133,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C134,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C135,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C136,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C137,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C138,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C139,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C140,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C141,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C142,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C143,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C144,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C145,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C146,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C147,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C148,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C149,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C150,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C151,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C152,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C153,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C154,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C155,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C156,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C157,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C158,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C159,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C160,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C161,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C162,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C163,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C164,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C165,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C166,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C167,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C168,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C169,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C170,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C171,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C172,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C173,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C174,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C175,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C176,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C177,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C178,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C179,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C180,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C181,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C182,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C183,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C184,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C185,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C186,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C187,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C188,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C189,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C190,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C191,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C192,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C193,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C194,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C195,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C196,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C197,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C198,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C199,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C200,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C201,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C202,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C203,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C204,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C205,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C206,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C207,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C208,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C209,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C210,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C211,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C212,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C213,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C214,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C215,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C216,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C217,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C218,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C219,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C220,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C221,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C222,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C223,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C224,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C225,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C226,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C227,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C228,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C229,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C230,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C231,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C232,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C233,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C234,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C235,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C236,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C237,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C238,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C239,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C240,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C241,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C242,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C243,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C244,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C245,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C246,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C247,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C248,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C249,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C250,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C251,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C252,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C253,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C254,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C255,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C256,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C257,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C258,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C259,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C260,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C261,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C262,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C263,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C264,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C265,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C266,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C267,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C268,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C269,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C270,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C271,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C272,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C273,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C274,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C275,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C276,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C277,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C278,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C279,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C280,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C281,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C282,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C283,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C284,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C285,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C286,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C287,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C288,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    }

    if (!mysqli_query($conn, $usql)) {
        // exit;
        // echo "<script>alert('Number Update Failed');window.location = 'color-declare-result-auto.php';</script>";
    } else {
        $dsql = "CALL Poc_colorWinningAmount('$market_id')";
        if (!mysqli_query($conn, $dsql)) {
            // exit;
            // echo '<script>alert("Number Update Failed");window.location = "color-declare-result-auto.php";</script>';
        } else {
            // exit;
            // echo '<script>alert("Number Update Successfully");window.location = "color-declare-result-auto.php";</script>';
        }
        // echo "<script>alert('Number Update Successfully');window.location = 'color-declare-result-auto.php';</script>";
    }
}


$number='';

$sql_unique = "SELECT number FROM lottery_number WHERE status='1' AND NOT EXISTS (SELECT 1 FROM colormarketbat
            WHERE statLineBatTime='$market_id' AND betting_date='$betting_date' AND colormarketbat.bet_num = lottery_number.number )";
$result_unique = mysqli_query($conn, $sql_unique);
while ($row = mysqli_fetch_assoc($result_unique)) {
    echo $number = $row['number'];
}
if ($number == '') {
    // SQL query to get the sum of bet_amount for each unique bet_num
    echo $sql = "SELECT bet_num, SUM(bet_amount) AS total_bet_amt FROM colormarketbat WHERE statLineBatTime='$market_id' AND game_name='Lottery_Number' GROUP BY bet_num";
    // Execute the query
    $result = mysqli_query($conn, $sql);
    // Check if query was successful
    if ($result) {
        $min_total_bet_amt = PHP_INT_MAX; // Initialize minimum total amount to a large value
        // Initialize variable to store bet_num with minimum total amount
        $bet_num_min_total = null;
        // Fetch the results and iterate through them
        while ($row = mysqli_fetch_assoc($result)) {
            $bet_num = $row['bet_num'];
            $total_bet_amt = $row['total_bet_amt'];
            // Check if current total amount is less than minimum total amount
            if ($total_bet_amt < $min_total_bet_amt) {
                $min_total_bet_amt = $total_bet_amt; // Update minimum total amount
                $bet_num_min_total = $bet_num; // Update bet_num with minimum total amount
            }
        }
        // Print the bet_num with minimum total amount
        $number = $bet_num_min_total;
    }
}


echo "<br/>";
echo "<br/>";
echo "<br/>";
echo $market_id = $market_id;
echo "<br/>";
echo $betdate = $betdate;
echo "<br/>";
echo $number = $number; //result number
echo "<br/>";
echo $game_name = 'Lottery_Number';
// exit;
$game_name = 'Lottery_Number';

$dsql = "SELECT * FROM colormarket WHERE betting_time = '$betdate' AND game_name ='$game_name' AND active_status='Active'";
$getqry = mysqli_query($conn, $dsql);
if (mysqli_num_rows($getqry) > 0) {
    $row = mysqli_fetch_assoc($getqry);
    $exid = $row['id'];

    if ($market_id == date('h:i a', strtotime("00:00:00"))) {
        $usql = "UPDATE colormarket SET C1='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:05:00"))) {
        $usql = "UPDATE colormarket SET C2='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:10:00"))) {
        $usql = "UPDATE colormarket SET C3='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:15:00"))) {
        $usql = "UPDATE colormarket SET C4='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:20:00"))) {
        $usql = "UPDATE colormarket SET C5='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:25:00"))) {
        $usql = "UPDATE colormarket SET C6='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:30:00"))) {
        $usql = "UPDATE colormarket SET C7='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:35:00"))) {
        $usql = "UPDATE colormarket SET C8='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:40:00"))) {
        $usql = "UPDATE colormarket SET C9='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:45:00"))) {
        $usql = "UPDATE colormarket SET C10='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:50:00"))) {
        $usql = "UPDATE colormarket SET C11='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("00:55:00"))) {
        $usql = "UPDATE colormarket SET C12='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:00:00"))) {
        $usql = "UPDATE colormarket SET C13='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:05:00"))) {
        $usql = "UPDATE colormarket SET C14='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:10:00"))) {
        $usql = "UPDATE colormarket SET C15='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:15:00"))) {
        $usql = "UPDATE colormarket SET C16='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:20:00"))) {
        $usql = "UPDATE colormarket SET C17='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:25:00"))) {
        $usql = "UPDATE colormarket SET C18='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:30:00"))) {
        $usql = "UPDATE colormarket SET C19='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:35:00"))) {
        $usql = "UPDATE colormarket SET C20='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:40:00"))) {
        $usql = "UPDATE colormarket SET C21='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:45:00"))) {
        $usql = "UPDATE colormarket SET C22='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:50:00"))) {
        $usql = "UPDATE colormarket SET C23='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("01:55:00"))) {
        $usql = "UPDATE colormarket SET C24='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:00:00"))) {
        $usql = "UPDATE colormarket SET C25='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:05:00"))) {
        $usql = "UPDATE colormarket SET C26='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:10:00"))) {
        $usql = "UPDATE colormarket SET C27='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:15:00"))) {
        $usql = "UPDATE colormarket SET C28='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:20:00"))) {
        $usql = "UPDATE colormarket SET C29='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:25:00"))) {
        $usql = "UPDATE colormarket SET C30='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:30:00"))) {
        $usql = "UPDATE colormarket SET C31='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:35:00"))) {
        $usql = "UPDATE colormarket SET C32='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:40:00"))) {
        $usql = "UPDATE colormarket SET C33='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:45:00"))) {
        $usql = "UPDATE colormarket SET C34='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:50:00"))) {
        $usql = "UPDATE colormarket SET C35='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("02:55:00"))) {
        $usql = "UPDATE colormarket SET C36='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:00:00"))) {
        $usql = "UPDATE colormarket SET C37='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:05:00"))) {
        $usql = "UPDATE colormarket SET C38='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:10:00"))) {
        $usql = "UPDATE colormarket SET C39='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:15:00"))) {
        $usql = "UPDATE colormarket SET C40='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:20:00"))) {
        $usql = "UPDATE colormarket SET C41='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:25:00"))) {
        $usql = "UPDATE colormarket SET C42='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:30:00"))) {
        $usql = "UPDATE colormarket SET C43='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:35:00"))) {
        $usql = "UPDATE colormarket SET C44='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:40:00"))) {
        $usql = "UPDATE colormarket SET C45='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:45:00"))) {
        $usql = "UPDATE colormarket SET C46='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:50:00"))) {
        $usql = "UPDATE colormarket SET C47='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("03:55:00"))) {
        $usql = "UPDATE colormarket SET C48='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:00:00"))) {
        $usql = "UPDATE colormarket SET C49='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:05:00"))) {
        $usql = "UPDATE colormarket SET C50='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:10:00"))) {
        $usql = "UPDATE colormarket SET C51='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:05:00"))) {
        $usql = "UPDATE colormarket SET C52='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:10:00"))) {
        $usql = "UPDATE colormarket SET C53='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:15:00"))) {
        $usql = "UPDATE colormarket SET C54='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:20:00"))) {
        $usql = "UPDATE colormarket SET C55='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:35:00"))) {
        $usql = "UPDATE colormarket SET C56='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:40:00"))) {
        $usql = "UPDATE colormarket SET C57='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:45:00"))) {
        $usql = "UPDATE colormarket SET C58='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:50:00"))) {
        $usql = "UPDATE colormarket SET C59='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("04:55:00"))) {
        $usql = "UPDATE colormarket SET C60='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:00:00"))) {
        $usql = "UPDATE colormarket SET C61='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:05:00"))) {
        $usql = "UPDATE colormarket SET C62='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:10:00"))) {
        $usql = "UPDATE colormarket SET C63='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:15:00"))) {
        $usql = "UPDATE colormarket SET C64='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:20:00"))) {
        $usql = "UPDATE colormarket SET C65='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:25:00"))) {
        $usql = "UPDATE colormarket SET C66='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:30:00"))) {
        $usql = "UPDATE colormarket SET C67='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:35:00"))) {
        $usql = "UPDATE colormarket SET C68='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:40:00"))) {
        $usql = "UPDATE colormarket SET C69='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:45:00"))) {
        $usql = "UPDATE colormarket SET C70='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:50:00"))) {
        $usql = "UPDATE colormarket SET C71='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("05:55:00"))) {
        $usql = "UPDATE colormarket SET C72='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:00:00"))) {
        $usql = "UPDATE colormarket SET C73='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:05:00"))) {
        $usql = "UPDATE colormarket SET C74='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:10:00"))) {
        $usql = "UPDATE colormarket SET C75='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:15:00"))) {
        $usql = "UPDATE colormarket SET C76='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:20:00"))) {
        $usql = "UPDATE colormarket SET C77='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:25:00"))) {
        $usql = "UPDATE colormarket SET C78='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:30:00"))) {
        $usql = "UPDATE colormarket SET C79='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:35:00"))) {
        $usql = "UPDATE colormarket SET C80='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:40:00"))) {
        $usql = "UPDATE colormarket SET C81='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:45:00"))) {
        $usql = "UPDATE colormarket SET C82='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:50:00"))) {
        $usql = "UPDATE colormarket SET C83='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("06:55:00"))) {
        $usql = "UPDATE colormarket SET C84='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:00:00"))) {
        $usql = "UPDATE colormarket SET C85='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:05:00"))) {
        $usql = "UPDATE colormarket SET C86='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:10:00"))) {
        $usql = "UPDATE colormarket SET C87='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:15:00"))) {
        $usql = "UPDATE colormarket SET C88='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:20:00"))) {
        $usql = "UPDATE colormarket SET C89='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:25:00"))) {
        $usql = "UPDATE colormarket SET C90='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:30:00"))) {
        $usql = "UPDATE colormarket SET C91='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:35:00"))) {
        $usql = "UPDATE colormarket SET C92='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:40:00"))) {
        $usql = "UPDATE colormarket SET C93='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:45:00"))) {
        $usql = "UPDATE colormarket SET C94='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:50:00"))) {
        $usql = "UPDATE colormarket SET C95='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("07:55:00"))) {
        $usql = "UPDATE colormarket SET C96='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:00:00"))) {
        $usql = "UPDATE colormarket SET C97='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:05:00"))) {
        $usql = "UPDATE colormarket SET C98='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:10:00"))) {
        $usql = "UPDATE colormarket SET C99='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:15:00"))) {
        $usql = "UPDATE colormarket SET C100='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:20:00"))) {
        $usql = "UPDATE colormarket SET C101='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:25:00"))) {
        $usql = "UPDATE colormarket SET C012='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:30:00"))) {
        $usql = "UPDATE colormarket SET C103='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:35:00"))) {
        $usql = "UPDATE colormarket SET C104='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:40:00"))) {
        $usql = "UPDATE colormarket SET C105='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:45:00"))) {
        $usql = "UPDATE colormarket SET C106='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:50:00"))) {
        $usql = "UPDATE colormarket SET C107='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("08:55:00"))) {
        $usql = "UPDATE colormarket SET C108='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:00:00"))) {
        $usql = "UPDATE colormarket SET C109='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:05:00"))) {
        $usql = "UPDATE colormarket SET C110='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:10:00"))) {
        $usql = "UPDATE colormarket SET C111='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:15:00"))) {
        $usql = "UPDATE colormarket SET C112='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:20:00"))) {
        $usql = "UPDATE colormarket SET C113='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:25:00"))) {
        $usql = "UPDATE colormarket SET C114='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:30:00"))) {
        $usql = "UPDATE colormarket SET C115='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:35:00"))) {
        $usql = "UPDATE colormarket SET C116='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:40:00"))) {
        $usql = "UPDATE colormarket SET C117='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:45:00"))) {
        $usql = "UPDATE colormarket SET C118='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:50:00"))) {
        $usql = "UPDATE colormarket SET C119='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("09:55:00"))) {
        $usql = "UPDATE colormarket SET C120='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:00:00"))) {
        $usql = "UPDATE colormarket SET C121='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:05:00"))) {
        $usql = "UPDATE colormarket SET C122='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:10:00"))) {
        $usql = "UPDATE colormarket SET C123='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:15:00"))) {
        $usql = "UPDATE colormarket SET C124='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:20:00"))) {
        $usql = "UPDATE colormarket SET C125='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:25:00"))) {
        $usql = "UPDATE colormarket SET C126='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:30:00"))) {
        $usql = "UPDATE colormarket SET C127='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:35:00"))) {
        $usql = "UPDATE colormarket SET C128='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:40:00"))) {
        $usql = "UPDATE colormarket SET C129='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:45:00"))) {
        $usql = "UPDATE colormarket SET C130='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:50:00"))) {
        $usql = "UPDATE colormarket SET C131='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("10:55:00"))) {
        $usql = "UPDATE colormarket SET C132='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:00:00"))) {
        $usql = "UPDATE colormarket SET C133='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:05:00"))) {
        $usql = "UPDATE colormarket SET C134='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:10:00"))) {
        $usql = "UPDATE colormarket SET C135='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:15:00"))) {
        $usql = "UPDATE colormarket SET C136='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:20:00"))) {
        $usql = "UPDATE colormarket SET C137='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:25:00"))) {
        $usql = "UPDATE colormarket SET C138='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:30:00"))) {
        $usql = "UPDATE colormarket SET C139='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:35:00"))) {
        $usql = "UPDATE colormarket SET C140='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:40:00"))) {
        $usql = "UPDATE colormarket SET C141='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:45:00"))) {
        $usql = "UPDATE colormarket SET C142='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:50:00"))) {
        $usql = "UPDATE colormarket SET C143='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("11:55:00"))) {
        $usql = "UPDATE colormarket SET C144='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:00:00"))) {
        $usql = "UPDATE colormarket SET C145='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:05:00"))) {
        $usql = "UPDATE colormarket SET C146='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:10:00"))) {
        $usql = "UPDATE colormarket SET C147='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:15:00"))) {
        $usql = "UPDATE colormarket SET C148='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:20:00"))) {
        $usql = "UPDATE colormarket SET C149='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:25:00"))) {
        $usql = "UPDATE colormarket SET C150='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:30:00"))) {
        $usql = "UPDATE colormarket SET C151='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:35:00"))) {
        $usql = "UPDATE colormarket SET C152='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:40:00"))) {
        $usql = "UPDATE colormarket SET C153='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:45:00"))) {
        $usql = "UPDATE colormarket SET C154='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:50:00"))) {
        $usql = "UPDATE colormarket SET C155='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("12:55:00"))) {
        $usql = "UPDATE colormarket SET C156='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:00:00"))) {
        $usql = "UPDATE colormarket SET C157='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:05:00"))) {
        $usql = "UPDATE colormarket SET C158='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:10:00"))) {
        $usql = "UPDATE colormarket SET C159='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:15:00"))) {
        $usql = "UPDATE colormarket SET C160='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:20:00"))) {
        $usql = "UPDATE colormarket SET C161='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:25:00"))) {
        $usql = "UPDATE colormarket SET C162='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:30:00"))) {
        $usql = "UPDATE colormarket SET C163='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:35:00"))) {
        $usql = "UPDATE colormarket SET C164='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:40:00"))) {
        $usql = "UPDATE colormarket SET C165='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:45:00"))) {
        $usql = "UPDATE colormarket SET C166='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:50:00"))) {
        $usql = "UPDATE colormarket SET C167='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("13:55:00"))) {
        $usql = "UPDATE colormarket SET C168='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:00:00"))) {
        $usql = "UPDATE colormarket SET C169='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:05:00"))) {
        $usql = "UPDATE colormarket SET C170='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:10:00"))) {
        $usql = "UPDATE colormarket SET C171='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:15:00"))) {
        $usql = "UPDATE colormarket SET C172='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:20:00"))) {
        $usql = "UPDATE colormarket SET C173='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:25:00"))) {
        $usql = "UPDATE colormarket SET C174='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:30:00"))) {
        $usql = "UPDATE colormarket SET C175='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:35:00"))) {
        $usql = "UPDATE colormarket SET C176='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:40:00"))) {
        $usql = "UPDATE colormarket SET C177='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:45:00"))) {
        $usql = "UPDATE colormarket SET C178='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:50:00"))) {
        $usql = "UPDATE colormarket SET C179='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("14:55:00"))) {
        $usql = "UPDATE colormarket SET C180='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:00:00"))) {
        $usql = "UPDATE colormarket SET C181='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:05:00"))) {
        $usql = "UPDATE colormarket SET C182='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:10:00"))) {
        $usql = "UPDATE colormarket SET C183='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:15:00"))) {
        $usql = "UPDATE colormarket SET C184='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:20:00"))) {
        $usql = "UPDATE colormarket SET C185='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:25:00"))) {
        $usql = "UPDATE colormarket SET C186='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:30:00"))) {
        $usql = "UPDATE colormarket SET C187='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:35:00"))) {
        $usql = "UPDATE colormarket SET C188='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:40:00"))) {
        $usql = "UPDATE colormarket SET C189='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:45:00"))) {
        $usql = "UPDATE colormarket SET C190='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:50:00"))) {
        $usql = "UPDATE colormarket SET C191='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("15:55:00"))) {
        $usql = "UPDATE colormarket SET C192='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:00:00"))) {
        $usql = "UPDATE colormarket SET C193='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:05:00"))) {
        $usql = "UPDATE colormarket SET C194='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:10:00"))) {
        $usql = "UPDATE colormarket SET C195='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:15:00"))) {
        $usql = "UPDATE colormarket SET C196='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:20:00"))) {
        $usql = "UPDATE colormarket SET C197='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:25:00"))) {
        $usql = "UPDATE colormarket SET C198='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:30:00"))) {
        $usql = "UPDATE colormarket SET C199='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:35:00"))) {
        $usql = "UPDATE colormarket SET C200='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:40:00"))) {
        $usql = "UPDATE colormarket SET C201='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:45:00"))) {
        $usql = "UPDATE colormarket SET C202='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:50:00"))) {
        $usql = "UPDATE colormarket SET C203='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("16:55:00"))) {
        $usql = "UPDATE colormarket SET C204='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:00:00"))) {
        $usql = "UPDATE colormarket SET C205='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:05:00"))) {
        $usql = "UPDATE colormarket SET C206='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:10:00"))) {
        $usql = "UPDATE colormarket SET C207='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:15:00"))) {
        $usql = "UPDATE colormarket SET C208='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:20:00"))) {
        $usql = "UPDATE colormarket SET C209='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:25:00"))) {
        $usql = "UPDATE colormarket SET C210='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:30:00"))) {
        $usql = "UPDATE colormarket SET C211='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:35:00"))) {
        $usql = "UPDATE colormarket SET C212='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:40:00"))) {
        $usql = "UPDATE colormarket SET C213='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:45:00"))) {
        $usql = "UPDATE colormarket SET C214='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:50:00"))) {
        $usql = "UPDATE colormarket SET C215='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("17:55:00"))) {
        $usql = "UPDATE colormarket SET C216='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:00:00"))) {
        $usql = "UPDATE colormarket SET C217='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:05:00"))) {
        $usql = "UPDATE colormarket SET C218='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:10:00"))) {
        $usql = "UPDATE colormarket SET C219='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:15:00"))) {
        $usql = "UPDATE colormarket SET C220='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:20:00"))) {
        $usql = "UPDATE colormarket SET C221='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:25:00"))) {
        $usql = "UPDATE colormarket SET C222='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:30:00"))) {
        $usql = "UPDATE colormarket SET C223='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:35:00"))) {
        $usql = "UPDATE colormarket SET C224='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:40:00"))) {
        $usql = "UPDATE colormarket SET C225='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:45:00"))) {
        $usql = "UPDATE colormarket SET C226='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:50:00"))) {
        $usql = "UPDATE colormarket SET C227='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("18:55:00"))) {
        $usql = "UPDATE colormarket SET C228='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:00:00"))) {
        $usql = "UPDATE colormarket SET C229='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:05:00"))) {
        $usql = "UPDATE colormarket SET C230='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:10:00"))) {
        $usql = "UPDATE colormarket SET C231='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:15:00"))) {
        $usql = "UPDATE colormarket SET C232='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:20:00"))) {
        $usql = "UPDATE colormarket SET C233='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:25:00"))) {
        $usql = "UPDATE colormarket SET C234='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:30:00"))) {
        $usql = "UPDATE colormarket SET C235='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:35:00"))) {
        $usql = "UPDATE colormarket SET C236='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:40:00"))) {
        $usql = "UPDATE colormarket SET C237='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:45:00"))) {
        $usql = "UPDATE colormarket SET C238='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:50:00"))) {
        $usql = "UPDATE colormarket SET C239='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("19:55:00"))) {
        $usql = "UPDATE colormarket SET C240='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:00:00"))) {
        $usql = "UPDATE colormarket SET C241='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:05:00"))) {
        $usql = "UPDATE colormarket SET C242='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:10:00"))) {
        $usql = "UPDATE colormarket SET C243='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:15:00"))) {
        $usql = "UPDATE colormarket SET C244='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:20:00"))) {
        $usql = "UPDATE colormarket SET C245='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:25:00"))) {
        $usql = "UPDATE colormarket SET C246='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:30:00"))) {
        $usql = "UPDATE colormarket SET C247='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:35:00"))) {
        $usql = "UPDATE colormarket SET C248='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:40:00"))) {
        $usql = "UPDATE colormarket SET C249='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:45:00"))) {
        $usql = "UPDATE colormarket SET C250='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:50:00"))) {
        $usql = "UPDATE colormarket SET C251='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("20:55:00"))) {
        $usql = "UPDATE colormarket SET C252='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:00:00"))) {
        $usql = "UPDATE colormarket SET C253='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:05:00"))) {
        $usql = "UPDATE colormarket SET C254='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:10:00"))) {
        $usql = "UPDATE colormarket SET C255='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:15:00"))) {
        $usql = "UPDATE colormarket SET C256='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:20:00"))) {
        $usql = "UPDATE colormarket SET C257='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:25:00"))) {
        $usql = "UPDATE colormarket SET C258='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:30:00"))) {
        $usql = "UPDATE colormarket SET C259='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:35:00"))) {
        $usql = "UPDATE colormarket SET C260='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:40:00"))) {
        $usql = "UPDATE colormarket SET C261='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:45:00"))) {
        $usql = "UPDATE colormarket SET C262='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:50:00"))) {
        $usql = "UPDATE colormarket SET C263='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("21:55:00"))) {
        $usql = "UPDATE colormarket SET C264='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:00:00"))) {
        $usql = "UPDATE colormarket SET C265='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:05:00"))) {
        $usql = "UPDATE colormarket SET C266='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:10:00"))) {
        $usql = "UPDATE colormarket SET C267='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:15:00"))) {
        $usql = "UPDATE colormarket SET C268='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:20:00"))) {
        $usql = "UPDATE colormarket SET C269='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:25:00"))) {
        $usql = "UPDATE colormarket SET C270='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:30:00"))) {
        $usql = "UPDATE colormarket SET C271='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:35:00"))) {
        $usql = "UPDATE colormarket SET C272='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:40:00"))) {
        $usql = "UPDATE colormarket SET C273='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:45:00"))) {
        $usql = "UPDATE colormarket SET C274='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:50:00"))) {
        $usql = "UPDATE colormarket SET C275='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("22:55:00"))) {
        $usql = "UPDATE colormarket SET C276='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:00:00"))) {
        $usql = "UPDATE colormarket SET C277='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:05:00"))) {
        $usql = "UPDATE colormarket SET C278='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:10:00"))) {
        $usql = "UPDATE colormarket SET C279='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:15:00"))) {
        $usql = "UPDATE colormarket SET C280='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:20:00"))) {
        $usql = "UPDATE colormarket SET C281='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:25:00"))) {
        $usql = "UPDATE colormarket SET C282='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:30:00"))) {
        $usql = "UPDATE colormarket SET C283='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:35:00"))) {
        $usql = "UPDATE colormarket SET C284='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:40:00"))) {
        $usql = "UPDATE colormarket SET C285='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:45:00"))) {
        $usql = "UPDATE colormarket SET C286='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:50:00"))) {
        $usql = "UPDATE colormarket SET C287='$number' WHERE id='$exid'";
    } elseif ($market_id == date('h:i a', strtotime("23:55:00"))) {
        $usql = "UPDATE colormarket SET C288='$number' WHERE id='$exid'";
    }

    $market_id =   date('h:i a', strtotime($market_id));

    // $usql = "UPDATE winningbetting_detail SET winning_number_first='$number1', winning_number_second='$number2', winning_number_third='$number3' , winning_number_fouth='$number4' WHERE Id='$exid'";

    if (!mysqli_query($conn, $usql)) {
        exit;
        echo "<script>alert('Number Update Failed');window.location = 'color-declare-result-auto.php';</script>";
    } else {
        $dsql = "CALL Poc_colorWinningAmount('$market_id')";
        if (!mysqli_query($conn, $dsql)) {
            exit;
            echo '<script>alert("Number Update Failed");window.location = "color-declare-result-auto.php";</script>';
        } else {
            exit;
            echo '<script>alert("Number Update Successfully");window.location = "color-declare-result-auto.php";</script>';
        }
        // echo "<script>alert('Number Update Successfully');window.location = 'color-declare-result-auto.php';</script>";
    }
} else {
    if ($market_id == date('h:i a', strtotime("00:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C1,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C2,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C3,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C4,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C5,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C6,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C7,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C8,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C9,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C10,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C11,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("00:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C12,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C13,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C14,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C15,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C16,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C17,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C18,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C19,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C20,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C21,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C22,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C23,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("01:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C24,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C25,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C26,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C27,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C28,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C29,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C30,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C31,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C32,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C33,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C34,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C35,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("02:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C36,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C37,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C38,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C39,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C40,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C41,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C42,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C43,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C44,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C45,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C46,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C47,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("03:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C48,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C49,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C50,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C51,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C52,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C53,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C54,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C55,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C56,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C57,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C58,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C59,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("04:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C60,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C61,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C62,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C63,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C64,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C65,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C66,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C67,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C68,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C69,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C70,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C71,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("05:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C72,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C73,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C74,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C75,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C76,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C77,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C78,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C79,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C80,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C81,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C82,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C83,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("06:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C84,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C85,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C86,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C87,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C88,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C89,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C90,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C91,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C92,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C93,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C94,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C95,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("07:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C96,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C97,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C98,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C99,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C100,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C101,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C102,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C203,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C104,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C105,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C106,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C107,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("08:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C108,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C109,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C110,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C111,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C112,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C113,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C114,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C115,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C116,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C117,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C118,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C119,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("09:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C120,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C121,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C122,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C123,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C124,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C124,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C126,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C127,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C128,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C129,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C130,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C131,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("10:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C132,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C133,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C134,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C135,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C136,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C137,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C138,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C139,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C140,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C141,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C142,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C143,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("11:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C144,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C145,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C146,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C147,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C148,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C149,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C150,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C151,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C152,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C153,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C154,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C155,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("12:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C156,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C157,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C158,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C159,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C160,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C161,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C162,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C163,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C164,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C165,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C166,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C167,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("13:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C168,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C169,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C170,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C171,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C172,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C173,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C174,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C175,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C176,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C177,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C178,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C179,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("14:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C180,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C181,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C182,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C183,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C184,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C185,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C186,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C187,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C188,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C189,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C190,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C191,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("15:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C192,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C193,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C194,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C195,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C196,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C197,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C198,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C199,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C200,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C201,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C202,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C203,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("16:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C204,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C205,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C206,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C207,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C208,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C209,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C210,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C211,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C212,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C213,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C214,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C215,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("17:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C216,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C217,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C218,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C219,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C220,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C221,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C222,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C223,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C224,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C225,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C226,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C227,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("18:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C228,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C229,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C230,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C231,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C232,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C233,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C234,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C235,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C236,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C237,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C238,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C239,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("19:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C240,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C241,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C242,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C243,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C244,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C245,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C246,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C247,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C248,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C249,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C250,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C251,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("20:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C252,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C253,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C254,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C255,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C256,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C257,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C258,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C259,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C260,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C261,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C262,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C263,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("21:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C264,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C265,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C266,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C267,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C268,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C269,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C270,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C271,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C272,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C273,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C274,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C275,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("22:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C276,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:00:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C277,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:05:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C278,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:10:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C279,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:15:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C280,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:20:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C281,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:25:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C282,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:30:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C283,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:35:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C284,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:40:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C285,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:45:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C286,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:50:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C287,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    } elseif ($market_id == date('h:i a', strtotime("23:55:00"))) {
        $usql = "INSERT INTO colormarket(betting_time,C288,active_status,game_name) VALUES ('$betdate','$number','active','$game_name')";
    }

    if (!mysqli_query($conn, $usql)) {
        exit;
        echo "<script>alert('Number Update Failed');window.location = 'color-declare-result-auto.php';</script>";
    } else {
        $dsql = "CALL Poc_colorWinningAmount('$market_id')";
        if (!mysqli_query($conn, $dsql)) {
            exit;
            echo '<script>alert("Number Update Failed");window.location = "color-declare-result-auto.php";</script>';
        } else {
            exit;
            echo '<script>alert("Number Update Successfully");window.location = "color-declare-result-auto.php";</script>';
        }
        // echo "<script>alert('Number Update Successfully');window.location = 'color-declare-result-auto.php';</script>";
    }
}
exit;