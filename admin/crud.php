<?php require_once("heading.php")?>
<?php require_once("../connector/connection.php") ?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Aramyzda</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="../index.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="index.php">
              <i class="fa fa-home"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-dark bg-secondary bg-opacity-25" aria-current="page" href="crud.php">
              <i class="fa fa-share"></i> Entry
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="report.php">
              <i class="fa fa-book"></i> Report
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-3">
      <h2>Entry Produk</h2>
      <div class="mb-3">
        <label for="inp-nama" class="form-label">Nama:</label>
        <input type="text" class="form-control" id="inp-nama" placeholder="Nama Produk" name="inp-nama">
      </div>
      <div class="mb-3">
        <label for="inp-tipe" class="form-label">Tipe:</label>
        <input type="text" class="form-control" id="inp-tipe" placeholder="Tipe Produk" name="inp-tipe">
      </div>
      <div class="mb-3">
        <label for="inp-brand" class="form-label">Brand:</label>
        <input type="text" class="form-control" id="inp-brand" placeholder="Brand Produk" name="inp-brand">
      </div>
      <div class="mb-3">
        <label for="inp-harga" class="form-label">Harga:</label>
        <input type="number" class="form-control" id="inp-harga" placeholder="Harga Produk" name="inp-harga">
      </div>
      <div class="mb-3">
        <label for="inp-stok" class="form-label">Stok:</label>
        <input type="number" class="form-control" id="inp-stok" placeholder="Stok Produk" name="inp-stok">
      </div>
      <div class="mb-3">
        <label for="inp-description" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="inp-description" name="inp-description" rows="3" placeholder="Deskripsi Produk"></textarea>
      </div>
      <div class="mb-3">
        <label for="inp-image" class="form-label">URL Gambar:</label>
        <input type="text" class="form-control" id="inp-image" placeholder="URL Gambar Produk" name="inp-image">
      </div>
      <div class="mb-3 d-flex justify-content-end">
        <button id="btn-submit" name="btn-submit" type="submit" class="btn btn-primary" onclick="entryProductSingle()">Submit</button>
      </div>

      <h2>Entry Bulk</h2>
      <p class="info">
        *Masukkan file .csv kedalam folder admin <br>
        *Format CSV = nama, brand, harga, stok, tipe, deskripsi, url_image
      </p>
      <div class="mb-3">
        <label for="formFile" class="form-label">CSV File: </label>
        <input class="form-control" type="file" id="inp-csv">
      </div>
      <div class="mb-3 d-flex justify-content-end">
        <button id="btn-submit-bulk" name="btn-submit" type="submit" class="btn btn-primary" onclick="entryProductBulk()">Submit</button>
      </div>
      <h2>Log</h2>
      <div id="info" style="height: 500px; overflow: scroll;"></div>
    </main>
  </div>
</div>
<?php require_once("../template/footing.php")?>
<script>
  function entryProductSingle() {
    if (
      $("#inp-nama").val() == "" ||
      $("#inp-tipe").val() == "" ||
      $("#inp-brand").val() == "" ||
      $("#inp-harga").val() == "" ||
      $("#inp-stok").val() == "" ||
      $("#inp-description").val() == "" ||
      $("#inp-image").val() == ""
    ) {
      alert('ada field yang kosong!');
    } 
    else if (
      $("#inp-harga").val() <= 0 ||
      $("#inp-stok").val() <= 0
    ) {
      alert('harga dan stok tidak valid!');
    }
    else {
      $.ajax({
        type: "post",
        url: "entry_product_single.php",
        data: {
          "nama"        : $("#inp-nama").val(),
          "tipe"        : $("#inp-tipe").val(),
          "brand"       : $("#inp-brand").val(),
          "harga"       : $("#inp-harga").val(),
          "stok"        : $("#inp-stok").val(),
          "description" : $("#inp-description").val(),
          "image"       : $("#inp-image").val()
        },
        success: function (response) {
          alert('berhasil!');
          $("#inp-nama").val("");
          $("#inp-tipe").val("");
          $("#inp-brand").val("");
          $("#inp-harga").val("");
          $("#inp-stok").val("");
          $("#inp-description").val("");
          $("#inp-image").val("");
        }
      });
    }
  }

  function entryProductBulk() {
    $.ajax({
      type: "post",
      url: "entry_product_bulk.php",
      data: {
        "file-directory" : document.getElementById('inp-csv').files[0].name
      },
      success: function (response) {
        alert('berhasil!');
        $("#info").html();
        $("#info").append(response);
      }
    });
  }
</script>