<?php if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === 'admin'):?>

<div class="container">
    <div class="my-1">            
        <h1 class="fw-bold">
            Upload Thumbnail
        </h1>
    </div>
    <!-- tambah -->

    <!-- upload thumbnail -->
    <div class="mt-3">
        <div class="col imgUp">
            <div id="content-thumbnail" data-aksi="upload" class="btn imagePreview position-relative rounded" style="background-image: url('<?= $wisata['UrlThumbnailWST'] ?>');">
                <div data-aksi="upload" class="position-absolute top-50 start-50 translate-middle fw-bold">
                    <!-- tambah -->
                    <svg data-aksi="upload" width="34" height="34" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path data-aksi="upload" d="M28 16H16V28H12V16H0V12H12V0H16V12H28V16Z" fill="white" />
                    </svg>
                    <!-- input thumbnail -->
                </div>
                <input accept="image/*" required id="input-thumbnail" name="input-thumbnail" class="position-absolute top-50 start-50 translate-middle uploadFileImg" type="file" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
            </div>
        </div>
    </div>

    <!-- input not file -->
    <div class="input-group">
        <input type="text" required class="border-warning p-3 w-100 rounded fw-semibold mt-3" id="NamaWisata" placeholder="Nama Wisata">
        <input type="number" required class="border-warning p-3 w-100 rounded fw-semibold my-3" min='0' id="HargaWisata" placeholder="Harga Tiket">

        <textarea class="border-warning p-3 w-100 rounded" required id="DeskripsiWisata" rows="10" placeholder="Deskripsi Wisata"></textarea>
    </div>



    <div class="my-1">
        <h1 class="fw-bold">
            Upload Galeri
        </h1>
    </div>

    <!-- tambah galeri -->
    <!-- //! change data-new-galeri-target match with 'input tag' file id  -->
    <div class="row row-cols-4 gap-3 mb-3 ps-3">
        <div data-aksi="upload-new-galeri"  data-new-galeri-target="1" id="content-new-galeri-1" class="col btn  imagePreview-galeri position-relative rounded">                
            <div data-aksi="upload-new-galeri" data-new-galeri-target='1' class="text-white text-center fs-5 position-absolute top-50 start-50 translate-middle fw-bold">
                <!-- icon add -->
                <svg data-aksi="upload-new-galeri" data-new-galeri-target='1' width="34" height="34" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path data-aksi="upload-new-galeri" data-new-galeri-target='1' d="M28 16H16V28H12V16H0V12H12V0H16V12H28V16Z" fill="white" />
                </svg>
                <!-- input galeri -->
            </div>

            <input accept="image/*" required id="input-new-galeri-1" multiple class="position-absolute top-50 start-50 translate-middle uploadFileImg" type="file" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" multiple>
        </div>
    </div>


    <div class="row row-cols-2 mb-5">
        <div class="col">
            <button class="btn btn-custom w-100 fw-bold" onclick="location.reload()">Batal</button>
        </div>
        <div class="col">
            <button onclick="formEditTambah('tambah')" class="btn btn-warning w-100 fw-bold text-white">Simpan</button>
        </div>
    </div>


</div>

<?php endif; ?>