
<?php 
    require_once("./template/heading.php");
    require_once("./connector/connection.php");
    if (isset($_SESSION['user-login'])) {
        header("Location: index.php");
    }
    if (isset($_REQUEST['btn-register'])) {
        header("Location: register.php");
    }
    // if (isset($_REQUEST['btn-login'])) {
    //     $email = $_REQUEST['inp-email'];
    //     $password = $_REQUEST['inp-password'];

    //     if ($email == "admin" && $password == "admin") {
    //         header("Location: ../admin/entry.php");
    //     }

    //     $stmt = $conn->prepare("SELECT * FROM user where email = ?");
    //     $stmt -> bind_param("s", $email);
    //     $stmt->execute();
    //     $user = $stmt->get_result()->fetch_assoc();

    //     $usernameKembar = true;
    //     $passwordKembar = true;
        
    //     if ($user == null || $user == "") $usernameKembar = false;
    //     else if ($user['password'] != $password) $passwordKembar = false;

    //     if (!$usernameKembar) {
    //         alert('username tidak ada!');
    //     }
    //     else if (!$passwordKembar) {
    //         alert('password salah!');
    //     }
    //     else {
    //         $_SESSION['user-login'] = $user;
    //         alert('berhasil login');
    //     }
    // }
?>
    <div class="container p-3">
        <div class="row">
            <div class="col-12">
                <h1>Login</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="inp-email">Email</label>
                        <input type="text" class="form-control" id="inp-email" placeholder="Enter email" name="inp-email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="inp-password">Password</label>
                        <input type="password" class="form-control" id="inp-password" placeholder="Password" name="inp-password">
                    </div>
                    <button name="btn-login" type="" class="btn btn-primary" onclick="prosesLogin()">Login</button>
                    <button name="btn-register" type="submit" class="btn border btn-light">Go to register</button>
                </form>
            </div>
        </div>
    </div>
<?php require_once("./template/footing.php")?>
<script>
    function prosesLogin() {
        $.ajax({
            type: "post",
            url: "./ajax/proses_login.php",
            data: {
                "email" : $("#inp-email").val(),
                "password" : $("#inp-password").val()
            },
            success: function (response) {
                alert(response);
            }
        });
    }
</script>