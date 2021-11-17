<?php require_once("../template/heading.php")?>
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
            <a class="nav-link active text-dark" aria-current="page" href="#">
              <i class="fa fa-home"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="#">
              <i class="fa fa-share"></i> Entry
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="#">
              <i class="fa fa-folder-open"></i> Stock Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="#">
              <i class="fa fa-book"></i> Report
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
      <h2>List Product</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>aaa</td>
              <td>aaa</td>
              <td>aaa</td>
              <td>aaa</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<?php require_once("../template/footing.php")?>
<script>
    loadListBarang() {
        $.ajax({
            type: "post",
            url: "ajaxAdmin.php",
            data: {
                "action" : "LOAD_LIST_BARANG"
            },
            dataType: "dataType",
            success: function (response) {
                
            }
        });
    }
</script>