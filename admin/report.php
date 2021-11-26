<?php require_once("heading.php")?>
<?php require_once("../connector/connection.php") ?>
<?php require_once "header.php" ?>
<?php 
  $listTransaction = [];
  try {
    $stmt = $conn -> prepare("SELECT h.*, u.first_name FROM htrans h, user u where h.id_user = u.id");
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

      <div class="row py-3">
        <div class="col-3"></div>
        <div class="col-6 d-flex align-items-center justify-content-center">
        <?php if(count($listTransaction) > 0) { ?>
          <nav class="d-flex justify-content-center">
            <ul class="pagination m-0">
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
              <th scope="col">Tanggal</th>
              <th scope="col">Total</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody id="tbody">
          <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
            <?php if ($i >= count($listTransaction)) break; ?>
            <?php $transaction = $listTransaction[$i] ?>
            <tr>
                <td><?=($i + 1)."."?></td>
                <td><?=$transaction['id_transaksi']?></td>
                <td><?=$transaction['first_name']?></td>
                <td><?=$transaction['tanggal']?></td>
                <td><?=$transaction['total']?></td>
                <td><?=$transaction['status']?></td>
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
        </div>
        <div class="col-3">
        </div>
      </div>
    </main>
  </div>
</div>
<?php require_once("../template/footing.php")?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {
    var data = new google.visualization.DataTable();
    data.addColumn('timeofday', 'Time of Day');
    data.addColumn('number', 'Motivation Level');

    data.addRows([
      [{v: [8, 0, 0], f: '8 am'}, 1],
      [{v: [9, 0, 0], f: '9 am'}, 2],
      [{v: [10, 0, 0], f:'10 am'}, 3],
      [{v: [11, 0, 0], f: '11 am'}, 4],
      [{v: [12, 0, 0], f: '12 pm'}, 5],
      [{v: [13, 0, 0], f: '1 pm'}, 6],
      [{v: [14, 0, 0], f: '2 pm'}, 7],
      [{v: [15, 0, 0], f: '3 pm'}, 8],
      [{v: [16, 0, 0], f: '4 pm'}, 9],
      [{v: [17, 0, 0], f: '5 pm'}, 10],
    ]);

    var options = {
      title: 'Motivation Level Throughout the Day',
      hAxis: {
        title: 'Time of Day',
        format: 'h:mm a',
        viewWindow: {
          min: [7, 30, 0],
          max: [17, 30, 0]
        }
      },
      vAxis: {
        title: 'Rating (scale of 1-10)'
      }
    };

    var chart = new google.visualization.ColumnChart(
      document.getElementById('chart_div'));

    chart.draw(data, options);
  }
</script>