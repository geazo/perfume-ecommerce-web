<?php include("./template/heading.php") ?>
<?php include("./template/header.php") ?>
<?php
$id = $_REQUEST['id'];
$listProduct = [];
try {
    $stmt = $conn->prepare("SELECT * FROM dtrans d, product p WHERE p.id = d.id_product AND d.id_transaksi = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $listProduct = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM htrans h, user u WHERE h.id_user = u.id AND h.id_transaksi = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $transaction = $stmt->get_result()->fetch_assoc();
} catch (Exception $e) {
    exit($e->getMessage());
}

$maxProductInAPage = 10;
$maxPage = ceil(count($listProduct) / $maxProductInAPage);

$currentPage = 1;
if (isset($_REQUEST['page'])) {
    $currentPage = $_REQUEST['page'];
    if ($currentPage < 1) {
        $currentPage = 1;
    } else if ($currentPage > $maxPage) {
        $currentPage = $maxPage;
    }
}
?>
<div class="container-fluid my-4">

    <h2>Detail Transaksi</h2>
    <table class="fs-5">
        <tr>
            <td class="p-1 text-end">ID Transaksi:</td>
            <td class="p-1"><?= $transaction['id_transaksi'] ?></td>
        </tr>
        <tr>
            <td class="p-1 text-end">Nama User:</td>
            <td class="p-1"><?= $transaction['first_name'] . " " . $transaction['last_name'] ?></td>
        </tr>
        <tr>
            <td class="p-1 text-end">Tanggal & Waktu:</td>
            <td class="p-1"><?= $transaction['tanggal'] ?></td>
        </tr>
        <tr>
            <td class="p-1 text-end">Status:</td>
            <td class="p-1"><?= $transaction['status'] ?></td>
        </tr>
        <tr>
            <td class="p-1 text-end">Total:</td>
            <td class="p-1"><?= "Rp. " . getFormatHarga($transaction['total']) ?></td>
        </tr>
    </table>

    <div class="row py-3">
        <div class="col-3">
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <?php if (count($listProduct) > 0) { ?>
                <nav class="d-flex justify-content-center">
                    <ul class="pagination m-0">
                        <li class="page-item"><a class="page-link text-dark" href="<?= 'profile_detail_transaction.php?id=' . $id . '&page=' . ($currentPage - 1) ?>">Previous</a></li>
                        <?php if ($currentPage - 2 > 1) { ?>
                            <li class="page-item"><a class="page-link text-dark" href="<?= 'profile_detail_transaction.php?id=' . $id ?>">1</a></li>
                            <li class="page-item"><span class="page-link text-dark">...</span></li>
                        <?php } ?>
                        <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                            <?php if ($i < 1 || $i > $maxPage) continue; ?>
                            <?php if ($i == $currentPage) { ?>
                                <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'profile_detail_transaction.php?id=' . $id . '&page=' . $i ?>"><?= $i ?></a></li>
                            <?php } else { ?>
                                <li class="page-item"><a class="page-link text-dark" href="<?= 'profile_detail_transaction.php?id=' . $id . '&page=' . $i ?>"><?= $i ?></a></li>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($currentPage + 2 < $maxPage) { ?>
                            <li class="page-item"><span class="page-link text-dark">...</span></li>
                            <li class="page-item"><a class="page-link text-dark" href="<?= 'profile_detail_transaction.php?id=' . $id . '&page=' . $maxPage ?>"><?= $maxPage ?></a></li>
                        <?php } ?>
                        <li class="page-item"><a class="page-link text-dark" href="<?= 'profile_detail_transaction.php?id=' . $id . '&page=' . ($currentPage + 1) ?>">Next</a></li>
                    </ul>
                </nav>
            <?php } ?>
        </div>
        <div class="col-md-3 d-none d-md-flex justify-content-end align-items-center">
            <?= (($currentPage - 1) * $maxProductInAPage) + 1 ?> -
            <?= ($currentPage * $maxProductInAPage) > count($listProduct) ? count($listProduct) : ($currentPage * $maxProductInAPage) ?>
            out of <?= count($listProduct) ?> product(s)
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Type</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
                    <?php if ($i >= count($listProduct)) break; ?>
                    <?php $product = $listProduct[$i] ?>
                    <tr>
                        <td><?= ($i + 1) . "." ?></td>
                        <td class="text-center">
                            <img class="hover-expand" style="width: 100px;" src="<?= $product['image_source'] ?>" alt="">
                        </td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['brand'] ?></td>
                        <td><?= $product['type'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once("./template/footer.php") ?>
<?php include("./template/footing.php") ?>