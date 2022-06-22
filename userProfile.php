<?php
    include "controller.php";
    userProfile();
    // head
    $title = "User Profile " . $_SESSION['user']["Nama"];
    include_once "./template/head.php";
?>
    <div class="main">
        <?php             
            // navbar
            $fixedTo = "sticky-top";
            $userProfile = 1;
            $navbar = $navbar = "navbar-accent";
            include_once "./template/navbar.php";
        ?>
        <main class="my-3 mb-5">
            <section>
                <div id="content-card-user" class="container rounded shadow-lg p-5">
                    <div class="d-flex">                        
                        <div class="m-auto">
                            <!-- add user -->
                            <?php if(isset($_SESSION['UrlGambarProfile'])):?>    
                                    <div id="user-profile" class="image-profile position-relative mx-auto rounded-circle border-warning border-5" style="background-image:url('<?= $_SESSION['UrlGambarProfile'] ?>')">
                            <?php else:?>
                                    <div id="user-profile" class="image-profile position-relative mx-auto">
                            <?php endif;?>
                                    <img src="./assets/img/add-img.png" class="position-absolute bottom-0 end-0" alt="">
                                    <input type="file" name="" id="input-new-user-profile" class="d-none">
                                </div>
                        </div>                        
                    </div>
    
                    <div class="input-text my-3 d-flex flex-column">
                        <div class="w-50 mx-auto">
                            <div class="form-floating mb-3">
                                <input type="username" value="<?= $_SESSION['user']['Nama'] ?>" required name="username" class="form-control input-form" id="username" placeholder="username">
                                <label for="username" class="hint">Username</label>
                            </div>
    
                            <div class="form-floating mb-3 position-relative">
                                <!-- show  -->
                                <span id="hide-password" style="cursor: pointer;" class="material-symbols-outlined text-warning me-2 fs-2 position-absolute top-50 end-0 translate-middle-y d-inline-block d-none">visibility</span>
                                <!-- hide -->
                                <span style="cursor: pointer;" id="show-password" class="material-symbols-outlined text-warning me-2 fs-2 position-absolute top-50 end-0 translate-middle-y d-inline-block">visibility_off</span>
    
                                <input type="password" value="<?= $_SESSION['user']['Password'] ?>" required name="password" class="form-control input-form" id="password" placeholder="Password">
                                <label for="password" class="hint">Password</label>
                            </div>
    
                            <div class="form-floating mb-3">
                                <input type="text" value="<?= $_SESSION['user']['Nama'] ?>" required name='nama' class="form-control input-form" id="nama" placeholder="nama">
                                <label for="nama" class="hint">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" value="<?= $_SESSION['user']['NomorTelp'] ?>" required name='noTelp' class="form-control input-form" id="noTelp" placeholder="No Telepon">
                                <label for="noTelp" class="hint">No Telepon</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" value="<?= $_SESSION['user']['Alamat'] ?>" required name='alamat' class="form-control input-form" id="alamat" placeholder="Alamat">
                                <label for="alamat" class="hint">Alamat</label>
                            </div>
                            <div class="container-fluid p-0 d-flex">
                                <button type="submit" name="updateUser" class="m-auto py-2 px-3 btn btn-warning text-white fw-bold fs-4 text-uppercase">SIMPAN PERUBAHAN</button>
                            </div>
                        </div>
    
                    </div>
                </div>
            </section>
        </main>
    </div>

<?php 
    $anotherScript = "userProfile.js";
    include "./template/footer.php";
?>