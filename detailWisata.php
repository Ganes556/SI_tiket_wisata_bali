<?php
    include "controller.php";    
    // menu handler profile
    menuProfile();

    $wisata = detailWisata();
    // head
    $title = $wisata['Nama'];
    include_once "./template/head.php";

?>
    <div class="main">
        <?php             
            // navbar
            $fixedTo = "fixed-top";
            $navbar = "navbar-accent-25";
            include_once "./template/navbar.php";
        ?>
        <main>
            <section style="overflow:hidden;">
                <div class="container-fluid p-0 m-0 h-100">
        
                    <div class="img-detail" style="background-image: url('<?= $wisata['UrlThumbnailWST'] ?>');">
                        <div class="fs-4 title"><?= $wisata['Nama'] ?></div>
                    </div>
        
                    <div class="description fw-light p-3">
                        <?= $wisata['Deskripsi'] ?>
                    </div>
        
                    <!-- galeri wisata -->
                    <div class="container mb-5">
                        <h1 class="text-center fw-bold">Foto</h1>
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner p-3">
                                <?php
                                
                                //  looping galeri wisata
                                $UrlImg = array_chunk(unserialize($wisata['UrlGaleriWST']), 3); // split array into 3 parts

                                for ($i = 0; $i < count($UrlImg); $i++) {
                                    if ($i == 0) {
                                        echo '<div class="carousel-item active">';
                                    } else {
                                        echo '<div class="carousel-item">';
                                    }
                                    echo '<div class="d-flex justify-content-center w-100">';
                                    for ($j = 0; $j < count($UrlImg[$i]); $j++) {
                                        if ($j == 1) {
                                            echo '<img class="rounded shadow-sm mx-3" width="200px" height="250px" src="' . $UrlImg[$i][$j] . '" alt="Galeri-' . $i + 1 . '">';
                                        } else {
                                            echo '<img class="rounded shadow-sm" width="200px" height="250px" src="' . $UrlImg[$i][$j] . '" alt="Galeri-' . $i + 1 . '">';
                                        }
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <!-- show button if less than 1 data in UrlImg -->
                            <?php if (count($UrlImg) > 1) { ?>
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
                <?php 
                    include_once "./template/modal/beli-tiket.php";
                    include_once "./template/modal/pembayaran.php";
                    include_once "./template/modal/alert.php";
                ?>
            </section>
        </main>  
    </div>    
<?php     
    include_once "./template/footer.php";
?>