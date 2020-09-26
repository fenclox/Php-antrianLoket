<?php
    include 'koneksi.php';
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
    <title>Antrian Loket</title>
  </head>
  <body>

    <!-- Content -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Antrian</a>
        </div>
    </nav>

    <div class="container pt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <!-- Form -->
                <form method="post" action="proses-simpan.php">
                    <div class="form-group row">
                        <label for="" class="col-sm-12  d-flex justify-content-center col-form-label"><small class="text-danger">*Silahkan klik tombol dibawah untuk mendapatkan nomor antrian</small></label>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12  d-flex justify-content-center">
                            <button id="cetak" type="submit" class="btn btn-sm btn btn-dark p-2">Klik Antrian</button>
                        </div>
                    </div>

                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
    <!-- End Content -->

    <script src="js/bootstrap.min.js"></script>

  </body>

</html>
