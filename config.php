<?php    
    function conn(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "si_pmsn_tiket_wisata_bali";
        $conn = new mysqli($servername, $username, $password, $dbname);            

        if ($conn->connect_errno) {
            http_response_code(500);
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    
?>