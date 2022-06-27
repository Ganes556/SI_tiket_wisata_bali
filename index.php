<?php

    include "controller.php";
    
    // menu handler profile
    menuProfile();
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
                        <?php if ($wisata) :
                            //  get data wisata
                            foreach ($wisata as $key => $w) : ?>
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

                                                <?php if(!isset($_SESSION['user'])): ?>
                                                    <button name='' type="button" onclick="location.href='http://localhost/project_UAS/login.php'" class="btn ms-3 btn-warning text-white fw-bold text-uppercase">Beli Tiket</button>
                                                <?php else: ?>
                                                    <button name='' type="button" onclick="clickBeliTiket('<?=$w['Nama'] ?>',<?=$w['Harga']?> , <?=$w['IdWisata']?>)" data-bs-toggle="modal" data-bs-target="#modalTicket" class="btn ms-3 btn-warning text-white fw-bold text-uppercase">Beli Tiket</button>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </section>

            <!-- icon WA -->
            <div style="position: fixed; bottom: 20px; right: 20px;cursor:pointer;" onclick="window.open('https://wa.me/085330096712')">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#43bd52" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                </svg>
            </div>
            
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