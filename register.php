
<?php 
    require_once("./template/heading.php");
    require_once("./connector/connection.php");
    if (isset($_REQUEST['btn-login'])) {
        // header("Location: login.php");
        windowLocationHref("login.php");
    }
    if (isset($_REQUEST['btn-register'])) {
        $email = $_REQUEST['inp-email'];
        $password = $_REQUEST['inp-password'];
        $confirmPassword = $_REQUEST['inp-confirm-password'];
        $firstName = $_REQUEST['inp-first-name'];
        $lastName = $_REQUEST['inp-last-name'];
        $address = $_REQUEST['inp-address'];
        $phone = $_REQUEST['inp-phone'];
        $gender = $_REQUEST['rb-gender'];
        $birthDate = $_REQUEST['inp-birth-date'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt -> bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        $usernameKembar = true;
        if ($user == null || $user == "") {
            $usernameKembar = false;
        }

        if ($usernameKembar || $email == "admin") {
            alert('username sudah ada!');
        }
        else if ($email == "" || $password == "" || $confirmPassword == "" || $firstName == "" || $lastName == "" || $address == "" || $phone == "" || $gender == "" || $birthDate == "") {
            alert('isi semua field!');
        }
        else {
            $stmt = $conn->prepare("INSERT INTO `user`(`password`, `email`, `first_name`, `last_name`, `address`, `phone`, `gender`, `birthdate`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt -> bind_param("ssssssss", $password, $email, $firstName, $lastName, $address, $phone, $gender, $birthDate);
            $stmt->execute();
            alert('berhasil daftar');
        }
    }
?>
    <div class="  text-light bg-dark  p-5">
        <div class="row p-5 d-flex justify-content-center ">
            <div class="col-8 p-5">
                <h1>Register</h1>
                <form method="POST" id="form">
                    <div class="form-group">
                        <label for="inp-full-name">First Name</label>
                        <input type="text" class="form-control" id="inp-full-name" placeholder="Enter First Name" name="inp-first-name">
                    </div>
                    <div class="form-group">
                        <label for="inp-full-name">Last Name (Optional)</label>
                        <input type="text" class="form-control" id="inp-full-name" placeholder="Enter Last Name (Optional)" name="inp-last-name">
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
                        <label for="inp-address">Address</label>
                        <input type="text" class="form-control" id="inp-address" placeholder="Enter Address" name="inp-address">
                    </div>
                    <div class="form-group">
                        <label for="inp-phone">Phone</label>
                        <input type="text" class="form-control" id="inp-phone" placeholder="Enter Phone" name="inp-phone">
                    </div>
                    <div class="form-group mb-2">
                        <label for="inp-birth-date">Birth Date</label>
                        <input type="date" class="form-control" id="inp-birth-date" name="inp-birth-date">
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
                    <button name="btn-register" type="submit" class="btn btn-primary">Register</button>
                    <button name="btn-login" type="submit" class="btn border btn-light">Go to login</button>
                </form>
            </div>
        </div>
    </div>
<?php require_once("./template/footing.php")?>