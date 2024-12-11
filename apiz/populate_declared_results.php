<?php
include '../includes/config.php'; // Include database connection

// Get selected parameters from AJAX request
$betdate = $_POST['betdate'];
$gameTime = $_POST['gameName'];
$number = $_POST['color'];
$game_name = 'Color';

// 2024-02-11<br/>12:00 am<br/>5002<br/>Color

// Fetch declared results based on selected parameters
$sql = "SELECT * FROM colormarket WHERE betting_time = '$betdate' AND game_name ='$game_name'";
$result = mysqli_query($conn, $sql);
// Prepare options for the dropdown
if (mysqli_num_rows($result) > 0) 
{
    $row=mysqli_fetch_array($result);
    if ($gameTime == date('h:i a', strtotime("00:00:00"))) {
        $options = $row['O'];
        
    }
    if ($gameTime == date('h:i a', strtotime("01:00:00"))) {
        $options = $row['P'];
        
    }
    if ($gameTime == date('h:i a', strtotime("02:00:00"))) {
        $options = $row['Q'];
        
    }
    if ($gameTime == date('h:i a', strtotime("03:00:00"))) {
        $options = $row['R'];
        
    }
    if ($gameTime == date('h:i a', strtotime("04:00:00"))) {
        $options = $row['S'];
        
    }
    if ($gameTime == date('h:i a', strtotime("05:00:00"))) {
        $options = $row['T'];
        
    }
    if ($gameTime == date('h:i a', strtotime("06:00:00"))) {
        $options = $row['U'];
        
    }
    if ($gameTime == date('h:i a', strtotime("07:00:00"))) {
        $options = $row['V'];
        
    }
    if ($gameTime == date('h:i a', strtotime("08:00:00"))) {
        $options = $row['W'];
        
    }
    if ($gameTime == date('h:i a', strtotime("9:00:00"))) {
        $options = $row['X'];
        
    }
    if ($gameTime == date('h:i a', strtotime("10:00:00"))) {
        $options = $row['A'];
        
    }
    if ($gameTime == date('h:i a', strtotime("11:00:00"))) {
        $options = $row['B'];
        
    }
    if ($gameTime == date('h:i a', strtotime("12:00:00"))) {
        $options = $row['C'];
        
    }
    if ($gameTime == date('h:i a', strtotime("13:00:00"))) {
        $options = $row['D'];
        
    }
    if ($gameTime == date('h:i a', strtotime("14:00:00"))) {
        $options = $row['E'];
        
    }
    if ($gameTime == date('h:i a', strtotime("15:00:00"))) {
        $options = $row['F'];
        
    }
    if ($gameTime == date('h:i a', strtotime("16:00:00"))) {
        $options = $row['G'];
        
    }
    if ($gameTime == date('h:i a', strtotime("17:00:00"))) {
        $options = $row['H'];
        
    }
    if ($gameTime == date('h:i a', strtotime("18:00:00"))) {
        $options = $row['I'];
        
    }
    if ($gameTime == date('h:i a', strtotime("19:00:00"))) {
        $options = $row['J'];
        
    }
    if ($gameTime == date('h:i a', strtotime("20:00:00"))) {
        $options = $row['K'];
        
    }
    if ($gameTime == date('h:i a', strtotime("21:00:00"))) {
        $options = $row['L'];
        
    }
    if ($gameTime == date('h:i a', strtotime("22:00:00"))) {
        $options = $row['M'];
        
    }
    if ($gameTime == date('h:i a', strtotime("23:00:00"))) {
        $options = $row['N'];
        
    }
    
    if ($options =='') {
        echo $options = "<option value=''>--No Result Declared Yet--</option>";  
        exit;
    }
    
    $sql1 = "SELECT * FROM color WHERE color_id=$options";
    $query1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($query1);
    $color_name1 = $row1['color_name'];
    echo $options = "<option value='" . $color_name1 . "'>" . $color_name1 . "</option>";
    exit;
}
else
{
    echo $options = "<option value=''>--No Result Declared Yet--</option>";
    exit;
    
}