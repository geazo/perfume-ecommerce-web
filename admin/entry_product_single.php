<?php
    require_once("../connector/connection.php");
    try {
        $stmt = $conn -> prepare("INSERT INTO `product`(`name`, `brand`, `price`, `stock`, `type`, `description`, `image_source`) VALUES (?,?,?,?,?,?,?)");
        $stmt -> bind_param("ssiisss", $_REQUEST['nama'], $_REQUEST['brand'], $_REQUEST['harga'], $_REQUEST['stok'], $_REQUEST['tipe'], $_REQUEST['description'], $_REQUEST['image']);
        $stmt -> execute();
    }
    catch(Exception $e) {
        echo $e->getMessage();
    }
?>