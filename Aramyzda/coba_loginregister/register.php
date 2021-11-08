
<?php require_once("../template/footing.php")?>
    <div class="container p-3">
        <h1>Register</h1>
        <form class="w-50">
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
                <input class="form-check-input" type="radio" name="rb-gender" id="rb-gender" value="Female" checked>
                <label class="form-check-label" for="rb-gender">
                    Default radio
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                <label class="form-check-label" for="exampleRadios2">
                    Second default radio
                </label>
                </div>
                <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
                <label class="form-check-label" for="exampleRadios3">
                    Disabled radio
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <button type="button" class="btn border btn-light">Go to login</button>
        </form>
    </div>
<?php require_once("../template/heading.php")?>