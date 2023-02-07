<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <script src="dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">
    <style>
            .divider:after,
            .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
            }

            .h-custom {
            height: calc(100% - 73px);
            }

            @media (max-width: 450px) {
                .h-custom {
                height: 100%;
                }
            }

            .center {
                display: flex;
                justify-content: center;
                align-items: center;
                }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  </head>
  <body>


  <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="image/bussiness_company.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
     
          <div class="center d-flex flex-row align-items-center justify-content-center">
            <h3>HELPDESK PEMBUATAN G-SUITE</h3>
          </div>
          <div class="divider d-flex align-items-center my-4"></div>
          <div class="dashboard">
            <div id="button1" class="center text-center text-lg-start mt-8 pt-">
                <a href="#">   
                    <button type="button" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Pembuatan Akun G-Suite</button>
                </a> 
            </div>
            <div id="button2" class="center text-center text-lg-start mt-4 pt-2">
                <a href="#">  
                <button type="button" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Lupa Password</button>
                </a>
            </div>
            <div id="button3" class="center text-center text-lg-start mt-4 pt-2">
                <a href="#">  
                <button type="button" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Akun Ditangguhkan</button>
                </a>
            </div>
          </div>

           <!-- LUPA PASSWORD -->
                <div class="lupapassword" style="display: none;">
                <form method="POST" enctype="multipart/form-data" action="index.php">  
                    <div id="open2" class="center text-center text-lg-start mt-4 pt-2">
                            <a href="#">  
                            <button type="button" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Back</button>
                            </a>
                    </div>
                    <input type="hidden" name="id_tiket" value="<?php echo date("dmYHis"); ?>" id="id_ticket"/>
                    <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>" id="tanggal"/>
                    <div class="center mt-4">
                        <label for="">LUPA PASSWORD</label>
                    </div>
                    <div class="center text-center text-lg-start mt-8 pt-">
                       <input type="email" name="email1" placeholder="email">
                    </div>

                    <div class="center text-center text-lg-start mt-4 pt-2">
                        <a href="#">  
                        <button type="submit" name="update" id="update" class="btn btn-success btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;" >Kirim</button>
                        </a>
                    </div>
                </form>
                    <?php        
                        if(isset($_POST['update'])) {
                            $email =  $_POST['email1'];
                            $id_tiket = $_POST['id_tiket'];
                            $tanggal = $_POST['tanggal'];
                            $status = "new";
                            $sql = "INSERT INTO tiket_gsuite(id_tiket,name, email, tanggal,status) VALUES('$id_tiket','2','$email', '$tanggal', '$status')";
                            $insert = mysqli_query($koneksi, $sql);

                            if ($insert) {
                                echo '<script>sweetAlert({
                                    title: "Berhasil Di Kirim!", 
                                     text: "Tiket Berhasil di kirim!", 
                                     type: "success"
                                     });</script>';
                            } else {
                                echo '<script>sweetAlert({
                                    title: "Gagal!", 
                                     text: "Tiket Gagal di kirim!", 
                                     type: "error"
                                     });</script>';
                            }
                        }   
                    ?>
                </div>
            <!-- LUPA PASSWORD -->

             <!-- AKUN DITANGGUHKAN -->
             <div class="akunditangguhkan" style="display: none;">
             <form method="POST" enctype="multipart/form-data" action="index.php">  
                    <div id="open3" class="center text-center text-lg-start mt-4 pt-2">
                            <a href="#">  
                            <button type="button" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Back</button>
                            </a>
                    </div>
                    <input type="hidden" name="id_tiket" value="<?php echo date("dmYHis"); ?>" id="id_ticket"/>
                    <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>" id="tanggal"/>
                    <div class="center mt-4">
                        <label for="">AKUN DITANGGUHKAN</label>
                    </div>
                    <div class="center text-center text-lg-start mt-8 pt-">
                       <input type="email" name="email2" placeholder="email">
                    </div>

                    <div class="center text-center text-lg-start mt-4 pt-2">
                        <a href="#">  
                        <button type="submit" name="update2" id="update2" class="btn btn-success btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Kirim</button>
                        </a>
                    </div>
                    </form>
                    <?php        
                        if(isset($_POST['update2'])) {
                            $email =  $_POST['email2'];
                            $id_tiket = $_POST['id_tiket'];
                            $tanggal = $_POST['tanggal'];
                            $status = "new";
                            $sql = "INSERT INTO tiket_gsuite(id_tiket,name, email, tanggal,status) VALUES('$id_tiket','3','$email', '$tanggal', '$status')";
                            $insert = mysqli_query($koneksi, $sql);

                            if ($insert) {
                                echo '<script>sweetAlert({
                                    title: "Berhasil Di Kirim!", 
                                     text: "Tiket Berhasil di kirim!", 
                                     type: "success"
                                     });</script>';
                            } else {
                                echo '<script>sweetAlert({
                                    title: "Gagal!", 
                                     text: "Tiket Gagal di kirim!", 
                                     type: "error"
                                     });</script>';
                            }
                        }   
                    ?>
                </div>
            <!-- AKUN DITANGGUHKAN -->

             <!-- PERMINTAAN PEMBUATAN AKUN -->
             <div class="permintaanakun" style="display: none;">
             <form method="POST" enctype="multipart/form-data" action="index.php">  
                    <div id="open4" class="center text-center text-lg-start mt-4 pt-2">
                            <a href="#">  
                            <button type="button" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Back</button>
                            </a>
                    </div>
                    <input type="hidden" name="id_tiket" value="<?php echo date("dmYHis"); ?>" id="id_ticket"/>
                    <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>" id="tanggal"/>
                    <div class="center mt-4">
                        <label for="">LUPA PASSWORD</label>
                    </div>
                    <div class="center text-center text-lg-start mt-8 pt-">
                       <input type="text" name="firstname" placeholder="nama depan">
                    </div>
                    <div class="center text-center text-lg-start mt-8 pt-">
                       <input type="text" name="lastname" placeholder="nama belakang">
                    </div>
                    <div class="center text-center text-lg-start mt-8 pt-">
                       <input type="number" name="nohp" placeholder="nomor hp">
                    </div>
                    <div class="center text-center text-lg-start mt-8 pt-">
                       <input type="email" name="email" placeholder="email">
                    </div>

                    <div class="center text-center text-lg-start mt-4 pt-2">
                        <a href="#">  
                        <button type="submit" name="update3" id="update2" class="btn btn-success btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Kirim</button>
                        </a>
                    </div>
                    <?php        
                        if(isset($_POST['update3'])) {
                            $firstname = $_POST['firstname'];
                            $lastname = $_POST['lastname'];
                            $nohp   = $_POST['nohp'];
                            $email =  $_POST['email'];
                            $id_tiket = $_POST['id_tiket'];
                            $tanggal = $_POST['tanggal'];
                            $status = "new";
                            $sql = "INSERT INTO tiket_gsuite(id_tiket,name,firstname,lastname,no_hp, email, tanggal,status) VALUES('$id_tiket','1','$firstname','$lastname','$nohp','$email', '$tanggal', '$status')";
                            $insert = mysqli_query($koneksi, $sql);

                            if ($insert) {
                                echo '<script>sweetAlert({
                                    title: "Berhasil Di Kirim!", 
                                     text: "Tiket Berhasil di kirim!", 
                                     type: "success"
                                     });</script>';
                            } else {
                                echo '<script>sweetAlert({
                                    title: "Gagal!", 
                                     text: "Tiket Gagal di kirim!", 
                                     type: "error"
                                     });</script>';
                            }
                        }   
                    ?>
                </div>
            <!-- PERMINTAAN PEMBUATAN AKUN -->

          <div class="divider d-flex align-items-center my-4"></div>
                    <div class="center text-center text-lg-start mt-3 pt-2">
                        <a href="datatiket.php">Data Tiket</a>
                    </div>
      </div>

    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2020. All rights reserved.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>

  <script>


    $("#button2").click(function(){
        $(".dashboard").hide();
        $(".lupapassword").show();
    });
    $("#open2").click(function() {
        $(".dashboard").show();
        $(".lupapassword").hide();
    });

    $("#button3").click(function(){
        $(".dashboard").hide();
        $(".akunditangguhkan").show();
    });
    $("#open3").click(function() {
        $(".dashboard").show();
        $(".akunditangguhkan").hide();
    });

    $("#button1").click(function(){
        $(".dashboard").hide();
        $(".permintaanakun").show();
    });
    $("#open4").click(function(){
        $(".dashboard").show();
        $(".permintaanakun").hide();
    });


  </script>
</html>

<?php } ?>