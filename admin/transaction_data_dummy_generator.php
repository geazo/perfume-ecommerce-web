<form action="" method="POST">
    <input type="number" name="jumlah" id="" value="1">
    <input type="submit" value="go!" name="go">
</form>
<?php 
    require_once './connector/connection.php';
    if (isset($_REQUEST['go'])) { 
        $stmt = $conn -> prepare("SELECT * FROM user ORDER BY 1 DESC LIMIT 1");
        $stmt -> execute();
        $id = $stmt -> get_result() -> fetch_assoc();
        $maxIdUser = (int) $id['id'];
    
        $stmt = $conn -> prepare("SELECT * FROM product ORDER BY 1 DESC LIMIT 1");
        $stmt -> execute();
        $id = $stmt -> get_result() -> fetch_assoc();
        $maxIdProduct = (int) $id['id'];

        $jumlahTransaksi = (int) $_REQUEST['jumlah'];
        $maxQuantity = 2;

        for ($i=0; $i < $jumlahTransaksi; $i++) { 
            //random header transaksi
            $date = '2021-' . mt_rand(1,12) . '-' . mt_rand(1,28);
            $idUser = mt_rand(1, $maxIdUser);
            $total = 0;

            //random status
            $status = "";
            $random = mt_rand(0, 9);
            if ($random < 7) $status = "SUCCESS";
            else if ($random < 9) $status = "PENDING";
            else $status = "FAILED";


            //random list product yang dibeli
            //dan quantity
            $jumlahProduct = mt_rand(5, 20);
            $listProduct = [];
            for ($j=0; $j < $jumlahProduct; $j++) { 
                while (true) {
                    $idRandom = mt_rand(1, $maxIdProduct);
                    $stmt = $conn -> prepare("SELECT * FROM product WHERE id = ?");
                    $stmt -> bind_param("i", $idRandom);
                    $stmt -> execute();
                    $hasil = $stmt -> get_result() -> fetch_assoc();

                    $quantity = mt_rand(1, $maxQuantity);

                    if ($hasil != "" && $hasil != null) {
                        $listProduct[] = [
                            "id" => $idRandom,
                            "quantity" => $quantity
                        ];
                        // isi total
                        $total += (int) $hasil['price'] * $quantity;
                        break;
                    }
                }
            }

            //insert ke htrans
            $stmt = $conn -> prepare("INSERT INTO `htrans`(`id_user`, `tanggal`, `total`, `status`) VALUES (?,?,?,?)");
            $stmt -> bind_param("isis", $idUser, $date, $total, $status);
            $stmt -> execute();

            //get id htrans
            $stmt = $conn -> prepare("SELECT id_transaksi FROM htrans ORDER BY 1 DESC LIMIT 1");
            $stmt -> execute();
            $idHTrans = $stmt -> get_result() -> fetch_assoc();
            $idHTrans = (int) $idHTrans['id_transaksi'];

            //insert dtrans
            foreach ($listProduct as $key => $item) {
                $stmt = $conn -> prepare("INSERT INTO `dtrans`(`id_transaksi`, `id_product`, `quantity`) VALUES (?,?,?)");
                $stmt -> bind_param("iii", $idHTrans, $item['id'], $item['quantity']);
                $stmt -> execute();
            }
            
        }
        echo "sukses"; echo "<br>";
    }
?>