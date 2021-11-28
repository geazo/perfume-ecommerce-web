<?php
if (!isset($_REQUEST['id'])) {
    die("Cannot access without id");
}
?>
<?php require_once("heading.php") ?>
<?php require_once("../connector/connection.php") ?>
<?php require_once "header.php" ?>
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

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" aria-current="page" href="index.php">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-dark" aria-current="page" href="crud.php">
                            <i class="fa fa-share"></i> Entry
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-dark bg-secondary bg-opacity-25" aria-current="page" href="report.php">
                            <i class="fa fa-book"></i> Report
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
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
                <div class="col-6 d-flex align-items-center justify-content-center">
                    <?php if (count($listProduct) > 0) { ?>
                        <nav class="d-flex justify-content-center">
                            <ul class="pagination m-0">
                                <li class="page-item"><a class="page-link text-dark" href="<?= 'detail_transaction.php?id=' . $id . '&page=' . $currentPage - 1 ?>">Previous</a></li>
                                <?php if ($currentPage - 2 > 1) { ?>
                                    <li class="page-item"><a class="page-link text-dark" href="<?= 'detail_transaction.php?id=' . $id?>">1</a></li>
                                    <li class="page-item"><span class="page-link text-dark">...</span></li>
                                <?php } ?>
                                <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                                    <?php if ($i < 1 || $i > $maxPage) continue; ?>
                                    <?php if ($i == $currentPage) { ?>
                                        <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'detail_transaction.php?id=' . $id . '&page=' . $i ?>"><?= $i ?></a></li>
                                    <?php } else { ?>
                                        <li class="page-item"><a class="page-link text-dark" href="<?= 'detail_transaction.php?id=' . $id . '&page=' . $i ?>"><?= $i ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($currentPage + 2 < $maxPage) { ?>
                                    <li class="page-item"><span class="page-link text-dark">...</span></li>
                                    <li class="page-item"><a class="page-link text-dark" href="<?= 'detail_transaction.php?id=' . $id . '&page=' . $maxPage ?>"><?= $maxPage ?></a></li>
                                <?php } ?>
                                <li class="page-item"><a class="page-link text-dark" href="<?= 'detail_transaction.php?id=' . $id . '&page=' . $currentPage + 1 ?>">Next</a></li>
                            </ul>
                        </nav>
                    <?php } ?>
                </div>
                <div class="col-3 d-flex justify-content-end align-items-center">
                    <?= (($currentPage - 1) * $maxProductInAPage) + 1 ?> -
                    <?= ($currentPage * $maxProductInAPage) + 1 > count($listProduct) ? count($listProduct) : ($currentPage * $maxProductInAPage) + 1 ?>
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
    </main>
</div>
</div>
<?php require_once("../template/footing.php") ?>