<?php      
    function totalInIdr($harga,$jumlah){        
        return "Rp. " . number_format($jumlah * $harga/1000,3, '.',"");
        // return number_format($jumlah * $harga/1000,3, '.',"");
    }
    function secureImage($img){
        $valid_image_types = array('image/jpg', 'image/jpeg', 'image/png');
        if (!in_array($img['type'], $valid_image_types)) {                  
            return "Format gambar tidak sesuai!";            
        }   

        $verifyimg = getimagesize($img['tmp_name']);
                    
        if (!in_array($verifyimg['mime'], $valid_image_types)) {                              
            return "Format gambar tidak sesuai!";            
        }      
                    
        if($img['size'] > 1000000){ // check file size < 1MB            
            return "Ukuran gambar terlalu besar!";            
        }
        return 1;
    }
    // // function upload image
    // function uploadImage($img,$path){

    // }

    function uniqueFileUpload($uploaddir,$filename,$ext){
        $prefix = $uploaddir . "/" . $filename . "-";
        $uploadfile = $prefix . uniqid(hash("md5",time())) . "." .$ext;
        return $uploadfile;
    }
?>