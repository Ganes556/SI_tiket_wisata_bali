<?php if(isset($_SESSION['user']) && $_SESSION['user']['Role'] === 'admin'):?>
<div class="row px-3 table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr class="text-center">
                <th class="text-nowrap">Tanggal</th>
                <th class="text-nowrap">Nama Pembeli</th>
                <th class="text-nowrap">Nama Wisata</th>
                <th class="text-nowrap">Jumlah</th>
                <th class="text-nowrap">Total</th>
                <th class="text-nowrap">Status</th>
                <th class="text-nowrap">Bukti Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allTransaksiUser as $key => $transaksi) : ?>
                <tr class="text-center">
                    <td class="text-nowrap"><?= date("d/m/Y", $transaksi["TanggalPembelian"]) ?></td>
                    <td class="text-nowrap truncate-1-line"><?= $transaksi["NamaPembeli"] ?></td>
                    <td class="text-nowrap"><?= $transaksi["NamaWisata"] ?></td>
                    <td class="text-nowrap"><?= $transaksi["JumlahTiket"] ?></td>
                    <td class="text-nowrap"><?= totalInIdr($transaksi['Harga'], $transaksi['JumlahTiket']) ?></td>
                    <td class="text-nowrap">
                        <?php $status = $transaksi['StatusPembelian']?>                         
                        <?php if ($status === 'menunggu verifikasi') : ?>
                            <span class="text-warning fw-bold text-capitalize"><?= $transaksi['StatusPembelian'] ?></span>
                        <?php elseif ($status === 'menunggu pembayaran') : ?>
                            <span class="text-secondary fw-bold text-capitalize"><?= $transaksi['StatusPembelian'] ?></span>
                        <?php elseif ($status === 'kadaluarsa') : ?>
                            <span class="fw-bold text-capitalize" style="color: #CDCDCD !important;"><?= $transaksi['StatusPembelian'] ?></span>                        
                        <?php elseif ($status === 'terverifikasi') : ?>
                            <span class="text-success fw-bold text-capitalize"><?= $transaksi['StatusPembelian'] ?></span>
                        <?php elseif ($status === 'dibatalkan') : ?>
                            <span class="text-danger fw-bold text-capitalize"><?= $transaksi['StatusPembelian'] ?></span>
                        <?php elseif ($status === 'ditolak') : ?>
                            <span class="fw-bold text-capitalize" style="color:#893428 !important"><?= $transaksi['StatusPembelian'] ?></span>
                        <?php endif ?>
                    </td>
                    <td class="text-nowrap">
                        <?php if ($transaksi["UrlBuktiPembayaran"] != null) : ?>
                            <a  class="btn-link" style="cursor:pointer;" data-bs-toggle="modal" onclick="lihatBukti(<?= $transaksi['IdTransaksi'] ?>,`<?= $transaksi['UrlBuktiPembayaran'] ?>`,`<?= $transaksi['NamaPembeli'] ?>`)" data-bs-target="#modalVerifikasi">Lihat</a>
                        <?php else : echo '-';
                        endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
<!-- modal verifikasi -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-labelledby="modalVerifikasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header fs-5">
                <h5 class="modal-title" id="modalVerifikasiLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >                
            </div>
            <div class="modal-footer">
                <button type="button" onclick="btnVerifikasi(false)" class="btn btn-tolak fw-bold" data-bs-dismiss="modal">Tolak</button>
                <button type="button" onclick="btnVerifikasi(true)" class="btn btn-warning text-white fw-bold">Verifikasi</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>