<?php     
    error_reporting(0);
    include  'config.php';
    ini_set( 'session.cookie_httponly', 1 );
    session_start();
    $_SESSION['error'] = [];    
    $_SESSION['msg'] = [];    
    
    include ("./middleware/cors.php");
    
    function login() {
        include('./middleware/isLogin.php');        
        if(isset($_POST['login'])){                
            $conn = conn();
            extract($_POST);        
            
            $sql = "SELECT * FROM users WHERE Username= ?";
            $prepare = $conn -> prepare($sql);        
            $prepare -> bind_param("s", $username);
            $prepare -> execute();
            $result = $prepare -> get_result();
            if ($result->num_rows > 0) {                

                $row = $result->fetch_assoc();            
                if(password_verify($password, $row["Password"])){
                    // set session
                    $_SESSION["id"] = $row["IdUser"];
                    $_SESSION["nama"] = $row["Nama"];
                    $_SESSION["username"] = $row["Username"];
                    $conn->close();
                    header("Location: dashboard.php");
                    die();                    
                }        
            }
            $conn->close();
            http_response_code(401);            
            $_SESSION["error"] = ["Username or password is incorrect"];
        }
    }

    function register(){
        include('./middleware/isLogin.php');        
        if(isset($_POST['register'])){
            
            $conn = conn();
            extract($_POST);
            
            // check if username exist
            $sql = "SELECT * FROM users WHERE Username= ?";
            $prepare = $conn -> prepare($sql);
            $prepare -> bind_param("s", $username);
            $prepare -> execute();
            $result = $prepare -> get_result(); // get result from query
            if ($result->num_rows > 0) { // if username exist
                http_response_code(409); // conflict
                $_SESSION["error"] = ["Username already exist!"];
                $conn->close();
                return;
            }

            // register user
            $sql = "INSERT INTO users (Nama, Username, Password, NomorTelp, Alamat) VALUES (?, ?, ?, ?, ?)";
            $prepare = $conn -> prepare($sql);
            // hash password
            $password = password_hash($password, PASSWORD_DEFAULT);
            $prepare -> bind_param("sssss", $nama, $username, $password, $noTelp, $alamat);
            $prepare -> execute();
            $conn->close();
            $_SESSION['msg'] = ["Register success!"];
        }
    }
    function dashboard(){
        include('./middleware/isNotLogin.php');        
        if(isset($_POST['dashboard'])){
            $conn = conn();            
            extract($_POST);
        }
    }
    function logout(){
        session_destroy();
        header("Location: login.php");
        die();        
    }
    
?>