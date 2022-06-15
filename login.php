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
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet"> 
    <!-- bootstrap -->
    <link rel="stylesheet" href="./public/css/bootstrap.css">
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>    
    <script src="./public/js/jquery-3.6.0.js"></script>    
    <!-- custom css  -->
    <link rel="stylesheet" href="./public/css/style.css">
    <title>Login</title>       
</head>
<body>
    <div class="container-fluid" style="height: 100%;">    
        <div class="row row-cols-2 d-flex" style="height: 100%;">
            <div class="col img-login" ></div>
            <div class="col px-5 py-4 m-auto">
                <div class="row mb-5">
                    <h1 class="fw-bold fs-1">Mari</h1>
                    <h1 class="fw-bold fs-1 text-warning">Berwisata</h1>
                    <h1 class="fw-bold fs-1">Bersama Kami.</h1>
                </div> 
                <div class="row">
                    <form action="controllerLogin.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name='username' class="form-control input-form" id="username" placeholder="Psername">
                            <label for="username" class="hint">Username</label>
                        </div>
                        <div class="form-floating mb-5">
                            <input type="password" name="password" class="form-control input-form" id="password" placeholder="Password">
                            <label for="password" class="hint">Password</label>
                        </div>
                        <div class="container-fluid p-0 d-flex">
                            <button type="submit" class="m-auto p-2 btn btn-warning text-white fw-bold fs-4 text-uppercase" style="width: 50%;">Login</button>
                        </div>
                    </form>
                </div>               
                
            </div>
        </div>
    </div>

    <script></script>

    <!-- <?php        
        // if($_SERVER["REQUEST_METHOD"] == "POST"){
        //     login();
        // }else{
    ?>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="Login">
        </form>
        <a href="register.php">Register</a>
    <?php //}?> -->

</body>
</html>