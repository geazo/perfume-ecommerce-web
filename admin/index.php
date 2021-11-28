<?php require_once("heading.php") ?>
<?php
$listProduct = [];
try {
  if (!isset($_REQUEST['select-query']) || $_REQUEST['select-query'] == "All") {
    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt->execute();
    $listProduct = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  } else {
    $arrParam = explode("-", $_REQUEST['select-query']);
    $stmt = $conn->prepare("SELECT * FROM product ORDER BY " . $arrParam[0] . " " . $arrParam[1]);
    $stmt->execute();
    $listProduct = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }
} catch (Exception $e) {
  exit($e->getMessage());
}

$maxProductInAPage = 50;
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
<?php require_once "header.php" ?>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-dark bg-secondary bg-opacity-25" aria-current="page" href="index.php">
              <i class="fa fa-home"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="crud.php">
              <i class="fa fa-share"></i> Entry
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="report.php">
              <i class="fa fa-book"></i> Report
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
      <h2>List Product</h2>

      <div class="row py-3">
        <div class="col-3">
          <form action="" method="GET">
            <select name="select-query" id="select-query" class="form-select" aria-label="select-query" onchange="changedSelect()">
              <option <?= !isset($_REQUEST['select-query']) ? "selected" : "" ?> value="All" selected>All</option>
              <option <?= !isset($_REQUEST['select-query']) ? "" : ($_REQUEST['select-query'] == "price-asc" ? "selected" : "") ?> value="price-asc">Harga Asc</option>
              <option <?= !isset($_REQUEST['select-query']) ? "" : ($_REQUEST['select-query'] == "price-desc" ? "selected" : "") ?> value="price-desc">Harga Desc</option>
              <option <?= !isset($_REQUEST['select-query']) ? "" : ($_REQUEST['select-query'] == "stock-asc" ? "selected" : "") ?> value="stock-asc">Stok Asc</option>
              <option <?= !isset($_REQUEST['select-query']) ? "" : ($_REQUEST['select-query'] == "stock-desc" ? "selected" : "") ?> value="stock-desc">Stok Desc</option>
            </select>
            <input id="btn-submit-sq" class="d-none" type="submit" value="">
          </form>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-center">
          <?php if (count($listProduct) > 0) { ?>
            <nav class="d-flex justify-content-center">
              <ul class="pagination m-0">
                <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . ($currentPage - 1) ?>">Previous</a></li>
                <?php if ($currentPage - 2 > 1) { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php' ?>">1</a></li>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                <?php } ?>
                <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                  <?php if ($i < 1 || $i > $maxPage) continue; ?>
                  <?php if ($i == $currentPage) { ?>
                    <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'index.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } else { ?>
                    <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } ?>
                <?php } ?>
                <?php if ($currentPage + 2 < $maxPage) { ?>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . $maxPage ?>"><?= $maxPage ?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . ($currentPage + 1) ?>">Next</a></li>
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
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Tipe</th>
              <th class="text-center" scope="col">Stok</th>
              <th class="text-end" scope="col">Harga</th>
              <th class="text-center" scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
              <?php if ($i >= count($listProduct)) break; ?>
              <?php $product = $listProduct[$i] ?>
              <tr>
                <td><?= ($i + 1) . "." ?></td>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['type'] ?></td>
                <td class="text-center" id="td-stock-<?= $product['id'] ?>"><?= $product['stock'] ?></td>
                <td class="text-end"><?= "Rp. " . getFormatHarga($product['price']) ?></td>
                <td class="text-center">
                  <button class="btn btn-secondary" id="btn-<?= $product['id'] ?>" state="inactive" onclick="toggleEdit(<?= $product['id'] ?>)">Edit</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="row py-3">
        <div class="col-3"></div>
        <div class="col-6 d-flex align-items-center justify-content-center">
          <?php if (count($listProduct) > 0) { ?>
            <nav class="d-flex justify-content-center">
              <ul class="pagination m-0">
                <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . ($currentPage - 1) ?>">Previous</a></li>
                <?php if ($currentPage - 2 > 1) { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php' ?>">1</a></li>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                <?php } ?>
                <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                  <?php if ($i < 1 || $i > $maxPage) continue; ?>
                  <?php if ($i == $currentPage) { ?>
                    <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'index.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } else { ?>
                    <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } ?>
                <?php } ?>
                <?php if ($currentPage + 2 < $maxPage) { ?>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . $maxPage ?>"><?= $maxPage ?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page=' . ($currentPage + 1) ?>">Next</a></li>
              </ul>
            </nav>
          <?php } ?>
        </div>
        <div class="col-3">
        </div>
      </div>
    </main>
  </div>
</div>
<?php require_once("../template/footing.php") ?>
<script>
  function changedSelect() {
    $("#btn-submit-sq").click();
  }

  function toggleEdit(id) {
    if ($("#btn-" + id).attr("state") == "inactive") {
      let stok = $("#td-stock-" + id).text();
      $("#td-stock-" + id).html("");
      $("#td-stock-" + id).append($('<input style="width:60px" type="number" id="inp-stock-' + id + '" value="' + stok + '">'));
      $("#btn-" + id).attr("state", "active");
      $("#btn-" + id).html("Save");
    } else {
      setNewStock(id);
      $("#td-stock-" + id).text($("#inp-stock-" + id).val());
      $("#btn-" + id).attr("state", "inactive");
      $("#btn-" + id).html("Edit");
    }
  }

  function setNewStock(id) {
    $.ajax({
      type: "post",
      url: "set_product_stock.php",
      data: {
        "id": id,
        "stok": $("#inp-stock-" + id).val()
      },
      success: function(response) {

      }
    });
  }
</script>
<style>
  .hover:hover {
    cursor: pointer;
  }
</style>