<?php 
    ini_set( 'session.cookie_httponly', 1 );
    session_start();
    include('functions.php');     
    cors();
    if(checkLogin()){
        header("Location: dashboard.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            login();
        }else{
    ?>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="Login">
        </form>
        <a href="register.php">Register</a>
    <?php }?>
</body>
</html>