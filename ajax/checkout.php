<?php
    require_once("../connector/connection.php");
    try {
        $stmt = $conn -> prepare("SELECT SUM(p.price * c.quantity) AS 'total' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();
        $total = $stmt -> get_result() -> fetch_assoc();
        $total = $total['total'];

        $date = date("Y-m-d");
        $amount = $total;
        $pending = "pending";
    
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
    
        $stmt = $conn -> prepare("DELETE FROM `cart` WHERE id_user = ?");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();   
    }
    catch (Exception $e) {
        alert($e);
    }
?>