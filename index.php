<?php

    include "controller.php";
    // user
    if(isset($_SESSION['user']) && isset($_GET['page'])){
        user();
        // profile
        if($_GET['page'] === "profile"){                    
            include_once "./template/user/profile.php";
            die();
        }
        if($_GET['page'] === "history"){
            $historyTransaksiUser = getHistoryTransaksiUser($_SESSION['user']['IdUser']);            
            include_once "./template/user/history.php";
            die();
        }
        
    }
    // dashboard
    $wisata = dashboard();
    // head 
    $title = "Dashboard";
    include_once "./template/head.php";
?>
    <div class="main">    
        <?php             
            // navbar
            $fixedTo = "sticky-top";
            $navbar = $navbar = "navbar-accent";
            include_once "./template/navbar.php";
        ?>        
        <main class="my-3">
            <!-- search -->
            <section class="mb-3">
                <div class="d-flex justify-content-center">
                    <div class="search-bar border-warning py-2 px-3 mb-3 d-flex justify-content-center">
                        <button class="btn-search me-2" name="search" type="button">
                            <svg width="20" height="20" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M25 22H23.42L22.86 21.46C24.82 19.18 26 16.22 26 13C26 5.82 20.18 0 13 0C5.82 0 0 5.82 0 13C0 20.18 5.82 26 13 26C16.22 26 19.18 24.82 21.46 22.86L22 23.42V25L32 34.98L34.98 32L25 22ZM13 22C8.02 22 4 17.98 4 13C4 8.02 8.02 4 13 4C17.98 4 22 8.02 22 13C22 17.98 17.98 22 13 22Z" fill="#FFB72B" />
                            </svg>
                        </button>
                        <input id="search" class="search-input  fw-semibold" type="search" placeholder="CARI WISATA">
                    </div>
                </div>
            </section>
            
            <!-- wisata -->
            <section>
                <div class="container-fluid">
                    <div class="row row-cols-md-4" id="container-wisata">
                        <!-- if wisata exist -->
                        <?php if ($wisata) {
                            //  get data wisata
                            foreach ($wisata as $key => $w) { ?>
                                <div class="col" id="container-<?= $w['IdWisata'] ?>">
                                    <div class="card shadow border-0 mb-4" style="width: 18rem;">
                                        <img src="<?= $w['UrlThumbnailWST'] ?>" height="150px" class="card-img-top" alt="<?= $w['Nama'] ?>">
                                        <div class="card-body">
                                            <div class="card-title d-flex flex-column">
                                                <div class="fw-bold fs-5 nowrap-1-line ">
                                                    <?= $w['Nama'] ?>
                                                </div>
                                                <div class="fw-bold fs-5 text-warning">
                                                    <?= totalInIdr($w['Harga'], 1) // formating to idr
                                                        ?>/Tiket
                                                </div>
                                            </div>
                                            <p class="card-text fw-light truncate-text"><?= $w['Deskripsi'] ?></p>
                                            <div class="">
                                                <a href="http://localhost/project_UAS/detailWisata.php?id=<?= $w['IdWisata'] ?>" class="btn btn-custom px-4 text-warning fw-bold text-uppercase">Detail</a>

                                                <button name='' type="button" <?php
                                                                                if (!isset($_SESSION['user'])) {
                                                                                    echo "onclick=\"location.href='http://localhost/project_UAS/login.php'\"";
                                                                                } else {
                                                                                    echo "onclick=\"clickBeliTiket('" . $w['Nama'] . "'," . $w['Harga'] . "," . $w['IdWisata'] . ")\"";
                                                                                    echo 'data-bs-toggle="modal" data-bs-target="#modalTicket"';
                                                                                }
                                                                                ?> class="btn ms-3 btn-warning text-white fw-bold text-uppercase">Beli Tiket</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                </div>
            </section>

            <!-- modal -->
            <section>
                <?php 
                    include_once "./template/modal/beli-tiket.php";
                    include_once "./template/modal/pembayaran.php";
                    include_once "./template/modal/alert.php";
                ?>
            </section>

        </main>
    </div>

<?php     
    include_once "./template/footer.php" 
?>