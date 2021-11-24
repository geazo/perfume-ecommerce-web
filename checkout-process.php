<?php namespace Midtrans; ?>
<?php require_once("./Midtrans.php") ?>
<?php require_once("./template/heading.php"); ?>
<?php require_once("./template/header.php"); ?>
<?php 
    try {
        $stmt = $conn -> prepare("SELECT SUM(p.price * c.quantity) AS 'total' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();
        $total = $stmt -> get_result() -> fetch_assoc();
        $total = $total['total'];

        $date = date("Y-m-d");
        $amount = $total;
        $pending = "PENDING";
    
        $stmt = $conn -> prepare("INSERT INTO `htrans`(`id_user`, `tanggal`, `total`, `status`) VALUES (?,?,?,?)");
        $stmt -> bind_param("isis", $_SESSION['user-login']['id'], $date, $amount, $pending);
        $stmt -> execute();
        
        $stmt = $conn -> prepare("SELECT * FROM htrans ORDER BY 1 DESC LIMIT 1");
        $stmt -> execute();
        $id = $stmt -> get_result() -> fetch_assoc();
        $id = $id['id_transaksi'];
        $id = (int) $id;
        
        $stmt = $conn -> prepare("SELECT p.id AS 'id', c.quantity AS 'quantity' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();
        $item_details = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        
        foreach ($item_details as $key => $item) {
            $stmt = $conn -> prepare("INSERT INTO `dtrans`(`id_transaksi`, `id_product`, `quantity`) VALUES (?,?,?)");
            $stmt -> bind_param("iii", $id, $item['id'], $item['quantity']);
            $stmt -> execute();
            $temp = $item['id'];
            $temp2 = $item['quantity'];
        }
    }
    catch (\Exception $e) {
        alert($e);
    }

    if ($total != "" || $total != null || $total > 0) {
        Config::$isSanitized = true;
        Config::$is3ds = true;
        
        $transaction_details = array(
            'order_id' => $id,
            'gross_amount' => $total, // no decimal allowed for creditcard
        );
        
        $stmt = $conn -> prepare("SELECT p.id AS 'id', p.price AS 'price', c.quantity AS 'quantity', p.name as 'name' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();
        $item_details = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        
        $user = $_SESSION['user-login'];
        // Optional
        $billing_address = array(
            'first_name'    => $user['first_name'],
            'last_name'     => $user['last_name'],
            'address'       => $user['address'],
            'city'          => "",
            'postal_code'   => "",
            'phone'         => $user['phone'],
            'country_code'  => 'IDN'
        );
        
        // Optional
        $shipping_address = array(
            'first_name'    => $user['first_name'],
            'last_name'     => $user['last_name'],
            'address'       => $user['address'],
            'city'          => "",
            'postal_code'   => "",
            'phone'         => $user['phone'],
            'country_code'  => 'IDN'
        );
        
        // Optional
        $customer_details = array(
            'first_name'    => $user['first_name'],
            'last_name'     => $user['last_name'],
            'email'         => $user['email'],
            'phone'         => $user['phone'],
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );
        
        // Optional, remove this to display all available payment methods
        $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');
        
        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );
        
        $snap_token = '';
        $snap_token = Snap::getSnapToken($transaction);

        $stmt = $conn -> prepare("DELETE FROM `cart` WHERE id_user = ?");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();
    }
?>
<div class="p-5">
    <div class="d-flex flex-column align-items-center py-5" id="container">
        <?php 
            if ($total <= 0) {
                echo "<h1>Belanja Dulu</h1>";
                echo "<a href='katalog.php'><button class='btn btn-primary btn-lg'>Catalogue</button></a>";
            }
            else {
                echo "
                <h1>Processing... 
                    <div class='spinner-border' role='status'>
                        <span class='visually-hidden'>Loading...</span>
                    </div>
                </h1>";
            }
        ?>
    </div>
</div>
<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
<script type="text/javascript">
    snap.pay('<?php echo $snap_token?>', {
        onSuccess: function(result){
            onFinished();
            // setTransactionStatus("SUCCESS");
            // alert('1');
        },
        onPending: function(result){
            onFinished();
            // setTransactionStatus("PENDING");
            // alert('2');
        },
        onError: function(result){
            onFinished();
            // setTransactionStatus("ERROR");
            // alert('3');
        }
    });

    function onFinished() {
        $("#container").html("");
        $("#container").append($("<h1>Thank You</h1>"))
        $("#container").append($("<div><a href='index.php'><button class='btn btn-primary btn-lg'>Home</button></a> <a href='catalogue.php'><button class='btn btn-primary btn-lg'>Catalogue</button></a></div>"))
    }

    function setTransactionStatus(status) {
        $.ajax({
            type: "post",
            url: "./ajax/set_transaction_status.php",
            data: {
                "status" : status
            },
            success: function (response) {
                alert('sukro');
            }
        });
    }

    function checkout() {
        $.ajax({
            type: "post",
            url: "./ajax/checkout.php",
            success: function (response) {
                alert(response)
            }
        });
    }
</script>