<?php
    session_start();
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'proyek_pw_aramyzda';
    $port = '3306';
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_errno) {
        die($conn->connect_error);
    }

    function alert($msg) {
        echo "<script>alert('$msg')</script>";
}
?>