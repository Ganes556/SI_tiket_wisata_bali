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
    <!-- jquery -->    
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
                    <?php if (isset($wisataInTransaksi)) {?>                            
                            <button class="btn btn-danger me-3 px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPembayaran">PEMBAYARAN</button>
                    <?php } ?>

                    <?php if(isset($_SESSION['user'])){ ?>
                        <div class="dropdown ms-3">                            
                            <div class="" style="cursor: pointer;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./assets/img/user.png" width="50px" height="50px" alt="" srcset="">
                            </div>  
                            <ul class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item text-danger" href="index.php?logout=1">Logout</a></li>                                
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
                                                                                    echo "onclick=\"clickBeliTiket('".$w['Nama']."',".$w['Harga'].",".$w['IdWisata'].")\"";
                                                                                    echo 'data-bs-toggle="modal" data-bs-target="#modalTicket"';
                                                                                }
                                                                                ?>  class="btn ms-3 btn-warning text-white fw-bold text-uppercase">Beli Tiket</button>
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
                    <form method="POST">                        
                        <input type="hidden" name="IdWisata" id="IdWisata">
                        <div class="modal-body">
                        <?php if(isset($wisataInTransaksi)){?>                            
                            <div class="alert alert-danger" role="alert">
                                Selesaikan/batalkan pembayaran, sebelum memesan tiket lain!
                            </div>
                        <?php } ?>
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
                        <!-- msg if transaksi exist -->
                        <h6>Lakukan pembayaran
                            <?php if(isset($wisataInTransaksi))
                                echo "<span class='fw-bold'>";
                                echo "Rp. " . number_format(($transaksi["JumlahTiket"] * $wisataInTransaksi['Harga'])/1000,3, '.',""); // formating to idr
                                echo "</span>";
                                echo " sebelum";
                                echo "<span class='fw-bold'>";
                                echo " " . date("d M Y",$transaksi["TanggalPembelian"] + (24 * 60 * 60)); // add expired time 24 hours
                                echo "</span>";
                            ?>
                        </h6>
                        <!-- set rekening -->
                        <?php if(isset($wisataInTransaksi)){?>
                            <div class="daftar-rekening">
                                <div class="fw-bold fs-6">
                                    Daftar rekening:
                                </div>
                                <div class="ps-2">                                    
                                    <?php 
                                        $noRek = unserialize($wisataInTransaksi['NoRekening']);
                                        foreach($noRek as $n => $d ){                                            
                                            echo "{$d['nama_bank']} - <span class='text-warning fw-bold'>{$n}</span> - {$d['atas_nama']} <br>";
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- set transaksi -->
                        <div class="d-flex justify-content-between mt-3 mb-3">
                            <?php if(isset($wisataInTransaksi)) {?>
                                <h6>
                                    <span class="text-warning me-1 fw-bold"><?=$transaksi['JumlahTiket']?></span>
                                    <span class="fw-bold"><?= $wisataInTransaksi['Nama'] ?></span>
                                </h6>
                                
                                <a href="index.php?batalkan=<?= $transaksi["IdTransaksi"] ?>" class="text-danger fw-bold fs-6">BATALKAN?</a>
                            <?php }?>
                        </div>
                        <form enctype="multipart/form-data" method="POST">
                            <!-- id transaksi -->
                            <input type="hidden" name="IdTransaksi" value="<?= $transaksi["IdTransaksi"] ?>">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label fw-bold">Upload Bukti Pembayaran</label>
                                    <input class="form-control" required  name="buktiPembayaran" type="file" id="formFile" accept="image/*">
                                </div>      
                            </div>                           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom fw-bold" data-bs-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-warning text-white fw-bold">KONFIRMASI</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal alert -->
        <?php if(isset($_SESSION['error']['bukti-pembayaran'])) {
                echo 
                "
                    <script>
                        $(document).ready(() => {
                            let err = `<div class='alert alert-danger' role='alert'>
                                        {$_SESSION['error']['bukti-pembayaran']}
                                        </div>
                                    `;             
                            $('#modalAlert .modal-header').removeClass('bg-success');               
                            $('#modalAlert .modal-header').addClass('bg-danger');
                            $('#modalAlertLabel').text(`Pesan Error`);
                            $('#modalAlert .modal-dialog .modal-body').html(err);
                            $('#modalAlert').modal('show');
                        })
                    </script>
                ";
                unset($_SESSION['error']['bukti-pembayaran']);
            }else if( isset($_SESSION['msg']['bukti-pembayaran'])) {
                echo 
                "
                    <script>
                        $(document).ready(() => {
                            let err = `<div class='alert alert-success' role='alert'>
                                        {$_SESSION['msg']['bukti-pembayaran']}
                                        </div>
                                    `;            
                            $('#modalAlert .modal-header').removeClass('bg-danger');                
                            $('#modalAlert .modal-header').addClass('bg-success');
                            $('#modalAlertLabel').text(`Pesan Sukses`);                            
                            $('#modalAlert .modal-dialog .modal-body').html(err);
                            $('#modalAlert').modal('show');
                        })
                    </script>
                ";
                unset($_SESSION['msg']['bukti-pembayaran']);
            }
        ?>
                
        <div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="modalAlertLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="modalAlertLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
        
    </section>        
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./assets/js/dashboard.js"></script>       -->
    <script src="./assets/js/script.js"></script>      
</body>

</html>