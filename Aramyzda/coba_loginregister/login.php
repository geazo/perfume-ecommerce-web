
<?php 
    require_once("../template/heading.php");
    if (isset($_REQUEST['btn-register'])) {
        header("Location: register.php");
    }
?>
    <div class="container p-3">
        <div class="row">
            <div class="col-12">
                <h1>Login</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="tbx-username">Username or Email</label>
                        <input type="text" class="form-control" id="tbx-username" placeholder="Enter username or email" name="tbx-username">
                    </div>
                    <div class="form-group mb-2">
                        <label for="tbx-password">Password</label>
                        <input type="password" class="form-control" id="tbx-password" placeholder="Password" name="tbx-password">
                    </div>
                    <button name="btn-login" type="submit" class="btn btn-primary">Login</button>
                    <button name="btn-register" type="submit" class="btn border btn-light">Go to register</button>
                </form>
            </div>
        </div>
    </div>
<?php require_once("../template/footing.php")?>