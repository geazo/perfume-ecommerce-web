<?php require_once("./template/heading.php"); ?>
<!-- code here -->
<!-- <form action="#" method= "post"> -->
  
<!-- <div class="mainHead col-12">
        <div class="headBg col-12 "></div>
        <div class="header col-12 ">
            <div class="logoToko">
                <div class="logo"></div>
            </div>
            <div class="NavBar">
                <nav class="nav nav-pills flex-row  justify-content-center">
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link active" name="keHome" aria-current="page" href="index.php">Home</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link " name="keKatalog" href="katalog.php">Catalogue</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw1</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw2</a>
                </nav>
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

  <!-- <div id="header">
    <div class="d-flex bg-black text-white p-3">
      <div class="w-25 text-dark">
        kiri
      </div>
      <div class="w-50 fs-1 text-center">
        
        Aramyzda
      </div>
      <div class="w-25">
        <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
          <li class="px-2"><i class="fa fa-search" aria-hidden="true"></i> Search</li>
          <li class="px-2"><i class="fa fa-user" aria-hidden="true"></i> Account</li>
          <li class="px-2 pe-4"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
        </ul>
      </div>
    </div>
    <ul class="d-flex bg-black p-1 justify-content-center align-items-center list-style-none">
      <a class="text-light nav-link active" href="index.php"><li>HOME</li></a>
      <a class="text-light nav-link active" href="katalog.php"><li>CATALOGUE</li></a>
      <a class="text-light nav-link active" href="#"><li>CART</li></a>
      <a class="text-light nav-link active" href="#"><li>TRANSACTION</li></a>
    </ul>
  </div> -->

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
<!-- </form> -->

<?php require_once("./template/footing.php")?>