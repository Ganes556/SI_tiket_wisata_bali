<?php     
    include('controller.php');
    register();
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
    <title>Register</title>
</head>
<body>        
    <div class="container-fluid" style="height: 100%; ">    
        <div class="row row-cols-2" style="height: 100%;">
            <div class="col p-4 m-auto <?php if($_SESSION['error'] || $_SESSION['msg']) echo 'overflow-auto'?>" style="height: 100%;">
                 
                <div class="row px-4 mb-5"> 
                    <h1 class="m-0 p-0 mb-1 fw-bold fs-1">Selamat Datang!</h1>                    
                    <div class="box-line mb-4"></div>
                    
                    <?php if($_SESSION['error']){ ?>
                        <div class="alert alert-danger">
                            <?php foreach($_SESSION['error'] as $error){ ?>
                                <?php echo $error ?><br>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if($_SESSION['msg']){?>
                        <div class="alert alert-success">
                            <?php foreach($_SESSION['msg'] as $msg){ ?>
                                <?php echo $msg ?><br>
                            <?php } ?>
                        </div>
                    <?php }; ?>

                    <form class="m-0 p-0" action="register.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" required name='username' class="form-control input-form" id="username" placeholder="Username">
                            <label for="username" class="hint">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" required name="password" class="form-control input-form" id="password" placeholder="Password">
                            <label for="password" class="hint">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required name='nama' class="form-control input-form" id="nama" placeholder="nama">
                            <label for="nama" class="hint">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required name='noTelp' class="form-control input-form" id="noTelp" placeholder="No Telepon">
                            <label for="noTelp" class="hint">No Telepon</label>
                        </div>                        
                        <div class="form-floating mb-5">
                            <input type="text" required name='alamat' class="form-control input-form" id="alamat" placeholder="Alamat">
                            <label for="alamat" class="hint">Alamat</label>
                        </div>
                        <div class="container-fluid p-0 d-flex">
                            <button type="submit" name="register" class="m-auto p-2 btn btn-warning text-white fw-bold fs-4 text-uppercase" style="width: 50%;">Register</button>
                        </div>
                    </form>
                </div>                      
            </div>
            <div class="col img-register" ></div>
        </div>
    </div>    

</body>
</html>