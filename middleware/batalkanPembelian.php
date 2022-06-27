<?php 
    if(isset($_GET["batalkan"])){
        $idTransaksi = $_GET["batalkan"];
        changeStatusPembelian($idTransaksi, "dibatalkan");
        unset($_SESSION["msg"]["pembayaran"]);
        $_SESSION["msg"]= ["pembayaran" => "Pembayaran berhasil dibatalkan!"];        
        
        if(isset($_SERVER['HTTP_REFERER'])){
            header("Location: $_SERVER[HTTP_REFERER]"); // redirect to prev page
            die();
        }
        
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        // berisi die karena tidak akan mengirimkan data ke client
        die();
    }
?>