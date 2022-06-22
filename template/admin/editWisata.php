<?php if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === 'admin'):?>
<div class="container">
    <div class="my-1">
        <input type="hidden" id="IdWisata" value="<?= $wisata['IdWisata'] ?>">
        <h1 class="fw-bold">
            Upload Thumbnail
        </h1>
    </div>    
    <!-- upload thumbnail -->
    <div class="mt-3">
        <div class="col imgUp">
            <div id="content-thumbnail" data-aksi="upload" class="btn imagePreview position-relative rounded" style="background-image: url('<?= $wisata['UrlThumbnailWST'] ?>');">
                <div data-aksi="upload" class="position-absolute top-50 start-50 translate-middle fw-bold">
                    <!-- edit -->
                    <svg data-aksi="upload" width="73" height="73" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path data-aksi="upload" d="M0 58.0002V73.0002H15L59.24 28.7602L44.24 13.7602L0 58.0002ZM70.84 17.1602C72.4 15.6002 72.4 13.0802 70.84 11.5202L61.48 2.16023C59.92 0.600234 57.4 0.600234 55.84 2.16023L48.52 9.48023L63.52 24.4802L70.84 17.1602Z" fill="white" />
                    </svg>
                    <!-- input thumbnail -->
                </div>
                <input accept="image/*" id="input-thumbnail" name="input-thumbnail" class="position-absolute top-50 start-50 translate-middle uploadFileImg" type="file" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">

            </div>
        </div>
    </div>

    <!-- input not file -->
    <div class="input-group">
        <input type="text" class="border-warning p-3 w-100 rounded fw-semibold mt-3" id="NamaWisata" placeholder="<?= $wisata['Nama'] ?>" value="<?= $wisata['Nama'] ?>">
        <input type="number" class="border-warning p-3 w-100 rounded fw-semibold my-3" min='0' id="HargaWisata" value="<?= $wisata['Harga'] ?>" placeholder="<?= totalInIdr($wisata['Harga'],1) . '/Tiket' ?>">
        <!-- <input type="text" class="border-warning p-3 w-100 rounded fw-semibold" id="NoRekeningWisata" value="<? //unserialize($wisata['NoRekening']) ?>"> -->

        <textarea class="border-warning p-3 w-100 rounded" id="DeskripsiWisata" rows="10" placeholder="<?= $wisata['Deskripsi'] ?>"><?= $wisata['Deskripsi'] ?></textarea>        
    </div>



    <div class="my-1">
        <h1 class="fw-bold">
            Upload Galeri
        </h1>
    </div>

    <div class="row row-cols-4 gap-3 mb-3 ps-3">
        <?php foreach (unserialize($wisata['UrlGaleriWST']) as $key => $value) : ?>
            <div data-aksi="upload-galeri" id="content-galeri-<?= $key ?>" data-galeri-target="<?= $key ?>" class="col btn  imagePreview-galeri position-relative rounded" style="background-image: url('<?= $value ?>');">

                <div data-aksi="upload-galeri" data-galeri-target="<?= $key ?>"  class="position-absolute top-50 start-50 translate-middle fw-bold">
                    <svg data-aksi="upload-galeri" data-galeri-target="<?= $key ?>" width="73" height="73" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path data-aksi="upload-galeri" data-galeri-target="<?= $key ?>" d="M0 58.0002V73.0002H15L59.24 28.7602L44.24 13.7602L0 58.0002ZM70.84 17.1602C72.4 15.6002 72.4 13.0802 70.84 11.5202L61.48 2.16023C59.92 0.600234 57.4 0.600234 55.84 2.16023L48.52 9.48023L63.52 24.4802L70.84 17.1602Z" fill="white" />
                    </svg>
                    <!-- input galeri -->
                </div>
                <input accept="image/*" id="input-galeri-<?= $key ?>" class="position-absolute top-50 start-50 translate-middle uploadFileImg" type="file" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
            </div>
        <?php endforeach; ?>
        
        <div data-aksi="upload-new-galeri" id="content-new-galeri-<?= $key + 1 ?>" data-new-galeri-target="<?= $key+1 ?>" class="col btn  imagePreview-galeri position-relative rounded">
            <div data-aksi="upload-new-galeri" data-new-galeri-target="<?= $key+1 ?>"  class="text-white text-center fs-5 position-absolute top-50 start-50 translate-middle fw-bold">
                <!-- 100 image dipilih -->                    
                <svg  data-aksi="upload-new-galeri" data-new-galeri-target="<?= $key+1 ?>" width="34" height="34" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path data-aksi="upload-new-galeri"  d="M28 16H16V28H12V16H0V12H12V0H16V12H28V16Z" fill="white" />
                </svg>
                <!-- input galeri -->
            </div>
            <input accept="image/*" id="input-new-galeri-<?= $key + 1 ?>" multiple class="position-absolute top-50 start-50 translate-middle uploadFileImg" type="file" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" multiple>
        </div>
    </div>


    <div class="row row-cols-2 mb-5">
        <div class="col">
            <button class="btn btn-custom w-100 fw-bold" onclick="location.reload()">Batal</button>
        </div>
        <div class="col">
            <button onclick="formEditTambah('edit')" class="btn btn-warning w-100 fw-bold text-white">Simpan</button>
        </div>
    </div>

</div>
<?php endif;?>