<?php
    include "./controller.php";

    extract(adminPanel());  // get allUser, allTransaksiUser, allWisata
    
    // head
    $title = "Admin Panel";
    include_once "./template/head.php";
?>
    <div class="w-100 h-100 row m-0 p-0">
        <!-- navbar side -->
        <div id="navbar-side" class="col-3 bg-secondary d-flex flex-column p-0">
            <div class="mt-4 text-center text-white overflow-hidden">
                <!-- admin-icon -->
                <svg width="150" height="150" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="40" r="38" fill="#FFB72B" stroke="#F7F7F7" stroke-width="4" />
                    <g clip-path="url(#clip0_64_184)">
                        <path style="" d="M40 40C43.536 40 46.4 37.136 46.4 33.6C46.4 30.064 43.536 27.2 40 27.2C36.464 27.2 33.6 30.064 33.6 33.6C33.6 37.136 36.464 40 40 40ZM40 43.2C35.728 43.2 27.2 45.344 27.2 49.6V52.8H52.8V49.6C52.8 45.344 44.272 43.2 40 43.2Z" fill="#F7F7F7" />
                    </g>                    
                </svg>
                
                <!-- <img class="rounded-circle"  src="./assets/img/no-user-profile.png" alt="" srcset="">                        -->
                <h1 class="text-warning fw-bold mt-3"><?= $_SESSION['user']["Nama"] ?></h1>
                <h5 class="fw-light"><?= $_SESSION['user']["Role"] ?></h5>
            </div>

            <div class="container-fluid mt-2 p-0 border border-2 border-start-0 border-end-0 d-flex flex-column" style="list-style-type: none;border-color: #ffb72b !important;">
                <div class="<?php if ($_GET['page'] === 'verifikasiTransaksi') echo 'bg-warning' ?> fw-bold p-3 text-white" onclick="location.href='adminPanel.php?page=verifikasiTransaksi';" style="cursor: pointer;">
                    Verifikasi Transaksi
                </div>
                <div class="<?php if ($_GET['page'] === 'kelolaObjek') echo 'bg-warning' ?> fw-bold text-white p-3" onclick="location.href='adminPanel.php?page=kelolaObjek';" style="cursor: pointer;">
                    Kelola Objek Wisata
                </div>
            </div>
            <div class="mt-auto bg-danger text-white fw-bold p-3" onclick="location.href='adminPanel.php?logout';" style="cursor: pointer;">
                Log Out
            </div>
        </div>

        <div class="col-9 px-3 overflow-auto h-100">
            <div class="row p-5 ">
                <div class="col card bg-warning mb-3 text-white">
                    <div class="card-body text-center">
                        <h3 class="card-title fw-bold">Objek Wisata Terdaftar</h3>
                        <h3 class="fw-bold mt-3"><?= count($allWisata) ?></h3>
                        <p class="card-text">Tempat</p>
                    </div>
                </div>

                <div class="col mx-3 card bg-warning mb-3 text-white">
                    <div class="card-body text-center">
                        <h3 class="card-title fw-bold">Transaksi Hari Ini</h3>
                        <h3 class="fw-bold mt-3"><?= count($allTransaksiUser) ?></h3>
                        <p class="card-text">Transaksi</p>
                    </div>
                </div>


                <div class="col card bg-warning mb-3 text-white">
                    <div class="card-body text-center">
                        <h3 class="card-title fw-bold">Jumlah Pengguna</h3>
                        <h3 class="fw-bold mt-3"><?= count($allUser) ?></h3>
                        <p class="card-text">Pengguna</p>
                    </div>
                </div>

            </div>

            <?php
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                    if ($page === "verifikasiTransaksi") {
                        include "./template/admin/verifikasiTransaksi.php";
                    } else if ($page === "kelolaObjek") {
                        include "./template/admin/kelolaObjek.php";
                    }
                }
            ?>

        </div>
    </div>
<?php 
    $anotherScript = "adminPanel.js";
    include_once "./template/footer.php";
?>