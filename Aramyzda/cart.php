<?php require_once("./template/heading.php"); ?>
<?php include ("./template/header.php")?>
<?php 
?>
<div class="py-3 m-3">
    <!-- <div class="yesno modal d-none" id="modalCart">
    <span onclick="document.getElementById('modalCart').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div> -->
    <table class="table table-hover fs-5">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th class="d-flex justify-content-center" scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>
</div>
<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>
<script>
    loadCart();
    function loadCart() {
        $.ajax({
            type: "post",
            url: "ajax/load_cart.php",
            success: function (response) {
                $("#tbody").html("");
                $("#tbody").append(response);
            }
        });
    }

    function editQuantity(num, id_cart) {
        $.ajax({
            type: "post",
            url: "ajax/edit_cart_quantity.php",
            data: {
                "number" : num,
                "id-cart" : id_cart
            },
            success: function (response) {
                loadCart();
            }
        });
    }

    function deleteCart(id_cart) {
        $.ajax({
            type: "post",
            url: "ajax/delete_cart.php",
            data: {
                "id-cart" : id_cart
            },
            success: function (response) {
                loadCart();
            }
        });
    }
</script>