<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico"> -->

    <title>Permintaan G-Suite</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link href="Blog%20Template%20new%202_files/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="Blog%20Template%20new%202_files/css.css" rel="stylesheet">
    <link href="Blog%20Template%20new%202_files/blog.css" rel="stylesheet">
  </head>
  <body  style="cursor: pointer;">
    <div class="mb-4 mt-4">
    <h3><center>Data Permintaan G-Suite</center></h3>
    </div>
    
    <div class="col-lg-12" style="margin-top: 40px;">
          <div class="container">
          <nav class="navbar navbar-light bg-light">
                  <form class="form-inline" method="post" action="datatiket.php">
                    <input name="cari" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button name="search" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
                </nav>
          </div>
        <?php

            $requestData= $_REQUEST;
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tiket";

            $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
                                
            if(isset($_POST['search'])){
              $cari = $_POST['cari'];
              
              $sql = "SELECT * FROM tiket_gsuite where email like '%$cari%' OR id_tiket like '%$cari%' OR tanggal like '%$cari%' OR name like '%$cari%' OR lokasi like '%$cari%' OR kelas like '%$cari%' OR status like '%$cari%'";     
              
            } else {
                $sql = "SELECT * FROM tiket_gsuite";
            }
                                $batas = 5;
                                $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                                $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
                      
                                $previous = $halaman - 1;
                                $next = $halaman + 1;
                                $result = $conn->query($sql);
                                // echo $sql;
                                // var_dump($result);

                                $jumlah_data = mysqli_num_rows($result);
                                $total_halaman = ceil($jumlah_data / $batas);
                    
                                $data_pegawai = mysqli_query($conn,"$sql limit $halaman_awal, $batas");
                                $nomor = $halaman_awal+1;

                                if ($data_pegawai->num_rows > 0) {
                                    while($row = $data_pegawai->fetch_assoc()) {
          ?>
          <div class="container">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary"><?php echo $row["email"]; ?></strong>
              <h3 class="mb-0">
                <a class="text-dark" href="#"><?php echo $row["id_tiket"]; ?></a>
              </h3>
              <div class="mb-1 text-muted"><?php echo $row["tanggal"]; ?></div>
              <div class="mb-3">
                <label for=""> <strong>Problem :</strong></label>
                <?php
                  $kind = '';

                  if ($row["name"]== 3) {
                      $kind = 'Pembuatan Akun G-Suite';
                  } else if ($row["name"] == 2) {
                      $kind = 'Lupa Password';
                  } else {
                      $kind = 'Akun Ditangguhkan';
                  }
                ?>
                <p class="card-text mb-auto"><?php echo $kind; ?></p>
              </div>
              <div class="mb-3">
                <label for=""> <strong>Penanganan :</strong></label>
                <p class="card-text mb-auto"><?php echo ($row["kelas"] != '') ? $row["kelas"] : 'Belum di Proses'; ?></p>
              </div>
              <?php
              $background = $row["status"];
              if ($background == "new") { $background = "btn-primary";
              } else if ($background == "Proses"){ $background = "btn-warning";
              } else { $background = "btn-success"; }

            ?>
              <button type="button" class="btn <?php echo $background; ?>"><?php echo $row["status"]; ?></button>    
            </div>
            <?php 

                $url = "image200500.png";
              
            ?>
            <img class="card-img-right flex-auto d-none d-md-block"  alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="image/<?php echo $url; ?>" data-holder-rendered="true">
          </div>
          </div>
        <?php }} ?>
   
      </div>
      
      
      <div class="container">
            <nav>
            <ul class="pagination justify-content-center">
              <li class="page-item">
                <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
              </li>
              <?php 
              for($x=1;$x<=$total_halaman;$x++){
                ?> 
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
              }
              ?>				
              <li class="page-item">
                <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
              </li>
            </ul>
          </nav>
      </div>
      <center><a href="index.php">Kembali</a></center>

    </body>

    <script src="Blog%20Template%20new%202_files/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="Blog%20Template%20new%202_files/popper.min.js"></script>
    <script src="Blog%20Template%20new%202_files/bootstrap.min.js"></script>
    <script src="Blog%20Template%20new%202_files/holder.min.js"></script>
</html>