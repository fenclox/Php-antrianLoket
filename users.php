<?php
    include 'koneksi.php';
    // cek apakah sudah login
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
    }
    $level = $_SESSION['level'];

    if ($level != 'default') { ?>
        <script language="JavaScript" type="text/javascript">
            window.alert('Anda tidak memiliki akses ke halaman tersebut');
            history.go(-1);
        </script>
    <?php 
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- CSS -->
    <style>
        @media print and (width: 8cm) and (height: 3cm) {
            @page {
                margin: 0cm;
            }
        }
    </style>

    <title>Cetak Label Pasien</title>
  </head>
  <body>

    <!-- Content -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <!-- <a class="navbar-brand" href="#">Label Pasien</a> -->
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="cetak.php">Cetak Label</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cetak_ulang.php">Cetak Ulang Label</a>
                </li>
                
                <?php //super user
                if ($level == 'default') { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                <?php } ?>
                    
                <li class="nav-item">
                    <a class="nav-link" href="" data-toggle="modal" data-target=".bd-example-modal-lg">Panduan</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link ml-auto" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container pt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-10">

                <div class="row">
                    <h5>Data User</h5>
                    <button type="button" class="btn btn-dark ml-auto" data-toggle="modal" data-target="#tambahUser"> <b>+</b> </button>
                </div>

                <div class="row mt-3">
                    <table class="table shadow-sm p-3 mb-5 bg-white rounded">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Level</th>
                            <th scope="col">Created by</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $user = mysqli_query($koneksi,"select * from ex_users");
                            while($row = mysqli_fetch_array($user))
                            {
                            echo "<tr>
                                <td>".$i."</td>
                                <td>".$row['name']."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['level']."</td>
                                <td>".$row['created_by']."</td>
                                <td> <button type='button' data-toggle='modal'
                                        class='btn btn-sm btn-dark ml-auto edit-user' 
                                        data-id='".$row['id']."' 
                                        data-nama='".$row['name']."' 
                                        data-username='".$row['username']."' 
                                        data-level='".$row['level']."' 
                                        data-password='".$row['password']."' 
                                        data-is_active='".$row['is_active']."' 
                                > Edit </button> </td>
                            </tr>";
                            $i++;
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Panduan Penggunaan Aplikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-1"><b>Cetak Label</b> (Langkah 1 - 4),  <b>Cetak Ulang Label</b> (Langkah 1 & 3)</p>
                    <ol class="m-0 pl-3">
                        <li>Isikan nomor registrasi pada isian "No. Reg" untuk menampilkan data pasien.</li>
                        <li>Selanjutnya, isi data sesuai form yang telah disediakan, seperti Nama, Type, Kamar, dan No. Bed </br>
                            (Isian Kamar dan No. Bed akan muncul apabila type pendaftarannya "In-patient".</li>
                        <li>Selanjutnya, klik tombol "Cetak" (Cetak Label) atau "Cetak Ulang" (Cetak Ulang Label) untuk mencetak label pasien </br>
                            <!-- - Pilih icon "Print" (di pojok kanan atas) </br>
                            - Pilih printer yang akan digunakan (diutamakan untuk set default printer label) </br>
                            - Klik tombol "Print"</br> -->
                            - Tekan CTRL + SHIFT + P (Google Chrome), maka akan muncul tampilan seperti gambar dibawah</br>
                            - <img src="img/panduan-1.jpg" alt="Tampilan print" srcset="" width="370"></br>
                            - [1] Printer yang digunakan, [2] Banyaknya jumlah yang ingin di print, [3] Tekan untuk melakukan print</br>
                        </li>
                        <li>Terakhir, Kembali ke Tab "Cetak label" lalu klik tombol "Simpan" untuk menyimpan data kedalam database.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal User -->
    <!-- Tambah -->
    <div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="tambahUser" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="proses-tambah_user.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUser">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <input name="nama" type="text" class="form-control" id="nama" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <input name="username" type="text" class="form-control" id="username" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label">Level <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <select name="level" id="level" class="form-control">
                                <option value="pendaftaran">Pendaftaran</option>
                                <option value="default">Default</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="proses-edit_user.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUser">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <input name="id" type="hidden" class="form-control" id="id" value="">
                            <input name="nama" type="text" class="form-control" id="nama" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <input name="username" type="text" class="form-control" id="username" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label">Level <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <select name="level" id="level" class="form-control">
                                <option value="pendaftaran">Pendaftaran</option>
                                <option value="default">Default</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_active" class="col-sm-3 col-form-label">Is active <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-3">
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1">True</option>
                                <option value="0">False</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- End Modal User -->

    <!-- Javascript Logic -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        //CSRF Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Edit (show modal with data)
        btnEditUser();
        // Edit
        function btnEditUser() {
            $('.edit-user').on('click', function () {
                var id          = $(this).data('id');
                var nama        = $(this).data('nama');
                var username    = $(this).data('username');
                var password    = $(this).data('password');
                var level       = $(this).data('level');
                var is_active   = $(this).data('is_active');

                $("#id").val(id);
                $("[name='nama']").val(nama);
                $("[name='username']").val(username);
                $("[name='password']").val(password);
                $("[name='level']").val(level);
                $("[name='is_active']").val(is_active);

                $("#editUser").modal("show");
            });
        }
    });
    </script>
    <!-- End Javascript Logic -->

  </body>

</html>

