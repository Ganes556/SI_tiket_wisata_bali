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