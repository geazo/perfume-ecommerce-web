<?php require_once("./connector/connection.php") ?>
<div id="mySidebar" class="sidebar h-100">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <div class="col min-vh-90">
    <div class="row align-self-start d-flex h-10 justify-content-center text-light fs-4 ">Your Cart</div>

    <div class="row align-self-center h-80 d-flex justify-content-center">
      items
    </div>

    <div class="row align-self-end text-light h-10 d-flex justify-content-center">
      <button class="button"><span>To Checkout </span></button>
    </div>
  
  </div>
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
function mobileOpen(){
  $("#theMobileSidebar").removeClass("mobileSidebarClosed");
  $("#theMobileSidebar").addClass("mobileSidebar");
}
function mobileClose(){
  $("#theMobileSidebar").addClass("mobileSidebarClosed");
  $("#theMobileSidebar").removeClass("mobileSidebar");
}
</script>
<div class="mobileSidebarClosed p-2" id="theMobileSidebar">
    <ul class = "d-flex flex-column list-style-none fs-6 text light">
      <li class="iconSidebar fs-1  pb-5 text-light align-self-end" onclick="mobileClose()"><i class="fa fa-bars"></i> </li>
      <a class="" style="text-decoration:none;" href="index.php">
        <li class = "text-light pt-5 pb-3 fs-4">HOME</li>
      </a>
      <a class="" style="text-decoration:none;" href="katalog.php">
        <li class = "text-light pb-3 fs-4">CATALOGUE</li>
      </a>
      <a class="" style="text-decoration:none;" href="">
        <li class = "text-light pb-3 fs-4">ACCOUNT</li>
      </a>
      <a class="" style="text-decoration:none;" href="">
        <li class = "text-light pb-3 fs-4">CHECK OUT</li>
      </a>
    </ul>
</div>
<div class="mainHead pcView">
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

      <div class="w-25 ">
      <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
          <li class="px-2">
            <i class="fa fa-search" aria-hidden="true"></i> Search
          </li>
          <li class="px-2">
            <div class="dropdown">
              <a class="text-light text-decoration-none dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i> Account
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
          </li>
          <li class="px-2 pe-4" onclick="openNav()">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
          </li>
        </ul>
      </div>
    </div>
    <div class="w-100 d-flex">
      <ul class="w-25 bg-black d-flex">
        kiri #2
      </ul>
      <ul class="d-flex w-50 bg-black p-1 justify-content-center align-items-center list-style-none ">
        <a class="text-light nav-link active" href="index.php"><li>HOME</li></a>
        <a class="text-light nav-link active" href="katalog.php"><li>CATALOGUE</li></a>
        <a class="text-light nav-link active" href="#"><li>CART</li></a>
        <a class="text-light nav-link active" href="#"><li>TRANSACTION</li></a>
      </ul>
      <ul class="w-25 bg-black d-flex justify-content-end">
        kanan 
      </ul>
    </div>
  </div>
</div>

<div class="mainHead mobileView ">
    <div class="headBg col-12 "></div>
    <div class="col-12" id ="header">
    <div class="d-flex  text-white p-3">
      <div class="w-25 text-dark">
        <div class="fa fa-bars text-light fs-1" onclick="mobileOpen()"></div>
          
      </div>
      <div class="w-50 text-light fs-1 text-center">
        <!-- Aramyzda logo-->
        Aramyzda
      </div>
      <div class="w-25 text-dark">
        kanan
      </div>

    </div>
    <div class="w-100 d-flex">
     
    </div>
    
  </div>
</div>

