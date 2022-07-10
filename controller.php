<?php     
    // error_reporting(0);    

    ini_set( 'session.cookie_httponly', 1 );
    session_start();
    
    include('queries.php');    
    
    if(isset($_SESSION['user']) && isset($_GET['logout'])){        
        session_destroy();         
        // reload current url without query       
        echo "<script>
            location.href = window.location.href.split('?')[0] 
        </script>";
        die();        
    }  

    function login() {
        // unset($_SESSION["msg"]);
        if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "user"){
            header("Location: index.php");
            die();
        }else if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "admin"){                        
            header("Location: adminPanel.php?page=verifikasiTransaksi");
            die();
        }

        if(isset($_POST['login'])){                                           
            extract($_POST);            
            $row = getUser($username); // get result from query

            if($row !== 0){
                if(password_verify($password, $row["Password"])){                    
                    $row['Password'] = $password;
                    $_SESSION["user"] = $row;
                    if($row["Role"] === "user"){
                        header("Location: index.php");                        
                    }else if($row["Role"] === "admin"){
                        header("Location: adminPanel.php?page=verifikasiTransaksi");                        
                    }                    
                    
                    // alasan menggunakan die bukan return karena halaman login akan di redirect ke index.php
                    // perbedaan die dan return
                        // die() -> tidak akan mengirimkan data ke client
                        // return -> akan mengirimkan data ke client
                    
                    die(); // stop script
                }        
            }                    
            return ['error'=> "Username or password is incorrect"];            
        }
    }
    // register
    function register(){ 
        // check if login or not if login, redirect to index.php 
        if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "user"){
            header("Location: index.php");
            die();
        }else if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "admin"){
            header("Location: adminPanel.php");
            die();
        }

        if(isset($_POST['register'])){
            extract($_POST);
            $row = getUser($username); // get result from query
            if($row !== 0){ // if user exist                                
                return ['error' => "Username already exist"];
            }            
            
        
            // register user
            registerUser($nama, $username, $password, $noTelp, $alamat); // register user
            return ['msg'=> "Register success!"];            
        }        
    }  
       

    
    
    
    include "./functionsLogic.php";
    // login as user
    if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "user"){
        include "./middleware/checkTransaksiUser.php";    
        include "./middleware/buktiPembayaranUploded.php";
        include "./middleware/batalkanPembelian.php";
        include "./middleware/beliTiket.php";                
    }      
    
    function dashboard(){
        if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "admin"){            
            header("Location: adminPanel.php?page=verifikasiTransaksi");
            die();
        }  
        
        $wisata = getWisata();           
        
        return $wisata;       
    }

    function detailWisata(){          
        if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === "admin"){
            header("Location: adminPanel.php?page=verifikasiTransaksi");
            die();
        }                
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $wisata = getWisataById($id);
            if($wisata === 0){
                http_response_code(404);
                echo "Wisata not found";
                die();
            }
            return $wisata;
        }
        http_response_code(404);
        echo "Wisata not found";
        die();        
    }

    //! admin panel 
    function adminPanel(){        
        if(!isset($_SESSION['user']) || $_SESSION['user']['Role'] === "user"){            
            header("Location: index.php");
            die();            
        }
        
        if(!isset($_GET["page"]) || !in_array($_GET["page"],["verifikasiTransaksi","kelolaObjek"])){              
            http_response_code(404);
            echo "Page not found";
            die();
        }
        
        $rowTransaksi = getAllTransaksiUser();        
        $allTransaksiHariIni = [];
        $allUser = getAllUser();
        $allWisata = getAllWisata();
        foreach ($rowTransaksi as $key => $value) {
            if(date("d M Y",$value['TanggalPembelian']) === date("d M Y")){
                $allTransaksiHariIni[] = $value;
            }
        }
        // del wisata with there files in server
        if(isset($_GET["hapus"])){
            $id = $_GET["hapus"];   
            $oldWisata = getWisataById($id);
            if($oldWisata === 0){      
                echo "Wisata not found";
                die();
            }
 
            
            // $oldWisata['Nama']
            $baseDir = "./assets/img/DataWisata/{$oldWisata['Nama']}";
            $files = glob("$baseDir/*"); // get all file names
            
            // echo $escapeDirSpace;
            foreach($files as $file){ // iterate files
                if(is_file($file)){
                    unlink($file); // delete file
                }else{
                    $cover = glob("$baseDir/cover/*")[0];
                    unlink($cover);
                    rmdir($file); // delete dir cover
                }
            }
            rmdir("$baseDir"); // delete dir wisata
            
            // delete wisata            
            delWisata($id);          
            echo "Wisata {$oldWisata['Nama']} berhasil dihapus!";                                                  
            die();
        }

        if(isset($_POST["verifikasi"])){
            extract($_POST);            
            $msg = "";
            if($verifikasi === 'true'){
                changeStatusPembelian($id,"terverifikasi");
                $msg = "Verifikasi bukti pembayaran $nama berhasil diverifikasi!";
            }else{
                changeStatusPembelian($id,"ditolak");
                $msg = "Verifikasi bukti pembayaran $nama berhasil ditolak!";
            }
            echo json_encode(["msg" => $msg]);
            die();
        }

        //! edit wisata
        if(isset($_POST["edit"])){            
            $oldWisata = getWisataById($_POST["id"]);
            $uploadDir = "./assets/img/DataWisata/" . $oldWisata['Nama'];
            
            
            //* handle files
            if(isset($_FILES)){
                $thumbnail = null;
                $galeri = [];                                
                $error = "";
                foreach($_FILES as $key => $value){
                    $secured = secureImage($value);
                    if($secured === 1){                        
                        if($key == "thumbnail"){
                            $thumbnail = $value;
                            continue;
                        }
                        $galeri[((int)substr($key, -1))-1] = $value;
                    }else{
                        $error = $secured;
                    }                                      
                }    

                if($error){
                    echo json_encode(["error"=>$error]);
                    die();
                }
                
                //* new thumbnail
                $newThumbnail = null;

                                
                $oldUrl = $oldWisata["UrlThumbnailWST"];                     

                if($thumbnail){         
                    
                    $newInfo = pathinfo($thumbnail['name']);                    
                    $newFileName = uniqueFileUpload($uploadDir . "/Cover",$newInfo['filename'],$newInfo['extension']);
                                        
                    if(move_uploaded_file($thumbnail['tmp_name'], $newFileName)){
                        // echo json_encode(["msg" => "Sukses mengupload file!"]);
                        $newThumbnail = $newFileName;           
                        if(file_exists($oldUrl)){
                            unlink($oldUrl);
                        }                           
                    }
                }

                //* new galeri
                $newGaleri = null;                
                if(count($galeri) > 0){
                    $oldUrlGaleri = unserialize($oldWisata["UrlGaleriWST"]);    
                    foreach($galeri as $key => $value){
                        
                        // edit old                        
                        $newInfo = pathinfo($value['name']);                             
                        $newFileName = uniqueFileUpload($uploadDir,$newInfo['filename'],$newInfo['extension']);
                        
                        if($key < count($oldUrlGaleri)){
                            $oldUrl = $oldUrlGaleri[$key];
                            if(move_uploaded_file($value['tmp_name'], $newFileName)){
                                // unlink($oldUrl);
                                $oldUrlGaleri[$key] = $newFileName;
                                // $newGaleri = $oldUrlGaleri;                                
                            }else{
                                die();
                            }
                            
                        }else{ // add new                             
                            if(move_uploaded_file($value['tmp_name'], $newFileName)){                                                                
                                $oldUrlGaleri[$key] = $newFileName;
                            }else{                                
                                die();
                            }
                        }
                        $newGaleri = $oldUrlGaleri;
                    }                    
                }
            }            

            $uploadDir = "./assets/img/DataWisata/" . $_POST['nama'];
            if($thumbnail){                
                $newThumbnail = $uploadDir . "/Cover" . "/" . pathinfo($newThumbnail)['basename'];
            }else{
                $oldThumb = $uploadDir . '/Cover' . "/" . pathinfo($oldWisata["UrlThumbnailWST"])['basename'];
            }                
            if($newGaleri){                
                foreach($newGaleri as $key => $value){
                    $newGaleri[$key] = $uploadDir . "/" . pathinfo($value)['basename'];
                }                
            }else{
                $oldGal = unserialize($oldWisata["UrlGaleriWST"]);
                foreach ($oldGal as $key => $value) {
                    $oldGal[$key] = $uploadDir . "/" . pathinfo($value)['basename'];
                }            
            }

            // * change name dir
            if($_POST['nama'] !== $oldWisata['Nama']){
                $oldName = "assets/img/DataWisata/" . $oldWisata['Nama'];
                $newName = "assets/img/DataWisata/" . $_POST['nama'];
                if(!rename($oldName,$newName)) {
                    if (copy ($oldName,$newName)) {
                        unlink($oldName);                        
                    }                    
                }
            }

            $newWisata = [
                "Nama" => $_POST["nama"],
                "Deskripsi" => $_POST["deskripsi"],
                "UrlThumbnailWST" => $thumbnail ? $newThumbnail : $oldThumb,
                "UrlGaleriWST" => $newGaleri ? serialize($newGaleri) : serialize($oldGal),
                "Harga" => $_POST["harga"]
            ];            
            // var_dump($newThumbnail);
            // var_dump($newWisata);
            // die();
            updateWisata($_POST["id"],$newWisata);
            
            echo json_encode(["msg"=>"Sukses mengedit wisata!"]);
            die();
        }

        //! tambah wisata
        if(isset($_POST["tambah"])){            
            if(empty($_POST["nama"]) || empty($_POST["deskripsi"]) || empty($_POST["harga"])){
                echo json_encode(["error"=>"Tidak boleh ada field yang kosong!"]);
                die();
            }

            //* handle files
            if(isset($_FILES)){
                $wisata = [];      
                $galeri = [];
                $baseFile = "./assets/img/DataWisata/";
                
                $dirThumbnail = $baseFile . "$_POST[nama]/Cover";
                $dirGaleri = $baseFile . "$_POST[nama]";
                
                if(!file_exists($dirGaleri)){
                    mkdir($dirGaleri, 0777, true); // create dir for galeri
                }

                if(!file_exists($dirThumbnail)){
                    mkdir($dirThumbnail, 0777, true); // create directory for thumbnail
                }

                foreach($_FILES as $key => $value){
                    $secured = secureImage($value);
                    if($secured === 1){
                        $info = pathinfo($value['name']);
                        //* set url thumbnail
                        if($key === "thumbnail"){
                            $filename = uniqueFileUpload($dirThumbnail,$info['filename'],$info['extension']);
                            if(move_uploaded_file($value['tmp_name'], $filename)){
                                $wisata["UrlThumbnailWST"] = $filename;
                                continue;
                            }
                        }
                        //* set url galeri
                        $filename = uniqueFileUpload($dirGaleri,$info['filename'],$info['extension']);
                        if(move_uploaded_file($value['tmp_name'], $filename)){
                            $galeri[] = $filename;                            
                        }                        
                    }else{
                        echo json_encode(["error"=>$secured]);
                        die();
                    }
                }
            
                $wisata['UrlGaleriWST'] = serialize($galeri);                
                $wisata['Nama'] = $_POST["nama"];
                $wisata['Deskripsi'] = $_POST["deskripsi"];
                $wisata['Harga'] = $_POST["harga"];
                addWisata($wisata);
                echo json_encode(["msg"=>"Sukses menambah wisata!"]);
                die();
            }
            echo json_encode(["error"=>"Tidak ada file yang diupload!"]);
            die();            

        }        
        if(isset($_GET["tambah"])){            
            include "./template/admin/tambahWisata.php";
            die();
        }

        if(isset($_GET["edit"])){
            // echo 1;
            $wisata = getWisataById($_GET["edit"]);        
            include "./template/admin/editWisata.php";
            die();
        }

        return ["allUser" => $allUser, "allTransaksiUser" => $allTransaksiHariIni,"allWisata" => $allWisata];
    }           
  
    function user(){        
        if(isset($_POST['changeProfile'])){
            extract($_POST);                            
            $getUser = getUserById($changeProfile);
            $oldUrlProfile = $getUser['UrlGambarProfile'];
            $newProfile = $getUser['UrlGambarProfile'];

            if(isset($_FILES['profile'])){
                if($getUser){
                    if(file_exists($oldUrlProfile)){
                        unlink($oldUrlProfile);
                    }                
                }
                $profile = $_FILES['profile'];
                $secured = secureImage($profile);
                
                if($secured === 1){
                    $info = pathinfo($profile['name']);                    
                    $filename = uniqueFileUpload("userProfile",$info['filename'],$info['extension']);                    
                    
                    if(move_uploaded_file($profile['tmp_name'], $filename)){                        
                        $newProfile = $filename;
                        $_SESSION['user']['UrlGambarProfile'] = $newProfile;
                    }                    
                }else{
                    echo $secured;
                    die();
                }
            }
            
            $upUser = ["profile"=>$newProfile,"password"=>$password,"username"=>$username,"nama"=>$nama,"noTelp"=>$noTelp,"alamat"=>$alamat, "idUser" => $changeProfile];                                 
            updateUser($upUser);
            $_SESSION['user']['Nama'] = $nama;
            $_SESSION['user']['Password'] = $password;
            $_SESSION['user']['Username'] = $username;                        
            $_SESSION['user']['Alamat'] = $alamat;                        
            $_SESSION['user']['NomorTelp'] = $noTelp;                        
            echo "sukses!";                    
            die();
        }
    }
    function menuProfile(){        
        if(isset($_SESSION['user']) && isset($_GET['page'])){
            // control user profile
            user();
            // profile
            if($_GET['page'] === "profile"){                    
                include_once "./template/user/profile.php";
                die();
            }
            if($_GET['page'] === "history"){
                $historyTransaksiUser = getHistoryTransaksiUser($_SESSION['user']['IdUser']);            
                include_once "./template/user/history.php";
                die();
            }        
        }
    }
?>