<?php namespace Midtrans; ?>
<?php require_once("./template/heading.php"); ?>
<?php include ("./template/header.php"); ?>
<?php 
    require_once('./Midtrans.php');
    require_once('./connector/connection.php');

    if (!isset($_SESSION['user-login'])) {
        windowLocationHref("index.php");
    }

    Config::$isSanitized = true;
    Config::$is3ds = true;
    
    $stmt = $conn -> prepare("SELECT SUM(p.price * c.quantity) AS 'total' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $total = $stmt -> get_result() -> fetch_assoc();
    $total = $total['total'];
    
    $transaction_details = array(
        'order_id' => rand(),
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
?>
<div class="py-3 m-3">
    <!-- <div class="yesno modal d-none" id="modalCart">
    <span onclick="document.getElementById('modalCart').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div> -->
    <div class="row">
        <div class="col-12">
            <table class="table table-hover fs-6">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th class="d-flex justify-content-center" scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
            <div id="header-cart" class="d-flex align-items-end flex-column">
            </div>
        </div>
        
    </div>
    
</div>

<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
<script>
    loadCart();
    function loadDCart() {
        $.ajax({
            type: "post",
            url: "ajax/load_detail_cart.php",
            success: function (response) {
                $("#tbody").html("");
                $("#tbody").append(response);
            }
        });
    }

    function loadHCart() {
        $.ajax({
            type: "post",
            url: "ajax/load_header_cart.php",
            success: function (response) {
                $("#header-cart").html("");
                $("#header-cart").append(response);
                document.getElementById('pay-button').addEventListener('click', function () {
                    snap.pay('<?php echo $snap_token?>', {
                        onSuccess: function(result){
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        },
                        onPending: function(result){
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        },
                        onError: function(result){
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        }
                    });
                });
            }
        });
    }

    function loadCart() {
        loadDCart();
        loadHCart();
    }

    function editQuantity(num, id_cart) {
        $.ajax({
            type: "post",
            url: "ajax/edit_cart_quantity.php",
            data: {
                "number" : num,
                "id-cart" : id_cart
            },
            success: function (response) {
                loadCart();
            }
        });
    }

    function deleteCart(id_cart) {
        $.ajax({
            type: "post",
            url: "ajax/delete_cart.php",
            data: {
                "id-cart" : id_cart
            },
            success: function (response) {
                loadCart();
            }
        });
    }
</script>