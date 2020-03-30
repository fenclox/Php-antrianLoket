<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from ex_users where username='$username' and password='$password' and is_active='1'");
$row = mysqli_fetch_array($data);
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['name'] = $row['name'];
	$_SESSION['level'] = $row['level'];
	$_SESSION['status'] = "login";
	header("location:cetak.php");
}else{
	header("location:index.php?pesan=gagal");
}
?>