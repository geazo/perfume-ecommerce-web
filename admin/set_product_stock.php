<?php
    require_once("../connector/connection.php");
    $stmt = $conn -> prepare("UPDATE `product` SET `stock`=[value-5] WHERE id = ?");
    $stmt -> bind_param("i", $_REQUEST['id']);
    $stmt -> execute();
    echo "Success!";
?>