<?php 
    if(!isset($_SESSION['user'])){
        header("Location: login.php");        
        return 1;
    }
    return 0;
?>