<?php
include 'koneksi.php';
$no_reg = $_GET['no_reg'];
$query = mysqli_query($koneksi, "SELECT * FROM ex_registrations WHERE no_reg = '$no_reg' ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_array($query);
$yrdata= strtotime($row['dob']);
$data = array(
            'mr'        =>  $row['no_rm'],
            'kelas'     =>  $row['kelas'],
            'kamar'     =>  $row['kamar'],
            'no_bed'    =>  $row['no_bed'],
            'nama'      =>  $row['nama'],
            'dob'       =>  $row['dob'],
            'dob_view'  =>  date('d M Y', $yrdata),
            'corp'      =>  $row['corp'],
            'dokter'    =>  $row['dokter'],
            'type'      =>  $row['patient_type'],
            'gender'    =>  $row['gender'],
            'reg_date'  =>  $row['reg_date'],
        );
 echo json_encode($data);
?>