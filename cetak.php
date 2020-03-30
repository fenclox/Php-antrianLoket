<?php
    include 'koneksi.php';
    // cek apakah sudah login
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
    }
    $level = $_SESSION['level'];
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
                <li class="nav-item active">
                    <a class="nav-link" href="cetak.php">Cetak Label</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cetak_ulang.php">Cetak Ulang Label</a>
                </li>
                
                <?php //super user
                if ($level == 'default') { ?>
                    <li class="nav-item">
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
            <div class="col-md-5">
                <!-- Form -->
                <form method="post" action="proses-simpan.php">
                    <div class="form-group row">
                        <label for="" class="col-sm-12 col-form-label py-0"><small class="text-danger">*Isikan nomor registrasi pada isian "No. Reg" untuk menampilkan data pasien</small></label>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">No. Reg <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-4">
                        <!-- Buat sebuah textbox dan beri id keyword -->
                            <input name="no_reg" type="text" class="form-control" onkeyup="isi_otomatis()" id="no_reg" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">RM</label>
                        <div class="col-sm-4">
                        <input name="rm" type="text" class="form-control" id="mr" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm-9">
                            <input name="kelas" type="text" class="form-control" id="kelas" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Nama <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                        <input name="nama" type="text" class="form-control" onkeyup="isi_otomatis()" id="nama" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Type <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-9">
                            <!-- <select class="custom-select" id="type" name="type" required>
                                <option value ="">Pilih Type</option>
                                <?php
                                // $query = mysqli_query($koneksi, "SELECT reg_id,reg_name FROM ex_registrations_type");
                                // $result = mysqli_fetch_array($query);
                                // foreach($query as $row){
                                ?>
                                    <option value ="<?php // echo $row['reg_name']; ?>"><?php // echo $row['reg_name']; ?></option>
                                <?php
                                // }
                                ?>
                            </select> -->
                            <select class="custom-select" id="type" name="type" required>
                                <option value ="Out-patient">Out-patient</option>
                                <option value ="In-patient">In-patient</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="frm_kamar" style="display:none">
                        <label for="" class="col-sm-3 col-form-label">Kamar <p class="d-inline text-danger">*</p></label>
                        <div class="col-sm-6">
                            <select class="custom-select" onkeyup="isi_otomatis()" id="kamar" name="kamar">
                                <option value ="">Pilih Kamar</option>
                                <option value ="ANGGREK I">ANGGREK I</option>
                                <option value ="ANYELIR II">ANYELIR II</option>
                                <option value ="ANYELIR III">ANYELIR III</option>
                                <option value ="ANYELIR IV">ANYELIR IV</option>
                                <option value ="ANYELIR V">ANYELIR V</option>
                                <option value ="ANYELIR VI">ANYELIR VI</option>
                                <option value ="BOUGENVILE 101">BOUGENVILE 101</option>
                                <option value ="BOUGENVILE 102">BOUGENVILE 102</option>
                                <option value ="BOUGENVILE 201">BOUGENVILE 201</option>
                                <option value ="BOUGENVILE 301">BOUGENVILE 301</option>
                                <option value ="BOUGENVILE 302">BOUGENVILE 302</option>
                                <option value ="CEMPAKA I">CEMPAKA I</option>
                                <option value ="CEMPAKA II">CEMPAKA II</option>
                                <option value ="CEMPAKA III">CEMPAKA III</option>
                                <option value ="CEMPAKA IV">CEMPAKA IV</option>
                                <option value ="HCU">HCU</option>
                                <option value ="ICU/PICU">ICU/PICU</option>
                                <option value ="INCUBATOR">INCUBATOR</option>
                                <option value ="ISOLASI">ISOLASI</option>
                                <option value ="NICU">NICU</option>
                                <option value ="PERINA">PERINA</option>
                                <option value ="R. OBSERVASI">R. OBSERVASI</option>
                                <option value ="VIP">VIP</option>
                                <option value ="VK">VK</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input name="no_bed" type="text" class="form-control" onkeyup="isi_otomatis()" id="no_bed" value="" placeholder="No. Bed">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">DoB</label>
                        <div class="col-sm-4">
                        <input name="dob_view" type="text" class="form-control" id="dob_view" value="" readonly>
                        <input name="dob" type="hidden" class="form-control" id="dob" value="">
                        <input name="reg_date" type="hidden" class="form-control" id="reg_date" value="">
                        <input name="gender" type="hidden" class="form-control" id="gender" value="">
                        <input name="title" type="hidden" class="form-control" id="title" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Corp.</label>
                        <div class="col-sm-9">
                        <input name="corp" type="text" class="form-control" id="corp" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Dokter</label>
                        <div class="col-sm-9">
                        <input name="dokter" type="text" class="form-control" id="dokter" value="" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-sm-9">
                        <button type="submit" class="btn btn-dark">Simpan</button>
                        <a href="" id="cetakLabel" target="_blank" class="btn btn-dark text-white">Cetak</a>
                        </div>
                    </div>

                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Javascript Logic -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function isi_otomatis(){
            var no_reg = $("#no_reg").val();
            var nama = $("#nama").val();
            var type = $("#type").val();
            var kamar = $("#kamar").val();
            var no_bed = $("#no_bed").val();
            // link cetak label
            var result = "cetak-label.php?no_reg="+no_reg +"&nama="+nama +"&type="+type +"&kamar="+kamar +"&no_bed="+no_bed;
            $('#cetakLabel').attr('href', result);
            // ajax data
            $.ajax({
                url: 'proses-ajax.php',
                data:"no_reg="+no_reg ,
            }).success(function (data) {
                var json = data,
                obj = JSON.parse(json);
                $('#mr').val(obj.mr);
                // $('#nama').val(obj.nama);
                $('#dob_view').val(obj.dob_view);
                $('#dob').val(obj.dob);
                $('#corp').val(obj.corp);
                $('#dokter').val(obj.dokter);
                $('#kelas').val(obj.kelas);
                $('#reg_date').val(obj.reg_date);
                $('#gender').val(obj.gender);
                $('#title').val(obj.title);
            });
        }
        $(function () {
            $("#type").change(function () {
                var val = $(this).val();
                if (val === "In-patient") {
                    $("#frm_kamar").show();
                } else if (val === "Out-patient") {
                    $("#frm_kamar").hide();
                    $('[name="kamar"]').val('');
                    $('[name="no_bed"]').val('');
                }
            });
        });
    </script>
    <!-- End Javascript Logic -->

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

  </body>

</html>
