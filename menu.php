<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location: index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama | SMK Coding</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <span style="display: inline;">
            <a href="menu.php"><img src="images/smk-coding.png" alt="gambar"></a>
            <a href="logout.php"> <button type="button" class="btn btn-danger btn-sm float-right" style="margin-top: 2%; margin-right: 3%;">Log Out</button></a>    
        </span>  
    </header>

    <div class="formContainer" style="margin-top: 80px; margin-bottom: 80px;">
        <h1>Submission Assignment Portal</h1>
        <br>
        <h5>Selamat datang, 
                <span style="color: #004a74;"><u><?php echo $_SESSION['nama']; ?></u></span> !</h5>
        <br><br>

        <div class="d-flex justify-content-center" style="margin-left: -8%;">
            <a href="form-submit.php"><button class="mr-3 btn btn-primary" style="width: 95%;">Add Submission</button></a>
            <a href="list-tugas.php"><button class="btn btn-primary" style="width: 152%;">List Tugas</button></a>
        </div>

        <?php if (isset($_GET['status'])) : ?>
            <br><br><br>
            <p>
                <?php
                if ($_GET['status'] == 'sukses') {
                    echo "<h4>Pengumpulan berhasil dilakukan!</h4>";
                } else {
                    echo "<h4 style='color: #bf2b16'>Pengumpulan gagal!</h4>";
                }
                ?>
            </p>
        <?php endif; ?>

    </div>

    <footer>
        <h4>All Rights Reserved</h4>
    </footer>
</body>