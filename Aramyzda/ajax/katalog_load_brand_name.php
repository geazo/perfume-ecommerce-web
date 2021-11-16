<?php
    require_once("../connector/connection.php");
    $stmt = $conn -> prepare("SELECT brand FROM product GROUP BY brand");
    $stmt -> execute();
    $listBrand = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
?>

<?php foreach ($listBrand as $idxB => $brandName) { ?>
<li class="nav-item">
    <a class="nav-link " aria-current="page" href="katalog.php?brand=<?= $brandName['brand']?>"> <?= strtoupper($brandName['brand']) ?></a>
</li>
<?php } ?>