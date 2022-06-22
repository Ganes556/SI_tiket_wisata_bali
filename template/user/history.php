<?php
if (isset($_SESSION['user'])) {
    $title = "User Profile " . $_SESSION['user']["Nama"];
    include_once "./template/head.php";

?>
    <div class="main">
    <?php
        // navbar
        $fixedTo = "sticky-top";
        $userProfileHistory = 1;
        $navbar = "navbar-accent";
        include_once "./template/navbar.php";
    ?>
        <main>
            <section class="container rounded shadow-lg p-5">
                <h1 class="text-warning fw-bold">Histori Transaksi</h1>
                <div class="table-responsive mt-5">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th class="text-nowrap">Tanggal</th>
                                <th class="text-nowrap">Tiket</th>                                
                                <th class="text-nowrap">Jumlah</th>
                                <th class="text-nowrap">Harga</th>
                                <th class="text-nowrap">Total</th>
                                <th class="text-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach($historyTransaksiUser as $key => $value): ?>
                                <tr class="text-center">
                                    <td><?= date("d M Y",$value['TanggalPembelian']) ?></td>
                                    <td><?= $value['NamaWisata'] ?></td>
                                    <td><?= $value['JumlahTiket'] ?></td>
                                    <td><?= totalInIdr($value['Harga'],1) ?></td>
                                    <td><?= totalInIdr($value['Harga'],$value['JumlahTiket']) ?></td>
                                    <td><?= $value['StatusPembelian'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
<?php
    $anotherScript = "userProfile.js";
    include "./template/footer.php";
} else {
    http_response_code(403);
    echo "403 Forbidden!";
}
?>