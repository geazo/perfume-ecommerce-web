<?php require_once("./template/heading.php");
$listProduct = file_get_contents(
    "result.json"
);
$listProduct = json_decode($listProduct,true);
$product = $listProduct[$_REQUEST['product']];
$priceTeks = 'Rp '. number_format($product['price'],0,',','.');
// echo'<pre>';
//   print_r($listProduct[0]);
// echo'</pre>';
?>
<script>
    function gantiAngkaDown(){
        if(parseInt(document.getElementById('inputNumberLangsung').value)>1){
            document.getElementById('inputNumberLangsung').value = parseInt(document.getElementById('inputNumberLangsung').value) -  1;
        }
    }
    function gantiAngkaUp(){
        document.getElementById('inputNumberLangsung').value = parseInt(document.getElementById('inputNumberLangsung').value) +1;
    }
</script>
<!-- code here -->
<form action="#" method= "post">

    <!-- <div class="mainHead col-12">
        <div class="headBg col-12 "></div>
        <div class="header col-12 ">
            <div class="logoToko">
                <div class="logo"></div>
            </div>
            <div class="NavBar">
                <nav class="nav nav-pills flex-row  justify-content-center">
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link " name="keHome" aria-current="page" href="index.php">Home</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link active" name="keKatalog" href="katalog.php">Catalogue</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw1</a>
                    <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw2</a>
                </nav>
            </div>
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

    <div class="kontainerDetail">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <img class="fotoProd" src="<?=$product['image']?>" alt="" srcset="">
                </div>
                <div class="col-lg-6 col-sm-12 ">
                    <div class="row namaProduk "> <?=$product['name'] ?> </div>
                    <br>
                    <div class="row hargaProduk"> <?=$priceTeks?> </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4  col-lg-5">
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" id="btnDownQty" type="button" onclick="gantiAngkaDown()">-</button>
                                <input type="text" class="form-control text-center" id="inputNumberLangsung" aria-label="" value ="1">
                                <button class="btn btn-outline-secondary" id="btnUpQty"  type="button" onclick="gantiAngkaUp()">+</button>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <br>
                    <div class="row addToCart"> <button type="button" class="btn btn-danger">Add to Cart</button>  </div>
                    <br> <br>
                    <div class="row tipeProduk"><?= $product['type'] ?> </div>  
                    <div class="row descProduk"> <?=$product['description'] ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2 tagUlasan">
                    
                </div>
            </div>
        </div>
    </div><!-- penutup kontainer besar -->
    
  
</form>
<?php require_once("./template/footing.php")?>