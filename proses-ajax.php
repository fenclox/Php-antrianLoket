<?php
include 'koneksi.php';
$no_reg = $_GET['no_reg'];
$query = mysqli_query($koneksi, "SELECT registration_code,registered_date,mr,salutation,norm.first_name AS first_name,norm.last_name as last_name,norm.gender,norm.phone,norm.dob as dob,norm.address as alamat,reg_name,emp.first_name AS dok_fn, emp.last_name AS dok_ln, ins.name AS corp,kls.class_name AS kelas
                                FROM  whms_registrations reg
                                INNER JOIN  whms_patients norm ON norm.id=reg.patient_id
                                INNER JOIN ex_registrations_type ty ON ty.reg_id=reg.registration_type
                                INNER JOIN whms_registrations_handling_doctors han ON han.registration_id=reg.registration_code
                                INNER JOIN whms_employee emp ON emp.id=han.doctor_id
                                INNER JOIN whms_insurer_company ins ON ins.id=reg.insurer_class_id
                                INNER JOIN whms_classes kls ON kls.id=reg.class_id
                                WHERE registration_code = '$no_reg'");
$row = mysqli_fetch_array($query);
$yrdata= strtotime($row['dob']);
$nama_dokter = $row['dok_fn'].' '.$row['dok_ln'];
$data = array(
            'mr'        =>  $row['mr'],
            'dob'       =>  $row['dob'],
            'reg_date'  =>  $row['registered_date'],
            'gender'    =>  $row['gender'],
            'dob_view'  =>  date('d M Y', $yrdata),
            'corp'      =>  $row['corp'],
            'dokter'    =>  $nama_dokter,
            'kelas'     =>  $row['kelas'],
            'title'     =>  $row['salutation'],
        );
 echo json_encode($data);
?>