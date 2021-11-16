
<?php 
    require_once("../template/heading.php");
    if (isset($_REQUEST['btn-register'])) {
        header("Location: register.php");
    }
    if (isset($_REQUEST['btn-login'])) {
        $username = $_REQUEST['inp-username'];
        $password = $_REQUEST['inp-password'];

        if ($username == "admin" && $password == "admin") {
            header("Location: ../admin/entry.php");
        }

        $stmt = $conn->prepare("SELECT * FROM user");
        $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $usernameKembar = false;
        $passwordKembar = false;
        foreach ($users as $idxU => $user) {
            if ($username == $user['username']) {
                $usernameKembar = true;
                if ($password == $user['password']) {
                    $passwordKembar = true;
                }
            }
        }

        if (!$usernameKembar) {
            alert('username tidak ada!');
        }
        else if (!$passwordKembar) {
            alert('password salah!');
        }
        else {
            alert('berhasil login');
        }
    }
?>
    <div class="container p-3">
        <div class="row">
            <div class="col-12">
                <h1>Login</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="inp-username">Username or Email</label>
                        <input type="text" class="form-control" id="inp-username" placeholder="Enter username or email" name="inp-username">
                    </div>
                    <div class="form-group mb-2">
                        <label for="inp-password">Password</label>
                        <input type="password" class="form-control" id="inp-password" placeholder="Password" name="inp-password">
                    </div>
                    <button name="btn-login" type="submit" class="btn btn-primary">Login</button>
                    <button name="btn-register" type="submit" class="btn border btn-light">Go to register</button>
                </form>
            </div>
        </div>
    </div>
<?php require_once("../template/footing.php")?>