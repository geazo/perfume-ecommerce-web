<?php
    require_once('../connector/connection.php');
    $id_cart = $_REQUEST['id-cart'];

    
    $stmt = $conn -> prepare("DELETE FROM cart WHERE id_cart = ?");
    $stmt -> bind_param("i", $id_cart);
    $stmt -> execute();
?>