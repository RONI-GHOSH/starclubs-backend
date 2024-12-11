<?php

include '../config.php';

$singledigitlist=array();
$doubledigitlist=array();
$singlepanalist=array();
$doublepanalist=array();
$triplepanalist=array();
$fullsangamopen = array();
$fullsangamclose =array();
$halfsangampanna =array();
$lottery_number = array();
$color = array();

$sql = "SELECT * FROM tbl_fullsangamopen ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['digit'],
			"isCheck"=>false
		];
		array_push($fullsangamopen, $temp);
	}
}
else {
	$response = ["status"=>"failure"];
}


$sql = "SELECT * FROM tbl_fullsangamclose";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['digit'],
			"isCheck"=>false
		];
		array_push($fullsangamclose, $temp);
	}
}
else {
	$response = ["status"=>"failure"];
}

$sql = "SELECT * FROM tbl_halfsangampanna";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['digit'],
			"isCheck"=>false
		];
		array_push($halfsangampanna, $temp);
	}
}
else {
	$response = ["status"=>"failure"];
}
 $sql = "SELECT * FROM tbl_singledigit ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['single_digite'],
			"isCheck"=>false
		];
		array_push($singledigitlist, $temp);
	}


}
else {
	$response = ["status"=>"failure"];
}
 $sql = "SELECT * FROM tbl_doubledigit ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['double_digite'],
			"isCheck"=>false
		];
		array_push($doubledigitlist, $temp);
	}


}
else {
	$response = ["status"=>"failure"];
}
 $sql = "SELECT * FROM tbl_singlepana ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['single_pana'],
			"isCheck"=>false
		];
		array_push($singlepanalist, $temp);
	}
	

}
else {
	$response = ["status"=>"failure"];
}
  $sql = "SELECT * FROM tbl_doublepana ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['double_pana'],
			"isCheck"=>false
		];
		array_push($doublepanalist, $temp);
	}


}
else {
	$response = ["status"=>"failure"];
}
 $sql = "SELECT * FROM tbl_triplepana ";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp = 
		[
			"number"=>$row['triple_pana'],
			"isCheck"=>false
		];
		array_push($triplepanalist, $temp);
	}
	

}
else {
	$response = ["status"=>"failure"];
}


$sql = "SELECT * FROM color Where status='1'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp =
			[
				"color_name" => $row['color_name'],
				"color_code" => $row['color_code'],
				"color_id" => $row['color_id'],
				"isCheck" => false
			];
		array_push($color, $temp);
	}
} else {
	$response = ["status" => "failure"];
}

$sql = "SELECT * FROM lottery_number Where status='1'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) {
	$list = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$temp =
			[
				"number" => $row['number'],
				"isCheck" => false
			];
		array_push($lottery_number, $temp);
	}
} else {
	$response = ["status" => "failure"];
}

$response = ["status"=>"success", "color"=> $color, "lottery_number"=> $lottery_number,"singledigitlist"=>$singledigitlist,"doubledigitlist"=>$doubledigitlist,"singlepanalist"=>$singlepanalist,"doublepanalist"=>$doublepanalist,"triplepanalist"=>$triplepanalist, "fullsangamopen"=>$fullsangamopen, "fullsangamclose"=>$fullsangamclose, "halfsangampanna"=>$halfsangampanna];

echo json_encode($response);


?>