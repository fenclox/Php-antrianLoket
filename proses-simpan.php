<?php
include 'koneksi.php';

// Cek koneksi
if($koneksi === false){
     die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Get value dari form
$no_reg   = $_POST['no_reg'];
$rm       = $_POST['rm'];
$kelas    = $_POST['kelas'];
$nama     = $_POST['nama'];
$type     = $_POST['type'];
$dob      = $_POST['dob'];
$corp     = $_POST['corp'];
$dokter   = $_POST['dokter'];
$gender   = $_POST['gender'];
$reg_date = $_POST['reg_date'];
$title    = $_POST['title'];
// Convert ke Sentence case
$scTitle = ucfirst(strtolower($title));
$scTitle    = ', '.$scTitle.'.';
// nama + title
$namaWithTitle = $nama.$scTitle;

if ($type == 'In-patient' ){
     $kamar    = $_POST['kamar'];
     $no_bed   = $_POST['no_bed'];
} else if ($type == 'Out-patient' ){
     $kamar    = null;
     $no_bed   = null;
}

// Melakukan query insert
$sql = "INSERT INTO ex_registrations (no_reg, no_rm, kelas, kamar, no_bed, nama, dob, corp, dokter, patient_type, gender, reg_date) 
        VALUES ('$no_reg', '$rm', '$kelas', '$kamar', '$no_bed', '$namaWithTitle', '$dob', '$corp', '$dokter', '$type', '$gender', '$reg_date')";
if(mysqli_query($koneksi, $sql)){
    ?>
    <script language="JavaScript" type="text/javascript">
          window.alert('Data berhasil disimpan');
          window.location.href='cetak.php';
     </script>
    <?php
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
}
 
// Menutup connection
mysqli_close($koneksi);
?>