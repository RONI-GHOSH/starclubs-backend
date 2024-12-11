<?php
header('Content-Type: application/json');
include '../config.php';

$response = array();

try {
    $sql = "SELECT refer_type, refer_description, refer_title, refer_amount FROM admin WHERE id = '1'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        throw new Exception("Error fetching referral details: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $response['status'] = 'success';
        $response['data'] = $data;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No referral details found.';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
