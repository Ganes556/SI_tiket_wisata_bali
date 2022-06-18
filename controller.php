<?php     
    // error_reporting(0);    

    ini_set( 'session.cookie_httponly', 1 );
    session_start();
    $_SESSION['error'] = [];    
    $_SESSION['msg'] = [];    
    
    include ("./middleware/cors.php");
    include('queries.php');

    // 
    function login() {
        include('./middleware/isLogin.php');        
        if(isset($_POST['login'])){                                        
            extract($_POST);            
            $row = getUser($username); // get result from query
            if($row !== 0){
                if(password_verify($password, $row["Password"])){                    
                    $transaksi = getTransactionUser($row["IdUser"]);
                    if($transaksi !== 0){
                        $_SESSION['transaksi'] = $transaksi;
                    }
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
            $_SESSION["error"] = ["Username or password is incorrect"];
        }
    }
    // register
    function register(){
        // check if login
        include('./middleware/isLogin.php');
        if(isset($_POST['register'])){            
            extract($_POST);
            $row = getUser($username); // get result from query
            if($row !== 0){ // if user exist
                http_response_code(409); // conflict
                $_SESSION["error"] = ["Username already exist"];
                return;
            }            
            // register user
            registerUser($nama, $username, $password, $noTelp, $alamat); // register user
            $_SESSION['msg'] = ["Register success!"]; // success message
        }
    }
    function dashboard(){
        // include('./middleware/isNotLogin.php');        
        $wisata = getWisata();
        if(isset($_GET["search"])){
            // if(trim($_GET["search"]) === "") die();
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
        if(isset($_POST['beliTiket'])){
            
        }
        if(isset($_POST['logout'])){
            session_destroy();
            header("Location: login.php");
            die();
        }
        return $wisata;       
    }

    function detailWisata(){
        // if(isset($_GET['id'])){
        //     $conn = conn();
        //     $id = $_GET['id'];
        //     $sql = "SELECT * FROM wisata WHERE IdWisata= ?";
        //     $prepare = $conn -> prepare($sql);
        //     $prepare -> bind_param("s", $id);
        //     $prepare -> execute();
        //     $result = $prepare -> get_result();
        //     $row = $result->fetch_assoc();
        //     $conn->close();
        //     echo json_encode($row);
        // }
    }

    function logout(){
        session_destroy();
        header("Location: login.php");
        die();        
    }
    
?>