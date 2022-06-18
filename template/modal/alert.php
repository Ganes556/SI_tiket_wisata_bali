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