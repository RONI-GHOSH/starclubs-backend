<?php include 'includes/config.php';
// session_start();

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
$query1 = "SELECT * FROM admin";
$result1 = mysqli_query($conn, $query1);
$rows1 = mysqli_fetch_assoc($result1);
$refer_percentage = $rows1['refer_amount'];

if (isset($_POST['update-allot'])) {

    $market_id = $_POST['starlinemarkettype'];
    $betdate = $_POST['betdate'];
    $number = $_POST['number'];
    $game_name = $_POST['game_name'];

    //Return Winning Amount 
    $returnQuery = "SELECT * FROM wallet_transaction WHERE transaction_update_date=date('$betdate') AND market_Id ='$market_id' ORDER BY w_transaction_id DESC";
    $Returngql = mysqli_query($conn, $returnQuery);

    if (mysqli_num_rows($Returngql) > 0) {

        while ($Returngre = mysqli_fetch_array($Returngql)) {

            $memberid = $Returngre['member_id'];
            $amount = $Returngre['transaction_amount'];

            $msql = "SELECT * FROM member_wallet WHERE member_id='$memberid' ";
            $mquery = mysqli_query($conn, $msql);

            if ($mrow = mysqli_fetch_array($mquery)) {
                $mbalance = $mrow['member_wallet_balance'];
            }

            $mrbalance = $mbalance - $amount;

            $updsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$memberid'";
            if (mysqli_query($conn, $updsql)) {
                $lastid = mysqli_insert_id($conn);
                $upsql = "UPDATE wallet_transaction SET status='2' WHERE transaction_update_date=date('$betdate') AND member_id='$memberid' AND market_Id ='$market_id' ORDER BY w_transaction_id DESC";
                if (mysqli_query($conn, $upsql)) {
                }
            } else {
                $response = ["status" => 'Failure4'];
            }
        }
    }

    //Return Winning Amount

    $dsql = "SELECT * FROM colormarket WHERE betting_time = '$betdate' AND game_name ='$game_name' AND active_status='Active'";
    $getqry = mysqli_query($conn, $dsql);
    if (mysqli_num_rows($getqry) > 0) {
        $row = mysqli_fetch_assoc($getqry);
        $exid = $row['id'];



        if ($market_id == date('h:i a', strtotime("00:00:00"))) {
            $usql = "UPDATE colormarket SET C1='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("0:05:00"))) {
            $usql = "UPDATE colormarket SET C2='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("00:10:00"))) {
            $usql = "UPDATE colormarket SET C3='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("00:15:00"))) {
            $usql = "UPDATE colormarket SET C4='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("0:20:00"))) {
            $usql = "UPDATE colormarket SET C5='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("00:25:00"))) {
            $usql = "UPDATE colormarket SET C6='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("0:30:00"))) {
            $usql = "UPDATE colormarket SET C7='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("0035:00"))) {
            $usql = "UPDATE colormarket SET C8='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("0:40:00"))) {
            $usql = "UPDATE colormarket SET C9='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("00:45:00"))) {
            $usql = "UPDATE colormarket SET C10='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("00:50:00"))) {
            $usql = "UPDATE colormarket SET C11='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("0:55:00"))) {
            $usql = "UPDATE colormarket SET C12='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:00:00"))) {
            $usql = "UPDATE colormarket SET C13='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:00:00"))) {
            $usql = "UPDATE colormarket SET C14='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:05:00"))) {
            $usql = "UPDATE colormarket SET C15='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:10:00"))) {
            $usql = "UPDATE colormarket SET C16='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:15:00"))) {
            $usql = "UPDATE colormarket SET C17='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:20:00"))) {
            $usql = "UPDATE colormarket SET C18='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:25:00"))) {
            $usql = "UPDATE colormarket SET C19='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:30:00"))) {
            $usql = "UPDATE colormarket SET C20='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:35:00"))) {
            $usql = "UPDATE colormarket SET C21='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:40:00"))) {
            $usql = "UPDATE colormarket SET C22='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("01:45:00"))) {
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
        } elseif ($market_id == date('h:i a', strtotime("04:15:00"))) {
            $usql = "UPDATE colormarket SET C52='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("04:20:00"))) {
            $usql = "UPDATE colormarket SET C53='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("04:25:00"))) {
            $usql = "UPDATE colormarket SET C54='$number' WHERE id='$exid'";
        } elseif ($market_id == date('h:i a', strtotime("04:30:00"))) {
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
        } elseif ($market_id == date('h:i a', strtotime("1:10:00"))) {
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
        } elseif ($market_id == date('h:i a', strtotime("0:05:00"))) {
            $usql = "UPDATE colormarket SET C89='$number' WHERE id='$exid'";
        }

        $market_id =   date('h:i a', strtotime($market_id));

        // $usql = "UPDATE winningbetting_detail SET winning_number_first='$number1', winning_number_second='$number2', winning_number_third='$number3' , winning_number_fouth='$number4' WHERE Id='$exid'";

        if (!mysqli_query($conn, $usql)) {
            echo "<script>alert('Number Update Failed');window.location = 'lottery-number-declare-result.php';</script>";
        } else {
            $dsql = "CALL Poc_lotterynumberWinningAmount('$market_id')";
            if (!mysqli_query($conn, $dsql)) {
                echo '<script>alert("Number Update Failed");window.location = "lottery-number-declare-result.php";</script>';
            } else {
                $sql_refer_type = "SELECT refer_type FROM admin";
                $query_refer_type = mysqli_query($conn, $sql_refer_type);
                $row_refer_type = mysqli_fetch_array($query_refer_type);
                $refer_type = $row_refer_type['refer_type'];

                if ($refer_type = 'Loss Betting') {
                    // LOSS Bet Referall Earnings Transactions
                    $dateObject = new DateTime($betdate);
                    // Format the date as desired (y-m-d)
                    $formattedDate = $dateObject->format('y-m-d');
                    $lossbetmsql = "select * from colormarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate' AND  
                    game_name='Lottery_Number' AND bet_num !='$number'";
                    $lossbetquery = mysqli_query($conn, $lossbetmsql);
                    // Fetch and process each row
                    while ($row = mysqli_fetch_assoc($lossbetquery)) {
                        $member_id = $row['member_id'];
                        $msqlrefer = "SELECT * FROM member_referral WHERE referrer_id='$member_id' ";
                        $mqueryrefer = mysqli_query($conn, $msqlrefer);
                        while ($mrowrefer = mysqli_fetch_array($mqueryrefer)) {
                            $refermember_id = $mrowrefer['member_id'];
                            $referrerid = $refermember_id;
                        }
                        if (!empty($referrerid)) {
                            $bettingid = $row['betting_id'];
                            $bettingamount = $row['bet_amount'];
                            $b_game_cid = $row['b_game_cid'];
                            $sql = "INSERT INTO betting_loss_referral (betting_id, amount, referrer_user_id, b_game_cid, created_at, updated_at, status)
                            VALUES ($bettingid,$bettingamount,$referrerid,$b_game_cid,current_timestamp(), '0000-00-00 00:00:00', '0')";
                            $insertresult = mysqli_query($conn, $sql);
                            if ($referrerid) {
                                $amount = $bettingamount * $refer_percentage / 100;
                                $transection_id = 'TRANS' . rand(0000, 9999);
                                $msql = "SELECT * FROM member_wallet WHERE member_id='$referrerid' ";
                                $mquery = mysqli_query($conn, $msql);
                                if ($mrow = mysqli_fetch_array($mquery)) {
                                    $mbalance = $mrow['member_wallet_balance'];
                                }
                                $mrbalance = $mbalance + $amount;
                                $date_transection = $dateTime;
                                $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, 
                                transaction_type) VALUES ('$transection_id','$amount','$referrerid','$date_transection','ReferAmt')";
                                if (mysqli_query($conn, $sql)) {
                                    $lastid = mysqli_insert_id($conn);
                                    $mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, 
                                    m_update_date) VALUES ('$lastid','$transection_id','$amount','$referrerid','$date_transection')";
                                    if (mysqli_query($conn, $mpsql)) {
                                        $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$referrerid'";
                                        if (mysqli_query($conn, $upsql)) {
                                            $lastid = mysqli_insert_id($conn);
                                        } else {
                                            $response = ["status" => 'Failure4'];
                                        }
                                    } else {
                                        $response = ["status" => 'Failure3'];
                                    }
                                }
                            }
                        }
                    }
                    echo '<script>alert("Number Update Successfully");window.location = "lottery-number-declare-result.php";</script>';
                } elseif ($refer_type = 'Flat') {
                    $dateObject = new DateTime($betdate);
                    // Format the date as desired (y-m-d)
                    $formattedDate = $dateObject->format('y-m-d');
                    $lossbetmsql = "select * from colormarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate' AND game_name='Lottery_Number'";
                    $lossbetquery = mysqli_query($conn, $lossbetmsql);
                    // Fetch and process each row
                    while ($row = mysqli_fetch_assoc($lossbetquery)) {
                        $member_id = $row['member_id'];
                        $msqlrefer = "SELECT * FROM member_referral WHERE referrer_id='$member_id' ";
                        $mqueryrefer = mysqli_query($conn, $msqlrefer);
                        while ($mrowrefer = mysqli_fetch_array($mqueryrefer)) {
                            $refermember_id = $mrowrefer['member_id'];
                            $referrerid = $refermember_id;
                        }
                        if (!empty($referrerid)) {
                            $bettingid = $row['betting_id'];
                            $bettingamount = $row['bet_amount'];
                            $b_game_cid = $row['b_game_cid'];
                            $sql = "INSERT INTO betting_loss_referral (betting_id, amount, referrer_user_id, b_game_cid, created_at, updated_at, status)
                            VALUES ($bettingid,$bettingamount,$referrerid,$b_game_cid,current_timestamp(), '0000-00-00 00:00:00', '0')";
                            $insertresult = mysqli_query($conn, $sql);
                            if ($referrerid) {
                                $amount = $bettingamount * $refer_percentage / 100;
                                $transection_id = 'TRANS' . rand(0000, 9999);
                                $msql = "SELECT * FROM member_wallet WHERE member_id='$referrerid' ";
                                $mquery = mysqli_query($conn, $msql);
                                if ($mrow = mysqli_fetch_array($mquery)) {
                                    $mbalance = $mrow['member_wallet_balance'];
                                }
                                $mrbalance = $mbalance + $amount;
                                $date_transection = $dateTime;
                                $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, 
                                transaction_type) VALUES ('$transection_id','$amount','$referrerid','$date_transection','ReferAmt')";
                                if (mysqli_query($conn, $sql)) {
                                    $lastid = mysqli_insert_id($conn);
                                    $mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, 
                                    m_update_date) VALUES ('$lastid','$transection_id','$amount','$referrerid','$date_transection')";
                                    if (mysqli_query($conn, $mpsql)) {
                                        $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$referrerid'";
                                        if (mysqli_query($conn, $upsql)) {
                                            $lastid = mysqli_insert_id($conn);
                                        } else {
                                            $response = ["status" => 'Failure4'];
                                        }
                                    } else {
                                        $response = ["status" => 'Failure3'];
                                    }
                                }
                            }
                        }
                    }
                    echo '<script>alert("Number Update Successfully");window.location = "lottery-number-declare-result.php";</script>';
                }
            }
            // echo "<script>alert('Number Update Successfully');window.location = 'lottery-number-declare-result.php';</script>";
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
        } elseif ($market_id == date('h:i a', strtotime("01:0:00"))) {
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
            echo "<script>alert('Number Update Failed');window.location = 'lottery-number-declare-result.php';</script>";
        } else {
            $dsql = "CALL Poc_lotterynumberWinningAmount('$market_id')";
            if (!mysqli_query($conn, $dsql)) {
                echo '<script>alert("Number Update Failed");window.location = "lottery-number-declare-result.php";</script>';
            } else {
                $sql_refer_type = "SELECT refer_type FROM admin";
                $query_refer_type = mysqli_query($conn, $sql_refer_type);
                $row_refer_type = mysqli_fetch_array($query_refer_type);
                $refer_type = $row_refer_type['refer_type'];

                if ($refer_type = 'Loss Betting') {
                    // LOSS Bet Referall Earnings Transactions
                    $dateObject = new DateTime($betdate);
                    // Format the date as desired (y-m-d)
                    $formattedDate = $dateObject->format('y-m-d');
                    $lossbetmsql = "select * from colormarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate' AND  
                    game_name='Lottery_Number' AND bet_num !='$number'";
                    $lossbetquery = mysqli_query($conn, $lossbetmsql);
                    // Fetch and process each row
                    while ($row = mysqli_fetch_assoc($lossbetquery)) {
                        $member_id = $row['member_id'];
                        $msqlrefer = "SELECT * FROM member_referral WHERE referrer_id='$member_id' ";
                        $mqueryrefer = mysqli_query($conn, $msqlrefer);
                        while ($mrowrefer = mysqli_fetch_array($mqueryrefer)) {
                            $refermember_id = $mrowrefer['member_id'];
                            $referrerid = $refermember_id;
                        }
                        if (!empty($referrerid)) {
                            $bettingid = $row['betting_id'];
                            $bettingamount = $row['bet_amount'];
                            $b_game_cid = $row['b_game_cid'];
                            $sql = "INSERT INTO betting_loss_referral (betting_id, amount, referrer_user_id, b_game_cid, created_at, updated_at, status)
                            VALUES ($bettingid,$bettingamount,$referrerid,$b_game_cid,current_timestamp(), '0000-00-00 00:00:00', '0')";
                            $insertresult = mysqli_query($conn, $sql);
                            if ($referrerid) {
                                $amount = $bettingamount * $refer_percentage / 100;
                                $transection_id = 'TRANS' . rand(0000, 9999);
                                $msql = "SELECT * FROM member_wallet WHERE member_id='$referrerid' ";
                                $mquery = mysqli_query($conn, $msql);
                                if ($mrow = mysqli_fetch_array($mquery)) {
                                    $mbalance = $mrow['member_wallet_balance'];
                                }
                                $mrbalance = $mbalance + $amount;
                                $date_transection = $dateTime;
                                $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, 
                                transaction_type) VALUES ('$transection_id','$amount','$referrerid','$date_transection','ReferAmt')";
                                if (mysqli_query($conn, $sql)) {
                                    $lastid = mysqli_insert_id($conn);
                                    $mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, 
                                    m_update_date) VALUES ('$lastid','$transection_id','$amount','$referrerid','$date_transection')";
                                    if (mysqli_query($conn, $mpsql)) {
                                        $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$referrerid'";
                                        if (mysqli_query($conn, $upsql)) {
                                            $lastid = mysqli_insert_id($conn);
                                        } else {
                                            $response = ["status" => 'Failure4'];
                                        }
                                    } else {
                                        $response = ["status" => 'Failure3'];
                                    }
                                }
                            }
                        }
                    }
                    echo '<script>alert("Number Update Successfully");window.location = "lottery-number-declare-result.php";</script>';
                } elseif ($refer_type = 'Flat') {
                    $dateObject = new DateTime($betdate);
                    // Format the date as desired (y-m-d)
                    $formattedDate = $dateObject->format('y-m-d');
                    $lossbetmsql = "select * from colormarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate' AND game_name='Lottery_Number'";
                    $lossbetquery = mysqli_query($conn, $lossbetmsql);
                    // Fetch and process each row
                    while ($row = mysqli_fetch_assoc($lossbetquery)) {
                        $member_id = $row['member_id'];
                        $msqlrefer = "SELECT * FROM member_referral WHERE referrer_id='$member_id' ";
                        $mqueryrefer = mysqli_query($conn, $msqlrefer);
                        while ($mrowrefer = mysqli_fetch_array($mqueryrefer)) {
                            $refermember_id = $mrowrefer['member_id'];
                            $referrerid = $refermember_id;
                        }
                        if (!empty($referrerid)) {
                            $bettingid = $row['betting_id'];
                            $bettingamount = $row['bet_amount'];
                            $b_game_cid = $row['b_game_cid'];
                            $sql = "INSERT INTO betting_loss_referral (betting_id, amount, referrer_user_id, b_game_cid, created_at, updated_at, status)
                            VALUES ($bettingid,$bettingamount,$referrerid,$b_game_cid,current_timestamp(), '0000-00-00 00:00:00', '0')";
                            $insertresult = mysqli_query($conn, $sql);
                            if ($referrerid) {
                                $amount = $bettingamount * $refer_percentage / 100;
                                $transection_id = 'TRANS' . rand(0000, 9999);
                                $msql = "SELECT * FROM member_wallet WHERE member_id='$referrerid' ";
                                $mquery = mysqli_query($conn, $msql);
                                if ($mrow = mysqli_fetch_array($mquery)) {
                                    $mbalance = $mrow['member_wallet_balance'];
                                }
                                $mrbalance = $mbalance + $amount;
                                $date_transection = $dateTime;
                                $sql = "INSERT INTO wallet_transaction(transaction_id, transaction_amount, member_id, transaction_update_date, 
                                transaction_type) VALUES ('$transection_id','$amount','$referrerid','$date_transection','ReferAmt')";
                                if (mysqli_query($conn, $sql)) {
                                    $lastid = mysqli_insert_id($conn);
                                    $mpsql = "INSERT INTO member_payment(w_transaction_id, transaction_id, transaction_amount, member_id, 
                                    m_update_date) VALUES ('$lastid','$transection_id','$amount','$referrerid','$date_transection')";
                                    if (mysqli_query($conn, $mpsql)) {
                                        $upsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$referrerid'";
                                        if (mysqli_query($conn, $upsql)) {
                                            $lastid = mysqli_insert_id($conn);
                                        } else {
                                            $response = ["status" => 'Failure4'];
                                        }
                                    } else {
                                        $response = ["status" => 'Failure3'];
                                    }
                                }
                            }
                        }
                    }
                    echo '<script>alert("Number Update Successfully");window.location = "lottery-number-declare-result.php";</script>';
                }
            }
            // echo "<script>alert('Number Update Successfully');window.location = 'lottery-number-declare-result.php';</script>";
        }
    }
}
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Declare Result</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="adminassets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="adminassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="adminassets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <link href="adminassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="adminassets/css/app.min.css?v=2" id="app-style" rel="stylesheet" type="text/css" />

    <link href="adminassets/css/custom.css?v=11" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .model-footer-change {
            padding: 0px 20px 14px 0px;
            text-align: right;
        }
    </style>

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">

        <?php include 'includes/header.php';  ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-12 col-sm-12 col-lg-12">

                            <div class="row">

                                <div class="col-sm-12 col-12 ">

                                    <div class="card">


                                        <div class="card-body">
                                            <h5>Select Game</h5>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="market_close">Maximum Bat</label>
                                                    <div class="form-group">
                                                        <input type="text" name="maxbat" id="maxbat" class="form-control" readonly style="background-color:lightgoldenrodyellow;color:black;font-weight:500;">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="market_close">Minimum Bat</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="minbat" id="minbat" readonly style="background-color:lightgoldenrodyellow;color:black;font-weight:500;">
                                                    </div>
                                                </div>
                                            </div>

                                            <form class="theme-form mega-form" method="post">

                                                <input type="hidden" name="id" id="id">

                                                <div class="row">
                                                    <div class="form-group col-md-3">

                                                        <label>Result Date</label>

                                                        <label>Result Date</label>

                                                        <div class="date-picker">

                                                            <div class="input-group">

                                                                <input class="form-control digits" type="date" value="<?php echo $date ?>" name="betdate" id="starline_betdate">
                                                                <input class="form-control digits" type="hidden" value="Lottery_Number" name="game_name" id="game_name">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="form-group col-md-3">

                                                        <label>Game Name </label>

                                                        <select class="form-control" name="starlinemarkettype" id="starlinemarkettype">
                                                            <option value="">-- Please Select Market Name --</option>
                                                            <?php

                                                            $getsql = "SELECT * FROM colorMarketList WHERE active_status = 'Active'  ";
                                                            $getqry = mysqli_query($conn, $getsql);
                                                            $i = 1;
                                                            if (mysqli_num_rows($getqry) > 0) {
                                                                while ($row = mysqli_fetch_assoc($getqry)) {
                                                            ?>
                                                                    <option value="<?php echo  date('h:i a', strtotime($row['market_time'])); ?>"><?php echo date('h:i a', strtotime($row['market_time'])); ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="market_close">Number</label>
                                                        <div class="form-group">
                                                            <input type="text" maxlength="3" class="form-control" placeholder="Number" name="number" id="number">
                                                        </div>
                                                    </div>



                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary btn-block" name="update-allot">Declare Allot</button>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" onclick="starlineBtn(this);" class="btn btn-primary btn-block">Show Winner List</button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div id="error"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Win Bid History List</h4>
                                    <span id="deleteBetListMsg"></span>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="starline-win-member">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Member</th>
                                                    <th>Game Name</th>
                                                    <th>Bet Digit</th>
                                                    <th>Bet Amount</th>
                                                    <th>Edit Bet</th>
                                                    <th>Delete Bet</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <style>
            .select2-container {
                width: 398.984px !important;
            }
        </style>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> ©Matka.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">

                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>


    <!-- Large Size -->
    <div class="modal fade" id="editStarlineWin" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Edit Bet Number</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" name="ebetmodel" action="">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <label for="market_name">Bet Number</label>
                                <div class="form-group">
                                    <input type="text" id="betnum" class="form-control" minlength="3" maxlength="3" value="" placeholder="Bet Number" name="betnum">
                                    <input type="hidden" id="betid" class="form-control" value="" name="betid">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onClick="men(this);" class="btn btn-primary btn-round waves-effect" data-dismiss="modal">SAVE CHANGES</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete model start is here -->
    <div class="modal fade show" id="starlineDeleteModal" style=" padding-right: 16px;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Member !!</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body" style="padding: 20px 10px 10px 10px; text-align: center;">
                        <p style="font-size: 15px;">Are you sure ? You want to delete this Member !!</p>
                    </div>

                    <div class="model-footer-change">
                        <button type="button" style="padding: 5px 15px 5px 15px;" class="btn light btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" data-dismiss="modal" id="starlineListDel" style="padding: 5px 15px 5px 15px;" class="btn light btn-warning">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete model end is here -->

    <input type="hidden" id="base_url" value="">
    <input type="hidden" id="admin" value="krisshmatka-admin">

    <div id="snackbar"></div>
    <div id="snackbar-info"></div>
    <div id="snackbar-error"></div>
    <div id="snackbar-success"></div>

    <script src="adminassets/libs/jquery/jquery.min.js"></script>
    <script src="adminassets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="adminassets/libs/metismenu/metisMenu.min.js"></script>
    <script src="adminassets/libs/simplebar/simplebar.min.js"></script>
    <script src="adminassets/libs/node-waves/waves.min.js"></script>
    <script src="adminassets/libs/select2/js/select2.min.js"></script>
    <script src="adminassets/js/pages/form-advanced.init.js"></script>
    <!-- Required datatable js -->
    <script src="adminassets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="adminassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="adminassets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="adminassets/libs/jszip/jszip.min.js"></script>
    <script src="adminassets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="adminassets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="adminassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="adminassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="adminassets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script src="adminassets/js/app.js"></script>
    <script src="adminassets/js/customjs.js?v=8842"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#starline-win-member').DataTable();
        });
    </script>





    <script>
        $(document).ready(function() {
            // Function to send AJAX request to populate declared results dropdown
            function populateminbat() {
                var betdate = $('#starline_betdate').val();
                var gameName = $('#starlinemarkettype').val();
                // alert(gameName);
                // alert(betdate);
                // AJAX request
                $.ajax({
                    url: 'apiz/minbat.php',
                    type: 'POST',
                    data: {
                        betdate: betdate,
                        gameName: gameName,
                    },
                    success: function(response) {
                        // alert(response);
                        // Populate the declared results dropdown
                        $('#minbat').val(response);
                    }
                });
            }

            // Trigger populateminbat function when date, game name, or color changes
            $('#betdate, #starlinemarkettype').change(function() {
                populateminbat();
            });

            // Call the function initially when the page loads
            populateminbat();
        });
    </script>


    <script>
        $(document).ready(function() {
            // Function to send AJAX request to populate declared results dropdown
            function populatemaxbat() {
                var betdate = $('#starline_betdate').val();
                var gameName = $('#starlinemarkettype').val();
                // alert(gameName);
                // alert(betdate);
                // AJAX request
                $.ajax({
                    url: 'apiz/maxbat.php',
                    type: 'POST',
                    data: {
                        betdate: betdate,
                        gameName: gameName,
                    },
                    success: function(response) {
                        // alert(response);
                        // Populate the declared results dropdown
                        $('#maxbat').val(response);
                    }
                });
            }

            // Trigger populatemaxbat function when date, game name, or color changes
            $('#betdate, #starlinemarkettype').change(function() {
                populatemaxbat();
            });

            // Call the function initially when the page loads
            populatemaxbat();
        });
    </script>







    <script>
        function starlineBtn(el) {
            var betdate = $('#starline_betdate').val();
            var game_name = $('#game_name').val();
            var marketid = $('#starlinemarkettype').val();
            var number = $('#number').val();

            if (marketid != '') {
                if (betdate != '') {
                    if (number != '' && number.length >= 1) {
                        $('#starline-win-member').DataTable({
                            destroy: true,
                            "ajax": "apiz/get_color_decleare_result.php?marketid=" + marketid + "&betdate=" + betdate + "&game_name=" + game_name + "&number=" + number,
                            "data": [],
                        });
                    } else {
                        alert("Number required and must have 3 digit");
                    }
                } else {
                    alert("Date required");
                }
            } else {
                alert("Market required");
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#startable').DataTable();
        });
    </script>


    <script type="text/javascript">
        function editStarlineWin(ss) {
            var betnum = $(ss).attr('betnum');
            var betid = $(ss).attr('betid');

            $("#betnum").attr('alt', betnum).val(betnum);
            $("#betid").attr('alt', betid).val(betid);

            $('#editStarlineWin').modal({
                show: true
            });
        }
    </script>

    <script>
        function men(e) {
            var betnum = $('#betnum').val();
            var betid = $('#betid').val();
            $.ajax({
                type: "POST",
                url: "apiz/color-decleare-result-update.php",
                data: {
                    betnum,
                    betid
                },
                success: function(dataResult) {
                    alert(dataResult);
                    $('#starline-win-member').DataTable().ajax.reload();
                }
            });
        }
    </script>


    <script type="text/javascript">
        function statlineDelete(cd) {
            var id = $(cd).attr('alt');
            $("#starlineListDel").attr('alt', id);
        }
    </script>

    <script type="text/javascript">
        $("#starlineListDel").on('click', function() {
            var id = $(this).attr('alt');
            $.ajax({
                type: "POST",
                url: "apiz/delete_color_result.php",
                data: {
                    id
                },
                success: function(data) {
                    $("#deleteBetListMsg").html(data);
                    setTimeout(function() {
                        $("#deleteBetListMsg").html(null);
                    }, 4000);
                    $('#starline-win-member').DataTable().ajax.reload();
                }
            });
        });
    </script>

</body>

</html>