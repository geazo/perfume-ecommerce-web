<?php require_once("./template/heading.php"); ?>
<?php include ("./template/header.php")?>
<?php 
  if (isset($_SESSION['user-login'])) {
    $stmt = $conn -> prepare("SELECT p.*, c.quantity FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $carts = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
  }
?>
<div class="py-3 m-3">
    <table class="table table-hover fs-5">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th class="d-flex justify-content-center" scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            </tr>
        </thead>
    <tbody>
    <?php foreach ($carts as $key => $cart_item) { ?>
        <tr class="align-middle">
            <th scope="row"><?=$key + 1?></th>
            <td class="d-flex justify-content-center"><img class="hover-expand" style="width: 150px;" src="<?= $cart_item['image_source'] ?>" alt=""></td>
            <td><?=$cart_item['name']?></td>
            <td><?=$cart_item['type']?></td>
            <td><?=$cart_item['price']?></td>
            <td><?=$cart_item['quantity']?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>