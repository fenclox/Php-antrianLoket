<?php
include 'koneksi.php';

$now = date('Y-m-d');

$query = mysqli_query($koneksi, "SELECT MAX(no_urut) as no_urut
                                FROM  ex_antrian
                                WHERE DATE(tanggal_ins) = '$now'");
                                
$row = mysqli_fetch_array($query);

// Get value dari form
$no_urut   = $row['no_urut']+=1;

// Melakukan query insert
$sql = "INSERT INTO ex_antrian (no_urut) VALUES ('$no_urut')";

if(mysqli_query($koneksi, $sql)){
// if($no_urut){
     // MPDF -------------------------------------------------------------------------------------------------------
     
     $content = "
     <html>
     <body style='text-align:center'>
          <h3 style='margin:0;padding-bottom:12px'>RS Bunda Mulia</h3>
          <h6 style='margin:0;padding:0'>No. Antrian:</h6>
          <h1 style='margin:0;padding-bottom:12px;font-size:40px'>".$no_urut."</h1>
          <h6 style='margin:0;padding:0'>Silahkan untuk mengantri di bagian Pendaftaran</h6>
	</body>
	</html>
	";

	require_once "./vendor/autoload.php";
     // $mpdf = new \Mpdf\Mpdf();
     $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [72, 80]]);
	// $mpdf->AddPage("P","","","","","15","15","15","15","","","","","","","","","","","","A4");
	$mpdf->AddPage('','','','','',0,0,0,0);
	$mpdf->WriteHTML($content);
	$mpdf->Output();
     
     // MPDF -------------------------------------------------------------------------------------------------------
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
}
 
// Menutup connection
mysqli_close($koneksi);
?>