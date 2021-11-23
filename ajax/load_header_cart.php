<?php
    require_once('../connector/connection.php');
    $stmt = $conn -> prepare("SELECT SUM(p.price * c.quantity) AS 'total' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $total = $stmt -> get_result() -> fetch_assoc();
    $total = $total['total']
?>

<h2>Total : Rp. <?=getFormatHarga($total)?></h2>
<form action="" method="POST">
    <button type="submit" name="pay-button" id="pay-button" class="btn btn-primary btn-lg" onclick="checkout()">Check Out</button>
</form>