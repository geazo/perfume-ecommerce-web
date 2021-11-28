<?php
    require_once('../connector/connection.php');
    $n = $_REQUEST['number'];
    $id_cart = $_REQUEST['id-cart'];

    $stmt = $conn -> prepare("SELECT quantity FROM cart WHERE id_cart = ?");
    $stmt -> bind_param("i", $id_cart);
    $stmt -> execute();
    $cart = $stmt -> get_result() -> fetch_assoc();

    $newQty = $n;

    if ($newQty > 0) {
        $stmt = $conn -> prepare("UPDATE `cart` SET `quantity`=? WHERE id_cart = ?");
        $stmt -> bind_param("ii", $newQty, $id_cart);
        $stmt -> execute();
    }
    else {
        //todo mungkin kasih notif yes/no sebelum delete??? but how, pake mbox? ahihihihi
        $stmt = $conn -> prepare("DELETE FROM cart WHERE id_cart = ?");
        $stmt -> bind_param("i", $id_cart);
        $stmt -> execute();
    }
?>