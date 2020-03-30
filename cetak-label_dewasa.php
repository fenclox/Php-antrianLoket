<?php
include "koneksi.php";
// get data dari url
$no_reg = $_GET['no_reg'];
$nama   = $_GET['nama'];
$type   = $_GET['type'];
$kamar  = $_GET['kamar'];
$no_bed = $_GET['no_bed'];
// query select
$query = mysqli_query($koneksi, "SELECT registration_code,registered_date,mr,salutation,norm.first_name AS first_name,norm.last_name as last_name,norm.gender,norm.salutation as title,norm.phone,norm.dob as dob,norm.address as alamat,reg_name,emp.first_name AS nama_dokter,ins.name AS corp,kls.class_name AS kelas
                                FROM  whms_registrations reg
                                INNER JOIN  whms_patients norm ON norm.id=reg.patient_id
                                INNER JOIN ex_registrations_type ty ON ty.reg_id=reg.registration_type
                                INNER JOIN whms_registrations_handling_doctors han ON han.registration_id=reg.registration_code
                                INNER JOIN whms_employee emp ON emp.id=han.doctor_id
                                INNER JOIN whms_insurer_company ins ON ins.id=reg.insurer_class_id
                                INNER JOIN whms_classes kls ON kls.id=reg.class_id
                                WHERE registration_code = '$no_reg'");
$row = mysqli_fetch_array($query);
// ubah format dob untuk view
$yrdata = strtotime($row['dob']);
$dob_view = date('d M Y', $yrdata);
// ubah format tanggal registrasi untuk view
$regDate = $row['registered_date'];
$yrdataReg = strtotime($regDate);
$regDate_view = date('d M Y', $yrdataReg);
$regTime = substr($regDate, 11, -3);
// Convert ke Sentence case
$title = ucfirst(strtolower($row['title']));
// menegecek apakah pasien rawat jalan (OPA : Out-patient) atau rawat inap (IPA : In-patient)
if ($type == 'Out-patient') {
    $room = null;
}
else if ($type == 'In-patient') {
    $room = ' - '.$kamar.' - '.$no_bed;
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
$pdf = new FPDF('L','mm',array(65,25));
$pdf->SetMargins(1,0,0); 
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','b',8);
$pdf->Cell(0.00001,8,'RM : '.$row['mr'].' / REG : '.$no_reg);
$pdf->Cell(0.00001,16,$row['kelas'].$room);
$pdf->Cell(0.00001,24,$nama.', '.$title.'.'.' ('.$gender.') / '.$dob_view);
$pdf->Cell(0.00001,32,$row['corp'].' / '.$regDate_view.' '.$regTime);
$pdf->Cell(0.00001,40,$row['nama_dokter']);
$pdf->Output();
?>