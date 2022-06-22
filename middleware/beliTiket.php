<?php
    if(isset($_POST['beliTiket'])){
        $_SESSION['msg'] = [];
        extract($_POST);            
        beliTiket($_SESSION['user']['IdUser'], $IdWisata, $tiket);
        
        if(isset($_SERVER['HTTP_REFERER'])){
            header("Location: $_SERVER[HTTP_REFERER]"); // redirect to prev page
            die();
        }
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); // redirect to same page
        // berisi die karena tidak akan mengirimkan data ke client
        die();
    }
?>