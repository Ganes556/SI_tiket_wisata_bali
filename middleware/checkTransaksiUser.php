<?php     
    if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "user"){
        $user = $_SESSION['user']; // get user from session        
        $transaksi = getTransactionUser($user['IdUser']); // get transaksi user        

        if($transaksi !== 0){ // if user have transaksi
            // check expired 1 day 
            $now = time(); // get current time
            $expired = $transaksi['TanggalPembelian'] + 86400; // 1 day
            if($now > $expired){ // if now > expired
                // expired
                changeStatusPembelian($transaksi['IdTransaksi'], "kadaluarsa");                
            }else{
                $wisataInTransaksi = getWisataById($transaksi["IdWisata"]);
            }
        }
    } 
?>