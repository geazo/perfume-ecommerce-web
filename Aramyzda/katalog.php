<?php require_once("./template/heading.php");
$pilihanSort = array('Best Selling', 'Alhpabetical,A-Z', 'Alphabetical,Z-A', 'Price, Hight to Low', 'Price, Low to High', 'Oldest to Newest', 'Newest to Oldest');
$printedTex = isset($_REQUEST['']);
$listProductDB = file_get_contents(
  "result.json"
);
$listProductDB = json_decode($listProductDB, true);

$listProduct = [];

if (isset($_REQUEST['btn-submit-search'])) {
  header("Location: katalog.php?search=" . $_REQUEST['tbx-search']);
}

if (isset($_REQUEST['search']) || isset($_REQUEST['brand'])) {
  isset($_REQUEST['search']) ? $search = $_REQUEST['search'] : $search = $_REQUEST['brand'];
  foreach ($listProductDB as $key => $value) {
    if (str_contains(strtoupper($value['name']), strtoupper($search))) {
    $listProduct[] = $value;
    }
  }
}
else {
  $listProduct = $listProductDB;
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

<!-- <div class="mainHead col-12">
        <div class="headBg col-12 "></div>
        <div class="header col-12 ">
            <div class="logoToko">
                <div class="logo"></div>
            </div>
            <div class="NavBar bg-black">
                <nav class="nav nav-pills flex-row  justify-content-center">
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link " name="keHome" aria-current="page" href="index.php">Home</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link active" name="keKatalog" href="katalog.php">Catalogue</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw1</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw2</a>
                </nav>
            </div>
        </div>
    </div> -->
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <div class="row d-flex justify-content-center text-light fs-4 ">Your Cart</div>

</div>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>

    <div class="mainHead">
    <div class="headBg col-12 "></div>
    <div class="col-12" id ="header">
    <div class="d-flex  text-white p-3">
      <div class="w-25 text-dark">
        kiri
      </div>
      <div class="w-50 fs-1 text-center">
        <!-- Aramyzda logo-->
        Aramyzda
      </div>
      <!-- <div class="w-25">
        <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
          <li class="px-2"><i class="fa fa-search" aria-hidden="true"></i> Search</li>
          <li class="px-2"><i class="fa fa-user" aria-hidden="true"></i> Account</li>
          <li class="px-2 pe-4"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
        </ul>
      </div> -->
      <div class="w-25  iconMode">
      <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
          <li class="px-2"><i class="fa fa-search" aria-hidden="true"></i> Search</li>
          <li class="px-2"><i class="fa fa-user" aria-hidden="true"></i> Account</li>
          <li class="px-2 pe-4" onclick="openNav()"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
        </ul>
      </div>

    <div class="w-25  justify-content-end burgerMode">
        <div class="collapse" id="navbarToggleExternalContent">
        <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
          <li class="px-2"><i class="fa fa-search" aria-hidden="true"></i> Search</li>
          <li class="px-2"><i class="fa fa-user" aria-hidden="true"></i> Account</li>
          <button type="button" class="btn" onclick="openNav()">
              <li class="px-2 pe-4" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
          </button>
        </ul>
        </div>
        <nav class="navbar navbar-dark ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
                </button>
            </div>
        </nav>
    </div>
    </div>
    <ul class="d-flex bg-black p-1 justify-content-center align-items-center list-style-none">
      <a class="text-light nav-link active" href="index.php"><li>HOME</li></a>
      <a class="text-light nav-link active" href="katalog.php"><li>CATALOGUE</li></a>
      <a class="text-light nav-link active" href="#"><li>CART</li></a>
      <a class="text-light nav-link active" href="#"><li>TRANSACTION</li></a>
    </ul>
  </div>
</div>

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
          <div class="row">
            <div class="col-8">
              <input class="form-control me-2" name="tbx-search" type="search" placeholder="Search" aria-label="Search" value="<?= isset($_REQUEST['tbx-search']) ? $_REQUEST['tbx-search'] : '' ?>">
            </div>
            <div class="col-4">
              <form action="" method="POST">
                <button class="btn btn-outline-success" type="submit" name="btn-submit-search">Search</button>
              </form>
            </div>
          </div>
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
                  <img src="<?= $listProduct[$i]['image'] ?>" class="card-img-top" alt="...">
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
</script>