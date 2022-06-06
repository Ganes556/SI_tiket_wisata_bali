<?php    
    // include database 
    include('./config.php');         
    // login
    function login() {
        $conn = conn();      
        extract($_POST);

        $sql = "SELECT * FROM users WHERE Username= ?  AND Password= ?";
        $prepare = $conn -> prepare($sql);
        $prepare -> bind_param("ss", $username, $password);
        $prepare -> execute();
        $result = $prepare -> get_result();
        if ($result->num_rows > 0) {
            // output data of each row
            // get name from $result
            $row = $result->fetch_assoc();
            
            // set session
            $_SESSION["id"] = $row["idUser"];
            $_SESSION["nama"] = $row["Nama"];
            $_SESSION["username"] = $row["Username"];
            header("Location: dashboard.php");
            die();
        } else {
            echo "username or password is incorrect!";
        }
        $conn->close();        
    }    
    // function register
    function register() {                
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $conn = conn();   
            extract($_POST);                
            
            if(!empty($username) && !empty($password) && !empty($nama) && !empty($nomerTelp) && !empty($alamat)){
                $checkExist = "SELECT * FROM users WHERE Username = ? ";
                $prepare = $conn -> prepare($checkExist);
                $prepare -> bind_param("s", $username);
                $prepare -> execute();
                $result = $prepare -> get_result();
                
                if ($result->num_rows > 0) {
                    echo "Username sudah ada!";
                } else {
                    $sql = "INSERT INTO users (Username, Password, Nama, NomorTelp, Alamat) VALUES (?, ?, ?, ?, ?)";
                    $prepare = $conn -> prepare($sql);
                    $prepare -> bind_param("sssss", $username, $password, $nama, $nomerTelp, $alamat);
                    $prepare -> execute();
                    echo "New record created successfully";
                }
            } else {
                echo "Isi semua field!";                
            }
            $conn->close();
            return;
        }  
        
    }
    function checkLogin(){
        if(isset($_SESSION["id"])){
            return true;
        }else {
            return false;
        }
    }
    function cors() {
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        
            exit(0);
        }        
    }
?>