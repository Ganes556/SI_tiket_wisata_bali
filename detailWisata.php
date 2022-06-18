<?php 
    include "controller.php";
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
    <!-- bootstrap -->
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery-3.6.0.js"></script>
    <!-- custom css  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- favicon -->
    <link rel="icon" type="image/png" href="./assets/img/Logo.png" />
    <title>Wisata</title>
</head>

<body>
    
    <head>
        <nav class="navbar fixed-top navbar-expand-lg navbar-transparent mb-5">
            <div class="container-fluid px-3 d-flex justify-content-between">
                <a class="navbar-brand me-auto" href="index.php">
                    <img class="img-fluid" src="./assets/img/Logo.png" alt="Logo">
                </a>            
                <div class="navbar-nav ms-auto d-flex align-items-center">

                    <button class="px-5 btn btn-warning text-white fw-bold" <?php if(!isset($_SESSION['id'])) echo "onclick=\"location.href='http://localhost/project_UAS/login.php'\"" ?> data-bs-toggle="modal" data-bs-target="#modalTicket" data-bs-whatever="" >BELI TIKET</button>                    
                    <?php if (isset($_SESSION['user'])) {?>                        
                        <a href="" class="ms-3">
                            <img src="./assets/img/user.png" width="50px" height="50px" alt="" srcset="">
                        </a>
                    <?php } ?>
                </div>
            </div>
            </div>
        </nav>
    </head>
    <section style="overflow:hidden;">
        <div class="container-fluid p-0 m-0 h-100">
            <div class="img-detail">
                <div class="fs-4 title">Tanah Lot</div>
            </div>
            <div class="description fw-light p-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, non excepturi odio minima optio neque eos est temporibus, earum quia atque cupiditate veritatis eveniet eum sunt necessitatibus vero quam id nisi at, tenetur molestias numquam. Suscipit iste provident perspiciatis, vel, soluta voluptatibus laudantium atque vitae omnis ut repellendus fuga natus vero odio laboriosam ipsa? Laudantium saepe nesciunt error accusamus delectus?
            </div>
            
            <!-- daftar foto wisata -->
            <div class="container mb-5">
                <h1 class="text-center fw-bold">Foto</h1>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner p-3">
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center w-100">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm" alt="...">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm mx-3" alt="...">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm" alt="...">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center w-100">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm" alt="...">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm mx-3" alt="...">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm" alt="...">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center w-100">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm" alt="...">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm mx-3" alt="...">
                                <img src="https://source.unsplash.com/250x250?tanah lot" class="img-fluid rounded shadow-sm" alt="...">
                            </div>
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>


        </div>
    </section>
    
    <!-- modal -->
    <section>
        <!-- modal beli tiket-->
        <div class="modal fade" id="modalTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Tanah Lot</h5>
                        <button type="button" class="btn-close btn-close-warning" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="ticket" class="col-form-label">Masukan jumlah tiket yang ingin di beli!</label>
                                <input type="number" min="1" value="1" class="form-control border-warning " name="ticket" id="ticket">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom fw-bold" data-bs-dismiss="modal">BATAL</button>
                        <button type="button" class="btn btn-warning text-white fw-bold">BELI</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>