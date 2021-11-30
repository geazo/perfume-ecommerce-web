<?php 
  require_once("./template/heading.php"); 
  require_once("./connector/connection.php");
  $listProduct = [];
  $stmt = $conn->prepare("select * from product");
  $stmt->execute();
  $listProduct = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<?php include ("./template/header.php")?>

    <div id="carouselExampleCaptions" class="carousel py-2 slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./asset/formal_but_lux_amogus.png" class="d-block w-100" alt="...">
      <!-- <img style="width: 100%; height: 600px;" src="./asset/banner1.jpg" alt=""> -->
      <div class="carousel-caption text-dark d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./asset/formal_but_lux_amogus.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./asset/formal_but_lux_amogus.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>

    <!-- <a href="index.php#idbarang"></a> auto scroll waktu linking -->

  </button>
</div>
<!-- </form> -->

<div class="container my-3" style="background-color: none;">
  <h1 class="text-center my-5">Featured Product</h1>
  <div class="row">
    <?php 
      $stmt = $conn -> prepare("SELECT * FROM product LIMIT 4");
      $stmt -> execute();
      $listProduct = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    ?>
    <?php foreach ($listProduct as $key => $product) { ?>
      <div class="col-3">
        <div class="card text-decoration-none color-inherit" id="productNum_<?= $product['id'] ?>" href="detailProduk.php?product=<?= $product['id'] ?>">
          <a href="detailProduk.php?product=<?= $product['id'] ?>">
            <img style="max-height: 304px;" src="<?= $product['image_source'] ?>" class="card-img-top" alt="...">
          </a>
          <div class="row d-flex justify-content-center card-body">
            <a href="detailProduk.php?product=<?= $product['id'] ?>"></a>
            <h6 class="row p-0 card-title"> <?= $product['name'] ?> </h6>
            <p class="row p-0 card-text"> <?= $product['type'] ?> </p>
            <div class="row p-0  mb-2">
              <div class="col-md-7 col-sm-12  p-0 ">
                <p class="card-text">Rp <?= $product['price'] != '' ? number_format($product['price'], 0, ',', '.') : '0' ?> </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>