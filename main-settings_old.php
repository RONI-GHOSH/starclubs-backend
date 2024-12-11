<?php include 'includes/config.php'; 
date_default_timezone_set('Asia/Calcutta');
// $date = date("Y/m/d");

if (!isset($_SESSION['useradmin']) ) {
  echo '<script>alert("You are not logged in");window.location = "../admin/index.php";</script>';
}

$usertype = $_SESSION['useradmin'];

$msg = "";
$error = "";

// if (isset($_POST['updateadmin'])) {


//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $mobile = $_POST['mobile'];
//     $whatsapp_number = $_POST['whatsapp_number'];
//     $password = $_POST['password'];
//     $upi_id = $_POST['upi_id'];
//     $marchant_code = $_POST['marchant_code'];
//     $min_betting = $_POST['min_betting_rate'];
//     $min_deposit = $_POST['min_deposit_rate'];
//     $min_withdreal = $_POST['min_withdreal_rate'];

    
//     $ac_name = $_POST['ac_name'];
//     $ac_number = $_POST['ac_number'];
//     $ifsc_code = $_POST['ifsc_code'];
//     $app_link = $_POST['app_link'];
//     $app_description = $_POST['app_description'];
//     $upi_name = $_POST['upi_name'];

//     $upi_payment_id = $_POST['upi_payment_id'];
//     $market_open_time = $_POST['market_open_time'];
//     $alert_message = $_POST['alert_message'];

//     $youtube_description = $_POST['youtube_description'];
//     $youtube_link = $_POST['youtube_link'];

//     $refer_description = $_POST['refer_description'];
//     $refer_title = $_POST['refer_title'];
//     $refer_amount = $_POST['refer_amount'];

//     $max_withdrawal_rate = $_POST['max_withdrawal_rate'];
//     $max_deposite_rate = $_POST['max_deposite_rate'];
//     $minimum_transfer = $_POST['minimum_transfer'];
//     $maximum_transfer = $_POST['maximum_transfer'];
//     $maximum_bid_amount = $_POST['maximum_bid_amount'];
//     $minimum_bid_money = $_POST['minimum_bid_money'];
//     $welcome_bonus = $_POST['welcome_bonus'];

//     $welcome_title = $_POST['welcome_title'];
//     $welcome_description = $_POST['welcome_description'];

//     $home_title_one = $_POST['homeTitleOne'];
//     $home_title_two = $_POST['homeTitleTwo'];

    
//      $sql="UPDATE admin SET name='$name', email='$email', mobile='$mobile', whatsapp_number='$whatsapp_number', password='$password', upi_id='$upi_id', marchant_code='$marchant_code', min_betting_rate='$min_betting' , min_deposit_rate ='$min_deposit' , min_withdreal_rate='$min_withdreal' , update_date='$date', account_holder_name='$ac_name',account_number='$ac_number', IFSC_Code='$ifsc_code', app_url='$app_link', offer_description='$app_description',
//         upi_Name='$upi_name', upi_payment_id='$upi_payment_id', market_open_time='$market_open_time', alert_message='$alert_message', youtube_description='$youtube_description', youtube_link='$youtube_link',refer_description='$refer_description',refer_title='$refer_title',refer_amount='$refer_amount',max_withdrawal_rate='$max_withdrawal_rate',max_deposite_rate='$max_deposite_rate' ,minimum_transfer='$minimum_transfer',maximum_transfer='$maximum_transfer',maximum_bid_amount='$maximum_bid_amount',minimum_bid_money='$minimum_bid_money',welcome_bonus='$welcome_bonus', welcome_title='$welcome_title', welcome_description='$welcome_description' , home_title_one='$home_title_one' , home_title_two='$home_title_two' WHERE id='1'"; 
    
//         if (!mysqli_query($conn,$sql)) {
//             $error = "Fail to Update Settings";
//         }else{
//             $msg = "Settings Updated Successfully";
//         }
// }

if (isset($_POST['updateadminone']))
{

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $whatsapp_number = $_POST['whatsapp_number'];
    $password = $_POST['password'];
    $upi_id = $_POST['upi_id'];
    $marchant_code = $_POST['marchant_code'];
    $min_betting = $_POST['min_betting_rate'];
    $min_withdreal = $_POST['min_withdreal_rate'];

    $max_withdrawal_rate = $_POST['max_withdrawal_rate'];
    $withdraw_request_limit = $_POST['withdraw_request_limit'];
    $min_deposit = $_POST['min_deposit_rate'];
    $max_deposite_rate = $_POST['max_deposite_rate'];
    $minimum_transfer = $_POST['minimum_transfer'];
    $maximum_transfer = $_POST['maximum_transfer'];
    $maximum_bid_amount = $_POST['maximum_bid_amount'];
    $minimum_bid_money = $_POST['minimum_bid_money'];
    $welcome_bonus = $_POST['welcome_bonus'];

    
     $sql="UPDATE admin SET name='$name', email='$email', mobile='$mobile', whatsapp_number='$whatsapp_number', password='$password', upi_id='$upi_id', marchant_code='$marchant_code', min_betting_rate='$min_betting',min_withdreal_rate='$min_withdreal', withdraw_request_limit='$withdraw_request_limit',max_withdrawal_rate='$max_withdrawal_rate', min_deposit_rate ='$min_deposit',max_deposite_rate='$max_deposite_rate' ,minimum_transfer='$minimum_transfer',maximum_transfer='$maximum_transfer',maximum_bid_amount='$maximum_bid_amount',minimum_bid_money='$minimum_bid_money',welcome_bonus='$welcome_bonus',otherupi_id='$upi_id' WHERE id='1'"; 
    
        if (!mysqli_query($conn,$sql)) {
            $error = "Fail to Update Settings";
        }else{
            $msg = "Settings Updated Successfully";
        }
}

if (isset($_POST['updateadmintwo'])) {

    $ac_name = $_POST['ac_name'];
    $ac_number = $_POST['ac_number'];
    $ifsc_code = $_POST['ifsc_code'];

    
     $sql="UPDATE admin SET account_holder_name='$ac_name',account_number='$ac_number', IFSC_Code='$ifsc_code' WHERE id='1'"; 
    
        if (!mysqli_query($conn,$sql)) {
            $error = "Fail to Update Settings";
        }else{
            $msg = "Settings Updated Successfully";
        }
}

if (isset($_POST['updateadminthree'])) {

    $app_link = $_POST['app_link'];
    $app_description = $_POST['app_description'];

    
     $sql="UPDATE admin SET app_url='$app_link', offer_description='$app_description' WHERE id='1'"; 
    
    if (!mysqli_query($conn,$sql)) {
        $error = "Fail to Update Settings";
    }else{
        $msg = "Settings Updated Successfully";
    }
}

if (isset($_POST['updateadminforth'])) {

    $home_title_one = $_POST['homeTitleOne'];
    $home_title_two = $_POST['homeTitleTwo'];

    $home_title_one = preg_replace('/[^\p{L}\p{N}\s]/u', '', $home_title_one);
    $home_title_two = preg_replace('/[^\p{L}\p{N}\s]/u', '', $home_title_two);

    
     $sql="UPDATE admin SET home_title_message1='$home_title_one' , home_title_message2='$home_title_two' WHERE id='1'"; 
    
    if (!mysqli_query($conn,$sql)) {
        $error = "Fail to Update Settings";
    }else{
        $msg = "Settings Updated Successfully";
    }
}

if (isset($_POST['updateadminfifth'])) {

    $upi_name = $_POST['upi_name'];
    $upi_payment_id = $_POST['upi_payment_id'];
    $upi_paytm_id = $_POST['upi_paytm_id'];
    $upi_phonepay_id = $_POST['upi_phonepay_id'];
    $upi_googlePay_id = $_POST['upi_googlePay_id'];
    
     $sql="UPDATE admin SET upi_Name='$upi_name', upi_payment_id='$upi_payment_id' , upi_paytm_id='$upi_paytm_id' , upi_phonepay_id='$upi_phonepay_id', upi_googlePay_id='$upi_googlePay_id'  WHERE id='1'"; 
    
    if (!mysqli_query($conn,$sql)) {
        $error = "Fail to Update Settings";
    }else{
        $msg = "Settings Updated Successfully";
    }
}

if (isset($_POST['updateadminsixth'])) {

    $market_open_time = $_POST['market_open_time'];
    $alert_message = $_POST['alert_message'];
    
     $sql="UPDATE admin SET  market_open_time='$market_open_time', alert_message='$alert_message' WHERE id='1'"; 
    
    if (!mysqli_query($conn,$sql)) {
        $error = "Fail to Update Settings";
    }else{
        $msg = "Settings Updated Successfully";
    }
}

if (isset($_POST['updateadminseventh'])) {

    $youtube_description = $_POST['youtube_description'];
    $youtube_link = $_POST['youtube_link'];
    
     $sql="UPDATE admin SET  youtube_description='$youtube_description', youtube_link='$youtube_link' WHERE id='1'"; 
    
    if (!mysqli_query($conn,$sql)) {
        $error = "Fail to Update Settings";
    }else{
        $msg = "Settings Updated Successfully";
    }
}

if (isset($_POST['updateadmineight'])) {

    $refer_description = $_POST['refer_description'];
    $refer_title = $_POST['refer_title'];
    $refer_amount = $_POST['refer_amount'];
    
     $sql="UPDATE admin SET  refer_description='$refer_description',refer_title='$refer_title',refer_amount='$refer_amount' WHERE id='1'"; 
    
    if (!mysqli_query($conn,$sql)) {
        $error = "Fail to Update Settings";
    }else{
        $msg = "Settings Updated Successfully";
    }
}

if (isset($_POST['updateadminninth'])) {

    $welcome_title = $_POST['welcome_title'];
    $welcome_description = $_POST['welcome_description'];
    
     $sql="UPDATE admin SET  welcome_title='$welcome_title', welcome_description='$welcome_description' WHERE id='1'"; 
    
    if (!mysqli_query($conn,$sql)) {
        $error = "Fail to Update Settings";
    }else{
        $msg = "Settings Updated Successfully";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Settings</title>

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

    <!-- ckeditor  -->  
     <script type="text/javascript" src="assest/ckeditor/ckeditor.js"></script>
    <!-- ckeditor -->

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">

         <?php include 'includes/header.php';  ?>

        <div class="main-content">
            <div class="page-content"> 
                   <div class="col-md-12">
                        <?php if($msg){?>
                        <div class="alert alert-success left-icon-alert" role="alert">
                         <strong>Well done! </strong><?php echo htmlentities($msg); ?>
                         </div><?php } 
                         else if($error){?>
                            <div class="alert alert-danger left-icon-alert" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                            </div>
                        <?php } ?>
                    </div>

                <div class="container-fluid"> 
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card p-4">
                                <div class="header">
                                    <h2><strong>Setting</strong> <small>Update Settings</small> </h2>
                                </div>
                                <div class="body">
                                    <?php 

                                    $sql = "SELECT * FROM admin";
                                    $getqry = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($getqry) > 0) {
                                        while ($row = mysqli_fetch_assoc($getqry)) {
                                            $name = $row['name'];
                                            $email = $row['email'];
                                            $mobile = $row['mobile'];
                                            $whatsapp_number = $row['whatsapp_number'];
                                            $password = $row['password'];
                                            $upi_id = $row['upi_id'];
                                            $marchant_code = $row['marchant_code'];
                                            $min_betting_rate = $row['min_betting_rate'];
                                            $min_deposit_rate = $row['min_deposit_rate'];
                                            $min_withdreal_rate = $row['min_withdreal_rate'];

                                            $offer_description = $row['offer_description'];
                                            $app_url = $row['app_url'];
                                            $account_holder_name = $row['account_holder_name'];
                                            $account_number = $row['account_number'];
                                            $IFSC_Code = $row['IFSC_Code'];
                                            $upi_Name = $row['upi_Name'];
                                            $upi_payment_id = $row['upi_payment_id'];
                                            $market_open_time = $row['market_open_time'];
                                            $alert_message = $row['alert_message'];
                                            $youtube_link = $row['youtube_link'];
                                            $youtube_description = $row['youtube_description'];
                                            $refer_description = $row['refer_description'];
                                            $refer_title = $row['refer_title'];
                                            $refer_amount = $row['refer_amount'];

                                            $max_withdrawal_rate = $row['max_withdrawal_rate'];
                                            $withdraw_request_limit = $row['withdraw_request_limit'];
                                            $max_deposite_rate = $row['max_deposite_rate'];
                                            $minimum_transfer = $row['minimum_transfer'];
                                            $maximum_transfer = $row['maximum_transfer'];
                                            $maximum_bid_amount = $row['maximum_bid_amount'];
                                            $minimum_bid_money = $row['minimum_bid_money'];
                                            $welcome_bonus = $row['welcome_bonus'];
                                            
                                            $welcome_title = $row['welcome_title'];
                                            $welcome_description = $row['welcome_description'];
                                            $homeTitleOne = $row['home_title_message1'];
                                            $homeTitleTwo = $row['home_title_message2'];

                                            $upi_paytm_id = $row['upi_paytm_id'];
                                            $upi_phonepay_id = $row['upi_phonepay_id'];
                                            $upi_googlePay_id = $row['upi_googlePay_id'];
                                            
                                        }
                                    }
                                    ?>
                                    <form method="POST" action="">
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label for="market_name"> Name </label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_open">Email</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Mobile</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo $mobile; ?>" placeholder="Mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Whatsapp Number</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="whatsapp_number" name="whatsapp_number" class="form-control" value="<?php echo $whatsapp_number; ?>" placeholder="Mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Password</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Upi Id</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="upi_id" name="upi_id" class="form-control" value="<?php echo $upi_id; ?>" placeholder="Upi Id">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Merchant Id</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="marchant_code" name="marchant_code" class="form-control" value="<?php echo $marchant_code; ?>" placeholder="Merchant Id">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Min Betting Rate</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="min_betting_rate" name="min_betting_rate" class="form-control" value="<?php echo $min_betting_rate; ?>" placeholder="Min Betting Rate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Min Withdrwal Rate</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="min_withdreal_rate" name="min_withdreal_rate" class="form-control" value="<?php echo $min_withdreal_rate; ?>" placeholder="Min Withdrwal Rate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Max Withdrawal Rate</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="max_withdrawal_rate" name="max_withdrawal_rate" class="form-control" value="<?php echo $max_withdrawal_rate; ?>" placeholder="Max Withdrawal Rate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Min Deposit Rate</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="min_deposit_rate" name="min_deposit_rate" class="form-control" value="<?php echo $min_deposit_rate; ?>" placeholder="Min Deposit Rate">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-sm-4">
                                                <label for="market_close">Max Deposit Rate</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="max_deposite_rate" name="max_deposite_rate" class="form-control" value="<?php echo $max_deposite_rate;?>" placeholder="Max Deposite Rate">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-sm-4">
                                                <label for="market_close">Minimum Transfer</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="minimum_transfer" name="minimum_transfer" class="form-control" value="<?php echo $minimum_transfer; ?>" placeholder="Minimum Transfer">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Maximum Transfer</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="maximum_transfer" name="maximum_transfer" class="form-control" value="<?php echo $maximum_transfer; ?>" placeholder="Maximum Transfer">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Minimum Bid Amount</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="minimum_bid_money" name="minimum_bid_money" class="form-control" value="<?php echo $minimum_bid_money; ?>" placeholder="Minimum Bid Amount">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Maximum Bid Amount</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="maximum_bid_amount" name="maximum_bid_amount" class="form-control" value="<?php echo $maximum_bid_amount; ?>" placeholder="Maximum Bid Amount">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Welcome Bonus</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="welcome_bonus" name="welcome_bonus" class="form-control" value="<?php echo $welcome_bonus; ?>" placeholder="Welcome Bonus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="market_close">Withdrawal Limit Request</label>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="text" id="withdraw_request_limit" name="withdraw_request_limit" class="form-control" value="<?php echo $withdraw_request_limit; ?>" placeholder="Max Withdrawal Rate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadminone" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">Add Bank Details</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Account Holder Name</label>
                                                    <input class="form-control" type="text" name="ac_name" value="<?=$account_holder_name?>" placeholder="Enter Account Holder Name" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Account Number</label>
                                                    <input class="form-control" type="Number" name="ac_number" id="ac_number" value="<?=$account_number?>" placeholder="Enter Account Number" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">IFSC Code</label>
                                                    <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?=$IFSC_Code?>" placeholder="Enter " data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadmintwo" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">Add App Link</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">App Link</label>
                                                    <input class="form-control" type="text" name="app_link" id="app_link" value="<?=$app_url?>" placeholder="Enter APP Link" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="col-form-label">Share Message</label>
                                                    <textarea class="form-control" name="app_description" rows="4" value="<?=$offer_description?>" id="content"><?=$offer_description?></textarea>
                                                </div>
                                            </div> 
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadminthree" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">Home Title</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Home Title 1</label>
                                                    <input class="form-control" type="text" name="homeTitleOne" value="<?=$homeTitleOne?>" placeholder="Enter Title">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Home Title 2</label>
                                                    <input class="form-control" name="homeTitleTwo" placeholder="Enter Title" rows="4" value="<?=$homeTitleTwo?>" >
                                                </div>
                                            </div> 
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadminforth" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">UPI Payment ID</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">UPI Name</label>
                                                    <input class="form-control" type="text" name="upi_name" id="upi_name" value="<?=$upi_Name?>" placeholder="Enter upi Name" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">UPI Payment Id</label>
                                                    <input class="form-control" type="text" name="upi_payment_id" id="upi_payment_id" value="<?=$upi_payment_id?>" placeholder="Enter upi payment id" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">UPI Paytm Id</label>
                                                    <input class="form-control" type="text" name="upi_paytm_id" id="upi_paytm_id" value="<?=$upi_paytm_id?>" placeholder="Enter upi Paytm id" data-original-title="" title="">
                                                </div>
                                            </div> 
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">UPI PhonePay Id</label>
                                                    <input class="form-control" type="text" name="upi_phonepay_id" id="upi_phonepay_id" value="<?=$upi_phonepay_id?>" placeholder="Enter upi Phone Pay id" data-original-title="" title="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">UPI GooglePay Id</label>
                                                    <input class="form-control" type="text" name="upi_googlePay_id" id="upi_googlePay_id" value="<?=$upi_googlePay_id?>" placeholder="Enter upi Google Pay id" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadminfifth" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">Other Settings</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Market Open Time</label>
                                                    <input class="form-control" type="time" name="market_open_time" id="market_open_time" value="<?=$market_open_time?>" placeholder="Enter Market Open Time" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Alert Message</label>
                                                    <input class="form-control" type="text" name="alert_message" id="alert_message" value="<?=$alert_message?>" placeholder="Enter Alert Message" data-original-title="" title="">
                                                </div>
                                            </div>
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadminsixth" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">How To Play</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">How To Play Content</label>
                                                    <textarea class="form-control" type="text" name="youtube_description" id
                                                ="editor1"  value="<?=$youtube_description?>" placeholder="Enter Youtube Link" data-original-title="" title=""><?=$youtube_description?></textarea>
                                                    <script>
                                                        CKEDITOR.replace('editor1');
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">Video Link</label>
                                                    <textarea class="form-control" type="text" name="youtube_link" value="<?=$youtube_link?>" placeholder="Enter Youtube Link" data-original-title="" title=""><?=$youtube_link?></textarea>
                                                </div>
                                            </div> 
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadminseventh" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div> 
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">Refer & Earn</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">Refer Description</label>
                                                    <textarea class="form-control" type="text" name="refer_description" id
                                                ="editor2"  value="<?=$refer_description?>" placeholder="Enter Refer Description" data-original-title="" title=""><?=$refer_description?></textarea>
                                                    <script>
                                                        CKEDITOR.replace('editor2');
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Refer Title</label>
                                                    <textarea class="form-control" type="text" name="refer_title" value="<?=$refer_title?>" placeholder="Enter Refer Title" data-original-title="" title=""><?=$refer_title?></textarea>
                                                </div>
                                            </div> 
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Refer Amount</label>
                                                    <textarea class="form-control" type="text" name="refer_amount" value="<?=$refer_amount?>" placeholder="Refer Amount" data-original-title="" title=""><?=$refer_amount?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadmineight" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <br>
                                        <hr class="m-0">
                                        <br>
                                        <h5 style="color:blue;">Welcome</h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">Enter Title</label>
                                                    <textarea class="form-control" type="text" id="editor3" name="welcome_title" value="<?=$welcome_title?>" placeholder="Enter Title" data-original-title="" title=""><?=$welcome_title?></textarea>
                                                    <script>
                                                        CKEDITOR.replace('editor3');
                                                    </script>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">Enter Description</label>
                                                    <textarea class="form-control" type="text" name="welcome_description" value="<?=$welcome_description?>" placeholder="Enter Description" data-original-title="" title=""><?=$welcome_description?></textarea> 
                                                </div>
                                            </div>
                                            <div class="form-group m-4 text-sm-right">
                                                <button type="submit" style="text-align:right;" name="updateadminninth" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group m-4 text-sm-right">
                                            <button type="submit" style="text-align:right;" name="updateadmin" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                                        </div> -->
                                    </form> 
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>            
        </div>


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
<script src="adminassets/js/customjs.js?v=9212"></script>


</body>

</html>