<?php
    include('controller.php');

    $status = login();
    // head
    $title = "Login";
    include_once "./template/head.php";
?>
    <div class="container-fluid" style="height: 100%;">
        <div class="row row-cols-2" style="height: 100%;">
            <div class="col p-0" style="height:100%">
                <img class="img-fluid img-login" src="./assets/img/login.png" alt="login image" srcset="">
            </div>
            <div class="col pe-5 py-4 m-auto overflow-auto" style="<?php if (isset($_SESSION['error']["login"]) && count($_SESSION['error']["login"]) > 2) echo 'height:100%' ?>;">
                <div class="row mb-3">
                    <h1 class="fw-bold fs-1">Mari</h1>
                    <h1 class="fw-bold fs-1 text-warning">Berwisata</h1>
                    <h1 class="fw-bold fs-1">Bersama Kami.</h1>
                </div>                
                
                <!-- check error  -->
                <?php if (isset($status['error'])) : ?>
                    <!-- show error message -->
                    <div class="alert alert-danger" role="alert">
                        <?= $status['error'] ?>
                    </div>                    
                <?php endif; ?>

                <div class="row">
                    <form action="login.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name='username' class="form-control input-form" id="username" required placeholder="Username">
                            <label for="username" class="hint">Username</label>
                        </div>
                        <div class="form-floating mb-5">

                            
                            <span id="hide-password" style="cursor: pointer;" class="material-symbols-outlined text-warning me-2 fs-2 position-absolute top-50 end-0 translate-middle-y d-inline-block d-none">visibility</span>
                            <span style="cursor: pointer;" id="show-password" class="material-symbols-outlined text-warning me-2 fs-2 position-absolute top-50 end-0 translate-middle-y d-inline-block">visibility_off</span>                            

                            <input type="password" name="password" class=" form-control input-form" id="password" required placeholder="Password">
                            <label for="password" class="hint">Password</label>
                        </div>
                        <div class="container-fluid p-0 d-flex">
                            <button type="submit" name='login' class="m-auto p-2 btn btn-warning text-white fw-bold fs-4 text-uppercase" style="width: 50%;">Login</button>
                        </div>
                    </form>
                    <div class="container mt-2 text-center"> 
                        <a href="register.php" class="m-auto p-2 text-center text-warning fw-bold fs-5 text-uppercase">Register</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php      
    include_once "./template/footer.php";
?>