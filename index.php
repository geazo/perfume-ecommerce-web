<?php 
  require_once("./template/heading.php"); 
  require_once("./connector/connection.php");
  $listProduct = [];
  $stmt = $conn->prepare("select * from product");
  $stmt->execute();
  $listProduct = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  $ayebruv = $conn->prepare("select * from product order by stock desc");
  $ayebruv->execute();
  $listByStock = $ayebruv->get_result()->fetch_all(MYSQLI_ASSOC);
  $podium1 = $listProduct[count($listProduct)-2];
  $podium2 = $listByStock[0];
  $podium3 = $listProduct[68];
  
?>

<?php include ("./template/header.php")?>

<div class="container py-4">

  <div class="row h-75vh d-flex justify-content-center w-100 m-3 p-2  ">
      <h2 class="text-center">Popular Items</h2>
      <div id="carouselExampleCaptions" class="carousel carousel-dark py-3 slide carousel-fade vh-75" data-bs-ride="carousel">
      <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner " style="max-height:356px;">
      
      <div class="carousel-item active">
      <a href="detailProduk.php?product=<?= $podium1['id'] ?>">
        <img src="<?= $podium1['image_source']?>" class="d-block h-100 m-3 w-25" alt="...">
      </a>
        <div class="carousel-caption text-dark d-none d-md-block">
          <h5>Try one of our Latest Items!</h5>
          <p><?=$podium1['name'] ?>, a new comer in this Shop!</p>
        </div>
      </div>

      <div class="carousel-item " style="max-height:356px;">
      <a href="detailProduk.php?product=<?= $podium2['id'] ?>">
        <img src="<?= $podium2['image_source']?>" class=" d-block h-100 m-3 w-25" alt="...">
      </a>
        <div class="carousel-caption text-dark d-none d-md-block">
          <h5>The Item Everyone Wants!</h5>
          <p>Famously on demand, <?=$podium2['name'] ?>!</p>
        </div>
      </div>

      <div class="carousel-item  " style="max-height:356px;">
      <a href="detailProduk.php?product=<?= $podium3['id'] ?>">
        <img src="<?= $podium3['image_source']?>" class="d-block h-100 m-3 w-25" alt="..." >
      </a>
        <div class="carousel-caption text-dark d-none d-md-block">
          <h5>Our Favourite!</h5>
          <p>For us, <?=$podium3['name'] ?> has always been our favourite!</p>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon button-dark" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon button-dark" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    </div>
  </div>
  
</div>
<div class="row bgAboutUs text-light p-0 py-3 m-0" >
  <div class="col-12 d-flex justify-content-center align-items-center" id='aboutus'>
    <h2 class="" >About Us</h2>
  </div>
  <div class="col-12 d-flex justify-content-center " >
    
    <div class=" col-5 text-align-end">
        <p class="fs-4">We are a shop that wishes to bless your <br>
          senses of smell with the Fragrance of the World. <br> 
          Be it for a Party, a Romantic Dinner, or on the daily! <br> <br>
          Browse our vast collection of Fragrances ranging in many brands
        </p>
    </div>
  </div>
  <div class=" d-flex justify-content-center"><button type="button " class="btn fs-5 bg-none text-light w-25 btn-outline-dark border-light" style="height:50px;">Browse</button></div>
</div>

<!-- <a href="index.php#idbarang"></a> auto scroll waktu linking -->
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