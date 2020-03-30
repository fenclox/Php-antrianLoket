<?php
include "koneksi.php";
// get data dari url
$no_reg = $_GET['no_reg'];
// query select
$query = mysqli_query($koneksi, "SELECT * FROM ex_registrations WHERE no_reg = '$no_reg' ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_array($query);
if ($row > 0) {
    // ubah format dob untuk view
    $yrdata = strtotime($row['dob']);
    $dob_view = date('d M Y', $yrdata);
    // ubah format tanggal registrasi untuk view
    $regDate = $row['reg_date'];
    $yrdataReg = strtotime($regDate);
    $regDate_view = date('d M Y', $yrdataReg);
    $regTime = substr($regDate, 11, -3);
    // menegecek apakah pasien rawat jalan (OPA : Out-patient) atau rawat inap (IPA : In-patient)
    $type   = $row['patient_type'];
    if ($type == 'Out-patient') {
        $room = null;
    }
    else if ($type == 'In-patient') {
        $room = ' - '.$row['kamar'].' - '.$row['no_bed'];
    }
    // replace value gender
    $gender = $row['gender'];
    if ($gender == 'M') {
        $gender = 'L';
    }
    else if ($gender == 'F') {
        $gender = 'P';
    }
    // manggil file fpdf untuk report
    require('fpdf182/fpdf.php');
    $pdf = new FPDF('L','mm',array(80,30));
    $pdf->SetMargins(2,0,0); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetFont('Arial','b',8);
    $pdf->Cell(0.00001,8,'RM           :  '.$row['no_rm'].' / REG : '.$no_reg.' / '.$regDate_view.' '.$regTime);
    $pdf->Cell(0.00001,16,'KLS          :  '.$row['kelas'].$room);
    $pdf->Cell(0.00001,24,'NAMA      :  '.$row['nama'].' ('.$gender.')');
    $pdf->Cell(0.00001,32,'DOB         :  '.$dob_view);
    $pdf->Cell(0.00001,40,'CORP       :  '.$row['corp']);
    $pdf->Cell(0.00001,48,'DOKTER  :  '.$row['dokter']);
    $pdf->Output();
}
else {
    ?>
    <script language="JavaScript" type="text/javascript">
        window.alert('No. Reg tidak ditemukan');
        window.close();
     </script>
    <?php
}
?>