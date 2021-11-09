<?php require_once("./template/heading.php");
$pilihanSort = array('Featured', 'Best Selling', 'Alhpabetical,A-Z', 'Alphabetical,Z-A', 'Price, Hight to Low', 'Price, Low to High', 'Oldest to Newest', 'Newest to Oldest');
$printedTex = isset($_REQUEST['']);
$listProduct = file_get_contents(
  "result.json"
);
$listProduct = json_decode($listProduct, true);
$listBrand = [];
foreach ($listProduct as $key => $value) {
  $kembar = false;
  foreach ($listBrand as $i => $brandName) {
    if ($value['brand'] == $brandName) {
      $kembar = true;
    }
  }
  if (!$kembar) {
    $listBrand[] = $value['brand'];
  }
}
sort($listBrand);

$maxProductInAPage = 21;
$maxPage = ceil(count($listProduct) / $maxProductInAPage);

$currentPage = 1;
if (isset($_REQUEST['page'])) {
  $currentPage = $_REQUEST['page'];
  if ($currentPage <= 0)  {
    $currentPage = 0;
  }
  else if ( $currentPage >= $maxPage) {
    $currentPage = $maxPage;
  }
}
echo '<pre>';
print_r($currentPage); echo "<br>";
print_r($listProduct[20]);
echo '</pre>';
?>
<!-- code here -->
<form action="#" method="post">
  <div class="header">
    <div class="logoToko">
      <div class="logo"></div>
    </div>
    <div class="NavBar">
      <nav class="nav nav-pills  flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link" name="keHome" aria-current="page" href="index.php" type="submit">Home</a>
        <a class="flex-sm-fill text-sm-center nav-link active" name="keKatalog" href="katalog.php">Catalogue</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="#">otw1</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="#">otw2</a>
      </nav>
    </div>
  </div>
  <div class="kontainerUtama">
    <div class="sortBy">
      <div class="selectSort">
        <select class="form-select" aria-label="Default select example">
          <option selected>Featured Items</option>
          <?php for ($i = 0; $i < 6; $i++) {
          ?>
            <option value="sort<?= $i ?>">sort<?= $i ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="displayTeksSort">
        <span name="displayTeks" class="displayedTeks">Gucci Gang</span>
      </div>
    </div>


    <div class="konten row">
      <div class="navKiri col-3">
        <ul class="nav flex-sm-column nav-pills">
          <?php foreach ($listBrand as $idxB => $brandName) { ?>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="#"> <?= $brandName ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>

      <div class="navKanan col-9 ">
        <div class="katalog justify-content-between row ">
          <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
            <div class="card" style="width: 18rem;">
              <img src="<?= $listProduct[$i]['image'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h6 class="card-title"> <?= $listProduct[$i]['name'] ?> </h6>
                <p class="card-text">Rp <?= $listProduct[$i]['price'] != '' ? number_format($listProduct[$i]['price'], 0, ',', '.') : '0' ?> </p>
              </div>
            </div>
          <?php } ?>
        </div>
        <!-- pagination -->
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
      </div>
      <!--penutup katalog -->
    </div>
    <!--penutup konten -->
  </div>
  <!--penutup kontainer utama -->
</form>
<?php require_once("./template/footing.php") ?>