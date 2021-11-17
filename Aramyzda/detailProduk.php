<?php 
    require_once("./template/heading.php");
    require_once("./connector/connection.php");
    $stmt = $conn -> prepare("select * from product where id = ?");
    $stmt -> bind_param("i", $_REQUEST['product']);
    $stmt -> execute();
    $product = $stmt -> get_result() -> fetch_assoc();
    $priceTeks = 'Rp '. number_format($product['price'],0,',','.');
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

<?php include ("./template/header.php")?>

    <div class="kontainerDetail">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <img class="fotoProd" src="<?=$product['image_source']?>" alt="" srcset="">
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
                    <div class="row addToCart"> <button type="button" class="btn btn-danger" onclick="AddToCart(<?=$product['id']?>)">Add to Cart</button>  </div>
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
<script>
    function AddToCart(id_product) {
        quantity = parseInt($("#inputNumberLangsung").val()) || 1;
        $.ajax({
            type: "post",
            url: "ajax/add_to_cart.php",
            data: {
                "id-product" : id_product,
                "quantity" : quantity
            },
            success: function (response) {
                alert(response)  ;
            }
        });
    }
</script>
<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>