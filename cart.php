<?php namespace Midtrans; ?>
<?php require_once("./template/heading.php"); ?>
<?php include ("./template/header.php"); ?>
<?php 
    require_once('./Midtrans.php');
    require_once('./connector/connection.php');
    if(isset($_SESSION['user-login'])){

    }
    else{
        windowLocationHref("katalog.php");
    }
?>
<div class="py-3 m-3">
    <!-- <div class="yesno modal d-none" id="modalCart">
    <span onclick="document.getElementById('modalCart').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div> -->
    <div class="row">
        <div class="col-12" id="tableCheckout">
            <table class="table table-striped table-hover fs-6 " >
                <thead class="bg-light sticky-top ">
                    <tr>
                    <th scope="col">#</th>
                    <th class="text-center imgCart" scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th class="tipeCart" scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
        </div>
        <div id="header-cart" class="d-flex align-items-end flex-column"></div>
        
    </div>
    
</div>

<?php require_once("./template/footer.php")?>
<?php require_once("./template/footing.php")?>

<script>
    loadCart();
    function loadDCart() {
        $.ajax({
            type: "post",
            url: "ajax/load_detail_cart.php",
            success: function (response) {
                $("#tbody").html("");
                $("#tbody").append(response);
            }
        });
    }
    

    function loadHCart() {
        $.ajax({
            type: "post",
            url: "ajax/load_header_cart.php",
            success: function (response) {
                $("#header-cart").html("");
                $("#header-cart").append(response);
            }
        });
    }

    function loadCart() {
        loadDCart();
        loadHCart();
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
        $.confirm({
            title: '',
            content: 'Are you sure you want to \n remove this from Cart?',
            buttons: {
                confirm: function () {
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
                    $.alert('Removed');
                },
                cancel: function () {
                    //close
                },
            }
        });
    }
    function qtyCartManual(numget,id_cart){
        var num = numget;
        $.confirm({
        title:'',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Enter New Quantity Here</label>' +
        '<input type="number" placeholder="number" value="1" class="jumlah form-control" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var jum = this.$content.find('.jumlah').val();
                    if(jum<1){
                        $.alert('Input a Valid number');
                        return false;
                    }
                    num = jum;
                    $.ajax({
                        type: "post",
                        url: "ajax/edit_cart_quantity_manual.php",
                        data: {
                            "number" : num,
                            "id-cart" : id_cart
                        },
                        success: function (response) {
                            loadCart();
                        }
                    });
                }
            },
            cancel: function () {
                //close
            },
        },
        });
        
    }
</script>