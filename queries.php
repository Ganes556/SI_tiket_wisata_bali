<?php 
    include "config.php";
    function getTransactionUser($idUser){
        $conn = conn();
        $sql= "SELECT * FROM transaksi WHERE IdUser = ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("s", $idUser);
        $prepare -> execute();
        $result = $prepare -> get_result();
        if ($result->num_rows > 0) {
            $transaksi_arr = array();
            while($row = $result->fetch_assoc()) {
                if($row["StatusPembelian"] === "menunggu pembayaran"){
                    $transaksi_arr[] = $row;
                }
            }
            $conn->close();

            if(count($transaksi_arr) > 0){
                return $transaksi_arr;
            }
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
            $wisata_arr = array();
            while($row = $result->fetch_assoc()) {
                $wisata_arr[] = $row;
            }
            $conn->close();
            return $wisata_arr;
        }
        $conn->close();
        return 0;
    }
    
?>