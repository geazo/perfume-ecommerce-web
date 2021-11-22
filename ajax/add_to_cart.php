<?php 
    require_once('../connector/connection.php');
    if (isset($_SESSION['user-login'])) {
        $stmt = $conn -> prepare("select * from cart where id_user = ? AND id_product = ?");
        $stmt -> bind_param("ii", $_SESSION['user-login']['id'], $_REQUEST['id-product']);
        $stmt -> execute();
        $result = $stmt -> get_result() -> fetch_assoc();
        if ($result == null || $result == "") {
            $stmt = $conn -> prepare("INSERT INTO `cart`(`id_user`, `id_product`, `quantity`) VALUES (?,?,?)");
            $stmt -> bind_param("iii", $_SESSION['user-login']['id'], $_REQUEST['id-product'], $_REQUEST['quantity']);
            $stmt -> execute();
            echo "inserted\n";
        }
        else {
            $newQty = (int) $result['quantity'] + (int) $_REQUEST['quantity'];
            $stmt = $conn -> prepare("UPDATE `cart` SET `quantity`=? WHERE id_cart = ?");
            $stmt -> bind_param("ii", $newQty, $result['id_cart']);
            $stmt -> execute();
            echo "updated new quantity = " . $newQty;
        }
    }
?>