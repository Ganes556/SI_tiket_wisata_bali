<?php    
    function conn(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "si_pmsn_tiket_wisata_bali";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo $conn->connect_error;
        return $conn;
    }
    
?>