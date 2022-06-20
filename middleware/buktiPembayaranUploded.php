<?php 
    if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === 'user' && isset($_FILES['buktiPembayaran'])){
        unset($_SESSION['error']['bukti-pembayaran']);
        $img = $_FILES["buktiPembayaran"];
        
        // check file image valid
        $secured = secureImage($img);
        if($secured !== 1){
            $_SESSION['error']['bukti-pembayaran'] = $secured;
            die();
        }
        $info = pathinfo($img['name']);
        $uploaddir = 'e36b75e0eaec2e14ce7759e2b9581bcf';
        $fileNameBuktiPembayaran = uniqueFileUpload($uploaddir,$info["filename"],$info['extension']);
        if (move_uploaded_file($img['tmp_name'], $fileNameBuktiPembayaran)) {
            $_SESSION['msg'] = ['bukti-pembayaran'=>'Bukti pembayaran berhasil diupload!'];            
            changeStatusPembelian($_POST['IdTransaksi'],"menunggu verifikasi",$fileNameBuktiPembayaran);
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            die();
        }

        $_SESSION['error'] = ['bukti-pembayaran'=>'Bukti pembayaran gagal diupload!'];
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); // redirect to same page
        die();                    
    }

?>