<?php 
    require_once("../connector/connection.php");
    
     
    try {
      $stmt = $conn -> prepare("SELECT * FROM product");
      $stmt -> execute();
      $listProduct = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    }
    catch(Exception $e) {
      exit($e->getMessage());
    }
?>
<?php foreach ($listProduct as $key => $product) { ?>
    <tr>
        <td><?=$product['id']?></td>
        <td><?=$product['name']?></td>
        <td><?=$product['type']?></td>
        <td><?=$product['stock']?></td>
        <td class="d-flex justify-content-end"><?="Rp. " . getFormatHarga($product['price'])?></td>
    </tr>
<?php } ?>