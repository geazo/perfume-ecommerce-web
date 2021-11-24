<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for sample HTTP notifications:
// https://docs.midtrans.com/en/after-payment/http-notification?id=sample-of-different-payment-channels

namespace Midtrans;

require_once './Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-R9BFL_Q-ByzCbA4KB8SWaZak';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

try {
    $notif = new Notification();
}
catch (\Exception $e) {
    exit($e->getMessage());
}

$notif = $notif->getResponse();
$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

$status = "";
if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card') {
        if ($fraud == 'challenge') {
            // TODO set payment status in merchant's database to 'Challenge by FDS'
            // TODO merchant should decide whether this transaction is authorized or not in MAP
            // echo "Transaction order_id: " . $order_id ." is challenged by FDS";
            $status = "FAILED";
        } else {
            // TODO set payment status in merchant's database to 'Success'
            // echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
            $status = "SUCCESS";
        }
    }
} else if ($transaction == 'settlement') {
    // TODO set payment status in merchant's database to 'Settlement'
    // echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
    $status = "SUCCESS";
} else if ($transaction == 'pending') {
    // TODO set payment status in merchant's database to 'Pending'
    // echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
    $status = "PENDING";
} else if ($transaction == 'deny') {
    // TODO set payment status in merchant's database to 'Denied'
    // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
    $status = "FAILED";
} else if ($transaction == 'expire') {
    // TODO set payment status in merchant's database to 'expire'
    // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
    $status = "FAILED";
} else if ($transaction == 'cancel') {
    // TODO set payment status in merchant's database to 'Denied'
    // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
    $status = "FAILED";
}

// $coba = json_encode($_REQUEST);
// $stmt = $conn -> prepare("INSERT INTO `checkcheck`(`string`) VALUES (?)");
// $stmt -> bind_param("s", $coba);
// $stmt -> execute();

try {
    $stmt = $conn -> prepare("UPDATE `htrans` SET `status`= ? WHERE id_transaksi = ?");
    $stmt -> bind_param("si", $status, $order_id);
    $stmt -> execute();

    echo "200 OK";
}
catch(\Exception $e) {
    // echo "404";
    echo $e->getMessage();
}

function printExampleWarningMessage() {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo 'Notification-handler are not meant to be opened via browser / GET HTTP method. It is used to handle Midtrans HTTP POST notification / webhook.';
    }
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    }   
}
