<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Submission Tugas Siswa | SMK Coding</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <a href=""><img src="images/smk-coding.png" alt="gambar"></a>
    </header>
    <div class=" formContainerLogin" style="margin-top: 80px; margin-bottom: 80px">
        <h1 style="margin-bottom: 40px;">Login</h1>
        <div>
                <?php if (isset($_GET['status'])) : ?>
                    <p>
                        <?php
                        if ($_GET['status'] == 'gagal') {
                            echo "<h4 style='color: #bf2b16; margin-bottom: 40px;'>Informasi Login Salah!</h4>";
                        }

                        if ($_GET['status'] == 'logout') {
                            echo "<h4 style='color: #004a74; margin-bottom: 40px;'>Anda telah berhasil logout</h4>";
                        }
                        ?>
                        
                    </p>
                <?php endif; ?>

                <?php if (isset($_GET['regstatus'])) : ?>
                    <p>
                        <?php
                        if ($_GET['regstatus'] == 'sukses') {
                            echo "<h4 style='color: #64c09f; margin-bottom: 40px; '>Pendaftaran Berhasil !</h4>";
                        }
                        ?>
                    </p>
                <?php endif; ?>
            </div>
        <div class="container">
            <form autocomplete="off" action="proses-login.php" method="POST">
                <div class="form-group">
                    <label for="nis">Nomor Induk Siswa :</label>
                    <input type="text" name="nis" class="form-control" minlength="1" maxlength="15">
                </div>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" class="form-control" minlength="1" maxlength="20">
                </div>
                
                <button name="login" type="submit" class="btn btn-primary" style="margin-top: 20px; width: 100%;">Login</button>
                <br><br>
                <div class="form-group" style="text-align:center;">
                    <label for="register">Don't have an account? <a id="registerLink" href="form-register.php">Register Here</a></label>    
                </div>
            </form>   
        </div>
    </div>
    <footer>
        <h4>All Rights Reserved</h4>
    </footer>
</body>

</html>
