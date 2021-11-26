<?php
    require_once("../connector/connection.php");
    $directory = $_REQUEST['file-directory'];
    $row = 1;
    if (($handle = fopen($directory, "r")) !== FALSE) {
        echo "<pre>";
        $ctr = 1;
        while (($data = fgetcsv($handle, 9999, ",")) !== FALSE) {
            try {
                $stmt = $conn -> prepare("INSERT INTO `product`(`name`, `brand`, `price`, `stock`, `type`, `description`, `image_source`) VALUES (?,?,?,?,?,?,?)");
                $stmt -> bind_param("ssiisss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
                $stmt -> execute();
                echo $ctr++ . ". ";
                echo $data[0]. " - " . $data[1]. " - " . $data[2]. " - " . $data[3]. " - " . $data[4]. " - " . $data[5]. " - " . $data[6];
                echo "<br>";
            }
            catch (Exception $e) {
                break;
                echo $e;
            }
        }
        echo "</pre>";
        fclose($handle);
    }
    echo "Success!"
?>