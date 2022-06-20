<?php 
    include "./controller.php";
    
    extract(adminPanel());  // get allUser, allTransaksiUser, allWisata
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- jquery -->    
    <script src="./assets/js/jquery-3.6.0.js"></script>
    <!-- custom css  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- favicon -->
    <link rel="icon" type="image/png" href="./assets/img/LogoWhite.png" />
    <title>Admin Panel</title>
</head>
<body>    
    <div class="w-100 h-100 row p-0">        
        <!-- navbar side -->
        <div id="navbar-side" class="col-3 bg-secondary d-flex flex-column p-0">
            <div class="mt-4 text-center text-white overflow-hidden">                
                <img class="rounded-circle" height="200px" width="200px" src="./userProfile/a0e170ee7bc2578a63206f07c6ccb268.jpg" alt="" srcset="">                       
                <h1 class="text-warning fw-bold">Anne</h1>
                <h5 class="fw-light">Admin</h5>
            </div>

            <div class="container-fluid mt-2 p-0 border border-2 border-start-0 border-end-0 d-flex flex-column" style="list-style-type: none;border-color: #ffb72b !important;">                    
                <div class="<?php if($_GET['page'] === 'verifikasiTransaksi') echo 'bg-warning' ?> p-3 text-white" onclick="location.href='adminPanel.php?page=verifikasiTransaksi';" style="cursor: pointer;">
                    Verifikasi Transaksi
                </div>
                <div class="<?php if($_GET['page'] === 'kelolaObjek') echo 'bg-warning' ?> text-white p-3" onclick="location.href='adminPanel.php?page=kelolaObjek';" style="cursor: pointer;">
                    Kelola Objek Wisata
                </div>                
            </div>        
            <div class="mt-auto bg-danger text-white p-3" onclick="location.href='adminPanel.php?logout';" style="cursor: pointer;">
                Logout
            </div>  
        </div>

        <div class="col-9 px-3">
            <div class="row p-5 ">
                <div class="col card text-dark bg-warning mb-3 text-white" style="max-width: 18rem;">                        
                    <div class="card-body text-center">
                        <h3 class="card-title fw-bold" >Objek Wisata Terdaftar</h3>
                        <h3 class="fw-bold mt-3"><?= count($allWisata) ?></h3>
                        <p class="card-text">Tempat</p>
                    </div>
                </div>                
                
                <div class="col mx-3  card text-dark bg-warning mb-3 text-white" style="max-width: 18rem;">                        
                    <div class="card-body text-center">
                        <h3 class="card-title fw-bold">Transaksi Hari Ini</h3>
                        <h3 class="fw-bold mt-3"><?= count($allTransaksiUser) ?></h3>
                        <p class="card-text">Transaksi</p>
                    </div>
                </div>
                
                
                <div class="col card text-dark bg-warning mb-3 text-white" style="max-width: 18rem;">                        
                    <div class="card-body text-center">
                        <h3 class="card-title fw-bold">Jumlah Pengguna</h3>   
                        <h3 class="fw-bold mt-3"><?= count($allUser) ?></h3>
                        <p class="card-text">Pengguna</p>
                    </div>                        
                </div>
                
            </div>
            <?php  
                if(isset($_GET["page"])){
                    $page = $_GET["page"];
                    if($page === "verifikasiTransaksi"){
                        include "./template/admin/verifikasiTransaksi.php";
                    }else if($page === "kelolaObjek"){                        
                        include "./template/admin/kelolaObjek.php";
                    }
                }            
            ?>
            
        </div>
    </div>


</body>
<script src="./assets/js/bootstrap.bundle.min.js"></script> 
<script src="./assets/js/adminPanel.js"></script>
</html>