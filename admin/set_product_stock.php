<?php
    require_once("../connector/connection.php");
    $stmt = $conn -> prepare("UPDATE `product` SET `stock`=? WHERE id = ?");
    $stmt -> bind_param("ii",$_REQUEST['stok'], $_REQUEST['id']);
    $stmt -> execute();
    echo "Success!";
?>