<?php     
    // error_reporting(0);    

    ini_set( 'session.cookie_httponly', 1 );
    session_start();
        
    
    include ("./middleware/cors.php");
    include('queries.php');
    // check transaksi user;
    
    
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
        }
        if(isset($_POST['login'])){                                           
            extract($_POST);            
            $row = getUser($username); // get result from query
            if($row !== 0){
                if(password_verify($password, $row["Password"])){                    
                    $_SESSION["user"] = $row;                    
                    header("Location: index.php");

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

    include "./middleware/checkTransaksiUser.php";      
    include "./middleware/buktiPembayaranUploded.php";
    include "./middleware/batalkanPembelian.php";
    include "./middleware/beliTiket.php";
    function dashboard(){
          
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
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $wisata = getWisataById($id);
            if($wisata === 0){
                http_response_code(404);
                echo "Wisata not found";
                die();
            }
            // $partGaleri = [];
            // $galeri = unserialize($wisata['UrlGaleriWST']);
            // // split galeri each 3 item            
            // $galuer  = array_chunk($galeri, 3); // split galeri each 3 item


            // print_r($lists);
            // die();
            return $wisata;
        }else{
            http_response_code(404);
            echo "Wisata not found";
            die();
        }      

    }
    
    
?>