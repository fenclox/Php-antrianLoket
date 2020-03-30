<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
  </head>
  <body class="bg-dark">

    <!-- Content -->

    <div class="container">
        <div class="row justify-content-md-center pt-5">
            <div class="col-md-5 bg-white p-4">
                <!-- Title -->
                <div class="text-center pb-2">
                    <h4>Login - Aplikasi Label Pasien</h4>
                </div>
                <!-- Cek pesan notifikasi -->
                <?php 
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                        ?>
                        <div class="alert alert-dark mb-0 p-1 pl-2" role="alert">
                            Login gagal! username atau password salah!
                        </div>
                        <?php
                    }else if($_GET['pesan'] == "logout"){
                        ?>
                        <div class="alert alert-dark mb-0 p-1 pl-2" role="alert">
                            Anda telah berhasil logout
                        </div>
                        <?php
                    }else if($_GET['pesan'] == "belum_login"){
                        ?>
                        <div class="alert alert-dark mb-0 p-1 pl-2" role="alert">
                            Anda harus login terlebih dahulu
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- Form -->
                <form class="pt-3" method="post" action="cek_login.php">
                    <div class="form-group">
                        <label for="usename">Username</label>
                        <input name="username" type="text" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <input type="submit" class="btn btn-dark" value="Login">
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
        $(function () {
            
        });
    </script>
    <!-- End Javascript Logic -->

  </body>

</html>
