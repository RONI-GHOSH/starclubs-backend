<?php
include '../includes/config.php';
	
    $sql = "SELECT * FROM market WHERE active_status != 'Removed'";
	$qry = mysqli_query($conn,$sql);
	$i = 1;
	  	if (mysqli_num_rows($qry) > 0) {
	     	while ($row = mysqli_fetch_assoc($qry)) {
                
                $name = $row['market_name'];
                $mkid = $row['market_id'];

  				echo $response  =  "<option value='$mkid'> $name </option>";
                    // $i++;
			}

		}

?>