<?php require_once("./template/heading.php");

?>
<!-- code here -->
<form action="#" method= "post">
  
    <div class="header">
        <div class="logoToko">
            <div class="logo"></div>
        </div>
        <div class="NavBar">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link active" name="keHome" aria-current="page" href="index.php">Home</a>
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" name="keKatalog" href="katalog.php">Catalogue</a>
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw1</a>
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw2</a>
            </nav>
        </div>
    </div>

    <div id="carouselExampleCaptions" class="carousel  slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./asset/formal_but_lux_amogus.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
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
  </button>
</div>
</form>

<?php require_once("./template/footing.php")?>