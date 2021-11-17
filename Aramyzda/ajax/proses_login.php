<?php
    require_once("../connector/connection.php");
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    if ($email == "admin" && $password == "admin") {
        header("Location: ../admin/entry.php");
    }

    $stmt = $conn->prepare("SELECT * FROM user where email = ?");
    $stmt -> bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    $usernameKembar = true;
    $passwordKembar = true;
    
    if ($user == null || $user == "") $usernameKembar = false;
    else if ($user['password'] != $password) $passwordKembar = false;

    if (!$usernameKembar) {
        echo'username tidak ada!';
    }
    else if (!$passwordKembar) {
        echo'password salah!';
    }
    else {
        $_SESSION['user-login'] = $user;
        echo'berhasil login';
    }
?>