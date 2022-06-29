<?php
    include('controller.php');
    $status = register();
    // head
    $title = "Register";
    include_once "./template/head.php";
?>
    <div class="container-fluid" style="height: 100%; ">
        <div class="row row-cols-2" style="height: 100%;">

            <div class="col p-0" style="height: 100%;">
                <img class="img-fluid img-register" src="./assets/img/register.png" alt="login image">
            </div>

            <div class="col pt-4 pe-5 m-auto <?php if (isset($status['error']) || isset($status['msg'])) echo 'overflow-auto' ?>" style="height: 100%;">
                <div class="row px-4 mb-3">
                    <h1 class="m-0 p-0 mb-3 fw-bold fs-1">Selamat Datang!</h1>
                    <?php if (isset($status['error'])) { ?>
                        <div class="alert alert-danger">
                            <?= $status['error'] ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($status['msg'])) { ?>
                        <div class="alert alert-success">
                            <?= $status['msg'] ?>
                        </div>
                    <?php }; ?>

                    <form class="m-0 p-0" action="register.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" required name='username' class="form-control input-form" id="username" placeholder="Username">
                            <label for="username" class="hint">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <span id="hide-password" style="cursor: pointer;" class="material-symbols-outlined text-warning me-2 fs-2 position-absolute top-50 end-0 translate-middle-y d-inline-block d-none">visibility</span>
                            <span style="cursor: pointer;" id="show-password" class="material-symbols-outlined text-warning me-2 fs-2 position-absolute top-50 end-0 translate-middle-y d-inline-block">visibility_off</span>
                            <input type="password" required name="password" class="form-control input-form" id="password" placeholder="Password">
                            <label for="password" class="hint">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required name='nama' class="form-control input-form" id="nama" placeholder="nama">
                            <label for="nama" class="hint">Nama</label>
                        </div>
                        <div class="form-floating mb-3">                        
                            <input type="tel" pattern="08[0-9]{10}" required name='noTelp' class="form-control input-form" id="noTelp" placeholder="08xxxxxxxxx">
                            <label for="noTelp" class="hint">No Telepon (08xxxxxxxxx)</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" required name='alamat' class="form-control input-form" id="alamat" placeholder="Alamat">
                            <label for="alamat" class="hint">Alamat</label>
                        </div>
                        <div class="container-fluid p-0 d-flex">
                            <button type="submit" name="register" class="m-auto p-2 btn btn-warning text-white fw-bold fs-4 text-uppercase" style="width: 50%;">Register</button>
                        </div>
                    </form>
                    <div class="container mt-2 text-center">
                        <a href="login.php" class="m-auto p-2 text-center text-warning fw-bold fs-5 text-uppercase">login</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php 
    include_once "./template/footer.php";
?>