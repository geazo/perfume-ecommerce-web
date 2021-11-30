<?php
  require_once("./template/heading.php");
  require_once("./connector/connection.php");
  $pilihanSort = array('Best Selling', 'Alhpabetical,A-Z', 'Alphabetical,Z-A', 'Price, Hight to Low', 'Price, Low to High', 'Oldest to Newest', 'Newest to Oldest');
  $printedTex = isset($_REQUEST['']);

  $listProduct = [];

  if (isset($_REQUEST['search']) || isset($_REQUEST['brand'])) {
    isset($_REQUEST['search']) ? $search = $_REQUEST['search'] : $search = $_REQUEST['brand'];
    $search = "%" . $search . "%";
    $stmt = $conn->prepare("select * from product where name like ?");
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $listProduct = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  } else {
    $stmt = $conn->prepare("select * from product");
    $stmt->execute();
    $listProduct = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  $maxProductInAPage = 15;
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

<div class="toast-container">

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="<?= $product['image_source'] ?>" class="rounded me-2" style="width:40px;" alt="...">
        <strong class="me-auto"> <?= $product['name'] ?> </strong>
        <strong> </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Added to cart!
      </div>
    </div>
  </div>


</div>

<?php include("./template/header.php") ?>

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
    <div class="displayTeksSort col-md-9 col-sm-12">
      <span name="displayTeks" class="displayedTeks"><?= isset($_REQUEST['brand']) ? strtoupper($_REQUEST['brand']) : "CATALOGUE" ?> </span>
    </div>
    <div class="searchbox  col-md-3 col-sm-12">
      <form action="" method="get">
        <div class="row">
          <div class="col-8">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" value="<?= isset($_REQUEST['tbx-search']) ? $_REQUEST['tbx-search'] : '' ?>">
          </div>
          <div class="col-4">
            <button class="btn btn-outline-success" type="submit">Search</button>
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

    <div class="navKanan col-md-9 col-sm-12 ">

      <div class="row py-3">
        <div class="col-8 d-flex align-items-center justify-content-center">
          <?php if (count($listProduct) > 0) { ?>
            <nav class="d-flex justify-content-center">
              <ul class="pagination m-0">
                <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . ($currentPage - 1) ?>">Previous</a></li>
                <?php if ($currentPage - 2 > 1) { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php' ?>">1</a></li>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                <?php } ?>
                <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                  <?php if ($i < 1 || $i > $maxPage) continue; ?>
                  <?php if ($i == $currentPage) { ?>
                    <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'katalog.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } else { ?>
                    <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } ?>
                <?php } ?>
                <?php if ($currentPage + 2 < $maxPage) { ?>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . $maxPage ?>"><?= $maxPage ?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . ($currentPage + 1) ?>">Next</a></li>
              </ul>
            </nav>
          <?php } ?>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <?= (($currentPage - 1) * $maxProductInAPage) + 1 ?> -
          <?= (($currentPage * $maxProductInAPage) + 1) > count($listProduct) ? count($listProduct) : ($currentPage * $maxProductInAPage) ?>
          out of <?= count($listProduct) ?> product(s)
        </div>
      </div>

      <div class="katalog justify-content-around row" id="katalog">
        <?php if (count($listProduct) != 0) { ?>
          <?php for ($i = ($currentPage - 1) * $maxProductInAPage; $i < $currentPage * $maxProductInAPage; $i++) { ?>
            <?php if ($i >= count($listProduct)) break; ?>
            <div class="card text-decoration-none color-inherit" id="productNum_<?= $listProduct[$i]['id'] ?>" href="detailProduk.php?product=<?= $listProduct[$i]['id'] ?>">
              <!-- <div class="card" style="width: 18rem;"> -->
              <a href="detailProduk.php?product=<?= $listProduct[$i]['id'] ?>">
                <img src="<?= $listProduct[$i]['image_source'] ?>" class="card-img-top" alt="...">
              </a>
              <div class="row d-flex justify-content-center card-body">
                <a href="detailProduk.php?product=<?= $listProduct[$i]['id'] ?>"></a>
                <h6 class="row p-0 card-title"> <?= $listProduct[$i]['name'] ?> </h6>
                <p class="row p-0 card-text"> <?= $listProduct[$i]['type'] ?> </p>
                <div class="row p-0  mb-2">

                  <div class="col-md-7 col-sm-12  p-0 ">
                    <p class="card-text">Rp <?= $listProduct[$i]['price'] != '' ? number_format($listProduct[$i]['price'], 0, ',', '.') : '0' ?> </p>
                  </div>

                  <div class="input-group p-0 col ">
                    <button class="btn btn-outline-secondary" id="btnDownQty<?= $listProduct[$i]['id'] ?>" type="button" onclick="gantiAngkaDown(<?= $listProduct[$i]['id'] ?>)">-</button>
                    <input type="text" class="form-control text-center" id="inputNumberLangsung<?= $listProduct[$i]['id'] ?>" aria-label="" value="1">
                    <button class="btn btn-outline-secondary" id="btnUpQty<?= $listProduct[$i]['id'] ?>" type="button" onclick="gantiAngkaUp(<?= $listProduct[$i]['id'] ?>)">+</button>
                  </div>

                </div>
                <div class="row p-0 align-self-center addToCart">
                  <button type="button" class="btn btn-danger" onclick="AddToCartFullSet(<?= $listProduct[$i]['id'] ?>)">Add to Cart</button>
                </div>
              </div>
              <!-- </div> -->
            </div>
          <?php } ?>
        <?php } else { ?>
          <h1>Item yang anda cari tidak ada!</h1>
        <?php } ?>
      </div>
      <!-- pagination -->
      <div class="row py-3">
        <div class="col-12 d-flex align-items-center justify-content-center">
          <?php if (count($listProduct) > 0) { ?>
            <nav class="d-flex justify-content-center">
              <ul class="pagination m-0">
                <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . ($currentPage - 1) ?>">Previous</a></li>
                <?php if ($currentPage - 2 > 1) { ?>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php' ?>">1</a></li>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                <?php } ?>
                <?php for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) { ?>
                  <?php if ($i < 1 || $i > $maxPage) continue; ?>
                  <?php if ($i == $currentPage) { ?>
                    <li class="page-item"><a class="page-link text-dark bg-secondary bg-opacity-25" href="<?= 'katalog.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } else { ?>
                    <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . $i ?>"><?= $i ?></a></li>
                  <?php } ?>
                <?php } ?>
                <?php if ($currentPage + 2 < $maxPage) { ?>
                  <li class="page-item"><span class="page-link text-dark">...</span></li>
                  <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . $maxPage ?>"><?= $maxPage ?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link text-dark" href="<?= 'katalog.php?page=' . ($currentPage + 1) ?>">Next</a></li>
              </ul>
            </nav>
          <?php } ?>
        </div>
      </div>
    </div>
    <!--penutup katalog -->
  </div>
  <!--penutup konten -->
</div>
<!--penutup kontainer utama -->
<!-- </form> -->
<?php require_once("./template/footer.php") ?>
<?php require_once("./template/footing.php") ?>
<script>
  load_brand_name();

  function load_brand_name() {
    // $("#list-brand-name").html("bisa ini");
    $.ajax({
      type: "post",
      url: "ajax/katalog_load_brand_name.php",
      success: function(response) {
        $("#list-brand-name").html("");
        $("#list-brand-name").append(response);
      }
    });
  }

  function AddToCart(id_product) {
    quantity = parseInt($("#inputNumberLangsung" + id_product).val()) || 1;
    $.ajax({
      type: "post",
      url: "ajax/add_to_cart.php",
      data: {
        "id-product": id_product,
        "quantity": quantity
      },
      success: function(response) {
        alert(response);
      }
    });
  }

  function gantiAngkaDown(id_product) {
    if (parseInt(document.getElementById('inputNumberLangsung' + id_product).value) > 1) {
      document.getElementById('inputNumberLangsung' + id_product).value = parseInt(document.getElementById('inputNumberLangsung' + id_product).value) - 1;
    }
  }

  function gantiAngkaUp(id_product) {
    document.getElementById('inputNumberLangsung' + id_product).value = parseInt(document.getElementById('inputNumberLangsung' + id_product).value) + 1;
  }

  function liveToaster(id_product) {
    document.querySelector('#liveToast .toast-header img').src = document.querySelector('#productNum_' + id_product + " .card-img-top").src;
    var temp = document.querySelector('#productNum_' + id_product + " .card-title").innerHTML;
    document.querySelector('#liveToast .toast-header .me-auto').innerHTML = temp;
    console.log(temp);
    var toast = new bootstrap.Toast(document.querySelector('#liveToast'));
    toast.show()
  }

  function AddToCartFullSet(id_product) {
    <?php
    if (isset($_SESSION['user-login'])) {
    ?>
      AddToCart(id_product);
      liveToaster(id_product);
      loadSideCart();
    <?php
    } else {
    ?>
      $.confirm({
        title: 'Please Login First!',
        content: '',
        buttons: {
          cancel: {
            text: 'Cancel',
            btnClass: 'btn-light',
            action: function() {

            }
          },

          gotoLogin: {
            text: 'Login',
            btnClass: 'btn-blue',
            keys: ['enter', 'shift'],
            action: function() {
              window.location.href = "login.php";
            }
          }
        }
      });
    <?php
    }
    ?>

  }
</script>