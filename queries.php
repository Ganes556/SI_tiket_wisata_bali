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
    // get user by username untuk check username di register
    function getUser($username){
        $conn = conn();
        $sql= "SELECT * FROM users WHERE Username = ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("s", $username);        
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
    // get user by id
    function getUserById($idUser){
        $conn = conn();
        $sql= "SELECT * FROM users WHERE IdUser = ?";
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
    // regis user
    function registerUser($nama, $username, $password, $noTelp, $alamat){
        $conn = conn();
        $sql = "INSERT INTO users (Nama, Username, Password, NomorTelp, Alamat) VALUES (?, ?, ?, ?, ?)";
        $prepare = $conn -> prepare($sql);
        // hash password
        $password = password_hash($password, PASSWORD_DEFAULT);
        $prepare -> bind_param("sssss", $nama, $username, $password, $noTelp, $alamat);                
        $prepare -> execute();
        $conn->close();        
    }
    // get all wisata
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
    // get wisata by id
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
            $sql = "INSERT INTO transaksi (IdTransaksi,IdUser, IdWisata, StatusPembelian, TanggalPembelian, JumlahTiket ) VALUES (? , ?, ?, ?, ?, ?)";
            $prepare = $conn -> prepare($sql);        
            $time = time();
            $status = "menunggu pembayaran";
            $jumlahTiket = $tiket;
            $idTransaksi = (int)$time + (int)$idUser + (int)$idWisata;
            $prepare -> bind_param("ssssss", $idTransaksi , $idUser, $idWisata, $status, $time, $jumlahTiket);
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

    // get all user not admin
    function getAllUser(){
        $conn = conn();
        $sql= "SELECT * FROM users WHERE Role != 'admin'";
        $prepare = $conn -> prepare($sql);
        $prepare -> execute();
        $result = $prepare -> get_result();
        $user_arr = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user_arr[] = $row;
            }            
        }
        $conn->close();
        return $user_arr;
    }

    // get all transaksi     
    function getAllTransaksiUser(){
        $conn = conn();
        // get user transaksi order by field status pembelian 
        $sql= "SELECT transaksi.IdTransaksi, UrlBuktiPembayaran ,JumlahTiket , TanggalPembelian, StatusPembelian ,wisata.Nama as NamaWisata, users.Nama as NamaPembeli, wisata.Harga FROM transaksi INNER JOIN wisata ON transaksi.IdWisata = wisata.IdWisata INNER JOIN users ON transaksi.IdUser = users.IdUser WHERE users.Role != 'admin' ORDER BY FIELD(StatusPembelian, 'menunggu verifikasi', 'menunggu pembayaran', 'terverifikasi', 'kadaluarsa', 'ditolak' , 'dibatalkan')";

        $prepare = $conn -> prepare($sql);
        $prepare -> execute();
        $result = $prepare -> get_result();
        $transaksi_arr = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $transaksi_arr[] = $row;
            }
        }
        $conn->close();
        return $transaksi_arr;
    }

    // get all wisata
    function getAllWisata(){
        $conn = conn();
        $sql= "SELECT * FROM wisata";
        $prepare = $conn -> prepare($sql);
        $prepare -> execute();
        $result = $prepare -> get_result();
        $wisata_arr = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $wisata_arr[] = $row;
            }
        }
        $conn->close();
        return $wisata_arr;        
    }    

    // delete wisata
    function delWisata($idWisata){
        $conn = conn();
        $sql= "DELETE FROM wisata WHERE IdWisata = ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("s", $idWisata);
        $prepare -> execute();        
    }     
    // $noRekening = null -> belum ada
    function updateWisata($idWisata, $newWisata){

        $conn = conn();        
        $sql= "UPDATE wisata SET Nama = ?, Harga = ? , Deskripsi = ?, UrlThumbnailWST = ?, UrlGaleriWST = ? WHERE IdWisata = ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("ssssss", $newWisata['Nama'], $newWisata['Harga'], $newWisata['Deskripsi'], $newWisata['UrlThumbnailWST'], $newWisata['UrlGaleriWST'], $idWisata);
        $prepare -> execute();
        $conn->close();    
    }
    // add wisata
    function addWisata($wisata){
        $conn = conn();
        $sql= "INSERT INTO wisata (Nama, Harga, Deskripsi, UrlThumbnailWST, UrlGaleriWST) VALUES (?, ?, ?, ?, ?)";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("sssss", $wisata['Nama'], $wisata['Harga'], $wisata['Deskripsi'], $wisata['UrlThumbnailWST'], $wisata['UrlGaleriWST']);
        $prepare -> execute();
        $conn->close();
    }
    // get all transaksi by id user
    function getHistoryTransaksiUser($idUser){
        $conn = conn();        
        $sql= "SELECT transaksi.IdTransaksi, JumlahTiket, TanggalPembelian, StatusPembelian ,wisata.Nama as NamaWisata, users.Nama as NamaPembeli, wisata.Harga FROM transaksi INNER JOIN wisata ON transaksi.IdWisata = wisata.IdWisata INNER JOIN users ON transaksi.IdUser = users.IdUser WHERE transaksi.IdUser = ? ORDER BY FIELD(StatusPembelian, 'menunggu pembayaran','menunggu verifikasi', 'terverifikasi', 'kadaluarsa', 'ditolak' , 'dibatalkan')";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("s", $idUser);
        $prepare -> execute();
        $result = $prepare -> get_result();
        $transaksi_arr = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $transaksi_arr[] = $row;
            }
        }
        $conn->close();
        return $transaksi_arr;
    }    
    // update user
    function updateUser($data){
        extract($data);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $conn = conn();        
        $sql= "UPDATE users SET Nama = ?, Username = ?, NomorTelp = ?, Alamat = ?, Password = ?, UrlGambarProfile = ? WHERE IdUser = ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("sssssss", $nama, $username,$noTelp, $alamat ,$password, $profile, $idUser);
        $prepare -> execute();
        $conn->close();
    }
?>