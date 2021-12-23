<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Akun Baru | SMK Coding</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<html>
    <body>
        <header>
            <a href="index.php"><img src="images/smk-coding.png" alt="gambar"></a>
        </header>

        <div class=" formContainer" style="margin-top: 80px; margin-bottom: 80px">
            <h1 style="margin-bottom: 40px;">Registrasi Akun</h1>
            <div>
                <?php if (isset($_GET['regakun'])) : ?>
                        <p>
                            <?php
                            if ($_GET['regakun'] == 'nisalreadyreg') {
                                echo "<h4 style='color: #bf2b16; margin-bottom: 40px;'>Data NIS sudah terdaftar !</h4>";
                            }

                            else if ($_GET['regakun'] == 'wrongpass') {
                                echo "<h4 style='color: #bf2b16; margin-bottom: 40px;'>Password yang dimasukkan tidak sesuai !</h4>";
                            }

                            else if ($_GET['regakun'] == 'gagal') {
                                echo "<h4 style='color: #bf2b16; margin-bottom: 40px;'>Pendaftaran Akun Anda Gagal !</h4>";
                            }

                            else if ($_GET['regakun'] == 'emailalreadyreg') {
                                echo "<h4 style='color: #bf2b16; margin-bottom: 40px;'>Data Email sudah terdaftar !</h4>";
                            }

                            else if ($_GET['regakun'] == 'kuranglengkap') {
                                echo "<h4 style='color: #bf2b16; margin-bottom: 40px;'>Lengkapi keseluruhan data!</h4>";
                            }
                            ?>
                        </p>
                <?php endif; ?>
            </div>
            <div class="container">
                <form autocomplete="off" action="proses-register.php" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Siswa :</label>
                        <input type="text" name="nama" class="form-control" minlength="1" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="nis">Nomor Induk Siswa :</label>
                        <input type="text" name="nis" class="form-control" minlength="1" maxlength="25">
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" name="email" class="form-control" minlength="1" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="password" name="password" class="form-control" minlength="1" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="repassword">Ulangi Kembali Password :</label>
                        <input type="password" name="repassword" class="form-control" minlength="1" maxlength="20">
                    </div>
                    <span style="display : inline">
                        <button name="register" type="submit" class="btn btn-primary" style="margin-top: 20px; width: 10%;">Daftar</button>
                        <a href="index.php"><button type="button" name="cancel" class="btn btn-danger" style="margin-top: 20px; margin-left: 3%; width: 10%;">Batal</button></a>
                    </span>
                </form>
            </div>
        </div>
        <footer>
            <h4>All Rights Reserved</h4>
        </footer>

    </body>
</html>