<?php require_once("heading.php")?>
<?php require_once("../connector/connection.php") ?>
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
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Aramyzda</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="../index.php">Sign out</a>
    </div>
  </div>
</header>

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
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Tipe</th>
              <th scope="col">Stok</th>
              <th class="d-flex justify-content-end" scope="col">Harga</th>
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
                <td><?=$product['stock']?></td>
                <td class="d-flex justify-content-end"><?="Rp. " . getFormatHarga($product['price'])?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<?php require_once("../template/footing.php")?>