<?php require_once("./template/heading.php");
$listProduct = file_get_contents(
    "result.json"
);
$listProduct = json_decode($listProduct,true);
$product = $listProduct[0];
$priceTeks = 'Rp '. number_format($product['price'],0,',','.');
echo'<pre>';
  print_r($listProduct[0]);
echo'</pre>';
?>
<!-- code here -->
<form action="#" method= "post">
    <div class="header">
        <div class="logoToko">
            <div class="logo"></div>
        </div>
        <div class="NavBar">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link " name="keHome" aria-current="page" href="index.php">Home</a>
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link active" name="keKatalog" href="katalog.php">Catalogue</a>
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw1</a>
                <a class="flex-sm-fill text-sm-center bg-black text-light nav-link" href="#">otw2</a>
            </nav>
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
                    <div class="row descProduk"> <?=$product['description'] ?> </div>
                    <div class="row addToCart">  </div>
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