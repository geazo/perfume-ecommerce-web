<?php
    require_once('../connector/connection.php');
    $stmt = $conn -> prepare("SELECT SUM(p.price * c.quantity) AS 'total' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $total = $stmt -> get_result() -> fetch_assoc();
    $total = $total['total']
?>

<h2>Total : Rp. <?=getFormatHarga($total)?></h2>
<form id="form-h-cart" action="./Midtrans/checkout-process.php" method="POST">
    <input id="total-amount-h" type="hidden" name="amount" value="<?=$total?>">
    <button id="pay-button" type="submit" class="btn btn-primary btn-lg">Check Out</button>
</form>