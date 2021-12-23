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

$sql = "Select * from assignment Where id=$id";
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
    <title>Detail Pengumpulan Assignment | SMK Coding</title>
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
    <h1 style="margin-bottom: 40px;">Detail Submission</h1>
        <div class="container">
            <div id="formMahasiswa">
                <table class="table table-borderless custab">
                    <tr>
                        <td style="width: 25%"><label for="nama">Waktu Submission</label></td>
                        <td style="width: 2%"> : </td>
                        <td style=""><?php echo $tugas['waktu']?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%"><label for="nama">Nama Siswa</label></td>
                        <td style="width: 2%"> : </td>
                        <td style=""><?php echo $_SESSION['nama']?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%"><label for="nama">Nomor Induk Siswa</label></td>
                        <td style="width: 2%"> : </td>
                        <td style=""><?php echo $_SESSION['nis']?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%"><label for="nama">Judul Tugas</label></td>
                        <td style="width: 2%"> : </td>
                        <td style=""><?php echo $tugas['judul']?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%"><label for="nama">Kelas</label></td>
                        <td style="width: 2%"> : </td>
                        <td style=""><?php 
                                $kelasID = $tugas['kelas'];
                                $sql0 = "Select * from kelas Where id=$kelasID";
                                $query0 = mysqli_query($db, $sql0);
                                $kelas = mysqli_fetch_assoc($query0);
                                echo $kelas['nama_kelas']; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%"><label for="nama">Upload Dokumen</label></td>
                        <td style="width: 2%"> : </td>
                        <td style=""><?php 
                            if($tugas['dokumen'] != NULL){
                                $info = pathinfo($tugas['dokumen']);
                                if ($info['extension'] == "pdf"){
                                    echo "<iframe src='document/".$tugas['dokumen']."' width='560' height='480' allow='autoplay'>Browser anda tidak mendukung Iframe.</iframe>";
                                }
                                else{
                                    echo "<a href='document/".$tugas['dokumen']."'>" .$tugas['dokumen']. "</a>";
                                }
                                   
                            } else{
                                echo "Tidak ada dokumen!";
                            }?>
                        </td>
                    </tr>
                </table>
                <a href="list-tugas.php"><button  type="button" class="btn btn-primary float-right" style="margin-top: 20px;">Kembali</button></a>
            </div> 
        </div>
    </div>

    <footer>
        <h4>All Rights Reserved</h4>
    </footer>
</body>


</html>