 <!-- modal beli tiket-->
 <div class="modal fade" id="modalTicket" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title fw-bold" id="titleModalLabel"></h5>
                 <button type="button" class="btn-close btn-close-warning" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="index.php" method="POST">
                 <input type="hidden" name="IdWisata" id="IdWisata">
                 <div class="modal-body">
                     <?php if (isset($wisataInTransaksi)) { ?>
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
                     <button type="button" class="btn btn-custom fw-bold" data-bs-dismiss="modal" onclick="dismissBeliTiket()">BATAL</button>
                     <button type="submit" name="beliTiket" class="btn btn-warning text-white fw-bold">BELI</button>
                 </div>
             </form>
         </div>
     </div>
 </div>