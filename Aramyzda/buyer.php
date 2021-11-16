<?php include("./template/heading.php")?>
<!-- code here -->

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
          <li class="px-2 pe-4"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
        </ul>
      </div>

    <div class="w-25  justify-content-end burgerMode">
        <div class="collapse" id="navbarToggleExternalContent">
        <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
          <li class="px-2"><i class="fa fa-search" aria-hidden="true"></i> Search</li>
          <li class="px-2"><i class="fa fa-user" aria-hidden="true"></i> Account</li>
          <li class="px-2 pe-4"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
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
    <div class="w-100 d-flex   ">
    <ul class="w-25 d-flex bg-black p-1 align-items-center text-light">
        <li>Welcome, Nama</li>
    </ul>
    <ul class="w-50 d-flex bg-black justify-content-center p-1  align-items-center list-style-none"> 
      <div class="w-10"><a class="text-light w-10 nav-link active" href="index.php"><li>HOME</li></a></div>
      <a class="text-light w-10 nav-link active" href="katalog.php"><li>CATALOGUE</li></a>
      <a class="text-light w-10 nav-link active" href="#"><li>CART</li></a>
      <a class="text-light w-10 nav-link active" href="#"><li>TRANSACTION</li></a>
    </ul>
    <ul class="w-25 bg-black align-items-center">

    </ul>
    </div>
    
  </div>
</div>

<?php include("./template/footing.php")?>