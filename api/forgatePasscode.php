
<?php 
include '../config.php';
$member_id = $_POST['member_id'];
$memberPassword = $_POST['memberPassword'];
$passcode = $_POST['passcode'];

$sql = "SELECT * FROM member WHERE member_id = '$member_id'";
$result = mysqli_query($conn,$sql);
if ($row = mysqli_fetch_array($result)) 
{
     $password = $row['member_password'];
    if ($password != $memberPassword) 
    {
        $response = ["status"=>"failure"];
        
    }
    else 
    {
         $sql2 = "UPDATE member SET member_passcode = '$passcode' WHERE member_id = '$member_id'";
        $result2 = mysqli_query($conn,$sql2);
        if ($result2) 
        {
            $response = ["status"=>"success"];
        }
        else
        {
            $response = ["status"=>"failure"];
        }
    }
}


echo json_encode($response);


?>

