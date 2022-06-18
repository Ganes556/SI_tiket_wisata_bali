<?php 
    include "config.php";
    function getTransactionUser($idUser){
        $conn = conn();
        $sql= "SELECT * FROM transaksi WHERE IdUser = ? AND StatusPembelian = 'menunggu pembayaran'";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("s", $idUser);
        $prepare -> execute();
        $result = $prepare -> get_result();        
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            $conn->close();
            return $row;            
        }
        $conn->close();
        return 0;        
    }
    
    // get history transaksi 
    function getHistoryTransaksi($idUser){
        $conn = conn();
        $sql= "SELECT * FROM transaksi WHERE IdUser = ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("s", $idUser);
        $prepare -> execute();
        $result = $prepare -> get_result();
        if ($result->num_rows > 0) {
            $transaksi_arr = array();
            while($row = $result->fetch_assoc()) { 
                $transaksi_arr[] = $row;                
            }
            $conn->close();
            return $transaksi_arr;
        }
        $conn->close();
        return 0;
    }

    function getUser($username){
        $conn = conn();
        $sql= "SELECT * FROM users WHERE Username = '$username'";
        $prepare = $conn -> prepare($sql);
        $prepare -> execute();
        $result = $prepare -> get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $conn->close();
            return $row;
        }
        $conn->close();
        return 0;
    }            
    function registerUser($nama, $username, $password, $noTelp, $alamat){
        $conn = conn();
        $sql = "INSERT INTO users (Nama, Username, Password, NomorTelp, Alamat) VALUES (?, ?, ?, ?, ?)";
        $prepare = $conn -> prepare($sql);
        // hash password
        $password = password_hash($password, PASSWORD_DEFAULT);
        $prepare -> bind_param("sssss", $nama, $username, $password, $noTelp, $alamat);                
        $prepare -> execute();
        $conn->close();        
        // $_SESSION['msg'] = ["Register success!"];
    }
    function getWisata(){
        $conn = conn();
        $sql= "SELECT * FROM wisata";
        $prepare = $conn -> prepare($sql);
        $prepare -> execute();
        $result = $prepare -> get_result();
        if ($result->num_rows > 0) {
            $wisata_arr = array();
            while($row = $result->fetch_assoc()) {
                $wisata_arr[$row["IdWisata"]] = $row;
            }
            $conn->close();
            return $wisata_arr;
        }
        $conn->close();
        return 0;
    }
    function getWisataById($idWisata){
        $conn = conn();
        $sql= "SELECT * FROM wisata WHERE IdWisata = $idWisata";
        $prepare = $conn -> prepare($sql);
        $prepare -> execute();
        $result = $prepare -> get_result();
        if ($result->num_rows > 0) {            
            $row = $result->fetch_assoc();
            $conn->close();
            return $row;
        }
        $conn->close();
        return 0;
    }
    function beliTiket($idUser, $idWisata, $tiket){
        $conn = conn();
        // check if user already have a transaction
        $transaksi = getTransactionUser($idUser);
        if($transaksi === 0){
            $sql = "INSERT INTO transaksi (IdUser, IdWisata, StatusPembelian, TanggalPembelian, JumlahTiket ) VALUES (?, ?, ?, ?, ?)";
            $prepare = $conn -> prepare($sql);        
            $time = time();
            $status = "menunggu pembayaran";
            $jumlahTiket = $tiket;
            $prepare -> bind_param("sssss", $idUser, $idWisata, $status, $time, $jumlahTiket);        
            $prepare -> execute();                        
        }
        $conn->close();        
    }
    // change status pembelian
    function changeStatusPembelian($idTransaksi, $status, $buktiPembayaran = null){
        $conn = conn();
        $sql = "UPDATE transaksi SET StatusPembelian = ?, UrlBuktiPembayaran = ? WHERE IdTransaksi = ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("sss", $status, $buktiPembayaran, $idTransaksi);        
        $prepare -> execute();
        $conn->close();
    }

    
?>