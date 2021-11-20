<?php
    require_once('../connector/connection.php');
    if (!isset($_SESSION['user-login'])) {
        header("login.php");
    }
    else {
        $stmt = $conn -> prepare("SELECT p.*, c.quantity FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();
        $carts = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    }
?>
<?php foreach ($carts as $key => $cart_item) { ?>
    <tr class="align-middle">
        <th scope="row"><?=$key + 1?></th>
        <td class="d-flex justify-content-center">
            <a href="detailProduk.php?product=<?= $cart_item['id']?>">
                <img class="hover-expand" style="width: 120px;" src="<?= $cart_item['image_source'] ?>" alt="">
            </a>
        </td>
        <td>
            <a class="text-decoration-none color-inherit" href="detailProduk.php?product=<?= $cart_item['id']?>">
                <?=$cart_item['name']?>
            </a>
        </td>
        <td><?=$cart_item['type']?></td>
        <td><?=$cart_item['price']?></td>
        <td>
            <button class="btn btn-outline-secondary" id="btnDownQty" type="button" onclick="gantiAngkaDown()">-</button>
            <button class="btn btn-outline-secondary" type="button" disabled><?=$cart_item['quantity']?></button>
            <button class="btn btn-outline-secondary" id="btnUpQty"  type="button" onclick="gantiAngkaUp()">+</button>
        </td>
        <td>
            
        </td>
    </tr>
<?php } ?>