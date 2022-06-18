<?php 
    if(isset($_FILES['buktiPembayaran'])){
        $valid_image_types = array('image/jpg', 'image/jpeg', 'image/png');
        // check file image valid
        unset($_SESSION['error']['bukti-pembayaran']);
        $img = $_FILES["buktiPembayaran"];
                        
        if (!in_array($img['type'], $valid_image_types)) {                  
            $_SESSION['error'] = ['bukti-pembayaran'=>'Format gambar tidak sesuai!']; 
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            die(); 
        }   

        $verifyimg = getimagesize($img['tmp_name']);
                    
        if (!in_array($verifyimg['mime'], $valid_image_types)) {                  
            $_SESSION['error'] = ['bukti-pembayaran'=>'Format gambar tidak sesuai!']; 
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            die(); 
        }      
                    
        if($img['size'] > 1000000){ // check file size < 1MB
            $_SESSION['error'] = ['bukti-pembayaran'=>'Ukuran gambar terlalu besar!']; 
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            die(); 
        }
        $info = pathinfo($img['name']);
        $uploaddir = 'e36b75e0eaec2e14ce7759e2b9581bcf/';
        
        $uploadfile = $uploaddir . $info['filename'] . "-" . hash("md5",time()."uploaded-file") . "." .$info['extension'];

        if (move_uploaded_file($img['tmp_name'], $uploadfile)) {
            $_SESSION['msg'] = ['bukti-pembayaran'=>'Bukti pembayaran berhasil diupload!'];            
            changeStatusPembelian($_POST['IdTransaksi'],"menunggu verifikasi",$uploadfile);
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            die();
        }

        $_SESSION['error'] = ['bukti-pembayaran'=>'Bukti pembayaran gagal diupload!'];
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); // redirect to same page
        die();                    
    }

?>