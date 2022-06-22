<?php if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === 'admin'):?>
<!-- card and search -->
    <div class="container ">
        <div class="row align-items-center justify-content-center">
            <div class="col-11 border-warning p-3 d-flex justify-content-center m-0">
                <button class="btn-search me-2" name="search" type="button">
                    <svg width="20" height="20" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 22H23.42L22.86 21.46C24.82 19.18 26 16.22 26 13C26 5.82 20.18 0 13 0C5.82 0 0 5.82 0 13C0 20.18 5.82 26 13 26C16.22 26 19.18 24.82 21.46 22.86L22 23.42V25L32 34.98L34.98 32L25 22ZM13 22C8.02 22 4 17.98 4 13C4 8.02 8.02 4 13 4C17.98 4 22 8.02 22 13C22 17.98 17.98 22 13 22Z" fill="#FFB72B" />
                    </svg>
                </button>
                <input type="text" id="search-admin-panel" class="search-input fw-semibold" type="search" placeholder="CARI WISATA">
            </div>
            <div class="col-1 m-0">
                <button onclick="tambah()" class="btn btn-warning py-3 px-4 rounded">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28 16H16V28H12V16H0V12H12V0H16V12H28V16Z" fill="white" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="container-admin-panel-wisata" class="container-fluid mt-3 justify-content-center pt-2 " style="height: 50px;">
        <!-- card -->
        <?php foreach ($allWisata as $key => $wisata) : ?>
            <div class="d-flex bg-secondary rounded mb-2 p-3 justify-content-between shadow card-wisata">
                <!-- nama wisata -->
                <div class="row gap-3">
                    <div class="col-1 fw-bold text-white fs-4 index-wisata">
                        <?= $key + 1 ?>
                    </div>
                    <div class="col fw-bold text-white fs-4 nama-wisata">
                        <?= $wisata['Nama'] ?>
                    </div>
                </div>
                <!-- aksi -->
                <div class="row">
                    <div class="col">
                        <!-- edit -->
                        <div style="cursor: pointer;" data-aksi="edit" data-id-wisata="<?= $wisata['IdWisata'] ?>" >                        
                            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 29.5001V37.0001H7.5L29.62 14.8801L22.12 7.38012L0 29.5001ZM35.42 9.08012C36.2 8.30012 36.2 7.04012 35.42 6.26012L30.74 1.58012C29.96 0.800117 28.7 0.800117 27.92 1.58012L24.26 5.24012L31.76 12.7401L35.42 9.08012Z" fill="#FFB72B" />
                            </svg>
                        </div>

                    </div>
                    <!-- hapus -->
                    <div class="col">
                        <div onclick="$('#modalHapusWisata .modal-body').html(`Hapus Objek Wisata <span class='text-danger'><?= $wisata['Nama'] ?></span>?`);" data-bs-toggle="modal" 
                        data-aksi="hapus"
                        data-id-wisata="<?= $wisata['IdWisata'] ?>" data-bs-target="#modalHapusWisata" style="cursor: pointer;">
                            <svg width="28" height="36" viewBox="0 0 28 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 32C2 34.2 3.8 36 6 36H22C24.2 36 26 34.2 26 32V8H2V32ZM28 2H21L19 0H9L7 2H0V6H28V2Z" fill="#C91800" />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


<!-- modal -->

    <!-- modal validasi menghapus -->
    <div class="modal fade" id="modalHapusWisata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusWisataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">                
                <div class="modal-body fw-bold fs-4">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom fw-bold" data-bs-dismiss="modal">BATAL</button>
                    <button id="btn-hapus" type="button" class="btn btn-danger fw-bold" oncli >HAPUS</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>