<?php
include 'koneksi.php';
session_start();

// Cek koneksi
if($koneksi === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Get value dari form
$nama       = $_POST['nama'];
$username   = $_POST['username'];
$password   = MD5($_POST['password']);
$level      = $_POST['level'];
$created_by = $_SESSION['name'];

$querySelect = mysqli_query($koneksi, "SELECT username from ex_users where username = '$username'");
$row = mysqli_num_rows ($querySelect);

if ($row > 0) {
    ?>
    <script language="JavaScript" type="text/javascript">
          window.alert('Username sudah digunakan');
          window.location.href='users.php';
     </script>
    <?php
}
else{
    // Melakukan query insert
    $sql = "INSERT INTO ex_users (username, password, name, level, created_by) VALUES ('$username', '$password', '$nama', '$level', '$created_by')";
    if(mysqli_query($koneksi, $sql)){
        ?>
        <script language="JavaScript" type="text/javascript">
              window.alert('Data berhasil disimpan');
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