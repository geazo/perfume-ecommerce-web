<?php require_once("../template/heading.php")?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="crud.php">Entry</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="stock-management.php">Stock Management</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="report.php">Report</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- code here -->
<div class="container p-3">
        <div class="row">
            <div class="col-12">
                <h1>Register</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="inp-username">Username</label>
                        <input type="text" class="form-control" id="inp-username" placeholder="Enter username" name="inp-username">
                    </div>
                    <div class="form-group">
                        <label for="inp-email">Email address</label>
                        <input type="email" class="form-control" id="inp-email" aria-describedby="emailHelp" placeholder="Enter email" name="inp-email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="inp-password">Password</label>
                        <input type="password" class="form-control" id="inp-password" placeholder="Password" name="inp-password">
                    </div>
                    <div class="form-group">
                        <label for="inp-password">Confirm Password</label>
                        <input type="password" class="form-control" id="inp-confirm-password" placeholder="Confirm Password" name="inp-confirm-password">
                    </div>
                    <div class="form-group">
                        <label for="inp-full-name">Full Name</label>
                        <input type="text" class="form-control" id="inp-full-name" placeholder="Enter Full Name" name="inp-full-name">
                    </div>
                    <div class="form-group">
                        <label for="inp-address">Address</label>
                        <input type="text" class="form-control" id="inp-address" placeholder="Enter Address" name="inp-address">
                    </div>
                    <div class="form-group">
                        <label for="inp-phone">Phone</label>
                        <input type="text" class="form-control" id="inp-phone" placeholder="Enter Phone" name="inp-phone">
                    </div>
                    <div class="form-group">
                        <label for="rb-gender">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rb-gender" id="rb-gender-1" value="FEMALE" checked>
                            <label class="form-check-label" for="rb-gender-1">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rb-gender" id="rb-gender-2" value="MALE">
                            <label class="form-check-label" for="rb-gender-2">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rb-gender" id="rb-gender-3" value="OTHER">
                            <label class="form-check-label" for="rb-gender-3">
                                Other
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="inp-birth-date">Birth Date</label>
                        <input type="date" class="form-control" id="inp-birth-date" name="inp-birth-date">
                    </div>
                    <button name="btn-register" type="submit" class="btn btn-primary">Register</button>
                    <button name="btn-login" type="submit" class="btn border btn-light">Go to login</button>
                </form>
            </div>
        </div>
    </div>

<?php require_once("../template/footing.php")?>