<?php
include("config.php");

session_start();

if($_SESSION['status']!="login"){
    header("location: index.php");
}

if (!isset($_GET['id'])) {
    header('Location: list-tugas.php');
}

$id = $_GET['id'];

$sql = "Select * From assignment Where id=$id";
$query = mysqli_query($db, $sql);
$tugas = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Edit Submission | SMK Coding</title>
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

    <div class=" formContainer" style="margin-top: 80px; margin-bottom: 80px">
        <h1 style="margin-bottom: 40px;">Edit Submission</h1>
        <div>
            <?php if (isset($_GET['status'])) : ?>
                <p>
                    <?php
                        if ($_GET['status'] == 'kuranglengkap') {
                            echo "<h4 style='color: #bf2b16; margin-bottom: 20px;'>Isi Judul & Kelas!</h4>";
                        }           
                    ?>
                </p>
            <?php endif; ?>
        </div>
        
        <div class="container">
            <form autocomplete="off" action="proses-edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $tugas['id'] ?>">
                <div class="form-group">
                    <label for="judul">Judul Tugas :</label>
                    <input type="text" name="judul" class="form-control" minlength="1" value=" <?php echo $tugas['judul'] ?> ">
                </div>
                <div class="form-group">
                    <label for="kelas">Pilih Kelas :</label>
                    <?php
                        $sql = 'Select * from kelas Order By nama_kelas Asc;';
                        $query = mysqli_query($db, $sql);
                    ?>
                    <select name="kelas" class="form-control">
                        <option value="0">Pilih Kelas yang Tersedia</option>
                        <?php if(mysqli_num_rows($query) > 0) { ?> 
                            <?php while($row = mysqli_fetch_assoc($query)) { ?>
                                <?php $number = (int)$row['id']; ?>
                                <option <?php echo ($tugas['kelas'] == $row['id']) ? "selected" : "" ?> 
                                    value= <?php echo $number ?>><?php echo $row['nama_kelas']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dokumen">Upload Dokumen :</label><br><br>
                    <?php

                    if($tugas['dokumen'] != NULL){
                        $info = pathinfo($tugas['dokumen']);
                        if ($info['extension'] == "pdf"){
                            echo "<iframe src='document/".$tugas['dokumen']."' width='560' height='480' allow='autoplay'>Browser anda tidak mendukung Iframe.</iframe><br><br>";

                            echo "<input type='file' name='dokumen' value='".$tugas['dokumen']."'><br><br>";
                            echo "<input type='checkbox' name='ubah_dokumen' value='true'> Ceklis jika ingin mengubah dokumen saat ini<br>";
                        }
                        else{
                            echo "<a href='document/".$tugas['dokumen']."'>" .$tugas['dokumen']. "</a>";
                            echo "<br><br>";
                            echo "<input type='file' name='dokumen' value='".$tugas['dokumen']."'><br><br>";
                            echo "<input type='checkbox' name='ubah_dokumen' value='true'> Ceklis jika ingin mengubah dokumen saat ini<br>";
                        }
                    } 
                    else {
                        echo "Tidak ada dokumen!<br><br>";
                        echo "<input type='file' name='dokumen' value=''><br><br>";
                        echo "<input type='checkbox' name='ubah_dokumen' value='true'> Ceklis jika ingin mengubah dokumen saat ini<br>";
                    }
                    ?>
                </div>
                <span style="display : inline">
                    <button name="ubah" type="submit" class="btn btn-primary" style="margin-top: 20px; width: 10%;">Ubah</button>
                    <a href="list-tugas.php"><button type="button" name="cancel" class="btn btn-danger" style="margin-top: 20px; margin-left: 3%; width: 10%;">Batal</button></a>
                </span>
            </form>
        </div>
    </div>

    <footer>
        <h4>&copy All Rights Reserved.</h4>
    </footer>
</body>

</html>