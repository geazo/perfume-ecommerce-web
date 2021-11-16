<?php 
  require_once("./template/heading.php");
  require_once("./connector/connection.php");
  $pilihanSort = array('Best Selling', 'Alhpabetical,A-Z', 'Alphabetical,Z-A', 'Price, Hight to Low', 'Price, Low to High', 'Oldest to Newest', 'Newest to Oldest');
  $printedTex = isset($_REQUEST['']);
  // $listProductDB = file_get_contents(
  //   "result.json"
  // );
  // $listProductDB = json_decode($listProductDB, true);

  $listProduct = [];

  if (isset($_REQUEST['btn-submit-search'])) {
    header("Location: katalog.php?search=" . $_REQUEST['tbx-search']);
  }

  if (isset($_REQUEST['search']) || isset($_REQUEST['brand'])) {
    isset($_REQUEST['search']) ? $search = $_REQUEST['search'] : $search = $_REQUEST['brand'];
    // foreach ($listProductDB as $key => $value) {
    //   if (str_contains(strtoupper($value['name']), strtoupper($search))) {
    //   $listProduct[] = $value;
    //   }
    // }
    $search = "%".$search."%";
    $stmt = $conn -> prepare("select * from product where name like ?");
    $stmt -> bind_param("s", $search);
    $stmt -> execute();
    $listProduct = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
  }
  else {
    $stmt = $conn -> prepare("select * from product");
    $stmt -> execute();
    $listProduct = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
  }

  $maxProductInAPage = 21;
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

  // echo '<pre>';
  // print_r($currentPage); echo "<br>";
  // print_r($listProduct);
  // print_r($listProduct[0]);
  // echo '</pre>';
?>
<!-- code here -->
<!-- <form action="" method="post"> -->
  
<?php include ("./template/header.php")?>

  <div class="kontainerUtama">
    <div class="sortBy row">
      <div class="selectSort col-3 d-none">
        <select class="form-select" aria-label="Default select example">
          <option selected>Featured Items</option>
          <?php for ($i = 0; $i < 7; $i++) {
          ?>
            <option value="sort<?= $i ?>"><?= $pilihanSort[$i] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="displayTeksSort col-9">
        <span name="displayTeks" class="displayedTeks"><?= isset($_REQUEST['brand']) ? strtoupper($_REQUEST['brand']) :"CATALOGUE" ?> </span>
      </div>
      <div class="searchbox d-flex justify-content-end col-3">
          <form action="" method="POST">
            <div class="row">
              <div class="col-8">
                <input class="form-control me-2" name="tbx-search" type="search" placeholder="Search" aria-label="Search" value="<?= isset($_REQUEST['tbx-search']) ? $_REQUEST['tbx-search'] : '' ?>">
              </div>
              <div class="col-4">
                  <button class="btn btn-outline-success" type="submit" name="btn-submit-search">Search</button>
              </div>
            </div>
          </form>
      </div>
    </div>


    <div class="konten row">
      <div class="navKiri col-3">
        <ul class="nav flex-sm-column nav-pills" id="list-brand-name">
        </ul>
      </div>

      <div class="navKanan col-9 ">
        <div class="katalog justify-content-between row" id="katalog">
          <?php if(count($listProduct) != 0) { ?>
            <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
              <?php if ($i >= count($listProduct)) break; ?>
              <a class="card text-decoration-none color-inherit" style="width: 18rem;" href="detailProduk.php?product=<?= $i?>">
                <!-- <div class="card" style="width: 18rem;"> -->
                  <img src="<?= $listProduct[$i]['image_source'] ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h6 class="card-title"> <?= $listProduct[$i]['name'] ?> </h6>
                    <p class="card-text">Rp <?= $listProduct[$i]['price'] != '' ? number_format($listProduct[$i]['price'], 0, ',', '.') : '0' ?> </p>
                    <p class="card-text"> <?= $listProduct[$i]['type'] ?> </p>
                  </div>
                <!-- </div> -->
              </a>
            <?php } ?>
              <?php } else {?>
                <h1>Item yang anda cari tidak ada!</h1>
          <?php } ?>
        </div>
        <!-- pagination -->
          <?php if(count($listProduct) != 0) { ?>
            <nav class="d-flex justify-content-center">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="<?= 'katalog.php?page='.$currentPage - 1?>">Previous</a></li>
                <?php if($currentPage - 2 > 1) {?>
                  <li class="page-item"><a class="page-link" href="<?= 'katalog.php' ?>">1</a></li>
                  <li class="page-item"><span class="page-link">...</span></li>
                <?php } ?>
                <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                  <?php if ($i < 1 || $i > $maxPage) continue; ?>
                  <li class="page-item"><a class="page-link" href="<?= 'katalog.php?page='.$i ?>"><?=$i?></a></li>
                <?php } ?>
                <?php if($currentPage + 2 < $maxPage) {?>
                  <li class="page-item"><span class="page-link">...</span></li>
                  <li class="page-item"><a class="page-link" href="<?= 'katalog.php?page='.$maxPage?>"><?= $maxPage ?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link" href="<?= 'katalog.php?page='.$currentPage + 1?>">Next</a></li>
              </ul>
            </nav>
          <?php } ?>
      </div>
      <!--penutup katalog -->
    </div>
    <!--penutup konten -->
  </div>
  <!--penutup kontainer utama -->
<!-- </form> -->
<?php require_once("./template/footing.php") ?>
<script>
  load_brand_name();
  function load_brand_name() {
    $("#list-brand-name").html("bisa ini");
    $.ajax({
      type: "post",
      url: "ajax/katalog_load_brand_name.php",
      success: function (response) {
        $("#list-brand-name").html("");
        $("#list-brand-name").append(response);
      }
    });
  }

  // load_isi_katalog();
  
</script>