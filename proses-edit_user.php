<?php
include 'koneksi.php';
session_start();

// Cek koneksi
if($koneksi === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Get value dari form
$id         = $_POST['id'];
$nama       = $_POST['nama'];
$username   = $_POST['username'];
$password   = $_POST['password'];
$encPass    = MD5($_POST['password']);
$level      = $_POST['level'];
$is_active  = $_POST['is_active'];

$querySelect = mysqli_query($koneksi, "SELECT password from ex_users where id = '$id'");
$row = mysqli_fetch_array($querySelect);

if ($row['password'] == $password) {
     // Melakukan query insert
     $sql = "UPDATE ex_users SET level='$level', name='$nama', is_active='$is_active' WHERE id=$id";
     if(mysqli_query($koneksi, $sql)){
         ?>
         <script language="JavaScript" type="text/javascript">
               window.alert('Data berhasil diubah');
               window.location.href='users.php';
          </script>
         <?php
     } else{
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
     }
}
else {
    // Melakukan query insert
    $sql = "UPDATE ex_users SET level='$level', name='$nama', is_active='$is_active', password='$encPass' WHERE id=$id";
    if(mysqli_query($koneksi, $sql)){
        ?>
        <script language="JavaScript" type="text/javascript">
              window.alert('Data berhasil diubah');
              window.location.href='users.php';
         </script>
        <?php
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
    }
}
 
// Menutup connection
mysqli_close($koneksi);
?>