<?php include("./template/heading.php") ?>
<?php include("./template/header.php") ?>
<?php
$listTransaction = [];
$iduser = $_SESSION['user-login']['id'];
try {
  $sql = "";
  if (isset($_REQUEST['btn-filter'])) {
    $sql = "SELECT * FROM htrans WHERE id_user = $iduser ";
    if ($_REQUEST['select-status'] != "") {
      $status = $_REQUEST['select-status'];
      $sql = $sql . "AND status = '$status' ";
    }
    if ($_REQUEST['inp-id'] != "") {
      $idtemp = $_REQUEST['inp-id'];
      $sql = $sql . "AND id_transaksi = '$idtemp' ";
    }
    if ($_REQUEST['inp-tanggal']) {
      $tanggal = $_REQUEST['inp-tanggal'];
      $sql = $sql . "AND tanggal = '$tanggal' ";
    }
    if ($_REQUEST['select-order'] != "") {
      $arrParam = explode("-", $_REQUEST['select-order']);
      $sql = $sql . "ORDER BY ". $arrParam[0] . " " . $arrParam[1] . " ";
    }
  }
  else {
    $sql = "SELECT * FROM htrans WHERE id_user = $iduser";
  }
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $listTransaction = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
  exit($e->getMessage());
}

$maxProductInAPage = 20;
$maxPage = ceil(count($listTransaction) / $maxProductInAPage);

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
<!-- code here -->
<div class="cb py-3"></div>
<div class="container border border-black p-4">
  <div class="row">
    <div class="col-12 align-items-center">
      <div class="mintacenter">
        <h3 class="align-self-center">Customer Information</h3>
      </div>
      <div class="col-12">
        <div class="row my-2">
          <div class="col-3">First Name </div>
          <div class="col-1"> : </div>
          <div class="col"><?= $_SESSION['user-login']['first_name'] ?> </div>
        </div>
        <div class="row my-2">
          <div class="col-3">Last Name </div>
          <div class="col-1"> : </div>
          <div class="col"> <?= $_SESSION['user-login']['last_name'] ?> </div>
        </div>
        <div class="row my-2">
          <div class="col-3">Email Address </div>
          <div class="col-1"> : </div>
          <div class="col"> <?= $_SESSION['user-login']['email'] ?> </div>
        </div>
        <div class="row my-2">
          <div class="col-3">Phone Number </div>
          <div class="col-1"> : </div>
          <div class="col"> <?= $_SESSION['user-login']['phone'] ?> </div>
        </div>
        <div class="row my-2">
          <div class="col-3">Address </div>
          <div class="col-1"> : </div>
          <div class="col"> <?= $_SESSION['user-login']['address'] ?> </div>
        </div>
        <div class="row my-2">
          <div class="col-3">Birthday </div>
          <div class="col-1"> : </div>
          <div class="col"> <?= date($_SESSION['user-login']['birthdate']) ?> </div>
        </div>
      </div>
    </div>

    <h2>List Transaction</h2>

    <div class="row">
        <div class="col-md-2 col-sm-3">
          <h5 class="p-1 text-end">Filter: </h5> 
        </div>
        <div class="col-md-4 col-sm-8">
          <form action="" method="GET">
            <select class="form-select mb-2" name="select-status">
              <option value="">Status</option>
              <option <?= ((isset($_REQUEST['select-status']) && ($_REQUEST['select-status'] == 'SUCCESS')) ? "selected" : "") ?> value="SUCCESS">Success</option>
              <option <?= ((isset($_REQUEST['select-status']) && ($_REQUEST['select-status'] == 'FAILED')) ? "selected" : "") ?> value="FAILED">Failed</option>
              <option <?= ((isset($_REQUEST['select-status']) && ($_REQUEST['select-status'] == 'PENDING')) ? "selected" : "") ?> value="PENDING">Pending</option>
            </select>
            <select class="form-select mb-2" name="select-order">
              <option value="">Order</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'total-asc')) ? "selected" : "") ?> value="total-asc">Total Tertinggi</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'total-desc')) ? "selected" : "") ?> value="total-desc">Total Terendah</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'tanggal-desc')) ? "selected" : "") ?> value="tanggal-desc">Newest</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'tanggal-asc')) ? "selected" : "") ?> value="tanggal-asc">Oldest</option>
            </select>
            <input value="<?= isset($_REQUEST['inp-id']) ? $_REQUEST['inp-id'] : "" ?>" type="text" class="form-control mb-2" name="inp-id" placeholder="ID Transaksi">             
            <input value="<?= isset($_REQUEST['inp-tanggal']) ? $_REQUEST['inp-tanggal'] : "" ?>" type="date" class="form-control mb-2" name="inp-tanggal" placeholder="Tanggal">
            <div class="d-flex">
              <button name="btn-filter" type="submit" class="col-2 btn btn-secondary btn-sm  mb-2">Go</button>
            </form>
            <form action="" method="get">
              <button name="btn-reset" type="submit" class="mx-2 col-12 btn btn-secondary btn-sm mb-2">Reset</button>
            </form>
            </div>
        </div>
      </div>

    <div class="row py-3">
      <div class="col-md-8 col-sm-12 d-flex align-items-center justify-content-center">
        <?php if (count($listTransaction) > 0) { ?>
          <nav class="d-flex justify-content-center">
            <ul class="pagination m-0">
              <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . ($currentPage - 1) ?>">Previous</a></li>
              <?php if ($currentPage - 2 > 1) { ?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php' ?>">1</a></li>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
              <?php } ?>
              <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                <?php if ($i < 1 || $i > $maxPage) continue; ?>
                <?php if ($i == $currentPage) { ?>
                  <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'profile.php?page=' . $i ?>"><?= $i ?></a></li>
                <?php } else { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . $i ?>"><?= $i ?></a></li>
                <?php } ?>
              <?php } ?>
              <?php if ($currentPage + 2 < $maxPage) { ?>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . $maxPage ?>"><?= $maxPage ?></a></li>
              <?php } ?>
              <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . ($currentPage + 1) ?>">Next</a></li>
            </ul>
          </nav>
        <?php } ?>
      </div>
      <div class="col-md-4 d-none d-md-flex justify-content-end align-items-center">
        <?= (($currentPage - 1) * $maxProductInAPage) + 1 ?> -
        <?= ($currentPage * $maxProductInAPage) + 1 > count($listTransaction) ? count($listTransaction) : ($currentPage * $maxProductInAPage) ?>
        out of <?= count($listTransaction) ?> transaction(s)
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-sm align-middle">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th class="text-center" scope="col">Tanggal</th>
            <th class="text-end" scope="col">Total</th>
            <th class="text-center" scope="col">Status</th>
            <th class="text-center" scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
            <?php if ($i >= count($listTransaction)) break; ?>
            <?php 
              $transaction = $listTransaction[$i];
              if ($transaction['status'] == "SUCCESS") $classColor = "bg-success";
              else if ($transaction['status'] == "FAILED") $classColor = "bg-danger";
              else if ($transaction['status'] == "PENDING") $classColor = "bg-warning";
            ?>
            <tr>
              <td><?= ($i + 1) . "." ?></td>
              <td><?= $transaction['id_transaksi'] ?></td>
              <td class="text-center"><?= $transaction['tanggal'] ?></td>
              <td class="text-end"><?= "Rp. " . getFormatHarga($transaction['total']) ?></td>
              <td class="text-center <?=$classColor?>"><b><?= $transaction['status'] ?></b></td>
              <td class="text-center">
                <a href="profile_detail_transaction.php?id=<?= $transaction['id_transaksi'] ?>">
                  <button type="button" class="btn btn-secondary">Detail</button>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="row py-3">
      <div class="col-6 d-flex align-items-center justify-content-center">
        <?php if (count($listTransaction) > 0) { ?>
          <nav class="d-flex justify-content-center">
            <ul class="pagination m-0">
              <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . ($currentPage - 1) ?>">Previous</a></li>
              <?php if ($currentPage - 2 > 1) { ?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php' ?>">1</a></li>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
              <?php } ?>
              <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                <?php if ($i < 1 || $i > $maxPage) continue; ?>
                <?php if ($i == $currentPage) { ?>
                  <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'profile.php?page=' . $i ?>"><?= $i ?></a></li>
                <?php } else { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . $i ?>"><?= $i ?></a></li>
                <?php } ?>
              <?php } ?>
              <?php if ($currentPage + 2 < $maxPage) { ?>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . $maxPage ?>"><?= $maxPage ?></a></li>
              <?php } ?>
              <li class="page-item"><a class="page-link text-dark" href="<?= 'profile.php?page=' . ($currentPage + 1) ?>">Next</a></li>
            </ul>
          </nav>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="cb py-3"></div>
<?php require_once("./template/footer.php") ?>
<?php include("./template/footing.php") ?>