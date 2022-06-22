
<header class="<?= $fixedTo ?>">
    <nav class="navbar shadow navbar-expand-lg <?= $navbar ?> mb-5">
        <div class="container-fluid px-3 d-flex justify-content-between">
            <a class="navbar-brand me-auto" href=".">
                <img class="img-fluid" src="./assets/img/Logo.png" alt="Logo">                
            </a>
            <div class="navbar-nav ms-auto d-flex align-items-center">
                <?php if (isset($wisataInTransaksi) && !isset($userProfileHistory)) { ?>
                    <button class="btn btn-danger me-3 px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPembayaran">PEMBAYARAN</button>
                <?php } ?>
                <?php if (isset($_SESSION['user'])) { ?>
                    <div class="dropdown ms-3">
                        <div class="" style="cursor: pointer;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if(isset($_SESSION['user']['UrlGambarProfile'])) : ?> 
                            <img src="<?= $_SESSION['user']['UrlGambarProfile'] ?>" class="rounded-circle border-warning border-2" width="50px" height="50px" alt="" srcset="">                    
                        <?php else: ?>
                            <img src="./assets/img/no-user-profile.png" width="50px" height="50px" alt="" srcset="">
                        <?php endif; ?>                            
                        </div>
                        <ul class="dropdown-menu p-0" style="right: 0; left: auto;" aria-labelledby="dropdownMenuButton1">
                            <li class="border-2 border-bottom" style="border-color: #ffb72b !important;">
                                <a class="dropdown-item fw-bold text-warning fw-bold d-flex px-3 p-2" href="?page=profile">                                    
                                    <div class="material-icons me-1">account_circle</div>
                                    <div>Profile</div>
                                </a>
                            </li>
                            <li class="border-2 border-bottom" style="border-color: #ffb72b !important;">                                
                                <a class="dropdown-item fw-bold text-warning fw-bold d-flex px-3 p-2" href="?page=history">
                                    <div class="material-symbols-outlined me-1">history</div>
                                    <div>History</div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger fw-bold d-flex px-3 p-2" href="index.php?logout=1">                                    
                                    <div class="material-symbols-outlined me-1">logout</div>
                                    <div>Log Out</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <a class="btn px-5 me-3 btn-custom text-decoration-none fw-bold" href="register.php">REGISTER</a>
                    <a class="px-5 btn btn-warning text-white fw-bold" href="login.php">LOGIN</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>