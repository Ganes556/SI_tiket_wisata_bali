<?php
include "controller.php";
$wisata = dashboard();
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
    <!-- bootstrap css -->
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- bootstrap js -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery-3.6.0.js"></script>
    <!-- custom css  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- favicon -->
    <link rel="icon" type="image/png" href="./assets/img/Logo.png" />
    <title>Dashboard</title>
</head>

<body>

    <head>
        <nav class="navbar sticky-top shadow navbar-expand-lg navbar-accent mb-5">
            <div class="container-fluid px-3 d-flex justify-content-between">
                <a class="navbar-brand me-auto" href="#">
                    <img class="img-fluid" src="./assets/img/Logo.png" alt="Logo">
                </a>
                <div class="navbar-nav ms-auto d-flex align-items-center">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <!-- check if transaksi exist -->
                        <?php if (isset($_SESSION['transaksi'])) {
                            $allTransaksi = $_SESSION['transaksi']; ?>
                            <button class="btn btn-danger me-3 px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPembayaran">PEMBAYARAN</button>
                        <?php } ?>
                        <div class="dropdown">
                            <a data-toggle="dropdown" id="dropdownMenu2" aria-expanded="false">
                                <img src="./assets/img/user.png" width="50px" height="50px" alt="" srcset="">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a class="btn px-5 me-3 btn-custom text-decoration-none fw-bold" href="register.php">REGISTER</a>
                        <a class="px-5 btn btn-warning text-white fw-bold" href="login.php">LOGIN</a>
                    <?php } ?>
                </div>
            </div>
            </div>
        </nav>
    </head>

    <section class="mb-3">
        <div class="d-flex justify-content-center">
            <div class="search-bar border-warning py-2 px-3 mb-3 d-flex justify-content-center">
                <button class="btn-search me-2" name="search" type="button">
                    <svg width="20" height="20" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 22H23.42L22.86 21.46C24.82 19.18 26 16.22 26 13C26 5.82 20.18 0 13 0C5.82 0 0 5.82 0 13C0 20.18 5.82 26 13 26C16.22 26 19.18 24.82 21.46 22.86L22 23.42V25L32 34.98L34.98 32L25 22ZM13 22C8.02 22 4 17.98 4 13C4 8.02 8.02 4 13 4C17.98 4 22 8.02 22 13C22 17.98 17.98 22 13 22Z" fill="#FFB72B" />
                    </svg>
                </button>
                <input type="text" id="search" class="search-input  fw-semibold" type="search" placeholder="CARI WISATA">
            </div>
        </div>
    </section>

    <!-- wisata -->
    <section class="mb-3">
        <div class="container-fluid">
            <div class="row row-cols-md-4" id="container-wisata">
                <!-- if wisata exist -->
                <?php if ($wisata) {
                    //  get data wisata
                    foreach ($wisata as $key => $w) { ?>
                        <div class="col" id="container-<?= $w['IdWisata']?>">
                            <div class="card shadow border-0 mb-4" style="width: 18rem;">
                                <img src="<?= $w['UrlThumbnailWST'] ?>" height="150px" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="card-title d-flex flex-column">
                                        <div class="fw-bold fs-5">
                                            <?= $w['Nama'] ?>
                                        </div>
                                        <div class="fw-bold fs-5 text-warning">
                                            Rp. <?= number_format($w['Harga']/1000,3, '.',"") // formating to idr?>/Tiket
                                        </div>
                                    </div>
                                    <p class="card-text fw-light truncate-text"><?= $w['Deskripsi'] ?></p>
                                    <div class="">
                                        <a href="http://localhost/project_UAS/detailWisata.php?id=<?= $w['IdWisata'] ?>" class="btn btn-custom px-4 text-warning fw-bold text-uppercase">Detail</a>

                                        <button name='' type="button" <?php
                                                                                if (!isset($_SESSION['user'])) {
                                                                                    echo "onclick=\"location.href='http://localhost/project_UAS/login.php'\"";
                                                                                } else {
                                                                                    echo "onclick=\"clickBeliTiket('".$w['Nama']."',".$w['Harga'].")\"";
                                                                                }
                                                                                ?> class="btn ms-3 btn-warning text-white fw-bold text-uppercase" data-bs-toggle="modal" data-bs-target="#modalTicket">Beli Tiket</button>
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
        <!-- modal beli tiket-->
        <div class="modal fade" id="modalTicket" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="titleModalLabel"></h5>
                        <button type="button" class="btn-close btn-close-warning" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php" method="POST">
                        <div class="modal-body">
                                <div class="mb-3">
                                    <label for="ticket" class="col-form-label">Masukan jumlah tiket yang ingin di beli!</label>
                                    <input type="number" min="1" value="1" class="form-control border-warning " name="tiket" id="tiket">
                                </div>                            
                            <div class="fw-bold">
                                <span>Total Pembelian</span>
                                <span class="text-warning" id="total-pembelian"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-custom fw-bold" data-bs-dismiss="modal">BATAL</button>
                            <button type="submit" name="beliTiket" class="btn btn-warning text-white fw-bold">BELI</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal pembayaran -->
        <div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Lanjutkan Pembayaran</h5>
                        <button type="button" class="btn-close btn-close-warning" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="" class="text-warning fs-6">Lihat daftar no rekening</a>
                        <div class="d-flex justify-content-between mt-3 mb-3">
                            <h6>
                                <span class="text-warning me-1 fw-bold">2 Tiket</span>
                                <span class="fw-bold">Tanah Lot</span>
                            </h6>

                            <a href="" class="text-danger fw-bold fs-6">BATALKAN?</a>
                        </div>
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="fileUpload btn btn-secondary">
                                    <span class="fw-bold">UPLOAD BUKTI PEMBAYARAN</span>
                                    <input type="file" accept="image/*" id="buktiPembayaran" class="upload">
                                </div>
                            </div>

                            <!-- <div class="">                            
                                <label for="buktiPembayaran" class="form-label">Upload bukti pembayaran</label>
                                <input class="form-control btn" type="file" accept="image/*" id="buktiPembayaran">
                            </div>                         -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom fw-bold" data-bs-dismiss="modal">BATAL</button>
                        <button type="button" class="btn btn-warning text-white fw-bold">KONFIRMASI</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="./assets/js/dashboard.js"></script>    
</body>

</html>