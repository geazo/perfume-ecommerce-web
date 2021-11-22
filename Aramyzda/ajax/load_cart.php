<?php
    require_once('../connector/connection.php');
    $stmt = $conn -> prepare("SELECT p.*, c.quantity, c.id_cart FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $carts = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
?>
<?php if ($carts == null || $carts == "") { ?> 
    <h2>Kosong...</h2>
<?php } else { ?>
    <?php $total = 0; ?>
    <?php foreach ($carts as $key => $cart_item) { ?>
        <?php 
            $subtotal = $cart_item['quantity'] * $cart_item['price'];
            $total += $subtotal;
        ?>
        <tr class="align-middle">
            <th scope="row"><?=$key + 1?></th>
            <td class="d-flex justify-content-center">
                <a href="detailProduk.php?product=<?= $cart_item['id']?>">
                    <img class="hover-expand" style="width: 100px;" src="<?= $cart_item['image_source'] ?>" alt="">
                </a>
            </td>
            <td>
                <a class="text-decoration-none color-inherit" href="detailProduk.php?product=<?= $cart_item['id']?>">
                    <?=$cart_item['name']?>
                </a>
            </td>
            <td><?=$cart_item['type']?></td>
            <td><?="Rp. " . getFormatHarga($cart_item['price'])?></td>
            <td><?="Rp. " . getFormatHarga($cart_item['price'] * $cart_item['quantity'])?></td>
            <td>
                <button class="btn btn-outline-secondary" id="btnDownQty" type="button" onclick="editQuantity(-1, <?=$cart_item['id_cart']?>)">-</button>
                <button class="text-dark btn btn-outline-secondary" disabled><?=$cart_item['quantity']?></button>
                <button class="btn btn-outline-secondary" id="btnUpQty"  type="button" onclick="editQuantity(1, <?=$cart_item['id_cart']?>)">+</button>
            </td>
            <td>
                <i class="hover fa fa-trash fa-2x" aria-hidden="true" onclick="deleteCart(<?=$cart_item['id_cart']?>)"></i>
            </td>
        </tr>
    <?php } ?>
    <tr class="align-middle">
        <td colspan="5">
            <div class="d-flex justify-content-end">
                <h2>Total :</h2>
            </div>
        </td>
        <td colspan="2">
            <h2><?="Rp. " . getFormatHarga($total)?></h2>
        </td>
    </tr>
<?php } ?>