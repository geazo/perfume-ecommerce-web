<?php
    require_once('../connector/connection.php');
    if (isset($_SESSION['user-login'])) {
        $stmt = $conn -> prepare("SELECT p.*, c.quantity FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
        $stmt -> bind_param("i", $_SESSION['user-login']['id']);
        $stmt -> execute();
        $carts = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
      }
?>
<?php 
if(isset($_SESSION['user-login'])){ 
    foreach ($carts as $key => $cart) { 
    ?>
      <div class="d-flex justify-content-center cart-item" style="height: 75px;">
        <div class=" m-1 gbrCart d-flex justify-content-center align-items-center hoverable expand-hover" style="width:20%">
          <img class="h-100" src="<?=$cart['image_source']?>" alt="" class="itemGbrCart">
        </div>
        <div class=" m-1 itemNameCart d-flex text-light align-items-center" style="width:70%;">
          <?=$cart['name']?>
        </div>
        <div class="m-1 itemCountCart d-flex text-light align-items-center" style="width:10%">
          <?= $cart['quantity'] ?>x
        </div>
      </div>
      </div>
      
    <?php
        }
    }
    else{
    ?>
      <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center" style="text-decoration:none;" href="login.php"> Please Login first
            </a>
      </div>
    <?php
    }
    ?>