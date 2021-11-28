<?php include("./template/heading.php")?>
<?php include("./template/header.php")?>
<!-- code here -->
<div class="cb py-3"></div>
<div class="container border border-black p-4" >
    <div class="row ">
      <div class="col-md-5 col-sm-12 align-items-center">
        <div class="mintacenter">
          <h3 class="align-self-center">Customer Information</h3>
        </div>
        <div class="col my-3">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgJNg5Lobsd8RuidmEPPw0bfDjSzq6LhkG1C5xYvvaWovVix_TdwCqlZ1yWYCXGU6PWEA&usqp=CAU" class="col-3 rounded-circle border border-dark ">
        </div>
        <div class="col-12">
          <!-- <div class="row">
            <div class="col-3">Usename </div>
            <div class="col-1"> : </div>
            <div class="col">  </div>
          </div> -->
          <div class="row my-2">
            <div class="col-3">First Name </div>
            <div class="col-1"> : </div>
            <div class="col"><?=$_SESSION['user-login']['first_name'] ?> </div>
          </div>
          <div class="row my-2">
            <div class="col-3">Last Name </div>
            <div class="col-1"> : </div>
            <div class="col"> <?=$_SESSION['user-login']['last_name']?> </div>
          </div>
          <div class="row my-2">
            <div class="col-3">Email Address </div>
            <div class="col-1"> : </div>
            <div class="col"> <?=$_SESSION['user-login']['email'] ?> </div>
          </div>
          <div class="row my-2">
            <div class="col-3">Phone Number </div>
            <div class="col-1"> : </div>
            <div class="col"> <?=$_SESSION['user-login']['phone'] ?> </div>
          </div>
          <div class="row my-2">
            <div class="col-3">Address </div>
            <div class="col-1"> : </div>
            <div class="col"> <?=$_SESSION['user-login']['address'] ?> </div>
          </div>
          <div class="row my-2">
            <div class="col-3">Birthday </div>
            <div class="col-1"> : </div>
            <div class="col"> <?= date($_SESSION['user-login']['birthdate']) ?> </div>
          </div>
          
        </div>
        </div>
        <div class="col-md-7 col-sm-12 justify-content-center border border-dark rounded-3" >
          <div class="col-12 d-flex justify-content-center"><h5>Completed Transactions</h5></div>
          <div class="col-12" id="tableCompleted">
          <table class="table table-hover table-sm table-striped">
            <thead class="sticky-top bg-white">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Total Pembelian</th>
                <th scope="col">Details</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($i=0; $i < 10; $i++) { 
                # code...
              ?>
                <tr>
                  <th scope="row"><?= $i+1?></th>
                  <td>tgl transaksi <?= $i+1?></td>
                  <td>Rp, <?= number_format(($i+1)*899999, 0, ',', '.') ?> </td>
                  <td><a href="">idk what to put here</a></td>
                </tr>
              <?php
              }
              ?>
              
              
              </tr>
            </tbody>
          </table>
          </div>
        </div>
        <div class="col-12 border border-2 mt-3 rounded-3 border-dark  ">
          <div class="col-12 d-flex justify-content-center">
            <h3>History Transactions</h3>
          </div>
          <div class="col-12" id="tableAllTransaction">
            <table class="table table-hover table-light ">
              <thead class="sticky-top bg-white">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Invoice Number</th>
                  <th scope="col">Detail Status Transaksi</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i <2; $i++) { 
                  # code...
                ?>
                  <tr>
                    <th scope="row"><?=$i+1?></th>
                    <td>IVC<?= str_pad($i+1,5,"0",STR_PAD_LEFT) ?></td>
                    <td>Lagi di Jalan</td>
                    <td>Pending</td>
                  </tr>
                  <tr>
                    <th scope="row"><?=$i+2?></th>
                    <td>IVC<?= str_pad($i+721,5,"0",STR_PAD_LEFT) ?></td>
                    <td>Belum bayar</td>
                    <td>Pending</td>
                  </tr>
                  <tr>
                    <th scope="row"><?=$i+3?></th>
                    <td>IVC<?= str_pad($i+187,5,"0",STR_PAD_LEFT) ?></td>
                    <td>Belum dikirim seller</td>
                    <td>Pending</td>
                  </tr>
                  <tr>
                    <th scope="row"><?=$i+4?></th>
                    <td>IVC<?= str_pad($i+123,5,"0",STR_PAD_LEFT) ?></td>
                    <td>Payment Expired</td>
                    <td>Canceled</td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="cb py-3"></div>
<?php require_once("./template/footer.php")?>
<?php include("./template/footing.php")?>