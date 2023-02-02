<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="icon" href="img/favicon-32x32.ico" type="image/x-icon" />
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
    <script src="js/jquery-2.1.1.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <script src="dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">
    <link rel="stylesheet" href="css/mdb.min.css" />
    
	<title>Aplikasi Tikecting Request Design</title>
	
	 <!-- Favicons-->
 
         <style>
             
              .demo-bg {
                opacity: 0.4;
                position: absolute;
                left: 0;
                top: 0;
                width: 190%;
                height: 320%;
                }
        
                .demo-content {
                position: relative;
                }
        	 
        	 body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
         </style>
    
</head>
<body>
    <img class="demo-bg" src="image/vivid-colorful-bright-circles.jpg" alt="bg-dashboard" >
    

 <?php
 include "conn.php";
 
			if(isset($_POST['input'])){
			 
				$id_tiket  = $_POST['id_tiket'];
				$waktu     = $_POST['waktu'];
				$tanggal   = $_POST['tanggal'];
				$pc_no     = $_POST['pc_no'];
                $nama      = $_POST['nama'];
                $nomor     = $_POST['nomor'];
                $email     = $_POST['email'];
                $departemen= $_POST['departemen'];
                $jenis     = $_POST['jenis'];
                $video     = $_POST['video'];
                $tanggal   = $_POST['tanggal'];
                $deadline  = $_POST['deadline'];
                $problem   = $_POST['problem'];
                $filename  = $_FILES["choosefile"]["name"];
                $tempname  = $_FILES["choosefile"]["tmp_name"];
                $kegiatan  = $_POST["kegiatan"];
                $none      = "";
                $open      = "new";

                $folder = "image/".$filename;
                
    $laporan="<h4><b>Tiket Baru : $waktu</b></h4>";
    $laporan .="<br/>";
	$laporan .="<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\">";
	$laporan .="<tr>";
	$laporan .="<td>Tanggal</td><td>:</td><td>$tanggal</td>";
	$laporan .="</tr>";
    $laporan .="<tr>";
	$laporan .="<td>PC NO</td><td>:</td><td>$pc_no</td>";
	$laporan .="</tr>";
    $laporan .="<tr>";
	$laporan .="<td>Nama</td><td>:</td><td>$nama</td>";
	$laporan .="</tr>";
    $laporan .="<tr>";
	$laporan .="<td>Departemen</td><td>:</td><td>$departemen</td>";
	$laporan .="</tr>";
    $laporan .="<tr>";
	$laporan .="<td>Problem</td><td>:</td><td>$problem</td>";
	$laporan .="</tr>";
    $laporan .="<tr>";
	$laporan .="<td>Status/td><td>:</td><td>$open</td>";
	$laporan .="</tr>";
    
                
    require_once("phpmailer/class.phpmailer.php");
    require_once("phpmailer/class.smtp.php");
    
    $sendmail = new PHPMailer(true);
    $sendmail->isSMTP();                                            // Send using SMTP
    $sendmail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $sendmail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $sendmail->Username   = 'ypap@sekolah-avicenna.sch.id';                     // SMTP username
    $sendmail->Password   = 'ypap@123';                               // SMTP password
    $sendmail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $sendmail->setFrom('ypap@sekolah-avicenna.sch.id', 'YPAP');
    $sendmail->addAddress("$email","$nama"); //email tujuan
    $sendmail->addReplyTo('ypap@sekolah-avicenna.sch.id', 'YPAP');
    $sendmail->AddCC('adikuasa.mangkualam@gmail.com');
    $sendmail->isHTML(true);                                  // Set email format to HTML
    $sendmail->Subject = "Tiket Design Grafis $waktu"; //subjek email
    $sendmail->Body=$laporan; //isi pesan dalam format laporan
	if(!$sendmail->Send()) 
	{
		echo "Email gagal dikirim : " . $sendmail->ErrorInfo;  
	} 
	else 
	{ 
		//echo "Email berhasil terkirim!";  
	
				
				$cek = mysqli_query($koneksi, "SELECT * FROM tiketdg WHERE id_tiket='$id_tiket'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($koneksi, "INSERT INTO tiketdg(id_tiket,waktu, tanggal, pc_no, nama, email, departemen, problem, penanganan, status, filename, nomor, deadline, kegiatan, video, jenis)
															VALUES('$id_tiket','$waktu','$tanggal','$pc_no','$nama','$email','$departemen','$problem','$none','$open','$filename', '$nomor', '$deadline', '$kegiatan', '$video', '$jenis')") or die(mysqli_error());
						if($insert){
                            move_uploaded_file($tempname, $folder);
							echo '<script>sweetAlert({
	                                                   title: "Request berhasil dikirim!", 
                                                        text: "Cek email anda untuk mengetahui nomor tiket!", 
                                                        type: "success"
                                                        });</script>';
						}else{
							echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Request Gagal di kirim, silahakan coba lagi!", 
                                                        type: "error"
                                                        });</script>';
						}
				}else{
					echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Tiket Sudah ada Sebelumnya!", 
                                                        type: "error"
                                                        });</script>';
				}
            }
		}
			?>

	<form class="cd-form floating-labels" method="POST" enctype="multipart/form-data" action="dashboard.php" style="max-width:500px;margin:auto">
		<fieldset>
			<legend><h1 style = "font-weight: 900;">Ticketing Request Design-video</h1></legend>
            
            
            <li style="font-size:18px">Isi form dengan baik dan lengkapi dokumen pendukung</li><br />
            <li style="font-size:18px">Ticket diselesaikan oleh Tim Design berdasarkan urutan antrian.</li><br />
            <li style="font-size:18px">Penerimaan request desain kurang lebih 3 minggu dari waktu kegiatan/acara yang akan dilaksanakan.</li><br />
            <li style="font-size:18px">Pengerjaan paling cepat 1 minggu sejak request diterima (dilengkapi dengan data informasi dan ketentuannya).</li><br />
            <li style="font-size:18px">Permintaan revisi dari desain yang telah diterima yaitu maksimal 3x revisi terkait adanya perubahan atau kesalahan informasi.</li><br />

            <input type="hidden" name="id_tiket" value="<?php echo date("dmYHis"); ?>" id="id_ticket"/>
            <input type="hidden" name="waktu" value="<?php echo date("d.m.Y.H.i.s"); ?>" id="waktu"/>
            <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>" id="tanggal"/>
            <input type="hidden" name="pc_no" value="desaingrafis" id="desain"/>
		
		    <div class="icon">
		    	<label class="cd-label" for="nama">Nama PIC</label>
				<input class="user" type="text" name="nama" id="nama" autocomplete="off" required="required">
		    </div> 
            
            <div class="icon">
		    	<label class="cd-label" for="nama">Nomor WhatsApp</label>
				<input class="user" type="text" name="nomor" id="nama" autocomplete="off" required="required">
		    </div> 
            
            <div class="icon">
		    	<label class="cd-label" for="nama">Email PIC</label>
				<input class="email" type="email" name="email" id="email" autocomplete="off" required="email">
		    </div> 

		    
		    <div class="icon">
		    	<label class="cd-label" for="cd-email">Departemen / Unit</label>
				<select class="email" name="departemen" id="departemen" required>
                    <option value=""></option>
                <option value="Research and Development">Research and Development</option>
                <option value="Human Resources">Human Resources</option>
                <option value="General Affair">General Affair</option>
                <option value="Accounting & Tax">Accounting & Tax</option>
                <option value="Finance">Finance</option>
                <option value="Building Maintenance">Building & Maintenance</option>
                <option value="Building Maintenance">Branding & Marketing</option>
                <option value="Transformasi Digital">Transformasi Digital (IT)</option>
                <option value="Transformasi Digital">KB Avicenna Pamulang</option>
                <option value="Transformasi Digital">TK Avicenna Jagakarsa</option>
                <option value="Transformasi Digital">SD Avicenna Jagakarsa</option>
                <option value="Transformasi Digital">SMP Avicenna Jagakarsa</option>
                <option value="Transformasi Digital">SMA Avicenna Jagakarsa</option>
                <option value="Transformasi Digital">SD Avicenna Cinere</option>
                <option value="Transformasi Digital">SMP Avicenna Cinere</option>
                <option value="Transformasi Digital">SMA Avicenna Cinere</option>
                
                </select>
		    </div>
		    
		     <div class="icon">
		    	<label class="cd-label" for="cd-email">Jenis Permintaan</label>
				<select class="email" name="jenis" id="departemen" required>
                    <option value=""></option>
                    <option value="Pembuatan Desain">Pembuatan Desain</option>
                    <option value="Pembuatan Video">Pembuatan Video</option>
                </select>
		    </div>
		    
		     <div class="icon">
		    	<label class="cd-label" for="cd-email">Kategori</label>
				<select class="email" name="video" id="departemen" required>
                    <option value=""></option>
                <option value="Event Ekternal">Konten Design Event Eksternal</option>
                <option value="Event Internal">Konten Design Event Internal</option>
                <option value="Media Cetak">Konten Design Media Cetak</option>
                <option value="Prestasi">Konten Design Prestasi</option>
                <option value="Video Pembelajaran">Video Pembelajaran</option>
                <option value="Video Media Sosial">Video Promosi Media Sosial (IGTV, Reels, Tiktok)</option>
                <option value="Video Event">Video Event (Open House, School Tour, dkk)</option>
                <option value="Lainnya">Lainnya</option>
               
                </select>
		    </div>
		    
		    <div class="icon">
		        <label for="cd-email">Tanggal Kegiatan</label>
                <input name="tanggalkegiatan" type="date" class="email form-control" id="customFile" />
            </div> 
            
            <div class="icon">
		        <label for="cd-email">Estimasi Deadline</label>
                <input name="deadline" type="date" class="email form-control" id="customFile" />
            </div>
            
            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="Password" name="psw">
            </div>
		    
		     <div class="icon">
		    	<label class="cd-label" for="nama">Nama Kegiatan</label>
				<input class="user" type="text" name="kegiatan" id="nama" autocomplete="off" required="required">
		    </div> 
            
            <div class="icon">
				<label class="cd-label" for="cd-textarea">Deskripsi Materi</label>
      			<textarea class="message" name="problem" id="problem" required></textarea>
			</div>
            
            <div class="icon">
                <label for="cd-textarea">Referensi Design</label>
                <input name="choosefile" type="file" class="form-control" id="customFile" />
            </div>
            
            
           	<div style="font-size:18px">
            <a href="datatiket.php">Data Ticket</a>
            <input type="submit" onclick="notifikasi()" name="input" id="input" value="Send Message"> 
		    </div>
		</fieldset>
		
	</form>
<center style="font-size:18px">Copyright &copy; <a href="#">2022 Transformasi Digital- BPS YPAP</a></center><br /><br />
<script src="js/main.js"></script> <!-- Resource jQuery -->

           <!-- <script>
  sweetAlert("Hello world!");
  </script> -->

  
<script>
            $(document).ready(function() {
                  if (Notification.permission !== "granted")
                    Notification.requestPermission();
            });
             
            function notifikasi() {
                if (!Notification) {
                    alert('Browsermu tidak mendukung Web Notification.'); 
                    return;
                }
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notifikasi = new Notification('IT Design Grafis', {
                        icon: 'img/logo.jpg',
                        body: "Tiket Baru dari <?php echo $nama; ?>",
                    });
                    notifikasi.onclick = function () {
                        window.open("http://tsuchiya-mfg.com");      
                    };
                    setTimeout(function(){
                        notifikasi.close();
                    }, 1000);
                }
            };
</script>
</body>
</html>