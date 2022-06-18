<?php             
    include('controller.php');
    login();
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
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>    
    <script src="./assets/js/jquery-3.6.0.js"></script>    
    <!-- custom css  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Login</title>       
</head>
<body>
    <div class="container-fluid" style="height: 100%;">    
        <div class="row row-cols-2" style="height: 100%;">
            <div class="col p-0" style="height:100%">
                <img class="img-fluid img-login" src="./assets/img/login.png" alt="login image" srcset="">
            </div>
            <div class="col pe-5 py-4 m-auto overflow-auto" style="<?php if(count($_SESSION['error']) > 2) echo 'height:100%' ?>;">
                <div class="row mb-3">
                    <h1 class="fw-bold fs-1">Mari</h1>
                    <h1 class="fw-bold fs-1 text-warning">Berwisata</h1>
                    <h1 class="fw-bold fs-1">Bersama Kami.</h1>
                </div>

                <?php if($_SESSION['error']){?>
                    <?php for($i =0; $i < count($_SESSION['error']); $i++) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['error'][$i] ?>
                        </div>
                    <?php } ?>
                <?php }?>
                <div class="row">
                    <form action="login.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name='username' class="form-control input-form <?php if($_SESSION['error']) echo 'is-invalid' ?>" id="username" required placeholder="Username">
                            <label for="username" class="hint">Username</label>                            
                        </div>
                        <div class="form-floating mb-5">
                            <input type="password" name="password" class=" form-control input-form <?php if($_SESSION['error']) echo 'is-invalid' ?>" id="password" required placeholder="Password">
                            <label for="password" class="hint">Password</label>
                        </div>
                        <div class="container-fluid p-0 d-flex">
                            <button type="submit" name='login' class="m-auto p-2 btn btn-warning text-white fw-bold fs-4 text-uppercase" style="width: 50%;">Login</button>
                        </div>                        
                    </form>                    
                    <a href="http://localhost/project_UAS/register.php" class="m-auto p-2 text-center text-warning fw-bold fs-5 text-uppercase">Register</a>
                </div>               
                
            </div>
        </div>
    </div>    
</body>
</html>