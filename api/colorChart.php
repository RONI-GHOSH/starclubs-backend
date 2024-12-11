<?php

include '../config.php';
date_default_timezone_set('Asia/Kolkata');
$date = $date;

$timec = date('H:i');
$sql = "SELECT * FROM colorMarketList WHERE active_status ='Active' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) {
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $market_id = $row['id'];
        $market_time = $row['market_time'];
        $market_name = $row['star_name'];
        $digit1 = "*";
        $pana1 = "***";
        $sql = "SELECT * FROM colormarket where Date(betting_time)=Date('$date') AND game_name='Color'";
        $result1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result1)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {

                if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:00"))) {
                    $digit2 = $row1["C1"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:05"))) {
                    $digit2 = $row1["C2"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:10"))) {
                    $digit2 = $row1["C3"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:15"))) {
                    $digit2 = $row1["C4"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:20"))) {
                    $digit2 = $row1["C5"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:25"))) {
                    $digit2 = $row1["C6"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:30"))) {
                    $digit2 = $row1["C7"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:35"))) {
                    $digit2 = $row1["C8"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:40"))) {
                    $digit2 = $row1["C9"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:45"))) {
                    $digit2 = $row1["C10"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:50"))) {
                    $digit2 = $row1["C11"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:55"))) {
                    $digit2 = $row1["C12"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:00"))) {
                    $digit2 = $row1["C13"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:05"))) {
                    $digit2 = $row1["C14"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:10"))) {
                    $digit2 = $row1["C15"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:15"))) {
                    $digit2 = $row1["C16"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:20"))) {
                    $digit2 = $row1["C17"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:25"))) {
                    $digit2 = $row1["C18"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:30"))) {
                    $digit2 = $row1["C19"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:35"))) {
                    $digit2 = $row1["C20"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:40"))) {
                    $digit2 = $row1["C21"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:45"))) {
                    $digit2 = $row1["C22"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:50"))) {
                    $digit2 = $row1["C23"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:55"))) {
                    $digit2 = $row1["C24"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:00"))) {
                    $digit2 = $row1["C25"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:05"))) {
                    $digit2 = $row1["C26"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:10"))) {
                    $digit2 = $row1["C27"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:15"))) {
                    $digit2 = $row1["C28"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:20"))) {
                    $digit2 = $row1["C29"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:25"))) {
                    $digit2 = $row1["C30"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:30"))) {
                    $digit2 = $row1["C31"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:35"))) {
                    $digit2 = $row1["C32"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:40"))) {
                    $digit2 = $row1["C33"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:45"))) {
                    $digit2 = $row1["C34"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:50"))) {
                    $digit2 = $row1["C35"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:55"))) {
                    $digit2 = $row1["C36"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:00"))) {
                    $digit2 = $row1["C37"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:05"))) {
                    $digit2 = $row1["C38"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:10"))) {
                    $digit2 = $row1["C39"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:15"))) {
                    $digit2 = $row1["C40"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:20"))) {
                    $digit2 = $row1["C41"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:25"))) {
                    $digit2 = $row1["C42"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:30"))) {
                    $digit2 = $row1["C43"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:35"))) {
                    $digit2 = $row1["C44"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:40"))) {
                    $digit2 = $row1["C45"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:45"))) {
                    $digit2 = $row1["C46"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:50"))) {
                    $digit2 = $row1["C47"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:55"))) {
                    $digit2 = $row1["C48"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:00"))) {
                    $digit2 = $row1["C49"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:05"))) {
                    $digit2 = $row1["C50"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:10"))) {
                    $digit2 = $row1["C51"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:15"))) {
                    $digit2 = $row1["C52"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:20"))) {
                    $digit2 = $row1["C53"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:25"))) {
                    $digit2 = $row1["C54"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:30"))) {
                    $digit2 = $row1["C55"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:35"))) {
                    $digit2 = $row1["C56"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:40"))) {
                    $digit2 = $row1["C57"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:45"))) {
                    $digit2 = $row1["C58"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:50"))) {
                    $digit2 = $row1["C59"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:55"))) {
                    $digit2 = $row1["C60"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:00"))) {
                    $digit2 = $row1["C61"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:05"))) {
                    $digit2 = $row1["C62"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:10"))) {
                    $digit2 = $row1["C63"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:15"))) {
                    $digit2 = $row1["C64"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:20"))) {
                    $digit2 = $row1["C65"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:25"))) {
                    $digit2 = $row1["C66"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:30"))) {
                    $digit2 = $row1["C67"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:35"))) {
                    $digit2 = $row1["C68"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:40"))) {
                    $digit2 = $row1["C69"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:45"))) {
                    $digit2 = $row1["C70"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:50"))) {
                    $digit2 = $row1["C71"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:55"))) {
                    $digit2 = $row1["C72"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:00"))) {
                    $digit2 = $row1["C73"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:05"))) {
                    $digit2 = $row1["C74"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:10"))) {
                    $digit2 = $row1["C75"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:15"))) {
                    $digit2 = $row1["C76"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:20"))) {
                    $digit2 = $row1["C77"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:25"))) {
                    $digit2 = $row1["C78"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:30"))) {
                    $digit2 = $row1["C79"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:35"))) {
                    $digit2 = $row1["C80"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:40"))) {
                    $digit2 = $row1["C81"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:45"))) {
                    $digit2 = $row1["C82"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:50"))) {
                    $digit2 = $row1["C83"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:55"))) {
                    $digit2 = $row1["C84"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:00"))) {
                    $digit2 = $row1["C85"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:05"))) {
                    $digit2 = $row1["C86"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:10"))) {
                    $digit2 = $row1["C87"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:15"))) {
                    $digit2 = $row1["C88"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:20"))) {
                    $digit2 = $row1["C89"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:25"))) {
                    $digit2 = $row1["C90"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:30"))) {
                    $digit2 = $row1["C91"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:35"))) {
                    $digit2 = $row1["C92"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:40"))) {
                    $digit2 = $row1["C93"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:45"))) {
                    $digit2 = $row1["C94"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:50"))) {
                    $digit2 = $row1["C95"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:55"))) {
                    $digit2 = $row1["C96"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:00"))) {
                    $digit2 = $row1["C97"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:05"))) {
                    $digit2 = $row1["C98"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:10"))) {
                    $digit2 = $row1["C99"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:15"))) {
                    $digit2 = $row1["C100"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:20"))) {
                    $digit2 = $row1["C101"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:25"))) {
                    $digit2 = $row1["C102"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:30"))) {
                    $digit2 = $row1["C103"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:35"))) {
                    $digit2 = $row1["C104"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:40"))) {
                    $digit2 = $row1["C105"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:45"))) {
                    $digit2 = $row1["C106"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:50"))) {
                    $digit2 = $row1["C107"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:55"))) {
                    $digit2 = $row1["C108"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:00"))) {
                    $digit2 = $row1["C109"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:05"))) {
                    $digit2 = $row1["C110"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:10"))) {
                    $digit2 = $row1["C111"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:15"))) {
                    $digit2 = $row1["C112"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:20"))) {
                    $digit2 = $row1["C113"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:25"))) {
                    $digit2 = $row1["C114"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:30"))) {
                    $digit2 = $row1["C115"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:35"))) {
                    $digit2 = $row1["C116"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:40"))) {
                    $digit2 = $row1["C117"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:45"))) {
                    $digit2 = $row1["C118"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:50"))) {
                    $digit2 = $row1["C119"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:55"))) {
                    $digit2 = $row1["C120"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:00"))) {
                    $digit2 = $row1["C121"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:05"))) {
                    $digit2 = $row1["C122"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:10"))) {
                    $digit2 = $row1["C123"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:15"))) {
                    $digit2 = $row1["C124"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:20"))) {
                    $digit2 = $row1["C125"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:25"))) {
                    $digit2 = $row1["C126"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:30"))) {
                    $digit2 = $row1["C127"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:35"))) {
                    $digit2 = $row1["C128"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:40"))) {
                    $digit2 = $row1["C129"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:45"))) {
                    $digit2 = $row1["C130"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:50"))) {
                    $digit2 = $row1["C131"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:55"))) {
                    $digit2 = $row1["C132"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:00"))) {
                    $digit2 = $row1["C133"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:05"))) {
                    $digit2 = $row1["C134"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:10"))) {
                    $digit2 = $row1["C135"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:15"))) {
                    $digit2 = $row1["C136"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:20"))) {
                    $digit2 = $row1["C137"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:25"))) {
                    $digit2 = $row1["C138"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:30"))) {
                    $digit2 = $row1["C139"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:35"))) {
                    $digit2 = $row1["C140"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:40"))) {
                    $digit2 = $row1["C141"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:45"))) {
                    $digit2 = $row1["C142"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:50"))) {
                    $digit2 = $row1["C143"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:55"))) {
                    $digit2 = $row1["C144"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:00"))) {
                    $digit2 = $row1["C145"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:05"))) {
                    $digit2 = $row1["C146"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:10"))) {
                    $digit2 = $row1["C147"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:15"))) {
                    $digit2 = $row1["C148"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:20"))) {
                    $digit2 = $row1["C149"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:25"))) {
                    $digit2 = $row1["C150"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:30"))) {
                    $digit2 = $row1["C151"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:35"))) {
                    $digit2 = $row1["C152"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:40"))) {
                    $digit2 = $row1["C153"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:45"))) {
                    $digit2 = $row1["C154"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:50"))) {
                    $digit2 = $row1["C155"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:55"))) {
                    $digit2 = $row1["C156"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:00"))) {
                    $digit2 = $row1["C157"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:05"))) {
                    $digit2 = $row1["C158"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:10"))) {
                    $digit2 = $row1["C159"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:15"))) {
                    $digit2 = $row1["C160"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:20"))) {
                    $digit2 = $row1["C161"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:25"))) {
                    $digit2 = $row1["C162"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:30"))) {
                    $digit2 = $row1["C163"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:35"))) {
                    $digit2 = $row1["C164"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:40"))) {
                    $digit2 = $row1["C165"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:45"))) {
                    $digit2 = $row1["C166"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:50"))) {
                    $digit2 = $row1["C167"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:55"))) {
                    $digit2 = $row1["C168"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:00"))) {
                    $digit2 = $row1["C169"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:05"))) {
                    $digit2 = $row1["C170"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:10"))) {
                    $digit2 = $row1["C171"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:15"))) {
                    $digit2 = $row1["C172"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:20"))) {
                    $digit2 = $row1["C173"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:25"))) {
                    $digit2 = $row1["C174"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:30"))) {
                    $digit2 = $row1["C175"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:35"))) {
                    $digit2 = $row1["C176"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:40"))) {
                    $digit2 = $row1["C177"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:45"))) {
                    $digit2 = $row1["C178"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:50"))) {
                    $digit2 = $row1["C179"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:55"))) {
                    $digit2 = $row1["C180"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:00"))) {
                    $digit2 = $row1["C181"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:05"))) {
                    $digit2 = $row1["C182"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:10"))) {
                    $digit2 = $row1["C183"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:15"))) {
                    $digit2 = $row1["C184"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:20"))) {
                    $digit2 = $row1["C185"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:25"))) {
                    $digit2 = $row1["C186"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:30"))) {
                    $digit2 = $row1["C187"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:35"))) {
                    $digit2 = $row1["C188"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:40"))) {
                    $digit2 = $row1["C189"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:45"))) {
                    $digit2 = $row1["C190"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:50"))) {
                    $digit2 = $row1["C191"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:55"))) {
                    $digit2 = $row1["C192"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:00"))) {
                    $digit2 = $row1["C193"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:05"))) {
                    $digit2 = $row1["C194"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:10"))) {
                    $digit2 = $row1["C195"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:15"))) {
                    $digit2 = $row1["C196"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:20"))) {
                    $digit2 = $row1["C197"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:25"))) {
                    $digit2 = $row1["C198"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:30"))) {
                    $digit2 = $row1["C199"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:35"))) {
                    $digit2 = $row1["C200"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:40"))) {
                    $digit2 = $row1["C201"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:45"))) {
                    $digit2 = $row1["C202"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:50"))) {
                    $digit2 = $row1["C203"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:55"))) {
                    $digit2 = $row1["C204"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:00"))) {
                    $digit2 = $row1["C205"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:05"))) {
                    $digit2 = $row1["C206"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:10"))) {
                    $digit2 = $row1["C207"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:15"))) {
                    $digit2 = $row1["C208"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:20"))) {
                    $digit2 = $row1["C209"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:25"))) {
                    $digit2 = $row1["C210"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:30"))) {
                    $digit2 = $row1["C211"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:35"))) {
                    $digit2 = $row1["C212"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:40"))) {
                    $digit2 = $row1["C213"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:45"))) {
                    $digit2 = $row1["C214"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:50"))) {
                    $digit2 = $row1["C215"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:55"))) {
                    $digit2 = $row1["C216"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:00"))) {
                    $digit2 = $row1["C217"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:05"))) {
                    $digit2 = $row1["C218"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:10"))) {
                    $digit2 = $row1["C219"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:15"))) {
                    $digit2 = $row1["C220"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:20"))) {
                    $digit2 = $row1["C221"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:25"))) {
                    $digit2 = $row1["C222"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:30"))) {
                    $digit2 = $row1["C223"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:35"))) {
                    $digit2 = $row1["C224"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:40"))) {
                    $digit2 = $row1["C225"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:45"))) {
                    $digit2 = $row1["C226"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:50"))) {
                    $digit2 = $row1["C227"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:55"))) {
                    $digit2 = $row1["C228"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:00"))) {
                    $digit2 = $row1["C229"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:05"))) {
                    $digit2 = $row1["C230"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:10"))) {
                    $digit2 = $row1["C231"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:15"))) {
                    $digit2 = $row1["C232"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:20"))) {
                    $digit2 = $row1["C233"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:25"))) {
                    $digit2 = $row1["C234"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:30"))) {
                    $digit2 = $row1["C235"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:35"))) {
                    $digit2 = $row1["C236"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:40"))) {
                    $digit2 = $row1["C237"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:45"))) {
                    $digit2 = $row1["C238"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:50"))) {
                    $digit2 = $row1["C239"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:55"))) {
                    $digit2 = $row1["C240"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:00"))) {
                    $digit2 = $row1["C241"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:05"))) {
                    $digit2 = $row1["C242"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:10"))) {
                    $digit2 = $row1["C243"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:15"))) {
                    $digit2 = $row1["C244"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:20"))) {
                    $digit2 = $row1["C245"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:25"))) {
                    $digit2 = $row1["C246"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:30"))) {
                    $digit2 = $row1["C247"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:35"))) {
                    $digit2 = $row1["C248"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:40"))) {
                    $digit2 = $row1["C249"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:45"))) {
                    $digit2 = $row1["C250"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:50"))) {
                    $digit2 = $row1["C251"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:55"))) {
                    $digit2 = $row1["C252"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:00"))) {
                    $digit2 = $row1["C253"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:05"))) {
                    $digit2 = $row1["C254"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:10"))) {
                    $digit2 = $row1["C255"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:15"))) {
                    $digit2 = $row1["C256"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:20"))) {
                    $digit2 = $row1["C257"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:25"))) {
                    $digit2 = $row1["C258"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:30"))) {
                    $digit2 = $row1["C259"]; 
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:35"))) {
                    $digit2 = $row1["C260"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:40"))) {
                    $digit2 = $row1["C261"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:45"))) {
                    $digit2 = $row1["C262"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:50"))) {
                    $digit2 = $row1["C263"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:55"))) {
                    $digit2 = $row1["C264"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:00"))) {
                    $digit2 = $row1["C265"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:05"))) {
                    $digit2 = $row1["C266"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:10"))) {
                    $digit2 = $row1["C267"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:15"))) {
                    $digit2 = $row1["C268"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:20"))) {
                    $digit2 = $row1["C269"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:25"))) {
                    $digit2 = $row1["C270"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:30"))) {
                    $digit2 = $row1["C271"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:35"))) {
                    $digit2 = $row1["C272"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:40"))) {
                    $digit2 = $row1["C273"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:45"))) {
                    $digit2 = $row1["C274"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:50"))) {
                    $digit2 = $row1["C275"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:55"))) {
                    $digit2 = $row1["C276"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:00"))) {
                    $digit2 = $row1["C277"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:05"))) {
                    $digit2 = $row1["C278"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:10"))) {
                    $digit2 = $row1["C279"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:15"))) {
                    $digit2 = $row1["C280"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:20"))) {
                    $digit2 = $row1["C281"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:25"))) {
                    $digit2 = $row1["C282"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:30"))) {
                    $digit2 = $row1["C283"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:35"))) {
                    $digit2 = $row1["C284"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:40"))) {
                    $digit2 = $row1["C285"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:45"))) {
                    $digit2 = $row1["C286"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:50"))) {
                    $digit2 = $row1["C287"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:55"))) {
                    $digit2 = $row1["C288"];
                }
            }
        }

        $sql = "SELECT * FROM colormarket where Date(betting_time)=Date('$date') AND game_name='Lottery_Number'";
        $result1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result1)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {

                if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:00"))) {
                    $digit3 = $row1["C1"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:05"))) {
                    $digit3 = $row1["C2"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:10"))) {
                    $digit3 = $row1["C3"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:15"))) {
                    $digit3 = $row1["C4"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:20"))) {
                    $digit3 = $row1["C5"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:25"))) {
                    $digit3 = $row1["C6"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:30"))) {
                    $digit3 = $row1["C7"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:35"))) {
                    $digit3 = $row1["C8"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:40"))) {
                    $digit3 = $row1["C9"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:45"))) {
                    $digit3 = $row1["C10"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:50"))) {
                    $digit3 = $row1["C11"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("00:55"))) {
                    $digit3 = $row1["C12"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:00"))) {
                    $digit3 = $row1["C13"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:05"))) {
                    $digit3 = $row1["C14"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:10"))) {
                    $digit3 = $row1["C15"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:15"))) {
                    $digit3 = $row1["C16"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:20"))) {
                    $digit3 = $row1["C17"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:25"))) {
                    $digit3 = $row1["C18"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:30"))) {
                    $digit3 = $row1["C19"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:35"))) {
                    $digit3 = $row1["C20"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:40"))) {
                    $digit3 = $row1["C21"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:45"))) {
                    $digit3 = $row1["C22"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:50"))) {
                    $digit3 = $row1["C23"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("01:55"))) {
                    $digit3 = $row1["C24"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:00"))) {
                    $digit3 = $row1["C25"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:05"))) {
                    $digit3 = $row1["C26"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:10"))) {
                    $digit3 = $row1["C27"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:15"))) {
                    $digit3 = $row1["C28"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:20"))) {
                    $digit3 = $row1["C29"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:25"))) {
                    $digit3 = $row1["C30"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:30"))) {
                    $digit3 = $row1["C31"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:35"))) {
                    $digit3 = $row1["C32"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:40"))) {
                    $digit3 = $row1["C33"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:45"))) {
                    $digit3 = $row1["C34"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:50"))) {
                    $digit3 = $row1["C35"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("02:55"))) {
                    $digit3 = $row1["C36"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:00"))) {
                    $digit3 = $row1["C37"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:05"))) {
                    $digit3 = $row1["C38"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:10"))) {
                    $digit3 = $row1["C39"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:15"))) {
                    $digit3 = $row1["C40"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:20"))) {
                    $digit3 = $row1["C41"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:25"))) {
                    $digit3 = $row1["C42"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:30"))) {
                    $digit3 = $row1["C43"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:35"))) {
                    $digit3 = $row1["C44"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:40"))) {
                    $digit3 = $row1["C45"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:45"))) {
                    $digit3 = $row1["C46"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:50"))) {
                    $digit3 = $row1["C47"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("03:55"))) {
                    $digit3 = $row1["C48"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:00"))) {
                    $digit3 = $row1["C49"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:05"))) {
                    $digit3 = $row1["C50"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:10"))) {
                    $digit3 = $row1["C51"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:15"))) {
                    $digit3 = $row1["C52"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:20"))) {
                    $digit3 = $row1["C53"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:25"))) {
                    $digit3 = $row1["C54"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:30"))) {
                    $digit3 = $row1["C55"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:35"))) {
                    $digit3 = $row1["C56"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:40"))) {
                    $digit3 = $row1["C57"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:45"))) {
                    $digit3 = $row1["C58"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:50"))) {
                    $digit3 = $row1["C59"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("04:55"))) {
                    $digit3 = $row1["C60"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:00"))) {
                    $digit3 = $row1["C61"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:05"))) {
                    $digit3 = $row1["C62"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:10"))) {
                    $digit3 = $row1["C63"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:15"))) {
                    $digit3 = $row1["C64"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:20"))) {
                    $digit3 = $row1["C65"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:25"))) {
                    $digit3 = $row1["C66"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:30"))) {
                    $digit3 = $row1["C67"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:35"))) {
                    $digit3 = $row1["C68"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:40"))) {
                    $digit3 = $row1["C69"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:45"))) {
                    $digit3 = $row1["C70"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:50"))) {
                    $digit3 = $row1["C71"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("05:55"))) {
                    $digit3 = $row1["C72"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:00"))) {
                    $digit3 = $row1["C73"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:05"))) {
                    $digit3 = $row1["C74"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:10"))) {
                    $digit3 = $row1["C75"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:15"))) {
                    $digit3 = $row1["C76"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:20"))) {
                    $digit3 = $row1["C77"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:25"))) {
                    $digit3 = $row1["C78"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:30"))) {
                    $digit3 = $row1["C79"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:35"))) {
                    $digit3 = $row1["C80"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:40"))) {
                    $digit3 = $row1["C81"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:45"))) {
                    $digit3 = $row1["C82"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:50"))) {
                    $digit3 = $row1["C83"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("06:55"))) {
                    $digit3 = $row1["C84"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:00"))) {
                    $digit3 = $row1["C85"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:05"))) {
                    $digit3 = $row1["C86"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:10"))) {
                    $digit3 = $row1["C87"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:15"))) {
                    $digit3 = $row1["C88"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:20"))) {
                    $digit3 = $row1["C89"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:25"))) {
                    $digit3 = $row1["C90"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:30"))) {
                    $digit3 = $row1["C91"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:35"))) {
                    $digit3 = $row1["C92"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:40"))) {
                    $digit3 = $row1["C93"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:45"))) {
                    $digit3 = $row1["C94"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:50"))) {
                    $digit3 = $row1["C95"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("07:55"))) {
                    $digit3 = $row1["C96"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:00"))) {
                    $digit3 = $row1["C97"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:05"))) {
                    $digit3 = $row1["C98"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:10"))) {
                    $digit3 = $row1["C99"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:15"))) {
                    $digit3 = $row1["C100"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:20"))) {
                    $digit3 = $row1["C101"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:25"))) {
                    $digit3 = $row1["C102"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:30"))) {
                    $digit3 = $row1["C103"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:35"))) {
                    $digit3 = $row1["C104"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:40"))) {
                    $digit3 = $row1["C105"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:45"))) {
                    $digit3 = $row1["C106"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:50"))) {
                    $digit3 = $row1["C107"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("08:55"))) {
                    $digit3 = $row1["C108"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:00"))) {
                    $digit3 = $row1["C109"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:05"))) {
                    $digit3 = $row1["C110"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:10"))) {
                    $digit3 = $row1["C111"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:15"))) {
                    $digit3 = $row1["C112"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:20"))) {
                    $digit3 = $row1["C113"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:25"))) {
                    $digit3 = $row1["C114"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:30"))) {
                    $digit3 = $row1["C115"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:35"))) {
                    $digit3 = $row1["C116"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:40"))) {
                    $digit3 = $row1["C117"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:45"))) {
                    $digit3 = $row1["C118"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:50"))) {
                    $digit3 = $row1["C119"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("09:55"))) {
                    $digit3 = $row1["C120"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:00"))) {
                    $digit3 = $row1["C121"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:05"))) {
                    $digit3 = $row1["C122"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:10"))) {
                    $digit3 = $row1["C123"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:15"))) {
                    $digit3 = $row1["C124"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:20"))) {
                    $digit3 = $row1["C125"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:25"))) {
                    $digit3 = $row1["C126"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:30"))) {
                    $digit3 = $row1["C127"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:35"))) {
                    $digit3 = $row1["C128"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:40"))) {
                    $digit3 = $row1["C129"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:45"))) {
                    $digit3 = $row1["C130"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:50"))) {
                    $digit3 = $row1["C131"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("10:55"))) {
                    $digit3 = $row1["C132"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:00"))) {
                    $digit3 = $row1["C133"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:05"))) {
                    $digit3 = $row1["C134"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:10"))) {
                    $digit3 = $row1["C135"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:15"))) {
                    $digit3 = $row1["C136"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:20"))) {
                    $digit3 = $row1["C137"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:25"))) {
                    $digit3 = $row1["C138"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:30"))) {
                    $digit3 = $row1["C139"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:35"))) {
                    $digit3 = $row1["C140"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:40"))) {
                    $digit3 = $row1["C141"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:45"))) {
                    $digit3 = $row1["C142"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:50"))) {
                    $digit3 = $row1["C143"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("11:55"))) {
                    $digit3 = $row1["C144"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:00"))) {
                    $digit3 = $row1["C145"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:05"))) {
                    $digit3 = $row1["C146"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:10"))) {
                    $digit3 = $row1["C147"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:15"))) {
                    $digit3 = $row1["C148"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:20"))) {
                    $digit3 = $row1["C149"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:25"))) {
                    $digit3 = $row1["C150"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:30"))) {
                    $digit3 = $row1["C151"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:35"))) {
                    $digit3 = $row1["C152"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:40"))) {
                    $digit3 = $row1["C153"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:45"))) {
                    $digit3 = $row1["C154"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:50"))) {
                    $digit3 = $row1["C155"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("12:55"))) {
                    $digit3 = $row1["C156"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:00"))) {
                    $digit3 = $row1["C157"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:05"))) {
                    $digit3 = $row1["C158"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:10"))) {
                    $digit3 = $row1["C159"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:15"))) {
                    $digit3 = $row1["C160"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:20"))) {
                    $digit3 = $row1["C161"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:25"))) {
                    $digit3 = $row1["C162"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:30"))) {
                    $digit3 = $row1["C163"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:35"))) {
                    $digit3 = $row1["C164"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:40"))) {
                    $digit3 = $row1["C165"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:45"))) {
                    $digit3 = $row1["C166"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:50"))) {
                    $digit3 = $row1["C167"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("13:55"))) {
                    $digit3 = $row1["C168"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:00"))) {
                    $digit3 = $row1["C169"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:05"))) {
                    $digit3 = $row1["C170"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:10"))) {
                    $digit3 = $row1["C171"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:15"))) {
                    $digit3 = $row1["C172"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:20"))) {
                    $digit3 = $row1["C173"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:25"))) {
                    $digit3 = $row1["C174"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:30"))) {
                    $digit3 = $row1["C175"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:35"))) {
                    $digit3 = $row1["C176"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:40"))) {
                    $digit3 = $row1["C177"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:45"))) {
                    $digit3 = $row1["C178"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:50"))) {
                    $digit3 = $row1["C179"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("14:55"))) {
                    $digit3 = $row1["C180"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:00"))) {
                    $digit3 = $row1["C181"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:05"))) {
                    $digit3 = $row1["C182"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:10"))) {
                    $digit3 = $row1["C183"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:15"))) {
                    $digit3 = $row1["C184"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:20"))) {
                    $digit3 = $row1["C185"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:25"))) {
                    $digit3 = $row1["C186"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:30"))) {
                    $digit3 = $row1["C187"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:35"))) {
                    $digit3 = $row1["C188"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:40"))) {
                    $digit3 = $row1["C189"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:45"))) {
                    $digit3 = $row1["C190"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:50"))) {
                    $digit3 = $row1["C191"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("15:55"))) {
                    $digit3 = $row1["C192"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:00"))) {
                    $digit3 = $row1["C193"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:05"))) {
                    $digit3 = $row1["C194"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:10"))) {
                    $digit3 = $row1["C195"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:15"))) {
                    $digit3 = $row1["C196"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:20"))) {
                    $digit3 = $row1["C197"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:25"))) {
                    $digit3 = $row1["C198"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:30"))) {
                    $digit3 = $row1["C199"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:35"))) {
                    $digit3 = $row1["C200"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:40"))) {
                    $digit3 = $row1["C201"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:45"))) {
                    $digit3 = $row1["C202"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:50"))) {
                    $digit3 = $row1["C203"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("16:55"))) {
                    $digit3 = $row1["C204"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:00"))) {
                    $digit3 = $row1["C205"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:05"))) {
                    $digit3 = $row1["C206"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:10"))) {
                    $digit3 = $row1["C207"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:15"))) {
                    $digit3 = $row1["C208"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:20"))) {
                    $digit3 = $row1["C209"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:25"))) {
                    $digit3 = $row1["C210"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:30"))) {
                    $digit3 = $row1["C211"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:35"))) {
                    $digit3 = $row1["C212"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:40"))) {
                    $digit3 = $row1["C213"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:45"))) {
                    $digit3 = $row1["C214"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:50"))) {
                    $digit3 = $row1["C215"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("17:55"))) {
                    $digit3 = $row1["C216"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:00"))) {
                    $digit3 = $row1["C217"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:05"))) {
                    $digit3 = $row1["C218"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:10"))) {
                    $digit3 = $row1["C219"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:15"))) {
                    $digit3 = $row1["C220"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:20"))) {
                    $digit3 = $row1["C221"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:25"))) {
                    $digit3 = $row1["C222"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:30"))) {
                    $digit3 = $row1["C223"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:35"))) {
                    $digit3 = $row1["C224"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:40"))) {
                    $digit3 = $row1["C225"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:45"))) {
                    $digit3 = $row1["C226"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:50"))) {
                    $digit3 = $row1["C227"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("18:55"))) {
                    $digit3 = $row1["C228"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:00"))) {
                    $digit3 = $row1["C229"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:05"))) {
                    $digit3 = $row1["C230"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:10"))) {
                    $digit3 = $row1["C231"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:15"))) {
                    $digit3 = $row1["C232"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:20"))) {
                    $digit3 = $row1["C233"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:25"))) {
                    $digit3 = $row1["C234"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:30"))) {
                    $digit3 = $row1["C235"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:35"))) {
                    $digit3 = $row1["C236"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:40"))) {
                    $digit3 = $row1["C237"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:45"))) {
                    $digit3 = $row1["C238"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:50"))) {
                    $digit3 = $row1["C239"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("19:55"))) {
                    $digit3 = $row1["C240"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:00"))) {
                    $digit3 = $row1["C241"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:05"))) {
                    $digit3 = $row1["C242"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:10"))) {
                    $digit3 = $row1["C243"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:15"))) {
                    $digit3 = $row1["C244"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:20"))) {
                    $digit3 = $row1["C245"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:25"))) {
                    $digit3 = $row1["C246"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:30"))) {
                    $digit3 = $row1["C247"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:35"))) {
                    $digit3 = $row1["C248"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:40"))) {
                    $digit3 = $row1["C249"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:45"))) {
                    $digit3 = $row1["C250"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:50"))) {
                    $digit3 = $row1["C251"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("20:55"))) {
                    $digit3 = $row1["C252"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:00"))) {
                    $digit3 = $row1["C253"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:05"))) {
                    $digit3 = $row1["C254"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:10"))) {
                    $digit3 = $row1["C255"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:15"))) {
                    $digit3 = $row1["C256"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:20"))) {
                    $digit3 = $row1["C257"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:25"))) {
                    $digit3 = $row1["C258"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:30"))) {
                    $digit3 = $row1["C259"]; 
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:35"))) {
                    $digit3 = $row1["C260"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:40"))) {
                    $digit3 = $row1["C261"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:45"))) {
                    $digit3 = $row1["C262"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:50"))) {
                    $digit3 = $row1["C263"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("21:55"))) {
                    $digit3 = $row1["C264"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:00"))) {
                    $digit3 = $row1["C265"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:05"))) {
                    $digit3 = $row1["C266"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:10"))) {
                    $digit3 = $row1["C267"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:15"))) {
                    $digit3 = $row1["C268"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:20"))) {
                    $digit3 = $row1["C269"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:25"))) {
                    $digit3 = $row1["C270"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:30"))) {
                    $digit3 = $row1["C271"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:35"))) {
                    $digit3 = $row1["C272"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:40"))) {
                    $digit3 = $row1["C273"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:45"))) {
                    $digit3 = $row1["C274"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:50"))) {
                    $digit3 = $row1["C275"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("22:55"))) {
                    $digit3 = $row1["C276"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:00"))) {
                    $digit3 = $row1["C277"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:05"))) {
                    $digit3 = $row1["C278"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:10"))) {
                    $digit3 = $row1["C279"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:15"))) {
                    $digit3 = $row1["C280"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:20"))) {
                    $digit3 = $row1["C281"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:25"))) {
                    $digit3 = $row1["C282"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:30"))) {
                    $digit3 = $row1["C283"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:35"))) {
                    $digit3 = $row1["C284"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:40"))) {
                    $digit3 = $row1["C285"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:45"))) {
                    $digit3 = $row1["C286"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:50"))) {
                    $digit3 = $row1["C287"];
                } else if (date('h:i a', strtotime($market_time)) == date('h:i a', strtotime("23:55"))) {
                    $digit3 = $row1["C288"];
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



        if ($digit2 != '' and $digit3 != '') {
            $winningNumberColor = $digit2;
            $sqlcolor = "SELECT * FROM color where color_id=$digit2";
            $resultcolor = mysqli_query($conn, $sqlcolor);
            $rowcolor = mysqli_fetch_array($resultcolor);
            $color_code = $rowcolor['color_code'];
            $color_name = $rowcolor['color_name'];
            $winningNumberLottery_number = $digit3;
        }
        if ($digit2 != '' and $digit3 == '') {
            $winningNumberColor = $digit2;
            $sqlcolor = "SELECT * FROM color where color_id=$digit2";
            $resultcolor = mysqli_query($conn, $sqlcolor);
            $rowcolor = mysqli_fetch_array($resultcolor);
            $color_code = $rowcolor['color_code'];
            $color_name = $rowcolor['color_name'];
            $winningNumberLottery_number = '*';
        }
        if ($digit2 == '' and $digit3 == '') {
            $winningNumberColor = '*';
            $color_code = '*';
            $color_name = '*';
            $winningNumberLottery_number = '*';
        }
        if ($digit2 == '' and $digit3 != '') {
            $winningNumberColor = '*';
            $color_code = '*';
            $color_name = '*';
            $winningNumberLottery_number = $digit3;
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
