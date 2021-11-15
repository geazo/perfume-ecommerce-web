<?php
    require_once("./connector/connection.php");
    if (isset($_REQUEST['btn'])) {
        $listProduct = file_get_contents(
            "result.json"
        );
        $listProduct = json_decode($listProduct,true);
        
        foreach ($listProduct as $key => $product) {
            $name = $product['name'];
            $brand = $product['brand'];
            $price = $product['price'];
            $stock = mt_rand(1, 100);
            $type = $product['type'];
            $description = $product['description'];
            $image_source = $product['image'];
            $stmt = $conn -> prepare("INSERT INTO `product`(`name`, `brand`, `price`, `stock`, `type`, `description`, `image_source`) VALUES (?,?,?,?,?,?,?)");
            $stmt -> bind_param("ssiisss", $name, $brand, $price, $stock, $type, $description, $image_source);
            $stmt -> execute();
        }
        echo "done";
    }
?>
<form action="">
    <button name="btn!">Start?</button>
</form>