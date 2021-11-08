
<?php 
    require_once("../template/heading.php");
    if (isset($_REQUEST['btn-login'])) {
        header("Location: login.php");
    }
    if (isset($_REQUEST['btn-register'])) {
        
    }
?>
    <div class="container p-3">
        <div class="row">
            <div class="col-12">
                <h1>Register</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="tbx-username">Username</label>
                        <input type="text" class="form-control" id="tbx-username" placeholder="Enter username" name="tbx-username">
                    </div>
                    <div class="form-group">
                        <label for="tbx-email">Email address</label>
                        <input type="email" class="form-control" id="tbx-email" aria-describedby="emailHelp" placeholder="Enter email" name="tbx-email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="tbx-password">Password</label>
                        <input type="password" class="form-control" id="tbx-password" placeholder="Password" name="tbx-password">
                    </div>
                    <div class="form-group">
                        <label for="tbx-full-name">Full Name</label>
                        <input type="text" class="form-control" id="tbx-full-name" placeholder="Enter Full Name" name="tbx-full-name">
                    </div>
                    <div class="form-group">
                        <label for="tbx-address">Address</label>
                        <input type="text" class="form-control" id="tbx-address" placeholder="Enter Address" name="tbx-address">
                    </div>
                    <div class="form-group">
                        <label for="tbx-phone">Phone</label>
                        <input type="text" class="form-control" id="tbx-phone" placeholder="Enter Phone" name="tbx-phone">
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
                        <label for="tbx-birth-date">Birth Date</label>
                        <input type="date" class="form-control" id="tbx-birth-date" name="tbx-birth-date">
                    </div>
                    <button name="btn-register" type="submit" class="btn btn-primary">Register</button>
                    <button name="btn-login" type="submit" class="btn border btn-light">Go to login</button>
                </form>
            </div>
        </div>
    </div>
<?php require_once("../template/footing.php")?>