<?php include 'includes/config.php';
// session_start();
date_default_timezone_set('Asia/Kolkata');

$sqlautoresult="SELECT autoresult FROM admin";
$queryautoresult=mysqli_query($conn, $sqlautoresult);
$rowautoresult=mysqli_fetch_array($queryautoresult);
$autoresult=$rowautoresult['autoresult'];
if($autoresult=='Active')
{
include('color-declare-result-auto.php');
include('lottery-number-declare-result-auto.php');
}
exit;