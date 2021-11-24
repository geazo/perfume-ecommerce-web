<?php
    require_once("../connector/connection.php");
    $directory = $_REQUEST['file-directory'];
    $row = 1;
    if (($handle = fopen($directory, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 9999, ",")) !== FALSE) {
            try {
                $stmt = $conn -> prepare("INSERT INTO `product`(`name`, `brand`, `price`, `stock`, `type`, `description`, `image_source`) VALUES (?,?,?,?,?,?,?)");
                $stmt -> bind_param("ssiisss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
                $stmt -> execute();
            }
            catch (Exception $e) {
                break;
                echo $e;
            }
        }
        fclose($handle);
    }
?>