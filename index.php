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
  $podium1 = $listProduct[0];
  $podium2 = $listByStock[0];
  $podium3 = $listProduct[68];
  
?>
<!-- code here -->
<!-- <form action="#" method= "post"> -->

<?php include ("./template/header.php")?>
<div class="row bgAboutUs text-light p-0 py-3 m-0" >
  <div class="col-12 d-flex justify-content-center align-items-center" id='aboutus'>
    <h2 class="" >About Us</h2>
  </div>
  <div class="col-12 d-flex justify-content-center " >
    
    <div class="col-5 text-align-end">
        <p class="fs-4">We are a shop that wishes to bless your <br>
          senses of smell with the Fragrance of the World. <br> 
          Be it for a Party, a Romantic Dinner, or on the daily! <br>
          Browse our vast collection of Fragrances 
        </p>
    </div>
    
  </div>
</div>
<div class="container ">

  <div class="row h-75vh d-flex justify-content-center w-100 m-3 p-2  ">
      <h3 class="text-center">Featured Items</h3>
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
          <h5>Try our Very First Item in the Shop!</h5>
          <p><?=$podium1['name'] ?>, one of the Originals of this Shop!</p>
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


<!-- <a href="index.php#idbarang"></a> auto scroll waktu linking -->
<!-- </form> -->

<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>