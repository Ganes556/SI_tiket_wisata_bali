<?php     
    // error_reporting(0);    

    ini_set( 'session.cookie_httponly', 1 );
    session_start();
        
    
    include ("./middleware/cors.php");
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

                    $_SESSION["user"] = $row;                    
                    if($row["Role"] === "user"){
                        header("Location: index.php");
                        die();
                    }else if($row["Role"] === "admin"){
                        header("Location: adminPanel.php?page=verifikasiTransaksi");
                        die();
                    }                    
                    // alasan menggunakan die bukan return karena halaman login akan di redirect ke index.php
                    // perbedaan die dan return
                        // die() -> tidak akan mengirimkan data ke client
                        // return -> akan mengirimkan data ke client
                    
                    die(); // stop script
                }        
            }
            http_response_code(401);
            unset($_SESSION["error"]["login"]);
            $_SESSION["error"] = ["login" => ["Username or password is incorrect"]];
            header("Location: login.php");
            die();
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
            $_SESSION['error'] = [];
            $_SESSION['msg'] = [];
            extract($_POST);
            $row = getUser($username); // get result from query
            if($row !== 0){ // if user exist
                http_response_code(409); // conflict
                unset($_SESSION["error"]["register"]);
                $_SESSION["error"] = ["register" => "Username already exist"];
                header("Location: register.php");
                die();
            }            
            
        
            // register user
            registerUser($nama, $username, $password, $noTelp, $alamat); // register user
            unset($_SESSION["msg"]["register"]);
            $_SESSION['msg'] = ["register" => "Register success!"]; // success message
            header("Location: register.php");
            die();
        }
    }  

    include "./functionsLogic.php";
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
        
        if(isset($_GET["search"])){            
            $search =  $_GET['search'];     
            $data = [];      
            $data[] = (isset($_SESSION['user'])) ? 1 : 0;
            foreach($wisata as $key => $value){                
                if(str_contains(strtolower($value['Nama']), strtolower($search))){
                    $data[] = $value;                    
                }                
            }            
            echo json_encode($data);
            die();
        }
        
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
        if(isset($_GET["hapus"])){
            delWisata($_GET["hapus"]);                        
            die();
        }

        //! edit wisata
        if(isset($_POST["edit"])){            
            $oldWisata = getWisataById($_POST["id"]);
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
                if($thumbnail){         
                    $oldUrl = $oldWisata["UrlThumbnailWST"];
                    
                    $uploadDir = pathinfo($oldUrl)["dirname"];
                    $newInfo = pathinfo($thumbnail['name']);                    

                    $newFileName = uniqueFileUpload($uploadDir,$newInfo['filename'],$newInfo['extension']);
                    if(move_uploaded_file($thumbnail['tmp_name'], $newFileName)){
                        // echo json_encode(["msg" => "Sukses mengupload file!"]);
                        $newThumbnail = $newFileName;
                        unlink($oldUrl);                        
                    }
                }
                //* new galeri
                $newGaleri = null;                
                if(count($galeri) > 0){
                    $oldUrlGaleri = unserialize($oldWisata["UrlGaleriWST"]);    
                    foreach($galeri as $key => $value){
                        // edit old
                        $uploadDir = pathinfo($oldUrlGaleri[0])["dirname"];
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
                    $newGaleri = serialize($newGaleri);
                }
                $newWisata = [
                    "Nama" => $_POST["nama"],
                    "Deskripsi" => $_POST["deskripsi"],
                    "UrlThumbnailWST" => $thumbnail ? $newThumbnail : $oldWisata["UrlThumbnailWST"],
                    "UrlGaleriWST" => $newGaleri ? $newGaleri : $oldWisata["UrlGaleriWST"],
                    "Harga" => $_POST["harga"]
                ];
                updateWisata($_POST["id"],$newWisata);
                echo json_encode(["msg"=>"Sukses mengupload file!"]);                
            }            
            die();
        }
        if(isset($_POST["tambah"])){
            extract($_POST);
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
    
?>