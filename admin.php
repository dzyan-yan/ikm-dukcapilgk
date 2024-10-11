<?php
//buat session start
session_start();

//uji jika sesion telah diset/ tidak
if (
    empty($_SESSION['username'])
    or empty($_SESSION['password'])
    or empty($_SESSION['nama_user'])
) {
    echo "<script> alert('Maaf, Silahkan Login terlebih dahulu...!'); 
	document.location='index.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Admin | Survey Disdukcapil</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">


    <!-- Custom fonts for this template -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="page-top">

    <!-- koneksi ke database -->
    <?php

    include "koneksi.php";
    ?>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-2 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- awal -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <marquee behavior="" direction="">
                                    <span class="mr-2 d-none d-lg-inline text-white">
                                        -- Dukcapil Gunungkidul | Urus Dewe, Gampang, Ora Mbayar !!! --
                                    </span>
                                </marquee>
                            </a>
                        </li>
                        <!-- akhir -->

                        <div class="topbar-divider d-none d-sm-block"> </div>
                        <!-- awal -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <span class="mr-2 d-none d-lg-inline text-white"> Sekarang
                                    <?php date_default_timezone_set("Asia/Jakarta");
                                    echo date("d M Y") ?>
                                </span>
                            </a>
                        </li>
                        <!-- akhir -->

                        <div class="topbar-divider d-none d-sm-block"> </div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white"> Halo,
                                    <?php echo $_SESSION['nama_user'];

                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid bg-light">

<?php
//tampilkan data dari tabel ikm (#ikm)
$tampil = mysqli_query($koneksi, "SELECT * FROM ikm");
$data = mysqli_fetch_array($tampil);
?>

<style type="text/css">
    .box {
        padding: 30px 65px;
        border-radius: 20px;
    }

    .hasil {
        padding: 10px 1px;
        border-radius: 10px;
    }

    h4 {
        color: white;
        text-align: center;
    }

    .teks {
        color: black;
        text-align: center;
    }
</style>

<div>
<div class="container">
    <h5 class="alert alert-danger mt-2 mb-2 text-center" role="alert">Hasil Perolehan Penilaian Sampai Dengan <?php date_default_timezone_set("Asia/Jakarta");
                                echo date("d M Y") ?> </h5>
    <div class="row">
        <div class="col-md-3">
            <div class="bg-primary hasil text-white">
                <h5 class="text-center">Sangat Puas</h5>
                <h5 class="text-center"><?= $data['sangat_puas'] ?></h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-info hasil text-white">
                <h5 class="text-center">Puas</h5>
                <h5 class="text-center"><?= $data['puas'] ?></h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-success hasil text-white">
                <h5 class="text-center">Cukup</h5>
                <h5 class="text-center"><?= $data['cukup'] ?></h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-danger hasil text-white">
                <h5 class="text-center">Tidak Puas</h5>
                <h5 class="text-center"><?= $data['tidak_puas'] ?></h5>
            </div>
        </div>

    </div>
</div>
<hr>

<div class="container">
<div class="row">
    <div class="col-md-7">
        <!-- GRAFIIIIIIIIIIIK -->

  
    <canvas id="myChart" width="auto" height="200px"></canvas>

<script>
    var data = {
        labels: ['Sangat Puas', 'Puas', 'Cukup', 'Tidak Puas'],
        datasets: [{
            label: 'Jumlah Nilai',
            data: [ <?= $data['sangat_puas'] ?>,
                    <?= $data['puas'] ?>,
                    <?= $data['cukup'] ?>,
                    <?= $data['tidak_puas'] ?>
                ],
            backgroundColor: [
                '#0d6efd',
                '#0dcaf0',
                '#198754',
                '#dc3545',
            ],
        }]
    };

    // Membuat grafik
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<!-- GRAFIIIIIIIIIIIK -->
    </div>

    <div class="col-md-5">
        <!-- GRAFIIIIIIIIIIIK PIE -->
    <canvas id="myChart2" width="auto" height="auto "></canvas>

<script>
    var data = {
        labels: ['Sangat Puas', 'Puas', 'Cukup', 'Tidak Puas'],
        datasets: [{
            label: 'Jumlah Nilai',
            data: [ <?= $data['sangat_puas'] ?>,
                    <?= $data['puas'] ?>,
                    <?= $data['cukup'] ?>,
                    <?= $data['tidak_puas'] ?>
                ],
            backgroundColor: [
                '#0d6efd',
                '#0dcaf0',
                '#198754',
                '#dc3545',
            ],
        }]
    };

    // Membuat grafik
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<!-- GRAFIIIIIIIIIIIK -->
    </div>
</div>
</div>
    
</div>

<hr>
    </div>
</div>

</div>

</div>
</div>
<!-- end card body -->

            </div>
        </div>
        <!-- end card body -->
        </div>
        <!-- end card body -->


                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Footer -->

            <footer class="sticky-footer text-center bg-light">
                <div class="copyright text-primary my-auto">
                    <h6>Copyright &copy; Disdukcapil Gunungkidul 2023 - <?= date("Y") ?> | All rights reserved</h6>
                </div>
            </footer>

            <!-- End of Footer -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->


    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Yakin ingin keluar..?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik Oke untuk melanjutkan. <br> Semoga Lelahmu Jadi Ibadah..!!</div>
                <div class="modal-footer">
                    <button onclick="showSweetAlert()" class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="logout.php">Oke</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


</body>

</html>
