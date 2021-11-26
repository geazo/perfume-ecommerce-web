<?php require_once("heading.php")?>
<?php 
  $listProduct = [];
  try {
    $stmt = $conn -> prepare("SELECT * FROM product");
    $stmt -> execute();
    $listProduct = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
  }
  catch(Exception $e) {
    exit($e->getMessage());
  }

  $maxProductInAPage = 50;
  $maxPage = ceil(count($listProduct) / $maxProductInAPage);

  $currentPage = 1;
  if (isset($_REQUEST['page'])) {
    $currentPage = $_REQUEST['page'];
    if ($currentPage < 1)  {
      $currentPage = 1;
    }
    else if ( $currentPage > $maxPage) {
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

      <?php if(count($listProduct) > 0) { ?>
        <nav class="d-flex justify-content-center">
          <ul class="pagination">
            <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page='.$currentPage - 1?>">Previous</a></li>
            <?php if($currentPage - 2 > 1) {?>
              <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php' ?>">1</a></li>
              <li class="page-item"><span class="page-link text-dark">...</span></li>
            <?php } ?>
            <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
              <?php if ($i < 1 || $i > $maxPage) continue; ?>
              <?php if($i == $currentPage) { ?>
                <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'index.php?page='.$i ?>"><?=$i?></a></li>
              <?php } else { ?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page='.$i ?>"><?=$i?></a></li>
                <?php } ?>
            <?php } ?>
            <?php if($currentPage + 2 < $maxPage) {?>
              <li class="page-item"><span class="page-link text-dark">...</span></li>
              <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page='.$maxPage?>"><?= $maxPage ?></a></li>
            <?php } ?>
            <li class="page-item"><a class="page-link text-dark" href="<?= 'index.php?page='.$currentPage + 1?>">Next</a></li>
          </ul>
        </nav>
      <?php } ?>

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
                <td><?=($i + 1)."."?></td>
                <td><?=$product['id']?></td>
                <td><?=$product['name']?></td>
                <td><?=$product['type']?></td>
                <td class="text-center" id="td-stock-<?=$product['id']?>"><?=$product['stock']?></td>
                <td class="text-end"><?="Rp. " . getFormatHarga($product['price'])?></td>
                <td class="text-center">
                  <button class="btn btn-secondary" id="btn-<?=$product['id']?>" state="inactive" onclick="toggleEdit(<?=$product['id']?>)">Edit</button>
                </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<?php require_once("../template/footing.php")?>
<script>
  function toggleEdit(id) {
    if ($("#btn-" + id).attr("state") == "inactive") {
      let stok = $("#td-stock-" + id).text();
      $("#td-stock-"+id).html("");
      $("#td-stock-"+id).append($('<input style="width:60px" type="number" id="inp-stock-' + id + '" value="' + stok + '">'));
      $("#btn-" + id).attr("state", "active");
      $("#btn-" + id).html("Save");
    }
    else {
      setNewStock(id);
      $("#td-stock-"+id).text($("#inp-stock-" + id).val());
      $("#btn-" + id).attr("state", "inactive");
      $("#btn-" + id).html("Edit");
    }
  }
  function setNewStock(id) {
    $.ajax({
      type: "post",
      url: "set_product_stock.php",
      data: {
        "id" : id,
        "stok" : $("#inp-stock-" + id).val()
      },
      success: function (response) {
        
      }
    });
  }
</script>