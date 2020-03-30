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
    $pdf = new FPDF('L','mm',array(54,18));
    $pdf->SetMargins(1,0,0); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetFont('Arial','b',7);
    $pdf->Cell(0.00001,6,'RM : '.$row['no_rm'].' / REG : '.$no_reg);
    $pdf->Cell(0.00001,12, $row['kelas'].$room);
    $pdf->Cell(0.00001,18, $row['nama'].' ('.$gender.') / '.$dob_view);
    $pdf->Cell(0.00001,24, $row['corp'].' / '.$regDate_view.' '.$regTime);
    $pdf->Cell(0.00001,30, $row['dokter']);
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