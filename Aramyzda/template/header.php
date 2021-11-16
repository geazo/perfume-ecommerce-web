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
</script>

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

      <div class="w-25  iconMode">
      <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
            <li class="px-2"><i class="fa fa-search" aria-hidden="true"></i> Search</li>
            <li class="px-2"><i class="fa fa-user" aria-hidden="true"></i> Account</li>
            <li class="px-2 pe-4" onclick="openNav()"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
        </ul>
      </div>

    <div class="w-25  justify-content-end burgerMode">
        <div class="menuTiga">
          <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
              <li class="px-2"><i class="fa fa-search" aria-hidden="true"></i> Search</li>
              <li class="px-2"><i class="fa fa-user" aria-hidden="true"></i> Account</li>
              <li class="px-2 pe-4" onclick="openNav()"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
          </ul>
        </div>
        
    </div>

    </div>
    <div class="w-100 d-flex">
      <ul class="w-25 bg-black d-flex">
        kanan
      </ul>
      <ul class="d-flex w-50 bg-black p-1 justify-content-center align-items-center list-style-none ">
        <a class="text-light nav-link active" href="index.php"><li>HOME</li></a>
        <a class="text-light nav-link active" href="katalog.php"><li>CATALOGUE</li></a>
        <a class="text-light nav-link active" href="#"><li>CART</li></a>
        <a class="text-light nav-link active" href="#"><li>TRANSACTION</li></a>
      </ul>
      <ul class="w-25 bg-black d-flex justify-content-end">
        kiri
      </ul>
    </div>
    

  </div>
</div>

<div class="mainHead mobileView ">
    <div class="headBg col-12 "></div>
    <div class="col-12" id ="header">
    <div class="d-flex  text-white p-3">
      <div class="w-25 text-dark">
        kiri
      </div>
      <div class="w-50 text-light fs-1 text-center">
        <!-- Aramyzda logo-->
        Aramyzda
      </div>

    

    

    </div>
    <div class="w-100 d-flex">
     
    </div>
    

  </div>
</div>