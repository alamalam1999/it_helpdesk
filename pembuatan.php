<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <script src="js/jquery-2.1.1.js"></script>

    <script src="dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">

    <title>Aplikasi G-Suite</title>
</head>
<body>

<?php
include "conn.php";

if(isset($_POST['input'])){

    $id_tiket  = $_POST['id_tiket'];
    $tanggal   = $_POST['tanggal'];
    $pc_no     = $_POST['pc_no'];
    $nama      = $_POST['nama'];
    $email     = $_POST['email'];
    $departemen= $_POST['departemen'];
    $problem   = $_POST['problem'];
    $filename  = $_FILES["choosefile"]["name"];
    $tempname  = $_FILES["choosefile"]["tmp_name"];
    $none      = "";
    $open      = "new";

    $folder = "image/".$filename;

    $laporan="<h4><b>Tiket Baru : $id_tiket</b></h4>";
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
    $sendmail->isHTML(true);                                  // Set email format to HTML
    $sendmail->Subject = "Tiket G-Suite $id_tiket"; //subjek email
    $sendmail->Body=$laporan; //isi pesan dalam format laporan
    if(!$sendmail->Send())
    {
        echo "Email gagal dikirim : " . $sendmail->ErrorInfo;
    }
    else
    {
        //echo "Email berhasil terkirim!";
        echo "INSERT INTO tiket(id_tiket, tanggal, pc_no, nama, email, departemen, problem, penanganan, status, filename)
															VALUES('$id_tiket','$tanggal','$pc_no','$nama','$email','$departemen','$problem','$none','$open','$filename')";


        $cek = mysqli_query($koneksi, "SELECT * FROM tiket WHERE id_tiket='$id_tiket'");
        if(mysqli_num_rows($cek) == 0){
            $insert = mysqli_query($koneksi, "INSERT INTO tiket(id_tiket, tanggal, pc_no, nama, email, departemen, problem, penanganan, status, filename)
															VALUES('$id_tiket','$tanggal','$pc_no','$nama','$email','$departemen','$problem','$none','$open','$filename')") or die(mysqli_error());



            if($insert){
                move_uploaded_file($tempname, $folder);
                echo '<script>sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Tiket Berhasil di kirim, tunggu IT datang!", 
                                                        type: "success"
                                                        });</script>';
            }else{
                echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Tiket Gagal di kirim, silahakan coba lagi!", 
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

<form class="cd-form floating-labels" method="POST" enctype="multipart/form-data" action="index.php">
    <fieldset>
        <h1>Ticket Permintaan Akun G-Suite</h1>
        <input type="hidden" name="id_tiket" value="<?php echo date("dmYHis"); ?>" id="id_ticket"/>
        <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>" id="tanggal"/>
        <div class="icon">
            <label class="cd-label" for="pc_no">Nama Barang</label>
            <input class="company" type="text" name="pc_no" id="pc_no" autocomplete="off" required="required">
        </div>

        <div class="icon">
            <label class="cd-label" for="nama">Nama</label>
            <input class="user" type="text" name="nama" id="nama" autocomplete="off" required="required">
        </div>

        <div class="icon">
            <label class="cd-label" for="nama">Email</label>
            <input class="email" type="email" name="email" id="email" autocomplete="off" required="email">
        </div>


        <div class="icon">
            <label class="cd-label" for="cd-email">Departemen</label>
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
            </select>
        </div>


        <div class="icon">
            <label class="cd-label" for="cd-textarea">Permasalahan</label>
            <textarea class="message" name="problem" id="problem" required></textarea>
        </div>

        <div class="icon">
            <label for="cd-textarea">Upload File</label>
            <input type="file" name="choosefile" value="">
        </div>

        <div>
            <a href="datatiket.php">Data Ticket</a>
            <input type="submit" onclick="notifikasi()" name="input" id="input" value="Send Message">
        </div>
    </fieldset>

</form>
<center>Copyright &copy; <a href="#">2022 Transformasi Digital- BPS YPAP</a></center><br /><br />
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
            var notifikasi = new Notification('Permintaan Akun G-Suite', {
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