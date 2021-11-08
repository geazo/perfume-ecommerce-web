<?php require_once("./template/heading.php");
  $pilihanSort = array('Featured', 'Best Selling', 'Alhpabetical,A-Z', 'Alphabetical,Z-A', 'Price, Hight to Low', 'Price, Low to High', 'Oldest to Newest', 'Newest to Oldest');
  $printedTex = isset($_REQUEST['']);
  $listProduct = file_get_contents(
    "results.json"
  );
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


    <div class="konten">
      <div class="navKiri">
        <ul class="nav flex-sm-column nav-pills">
          <?php for ($i = 0; $i < 20; $i++) {
          ?>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="#">brand <?= $i + 1 ?></a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>

      <div class="katalog">
        <?php for ($i = 0; $i < 9; $i++) {
        ?>
          <div class="card" style="width: 18rem;">
            <img src="./asset/test.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h6 class="card-title">parfum mahal No.<?= $i + 1 ?> gaes</h6>
              <p class="card-text">Rp, 69.420.420
                <br> buatan anak lokal terpercaya!
              </p>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <!--penutup katalog -->
    </div>
    <!--penutup konten -->
  </div>
  <!--penutup kontainer utama -->
</form>
<?php require_once("./template/footing.php") ?>