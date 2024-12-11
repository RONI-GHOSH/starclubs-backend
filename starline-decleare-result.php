<?php include 'includes/config.php'; 
// session_start();

if (!isset($_SESSION['useradmin'])) 
{
  echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];
$query1 = "SELECT * FROM admin";
$result1 = mysqli_query($conn,$query1);
$rows1 = mysqli_fetch_assoc($result1);
$refer_percentage = $rows1['refer_amount'];

if (isset($_POST['update'])) {

    $market_id = $_POST['starlinemarkettype'];
    $betdate = $_POST['betdate'] ;
    $number = $_POST['number'] ;

    $dsql = "SELECT * FROM starlinemarket WHERE betting_time = '$betdate' AND active_status='Active'";
    $getqry = mysqli_query($conn, $dsql);
    if(mysqli_num_rows($getqry) > 0 ) {
        $row = mysqli_fetch_assoc($getqry);
        $exid = $row['id'];
        if ($market_id == date('h:i a',strtotime("00:00:00"))) {
            $usql = "UPDATE starlinemarket SET O='$number' WHERE id='$exid'";
            
        }elseif ($market_id  ==date('h:i a',strtotime("01:00:00"))) {
            $usql = "UPDATE starlinemarket SET P='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("02:00:00"))) {
            $usql = "UPDATE starlinemarket SET Q='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("03:00:00"))) {
            $usql = "UPDATE starlinemarket SET R='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("04:00:00"))) {
            $usql = "UPDATE starlinemarket SET S='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("05:00:00"))) {
            $usql = "UPDATE starlinemarket SET T='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("06:00:00"))) {
            $usql = "UPDATE starlinemarket SET U='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("07:00:00"))) {
            $usql = "UPDATE starlinemarket SET V='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("08:00:00"))) {
            $usql = "UPDATE starlinemarket SET W='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("09:00:00"))) {
            $usql = "UPDATE starlinemarket SET X='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("10:00:00"))) {
            $usql = "UPDATE starlinemarket SET A='$number' WHERE id='$exid'";
        }elseif ($market_id  ==date('h:i a',strtotime("11:00:00"))) {
            $usql = "UPDATE starlinemarket SET B='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("12:00:00"))) {
            $usql = "UPDATE starlinemarket SET C='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("13:00:00"))) {
            $usql = "UPDATE starlinemarket SET D='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("14:00:00"))) {
            $usql = "UPDATE starlinemarket SET E='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("15:00:00"))) {
            $usql = "UPDATE starlinemarket SET F='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("16:00:00"))) {
            $usql = "UPDATE starlinemarket SET G='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("17:00:00"))) {
            $usql = "UPDATE starlinemarket SET H='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("18:00:00"))) {
            $usql = "UPDATE starlinemarket SET I='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("19:00:00"))) {
            $usql = "UPDATE starlinemarket SET J='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("20:00:00"))) {
            $usql = "UPDATE starlinemarket SET K='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("21:00:00"))) {
            $usql = "UPDATE starlinemarket SET L='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("22:00:00"))) {
            $usql = "UPDATE starlinemarket SET M='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("23:00:00"))) {
            $usql = "UPDATE starlinemarket SET N='$number' WHERE id='$exid'";
        }

        if(!mysqli_query($conn,$usql)) {
            echo "<script>alert('Number Update Failed');window.location = 'starline-decleare-result.php';</script>";
        } 
        else {
            $sql_refer_type = "SELECT refer_type FROM admin";
            $query_refer_type = mysqli_query($conn, $sql_refer_type);
            $row_refer_type = mysqli_fetch_array($query_refer_type);
            $refer_type = $row_refer_type['refer_type'];

            if ($refer_type = 'Loss Betting') {
                // LOSS Bet Referall Earnings Transactions
                $dateObject = new DateTime($betdate);
                // Format the date as desired (y-m-d)
                $formattedDate = $dateObject->format('y-m-d');
                $lossbetmsql = "select * from starlinemarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate' AND  
                    bet_num !='$number'";
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
                echo '<script>alert("Number Update Successfully");window.location = "starline-decleare-result.php";</script>';
            } 
            elseif ($refer_type = 'Flat') {
                $dateObject = new DateTime($betdate);
                // Format the date as desired (y-m-d)
                $formattedDate = $dateObject->format('y-m-d');
                $lossbetmsql = "select * from starlinemarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate'";
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
                echo '<script>alert("Number Update Successfully");window.location = "starline-decleare-result.php";</script>';
            }
        
            //echo '<script>alert("Number Update Successfully");window.location = "starline-decleare-result.php";</script>';
        }
    }
    else {
        if ($market_id == date('h:i a',strtotime("00:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,O,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  ==date('h:i a',strtotime("01:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,P,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("02:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,Q,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("03:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,R,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("04:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,S,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("05:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,T,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("06:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,U,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("07:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,V,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("08:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,W,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("09:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,X,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("10:00:00"))) {
        $usql = "INSERT INTO starlinemarket(betting_time,A,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  ==date('h:i a',strtotime("11:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,B,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("12:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,C,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("13:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,D,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("14:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,E,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("15:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,F,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("16:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,G,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("17:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,H,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("18:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,I,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("19:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,J,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("20:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,K,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("21:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,L,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("22:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,M,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("23:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,N,active_status) VALUES ('$betdate','$number','active')";
        }
        if (!mysqli_query($conn, $usql)) {
            echo "<script>alert('Number Update Failed');window.location = 'starline-decleare-result.php';</script>";
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
                $lossbetmsql = "select * from starlinemarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate' AND  
                    bet_num !='$number'";
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
                echo '<script>alert("Number Update Successfully");window.location = "starline-decleare-result.php";</script>';
            }
            elseif ($refer_type = 'Flat') {
                $dateObject = new DateTime($betdate);
                // Format the date as desired (y-m-d)
                $formattedDate = $dateObject->format('y-m-d');
                $lossbetmsql = "select * from starlinemarketbat WHERE statLineBatTime='$market_id' AND betting_date ='$formattedDate'";
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
                echo '<script>alert("Number Update Successfully");window.location = "starline-decleare-result.php";</script>';
            }
        }
    }
}




if (isset($_POST['update-allot'])) {

    $market_id = $_POST['starlinemarkettype'];
    $betdate = $_POST['betdate'] ;
    $number = $_POST['number'] ;

        //Return Winning Amount 
         $returnQuery = "SELECT * FROM wallet_transaction WHERE transaction_update_date=date('$betdate') AND market_Id ='$market_id' ORDER BY w_transaction_id DESC";
            $Returngql = mysqli_query($conn , $returnQuery);

                if(mysqli_num_rows($Returngql) > 0) {
                                
                    while($Returngre = mysqli_fetch_array($Returngql)) {
                            
                            $memberid = $Returngre['member_id'];
                            $amount = $Returngre['transaction_amount'];
                            
                            $msql = "SELECT * FROM member_wallet WHERE member_id='$memberid' ";
                            $mquery = mysqli_query($conn, $msql);
                            
                            if ($mrow = mysqli_fetch_array($mquery)) {
                                $mbalance = $mrow['member_wallet_balance'];
                            }
                            
                            $mrbalance = $mbalance - $amount;
                            
                            $updsql = "UPDATE member_wallet SET member_wallet_balance='$mrbalance' WHERE member_id='$memberid'";
            				if(mysqli_query($conn,$updsql)) {
            					$lastid = mysqli_insert_id($conn);
            					$upsql = "UPDATE wallet_transaction SET status='2' WHERE transaction_update_date=date('$betdate') AND member_id='$memberid' AND market_Id ='$market_id' ORDER BY w_transaction_id DESC"; 
            					if(mysqli_query($conn,$upsql)) {
            				    
            					}
            					
            				} else {
        					    $response=["status"=>'Failure4']; 
        				    }
                     }
                }

        //Return Winning Amount
        
    $dsql = "SELECT * FROM starlinemarket WHERE betting_time = '$betdate' AND active_status='Active'";
    $getqry = mysqli_query($conn, $dsql);
    if(mysqli_num_rows($getqry) > 0 ) {
       $row = mysqli_fetch_assoc($getqry);
       $exid = $row['id'];



       if ($market_id == date('h:i a',strtotime("00:00:00"))) {
            $usql = "UPDATE starlinemarket SET O='$number' WHERE id='$exid'";
        }elseif ($market_id  ==date('h:i a',strtotime("01:00:00"))) {
            $usql = "UPDATE starlinemarket SET P='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("02:00:00"))) {
            $usql = "UPDATE starlinemarket SET Q='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("03:00:00"))) {
            $usql = "UPDATE starlinemarket SET R='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("04:00:00"))) {
            $usql = "UPDATE starlinemarket SET S='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("05:00:00"))) {
            $usql = "UPDATE starlinemarket SET T='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("06:00:00"))) {
            $usql = "UPDATE starlinemarket SET U='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("07:00:00"))) {
            $usql = "UPDATE starlinemarket SET V='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("08:00:00"))) {
            $usql = "UPDATE starlinemarket SET W='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("09:00:00"))) {
            $usql = "UPDATE starlinemarket SET X='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("10:00:00"))) {
            $usql = "UPDATE starlinemarket SET A='$number' WHERE id='$exid'";
        }elseif ($market_id  ==date('h:i a',strtotime("11:00:00"))) {
            $usql = "UPDATE starlinemarket SET B='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("12:00:00"))) {
            $usql = "UPDATE starlinemarket SET C='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("13:00:00"))) {
            $usql = "UPDATE starlinemarket SET D='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("14:00:00"))) {
            $usql = "UPDATE starlinemarket SET E='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("15:00:00"))) {
            $usql = "UPDATE starlinemarket SET F='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("16:00:00"))) {
            $usql = "UPDATE starlinemarket SET G='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("17:00:00"))) {
            $usql = "UPDATE starlinemarket SET H='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("18:00:00"))) {
            $usql = "UPDATE starlinemarket SET I='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("19:00:00"))) {
            $usql = "UPDATE starlinemarket SET J='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("20:00:00"))) {
            $usql = "UPDATE starlinemarket SET K='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("21:00:00"))) {
            $usql = "UPDATE starlinemarket SET L='$number' WHERE id='$exid'";
        }elseif ($market_id == date('h:i a',strtotime("22:00:00"))) {
            $usql = "UPDATE starlinemarket SET M='$number' WHERE id='$exid'";
        }elseif ($market_id  == date('h:i a',strtotime("23:00:00"))) {
            $usql = "UPDATE starlinemarket SET N='$number' WHERE id='$exid'";
        }

       $market_id=   date('h:i a',strtotime( $market_id));

        // $usql = "UPDATE winningbetting_detail SET winning_number_first='$number1', winning_number_second='$number2', winning_number_third='$number3' , winning_number_fouth='$number4' WHERE Id='$exid'";

       if(!mysqli_query($conn,$usql)) {
           echo "<script>alert('Number Update Failed');window.location = 'starline-decleare-result.php';</script>";
        }else{
          $dsql = "CALL Poc_StarLineWinningAmount('$market_id')";

            


            if(!mysqli_query($conn,$dsql)) {
               echo '<script>alert("Number Update Failed");window.location = "starline-decleare-result.php";</script>';
            }else{
                echo '<script>alert("Number Update Successfully");window.location = "starline-decleare-result.php";</script>';
            }
            // echo "<script>alert('Number Update Successfully');window.location = 'starline-decleare-result.php';</script>";
        }
    }else{
        if ($market_id == date('h:i a',strtotime("00:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,O,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  ==date('h:i a',strtotime("01:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,P,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("02:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,Q,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("03:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,R,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("04:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,S,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("05:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,T,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("06:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,U,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("07:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,V,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("08:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,W,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("09:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,X,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("10:00:00"))) {
        $usql = "INSERT INTO starlinemarket(betting_time,A,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  ==date('h:i a',strtotime("11:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,B,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("12:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,C,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("13:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,D,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("14:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,E,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("15:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,F,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("16:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,G,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("17:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,H,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("18:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,I,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("19:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,J,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("20:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,K,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("21:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,L,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id == date('h:i a',strtotime("22:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,M,active_status) VALUES ('$betdate','$number','active')";
        }elseif ($market_id  == date('h:i a',strtotime("23:00:00"))) {
            $usql = "INSERT INTO starlinemarket(betting_time,N,active_status) VALUES ('$betdate','$number','active')";
        }

        if(!mysqli_query($conn,$usql)) {
           echo "<script>alert('Number Update Failed');window.location = 'starline-decleare-result.php';</script>";
        }else{
            $dsql = "CALL Poc_StarLineWinningAmount('$market_id')";
            if(!mysqli_query($conn,$dsql)) {
               echo '<script>alert("Number Update Failed");window.location = "starline-decleare-result.php";</script>';
            }else{
                echo '<script>alert("Number Update Successfully");window.location = "starline-decleare-result.php";</script>';
            }
            // echo "<script>alert('Number Update Successfully');window.location = 'starline-decleare-result.php';</script>";
        }
        }
}
function debug_to_console($data) {
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
    .model-footer-change
    {
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

                                            <form class="theme-form mega-form"  method="post">

                                                <input type="hidden" name="id" id="id">

                                                <div class="row">
                                                    <div class="form-group col-md-4">

                                                        <label>Result Date</label>

                                                        <label>Result Date</label>

                                                        <div class="date-picker">

                                                            <div class="input-group">

                                                                <input class="form-control digits" type="date" value="<?php echo $date?>" name="betdate" id="starline_betdate" >

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="form-group col-md-4">

                                                        <label>Game Name </label>

                                                        <select class="form-control" name="starlinemarkettype" id="starlinemarkettype">
                                                          <option value="" >-- Please Select Market Name --</option>
                                                          <?php

                                                          $getsql = "SELECT * FROM starLineMarketList WHERE active_status = 'Active'  ";
                                                            $getqry = mysqli_query($conn, $getsql);
                                                          $i = 1;
                                                          if (mysqli_num_rows($getqry) > 0) {
                                                           while ($row = mysqli_fetch_assoc($getqry)) {
                                                            ?>
                                                            <option value="<?php echo  date('h:i a',strtotime($row['market_time'])) ; ?>"><?php echo date('h:i a',strtotime($row['market_time'])); ?></option>
                                                            <?php }}?>
                                                        </select>
                                                    </div>

                                                <div class="col-sm-4">
                                                    <label for="market_close">Number</label>
                                                    <div class="form-group">
                                                        <input type="text" maxlength="3" class="form-control" placeholder="Number" name="number" id="number">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>&nbsp;</label>   
                                                    <button type="submit" class="btn btn-danger btn-block" name="update">Share Commision</button>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>&nbsp;</label>   
                                                    <button type="submit" class="btn btn-success btn-block" name="update-allot">Declare Result</button>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>&nbsp;</label>   
                                                    <button type="button" onclick="starlineBtn(this);" class="btn btn-warning btn-block" >Show Winner List</button>
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


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Game Result History</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="startable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Declare Date</th>
                                            <?php 
                                                $gets = "SELECT * FROM starLineMarketList WHERE betting_time LIKE '%$date%'";
                                                $getq = mysqli_query($conn, $gets);
                                                $i = 1;
                                                if (mysqli_num_rows($getq) > 0)
                                                {
                                                     while ($rowq = mysqli_fetch_assoc($getq)) {
                                                        //  print_r($rowq);?>
                                                   <th><?php if ($rowq['O'] ||$rowq['O'] == null) { echo "12 AM"; } ?></th>
                                                    <th><?php if ($rowq['P'] ||$rowq['P'] == null) {echo "01 AM"; } ?></th>
                                                    <th><?php if ($rowq['Q'] ||$rowq['Q'] == null) { echo "02 AM"; } ?></th>
                                                    <th><?php if ($rowq['R'] ||$rowq['R'] == null) { echo "03 AM"; } ?></th>
                                                    <th><?php if ($rowq['S'] ||$rowq['S'] == null) { echo "04 AM"; } ?></th>
                                                    <th><?php if ($rowq['T'] ||$rowq['T'] == null) { echo "05 AM"; } ?></th>
                                                    <th><?php if ($rowq['U'] ||$rowq['U'] == null) { echo "06 AM"; } ?></th>
                                                    <th><?php if ($rowq['V'] ||$rowq['V'] == null) { echo "07 AM"; } ?></th>
                                                    <th><?php if ($rowq['W'] ||$rowq['W'] == null) { echo "08 AM"; } ?></th>
                                                    <th><?php if ($rowq['X'] ||$rowq['X'] == null) { echo "09 AM"; } ?></th>
                                                    <th><?php if ($rowq['A'] ||$rowq['A'] == null) {echo "10 AM"; } ?></th>
                                                    <th><?php if ($rowq['B'] ||$rowq['B'] == null) { echo "11 AM"; } ?></th>
                                                    <th><?php if ($rowq['C'] ||$rowq['C'] == null) { echo "12 PM"; } ?></th>
                                                    <th><?php if ($rowq['D'] ||$rowq['D'] == null) {echo  "1 PM"; } ?></th>
                                                    <th><?php if ($rowq['E'] ||$rowq['E'] == null) {echo  "2 PM"; } ?></th>
                                                    <th><?php if ($rowq['F'] ||$rowq['F'] == null) {echo  "3 PM"; } ?></th>
                                                    <th><?php if ($rowq['G'] ||$rowq['G'] == null) {echo  "4 PM"; } ?></th>
                                                    <th><?php if ($rowq['H'] ||$rowq['H'] == null) {echo  "5 PM"; } ?></th>
                                                    <th><?php if ($rowq['I'] ||$rowq['I'] == null) {echo  "6 PM"; } ?></th>
                                                    <th><?php if ($rowq['J'] ||$rowq['J'] == null) {echo  "7 PM"; } ?></th>
                                                    <th><?php if ($rowq['K'] ||$rowq['K'] == null) {echo  "8 PM"; } ?></th>
                                                    <th><?php if ($rowq['L'] ||$rowq['L'] == null) {echo  "9 PM"; } ?></th>
                                                    <th><?php if ($rowq['M'] ||$rowq['M'] == null) { echo "10 PM"; } ?></th>
                                                     <th><?php if ($rowq['N'] ||$rowq['N'] == null) { echo "11 PM"; } ?></th> 
                                                                                        <?php }}?>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php

                                          $getsql = "SELECT * FROM starlinemarket WHERE betting_time LIKE '%$date%' ";
                                          $getqry = mysqli_query($conn, $getsql);
                                          $i = 1;
                                          if (mysqli_num_rows($getqry) > 0) {
                                             while ($row = mysqli_fetch_assoc($getqry)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['betting_time']; ?></td>
                                            <td><?php echo $row['O'] ?? '-';?></td>
                                            <td><?php echo $row['P'] ?? '-';?></td>
                                            <td><?php echo $row['Q'] ?? '-';?></td>
                                            <td><?php echo $row['R'] ?? '-';?></td>
                                            <td><?php echo $row['S'] ?? '-';?></td>
                                            <td><?php echo $row['T'] ?? '-';?></td>
                                            <td><?php echo $row['U'] ?? '-';?></td>
                                            <td><?php echo $row['V'] ?? '-';?></td>
                                            <td><?php echo $row['W'] ?? '-';?></td>
                                            <td><?php echo $row['X'] ?? '-';?></td> 
                                            <td><?php echo $row['A'] ?? '-';?></td>
                                            <td><?php echo $row['B'] ?? '-';?></td>
                                            <td><?php echo $row['C'] ?? '-';?></td>
                                            <td><?php echo $row['D'] ?? '-';?></td>
                                            <td><?php echo $row['E'] ?? '-';?></td>
                                            <td><?php echo $row['F'] ?? '-';?></td>
                                            <td><?php echo $row['G'] ?? '-';?></td>
                                            <td><?php echo $row['H'] ?? '-';?></td>
                                            <td><?php echo $row['I'] ?? '-';?></td>
                                            <td><?php echo $row['J'] ?? '-';?></td>
                                            <td><?php echo $row['K'] ?? '-';?></td>
                                            <td><?php echo $row['L'] ?? '-';?></td>
                                            <td><?php echo $row['M'] ?? '-';?></td>
                                            <td><?php echo $row['N'] ?? '-';?></td>
                                        </tr>
                                    <?php $i++;}}?>
                                    </tbody>
                                </table>
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
                                    <button type="button"  data-dismiss="modal" id="starlineListDel" style="padding: 5px 15px 5px 15px;" class="btn light btn-warning" >Delete</button>
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
            function starlineBtn(el) {
                var betdate = $('#starline_betdate').val();
                var marketid = $('#starlinemarkettype').val();
                var number = $('#number').val();

                if (marketid != '' ) {
                    if (betdate != ''){
                        if (number != '' && number.length >= 3 ){
                            $('#starline-win-member').DataTable({
                                destroy:true,
                                "ajax":"apiz/get_starline_decleare_result.php?marketid="+marketid+"&betdate="+betdate+"&number="+number,
                                "data": [],
                            });
                        }else{
                            alert("Number required and must have 3 digit");
                        }
                    }else{
                        alert("Date required");
                    }
                }else{
                    alert("Market required");
                } 
            }
        </script>

        <script type="text/javascript">
            $(document).ready( function () {
                $('#startable').DataTable();
            } );
        </script>

        
        <script type="text/javascript">
            function editStarlineWin(ss)
            {
                var betnum = $(ss).attr('betnum');
                var betid = $(ss).attr('betid');

                $("#betnum").attr('alt',betnum).val(betnum);
                $("#betid").attr('alt',betid).val(betid);

                $('#editStarlineWin').modal({show:true});
            }
        </script>

        <script>
            function men(e){ 
                var betnum = $('#betnum').val();
                var betid = $('#betid').val();
                $.ajax({ 
                    type: "POST",
                    url: "apiz/starline-decleare-result-update.php",
                    data : {betnum,betid},
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
                $("#starlineListDel").attr('alt',id);
            }
        </script>

        <script type="text/javascript">
            $("#starlineListDel").on('click',function(){
                var id = $(this).attr('alt');
                $.ajax({
                    type:"POST",
                    url:"apiz/delete_starline_result.php",
                    data:{id},
                    success:function(data) { 
                        $("#deleteBetListMsg").html(data);
                        setTimeout(function(){ $("#deleteBetListMsg").html(null); }, 4000);
                        $('#starline-win-member').DataTable().ajax.reload();
                    }
                });
            });
        </script>

</body>

</html>