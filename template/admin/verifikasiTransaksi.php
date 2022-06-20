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
                <?php foreach($allTransaksiUser as $key => $transaksi): ?>
                    <tr class="text-center">
                        <td class="text-nowrap"><?= date("d/m/Y",$transaksi["TanggalPembelian"]) ?></td>
                        <td class="text-nowrap truncate-1-line"><?= $transaksi["NamaPembeli"] ?></td>
                        <td class="text-nowrap"><?= $transaksi["NamaWisata"] ?></td>
                        <td class="text-nowrap"><?= $transaksi["JumlahTiket"] ?></td>
                        <td class="text-nowrap"><?= totalInIdr($transaksi['Harga'],$transaksi['JumlahTiket']) ?></td>
                        <td class="text-nowrap">
                            <?php switch ($transaksi['StatusPembelian']):
                                case "berhasil":?>
                                    <span class="text-success fw-bold">Berhasil</span>
                                <?php break; ?>
                                <?php case "menunggu pembayaran": ?>
                                    <span class="text-secondary fw-bold">Menunggu Pembayaran</span>
                                <?php break; ?>
                                <?php case "menunggu verifikasi": ?>
                                    <span class="text-warning fw-bold">Menunggu Verifikasi</span>
                                <?php break; ?>
                                <?php case "dibatalkan": ?>
                                    <span class="text-danger fw-bold">Dibatalkan</span>
                                <?php break; ?>                                
                            <?php endswitch; ?>
                        </td>
                        <td class="text-nowrap">
                            <?php if($transaksi["UrlBuktiPembayaran"] != null): ?>
                                <a href="<?= $transaksi["UrlBuktiPembayaran"] ?>">Lihat</a>
                            <?php else: echo '-'; endif?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>                    
        </table>                
</div>