<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for sample HTTP notifications:
// https://docs.midtrans.com/en/after-payment/http-notification?id=sample-of-different-payment-channels

namespace Midtrans;

use Exception;

require_once("./Midtrans.php");
require_once("./connector/connection.php");
Config::$isProduction = false;

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


if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card') {
        if ($fraud == 'challenge') {
            // TODO set payment status in merchant's database to 'Challenge by FDS'
            // TODO merchant should decide whether this transaction is authorized or not in MAP
            // echo "Transaction order_id: " . $order_id ." is challenged by FDS";
            $transaction = "challenge by FDS";
        } else {
            // TODO set payment status in merchant's database to 'Success'
            // echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
            $transaction = "success";
        }
    }
} else if ($transaction == 'settlement') {
    // TODO set payment status in merchant's database to 'Settlement'
    // echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
} else if ($transaction == 'pending') {
    // TODO set payment status in merchant's database to 'Pending'
    // echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
} else if ($transaction == 'deny') {
    // TODO set payment status in merchant's database to 'Denied'
    // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
} else if ($transaction == 'expire') {
    // TODO set payment status in merchant's database to 'expire'
    // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
} else if ($transaction == 'cancel') {
    // TODO set payment status in merchant's database to 'Denied'
    // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
}
try {
    $stmt = $conn -> prepare("INSERT INTO `htrans`(`id_user`, `tanggal`, `total`, `status`) VALUES (?,?,?,?)");
    $stmt -> bind_param("isis", $_SESSION['user-login']['id'], date("d-m-Y"), $_REQUEST['gross_amount'], $transaction);
    $stmt -> execute();
    
    $stmt = $conn -> prepare("SELECT * FROM htrans ORDER BY 1 DESC LIMIT 1");
    $stmt -> execute();
    $id = $stmt -> get_result() -> fetch_assoc();
    $id = $id['id_transaksi'];
    $id = (int) $id;
    $id += 1;
    
    $stmt = $conn -> prepare("SELECT p.id AS 'id', c.quantity AS 'quantity', FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $item_details = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    
    foreach ($item_details as $key => $item) {
        $stmt = $conn -> prepare("INSERT INTO `dtrans`(`id_transaksi`, `id_product`, `quantity`) VALUES (?,?,?)");
        $stmt -> bind_param("iii", $id, $item['id'], $item['quantity']);
        $stmt -> execute();
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}

echo "404";
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