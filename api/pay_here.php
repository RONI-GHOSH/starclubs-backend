<!DOCTYPE html>
<html>

<head>
    <title>UPI Gateway - Payment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function redirectToPayment() {
            document.getElementById("progress").style.display = "block"; // Show progress indicator
            document.getElementById("paymentForm").submit(); // Automatically submit the form
        }
    </script>
</head>

<body onload="redirectToPayment()">
    <div class="container p-5">
        <div class="row">
            <div class="col-md-7 mb-2">
                <?php
                // Get `amount` and `udf1` from the URL query parameters
                $txnAmount = isset($_GET['amount']) ? $_GET['amount'] : 1; // Default to 1 if not provided
                $udf1 = isset($_GET['udf1']) ? $_GET['udf1'] : 'extradata'; // Default to 'extradata' if not provided

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $key = "6207dbac-c484-4674-a8bb-59e930ccd1ba"; // Your API Token
                    $post_data = new stdClass();
                    $post_data->key = $key;
                    $post_data->client_txn_id = (string) rand(100000, 999999); // Random transaction ID
                    $post_data->amount = $txnAmount; // Use the amount from the URL query
                    $post_data->p_info = "product_name";
                    $post_data->customer_name = "Dummy User"; // Dummy data
                    $post_data->customer_email = "dummy@example.com"; // Dummy data
                    $post_data->customer_mobile = "9999999999"; // Dummy data
                    $post_data->redirect_url = "https://starclubs.in/"; // Automatically adds query params
                    $post_data->udf1 = $udf1; // Use udf1 from the URL query
                    $post_data->udf2 = "extradata";
                    $post_data->udf3 = "extradata";

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.ekqr.in/api/create_order',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode($post_data),
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json'
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);

                    $result = json_decode($response, true);
                    if ($result['status'] == true) {
                        echo '<script>location.href="' . $result['data']['payment_url'] . '"</script>';
                        exit();
                    }

                    echo '<div class="alert alert-danger">' . $result['msg'] . '</div>';
                }
                ?>
                <h2>StarClubs - Payment </h2>
                <p id="progress" style="display: none;">Processing payment... Please wait.</p>
                <form action="" method="post" id="paymentForm">
                    <input type="hidden" name="txnAmount" value="<?php echo htmlspecialchars($txnAmount); ?>">
                    <input type="hidden" name="customerName" value="Dummy User">
                    <input type="hidden" name="customerMobile" value="9999999999">
                    <input type="hidden" name="customerEmail" value="dummy@example.com">
                    <input type="hidden" name="payment" value="true">
                </form>
            </div>
        </div>
    </div>
</body>

</html>

