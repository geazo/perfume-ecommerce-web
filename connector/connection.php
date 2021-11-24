<?php
    session_start();
    $host = 'localhost';
    $user = 'aramyzda_aramyzda';
    $password = 'kennymasterphp';
    $database = 'aramyzda_proyek_pw_aramyzda';
    //uncomment this for website
    $conn = new mysqli($host, $user, $password, $database);
    //uncomment this for localhost
    // $conn = new mysqli($host, 'root', '', 'proyek_pw_aramyzda');
    if ($conn->connect_errno) {
        die($conn->connect_error);
    }


    function alert($msg) {
        echo "<script>alert('$msg')</script>";
    }

    function getFormatHarga($number)  {
        return number_format($number,0,',','.');
    }

    function windowLocationHref($url) {
        echo "<script>window.location.href='$url'</script>";
    }
?>