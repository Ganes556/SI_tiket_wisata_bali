<?php    
    // include database 
    include('./config.php');         

    function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $conn = conn();      
            extract($_POST);

            $sql = "SELECT * FROM users WHERE Username= ?  AND Password= ?";
            $prepare = $conn -> prepare($sql);
            $prepare -> bind_param("ss", $username, $password);
            $prepare -> execute();
            $result = $prepare -> get_result();
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "id: " . $row["idUser"] . " - Name: " . $row["Username"]. " " . $row["Password"]. "<br>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();        
        }  
        
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
?>