<?php
    require_once("./connector/connection.php"); 
try {
    $transaction = "testing";
    $amount = 123;
    $date = date("d-m-Y");
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
    $stmt = $conn -> prepare("INSERT INTO `htrans`(`id_user`, `tanggal`, `total`, `status`) VALUES (?,?,?,?)");
    $stmt -> bind_param("isis", $_SESSION['user-login']['id'], $date, $amount, $transaction);
    $stmt -> execute();
    
    $stmt = $conn -> prepare("SELECT * FROM htrans ORDER BY 1 DESC LIMIT 1");
    $stmt -> execute();
    $id = $stmt -> get_result() -> fetch_assoc();
    $id = $id['id_transaksi'];
    $id = (int) $id;
    $id += 1;
    
    $stmt = $conn -> prepare("SELECT p.id AS 'id', c.quantity AS 'quantity' FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $item_details = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    
    foreach ($item_details as $key => $item) {
        $stmt = $conn -> prepare("INSERT INTO `dtrans`(`id_transaksi`, `id_product`, `quantity`) VALUES (?,?,?)");
        $stmt -> bind_param("iii", $id, $item['id'], $item['quantity']);
        $stmt -> execute();
    }
}
catch (\Exception $e) {
    // echo $e->getMessage();
    echo "404";
}