<?php require_once("heading.php")?>
<?php require_once("../connector/connection.php") ?>
<?php require_once "header.php" ?>
<?php 
  $listTransaction = [];
  try {
    $sql = "";
    if (isset($_REQUEST['btn-filter'])) {
      $sql = "SELECT h.*, CONCAT(u.first_name, ' ', u.last_name) as 'full_name' FROM htrans h, user u where h.id_user = u.id ";
      if ($_REQUEST['select-status'] != "") {
        $status = $_REQUEST['select-status'];
        $sql = $sql . "AND h.status = '$status' ";
      }
      if ($_REQUEST['inp-nama'] != "") {
        $nama = $_REQUEST['inp-nama'];
        $sql = $sql . "AND CONCAT(u.first_name, ' ', u.last_name) LIKE '%$nama%' ";
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
      $sql = "SELECT h.*, CONCAT(u.first_name, ' ', u.last_name) as 'full_name' FROM htrans h, user u where h.id_user = u.id";
    }
    $stmt = $conn -> prepare($sql);
    $stmt -> execute();
    $listTransaction = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
  }
  catch(Exception $e) {
    exit($e->getMessage());
  }

  $maxProductInAPage = 50;
  $maxPage = ceil(count($listTransaction) / $maxProductInAPage);

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
      <div id="chart_div"></div>
      <h2>List Transaction</h2>

      <div class="row">
        <div class="col-2">
          <h5 class="p-1 text-end">Filter: </h5> 
        </div>
        <div class="col-4">
          <form action="" method="GET">
            <select class="form-select mb-2" name="select-status">
              <option value="">Status</option>
              <option <?= ((isset($_REQUEST['select-status']) && ($_REQUEST['select-status'] == 'SUCCESS')) ? "selected" : "") ?> value="SUCCESS">Success</option>
              <option <?= ((isset($_REQUEST['select-status']) && ($_REQUEST['select-status'] == 'FAILED')) ? "selected" : "") ?> value="FAILED">Failed</option>
              <option <?= ((isset($_REQUEST['select-status']) && ($_REQUEST['select-status'] == 'PENDING')) ? "selected" : "") ?> value="PENDING">Pending</option>
            </select>
            <select class="form-select mb-2" name="select-order">
              <option value="">Order</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'total-asc')) ? "selected" : "") ?> value="total-asc">Total Asc</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'total-desc')) ? "selected" : "") ?> value="total-desc">Total Desc</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'tanggal-asc')) ? "selected" : "") ?> value="tanggal-asc">Tanggal Asc</option>
              <option <?= ((isset($_REQUEST['select-order']) && ($_REQUEST['select-order'] == 'tanggal-desc')) ? "selected" : "") ?> value="tanggal-desc">Tanggal Desc</option>
            </select>
            <input value="<?= isset($_REQUEST['inp-nama']) ? $_REQUEST['inp-nama'] : "" ?>" type="text" class="form-control mb-2" name="inp-nama" placeholder="Nama User">             
            <input value="<?= isset($_REQUEST['inp-tanggal']) ? $_REQUEST['inp-tanggal'] : "" ?>" type="date" class="form-control mb-2" name="inp-tanggal" placeholder="Tanggal">
            <button name="btn-filter" type="submit" class="btn btn-secondary btn-sm mb-2">Go</button>
          </form>
          <form action="" method="get">
            <button name="btn-reset" type="submit" class="btn btn-secondary btn-sm mb-2">Reset</button>
          </form>
        </div>
      </div>

      <div class="row py-3">
        <div class="col-3">
        </div>
        <div class="col-6 d-flex align-items-center justify-content-center">
        <?php if(count($listTransaction) > 0) { ?>
          <nav class="d-flex justify-content-center">
            <ul class="pagination m-0">
              <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.($currentPage - 1)?>">Previous</a></li>
              <?php if($currentPage - 2 > 1) {?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php' ?>">1</a></li>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
              <?php } ?>
              <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                <?php if ($i < 1 || $i > $maxPage) continue; ?>
                <?php if($i == $currentPage) { ?>
                  <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'report.php?page='.$i ?>"><?=$i?></a></li>
                <?php } else { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.$i ?>"><?=$i?></a></li>
                  <?php } ?>
              <?php } ?>
              <?php if($currentPage + 2 < $maxPage) {?>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.$maxPage?>"><?= $maxPage ?></a></li>
              <?php } ?>
              <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.($currentPage - 1)?>">Next</a></li>
            </ul>
          </nav>
        <?php } ?>
        </div>
        <div class="col-3 d-flex justify-content-end align-items-center">
          <?=(($currentPage - 1)* $maxProductInAPage) + 1?> - 
          <?= ($currentPage * $maxProductInAPage) + 1 > count($listTransaction) ? count($listTransaction) : ($currentPage * $maxProductInAPage) + 1?>
          out of <?=count($listTransaction)?> transaction(s)
        </div>
      </div>


      <div class="table-responsive">
        <table class="table table-striped table-sm align-middle">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">ID</th>
              <th scope="col">User</th>
              <th class="text-center" scope="col">Tanggal</th>
              <th class="text-end" scope="col">Total</th>
              <th class="text-center" scope="col">Status</th>
              <th class="text-center" scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="tbody">
          <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
            <?php if ($i >= count($listTransaction)) break; ?>
            <?php $transaction = $listTransaction[$i] ?>
            <tr>
              <td><?=($i + 1)."."?></td>
              <td><?=$transaction['id_transaksi']?></td>
              <td><?=$transaction['full_name']?></td>
              <td class="text-center"><?=$transaction['tanggal']?></td>
              <td class="text-end"><?="Rp. " . getFormatHarga($transaction['total'])?></td>
              <td class="text-center"><?=$transaction['status']?></td>
              <td class="text-center">
                <a href="detail_transaction.php?id=<?=$transaction['id_transaksi']?>">
                  <button type="button" class="btn btn-secondary">Detail</button>
                </a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="row py-3">
        <div class="col-3"></div>
        <div class="col-6 d-flex align-items-center justify-content-center">
        <?php if(count($listTransaction) > 0) { ?>
          <nav class="d-flex justify-content-center">
            <ul class="pagination m-0">
              <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.$currentPage - 1?>">Previous</a></li>
              <?php if($currentPage - 2 > 1) {?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php' ?>">1</a></li>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
              <?php } ?>
              <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                <?php if ($i < 1 || $i > $maxPage) continue; ?>
                <?php if($i == $currentPage) { ?>
                  <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'report.php?page='.$i ?>"><?=$i?></a></li>
                <?php } else { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.$i ?>"><?=$i?></a></li>
                  <?php } ?>
              <?php } ?>
              <?php if($currentPage + 2 < $maxPage) {?>
                <li class="page-item"><span class="page-link text-dark">...</span></li>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.$maxPage?>"><?= $maxPage ?></a></li>
              <?php } ?>
              <li class="page-item"><a class="page-link text-dark" href="<?= 'report.php?page='.$currentPage + 1?>">Next</a></li>
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
<?php require_once("../template/footing.php")?>
<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script>
  google.charts.load('current', {'packages': ['corechart'], 'language': 'id'});
  // google.charts.setOnLoadCallback(drawMarkersMap);
  // google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Penghasilan');

    data.addRows([
<?php 
  $arrBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
  $tahun = (int) date("Y");
  for ($i=0; $i < 12; $i++) { 
    $bulan = $i + 1;
    try {
      $stmt = $conn -> prepare("SELECT SUM(total) AS total FROM htrans WHERE MONTH(tanggal) = ? AND YEAR(tanggal) = ?");
      $stmt -> bind_param("ii", $bulan, $tahun);
      $stmt -> execute();
      $total = $stmt -> get_result() -> fetch_assoc();
      $total = $total['total'];
      $totalFormatted = getFormatHarga($total);
      if ($total == null || $total == "") $total = 0;
      // echo "\t\t[{v: '$arrBulan[$i]'}, $total]";
      echo "\t\t['$arrBulan[$i]', {v: $total, f:'Rp$totalFormatted'}]";
      if ($i != 11) echo ",";
      echo "\n";
    }
    catch(Exception $e) {
      exit($e->getMessage());
    }
  }  
?>
    ]);

    var options = {
      title: 'Penghasilan Tahun <?=date("Y")?>',
      hAxis: {
        title: 'Bulan',
        format: 'string',
        viewWindow: {
          // min: [7, 30, 0],
          // max: [17, 30, 0]
        }
      },
      vAxis: {
        title: 'Penghasilan',
        format: 'currency'
      },
      height: 650
    };

    var chart = new google.visualization.ColumnChart(
      document.getElementById('chart_div'));

    chart.draw(data, options);
  }
</script>