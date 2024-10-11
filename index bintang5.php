<?php

include "koneksi.php";

//tamilkan data tabel ikm
$tampil = mysqli_query($koneksi, "SELECT * FROM ikm limit 1");
$data = mysqli_fetch_array($tampil);

//tampung data ke variabel
$id_ikm = $data['id_ikm'];
$sangat_puas = $data['sangat_puas'];
$puas = $data['puas'];
$cukup = $data['cukup'];
$tidak_puas = $data['tidak_puas'];

//ambil nilai keterangan
$keterangan = $_GET['ket'];

//uji jika keterangan tidak kosong
if (isset($keterangan)) {

  //uji jika keterangan = sangat_puas
  if ($keterangan == "sangat_puas") {
    //nilai sangat_puas ditambah 1
    $sangat_puas = $sangat_puas + 1;
    //query update nilai kedalam tabel ikm
    $query = "UPDATE ikm SET sangat_puas = '$sangat_puas' where id_ikm = '$id_ikm' ";
  } elseif ($keterangan == "puas") {
    //nilai puas di tambah 1
    $puas = $puas + 1;
    //query update nilai puas dalam tabel ikm
    $query = "UPDATE ikm SET puas= '$puas' where id_ikm = '$id_ikm' ";
  } elseif ($keterangan == "cukup") {
    //nilai cukup di tambah 1
    $cukup = $cukup + 1;
    //query update nilai cukup dalam tabel ikm
    $query = "UPDATE ikm SET cukup= '$cukup' where id_ikm = '$id_ikm' ";
  } elseif ($keterangan == "tidak_puas") {
    //nilai tidak_puas di tambah 1
    $tidak_puas = $tidak_puas + 1;
    //query update nilai tidak_puas dalam tabel ikm
    $query = "UPDATE ikm SET tidak_puas= '$tidak_puas' where id_ikm = '$id_ikm' ";
  }


  //update data sesuai query
  mysqli_query($koneksi, $query);

if($query){
  echo  "<script> alert('Terimakasih, Anda telah memberikan Penilaian'); 
  document.location='index.php';</script>";
  }

}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <title>MPP | Survei Kepuasan Layanan</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

  <link rel="stylesheet" href="assets/css/sweetalert.css">

</head>


<?php
//koneksi ke database
include "koneksi.php";

//tampilkan data dari tabel ikm (#ikm)
$tampil = mysqli_query($koneksi, "SELECT * FROM ikm");
$data = mysqli_fetch_array($tampil);
?>


<body>

  <!-- head -->
  <div class="head text-center mt-4">
    <img src="assets/img/logo-capil.png" width="400 px">
  </div>
  <!-- end head -->

  <style type="text/css">
    .box {
      padding: 30px 65px;
      border-radius: 20px;
    }

    .hasil {
      padding: 10px 40px;
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

  <!-- Awal Container -->
  <div class="container">
    <!-- <div class="alert alert-warning text-center mt-3" role="alert">SILAHKAN BERI PENILAIAN KUALITAS LAYANAN KAMI DENGAN MEMILIH GAMBAR DIBAWAH INI !!</div> -->

    <div class="row mt-5">
      <!-- Card Option Sangat Puas -->
      <div class="col-md-1"></div>
      <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-primary bg-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">

                <a href="?ket=sangat_puas" title="Klik icon ini jika anda PUAS dengan pelayanan kami">
                  <h4>Sangat Puas</h4>
                  <img src="assets/img/sangatpuas.png" class="img-fluid mb-3">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card Option Puas -->
      <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-success bg-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?ket=puas" title="Klik icon ini jika anda PUAS dengan pelayanan kami">
                  <h4>Puas</h4>
                  <img src="assets/img/puas.png" class="img-fluid">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card Option Cukup -->
      <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-info bg-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?ket=cukup" title="Klik icon ini jika anda KURANG PUAS dengan pelayanan kami">
                  <h4>Cukup</h4>
                  <img src="assets/img/cukup.png" class="img-fluid">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card Option Tidak Puas -->
      <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-warning bg-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?ket=tidak_puas" title="Klik icon ini jika anda TIDAK PUAS dengan pelayanan kami">
                  <h4>Tidak Puas</h4>
                  <img src="assets/img/tidakpuas.png" class="img-fluid">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-warning bg-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?ket=tidak_puas" title="Klik icon ini jika anda TIDAK PUAS dengan pelayanan kami">
                  <h4>Tidak Puas</h4>
                  <img src="assets/img/tidakpuas.png" class="img-fluid">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-1"></div>

    </div>
    <!-- akhir -->
  </div>

                <!-- <div class="row">
                    <div class="col-md-1"> </div>
                    <div class="col-md-5 p-2">
                        <a class="btn btn-danger btn-block text-white" href="login.php">Login Administrator</a>
                    </div>
                </div> -->

  <!-- Footer -->
  <footer class="bg-light text-center text-white mt-3 pb-2 text-muted">
    <!-- Copyright -->
    <div>Copyright &copy <a href=" index.php"> Dinas Dukcapil Kabupaten Gunungkidul</a> 2023 - <?= date("Y") ?> | All Right Reserved | Version: 1.0.0 | <a href="login.php">Login Administrator</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <script src="assets/js/jquery-2.1.4.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <script src="assets/js/sweetalert/sweetalert2.all.min.js"></script>

</body>

</html>