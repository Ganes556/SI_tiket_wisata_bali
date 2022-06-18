<?php
include "controller.php";
    $wisata = detailWisata();
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
    <link rel="icon" type="image/png" href="./assets/img/LogoWhite.png" />
    <title><?=$wisata['Nama']?></title>
</head>

<body>

    <head>
        <nav class="navbar fixed-top navbar-expand-lg navbar-accent-25 mb-5">
            <div class="container-fluid px-3 d-flex justify-content-between">
                <a class="navbar-brand me-auto" href="index.php">
                    <img class="img-fluid" src="./assets/img/Logo.png" alt="Logo">
                </a>
                <div class="navbar-nav ms-auto d-flex align-items-center">
                    <?php if (isset($wisataInTransaksi)) {?>                            
                            <button class="btn btn-danger me-3 px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPembayaran">PEMBAYARAN</button>
                    <?php }else{ ?>
                        <button class="px-5 btn btn-warning text-white fw-bold" <?php if (!isset($_SESSION['user']))    {      
                            echo "onclick=\"location.href='http://localhost/project_UAS/login.php'\"" ;?>
                            <?php }else{ 
                                echo 'data-bs-toggle="modal" data-bs-target="#modalTicket"';
                                echo "onclick='clickBeliTiket(`{$wisata["Nama"]}`,{$wisata["Harga"]},{$wisata["IdWisata"]})'";
                            }?>
                                >BELI TIKET</button>
                    <?php } ?>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <!-- dropdown from bootstrap -->
                        <div class="dropdown ms-3">                            
                            <div class="" style="cursor: pointer;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./assets/img/user.png" width="50px" height="50px" alt="" srcset="">
                            </div>  
                            <ul class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item text-danger" href="detailWisata.php?logout=1">Logout</a></li>                                
                            </ul>
                        </div>

                    <?php } ?>
                </div>
            </div>
            </div>
        </nav>
    </head>
    <section style="overflow:hidden;">
        <div class="container-fluid p-0 m-0 h-100">
            
            <div class="img-detail" style="background-image: url('<?= $wisata['UrlThumbnailWST'] ?>');">
                <div class="fs-4 title"><?= $wisata['Nama']?></div>
            </div>

            <div class="description fw-light p-3">
                <?= $wisata['Deskripsi'] ?>
            </div>

            <!-- daftar foto wisata -->
            <div class="container mb-5">
                <h1 class="text-center fw-bold">Foto</h1>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner p-3">
                        <?php 
                            //  looping galeri wisata
                           $UrlImg = array_chunk(unserialize($wisata['UrlGaleriWST']),3); // split array into 3 parts
                           for($i=0;$i<count($UrlImg);$i++){
                                 if($i==0){
                                      echo '<div class="carousel-item active">';
                                 }else{
                                      echo '<div class="carousel-item">';
                                 }
                                    echo '<div class="d-flex justify-content-center w-100">';
                                        for($j=0;$j<count($UrlImg[$i]);$j++){
                                            if($j==1){
                                                echo '<img class="img-fluid rounded shadow-sm mx-3" width="200px" height="200px" src="'.$UrlImg[$i][$j].'" alt="Galeri-'. $i+1 .'">';
                                            }else{
                                                echo '<img class="img-fluid rounded shadow-sm" width="200px" height="200px" src="'.$UrlImg[$i][$j].'" alt="Galeri-'. $i+1 .'">';
                                            }

                                        }
                                    echo '</div>';
                                echo '</div>';
                           }
                        ?>

                    </div>
                    <!-- show button if less than 1 data in UrlImg -->
                    <?php if(count($UrlImg) > 1) {?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    <?php } ?>
                </div>
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
                                
                                <a href="detailWisata.php?batalkan=<?= $transaksi["IdTransaksi"] ?>" class="text-danger fw-bold fs-6">BATALKAN?</a>
                            <?php }?>
                        </div>
                        <form enctype="multipart/form-data" method="POST">
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
</body>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
</html>