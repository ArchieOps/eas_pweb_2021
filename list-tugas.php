<?php 

include("config.php"); 
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
    <title>List Pengumpulan Tugas Siswa | SMK Coding</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script> -->

    <style>
        .custab {
            border: 1px solid #ccc;
            padding: 5px;
            transition: 0.5s;
        }

        .custab:hover {
            box-shadow: 3px 3px 0px transparent;
            transition: 0.5s;
        }
    </style>
</head>

<body>
    <header>
        <span style="display: inline;">
            <a href="menu.php"><img src="images/smk-coding.png" alt="gambar"></a>
            <a href="logout.php"> <button type="button" class="btn btn-danger btn-sm float-right" style="margin-top: 2%; margin-right: 3%;">Log Out</button></a>    
        </span>  
    </header>

    <div id="dataTable" style="margin-top:20px; margin-bottom: 40px; width: 90%; margin-left: auto; margin-right: auto;">
        <h1>List Submission Tugas</h1>
        <br>
        <!-- <div>
            <?php if (isset($_GET['hapus'])) : ?>
                <p>
                    <?php
                        if ($_GET['hapus'] == 'sukses') {
                            echo "<h4 style='color: #bf2b16; margin-bottom: 20px;'>Penghapusan Berhasil!</h4>";
                        }           
                    ?>
                </p>
            <?php endif; ?>
        </div> -->
        <br>
            <p style="text-align: right; margin:15px">
                <a href=" form-submit.php" class="btn btn-primary btn-xs col-md-3">[+] Tambah Baru</a>
            </p>
            <div class="col-md-12 col-md-offset-2 custyle">
                <table class="table table-striped custab">
                    <thead>
                        <tr> 
                            <th width="5%" style="text-align: center;">Detail</th>   
                            <th width="8%" style="text-align: center;">ID Tugas</th>
                            <th width="20%" style="text-align: center;">Waktu Submit</th>
                            <th width="22%" style="text-align: center;">Judul Tugas</th>
                            <th width="20%" style="text-align: center;">Kelas</th>
                            <th style="text-align: center;">Aksi</th>
                            <th width="8%" style="text-align: center;">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = (int)$_SESSION['user_id'];
                        $sql = "Select * From assignment where user_id =  $user_id";
                        $query = mysqli_query($db, $sql);

                        while ($tugas = mysqli_fetch_array($query)) {
                            $tugaskelas = (int)$tugas['kelas'];

                            $sql1 = "select * from kelas where id=$tugaskelas";
                            $query1 = mysqli_query($db, $sql1);
                            $kelas = mysqli_fetch_assoc($query1);
                            
                            echo "<tr>";
                            echo "<td><a  class='btn btn-success btn-xs' href='form-detail.php?id=" . $tugas['id'] . "'><span class='glyphicon glyphicon-remove'></span>Detail</a></td>";
                            echo "<td class='text-center'>" . $tugas['id'] . "</td>";
                            echo "<td class='text-center'>" . $tugas['waktu'] . "</td>";
                            echo "<td class='text-center'>" . $tugas['judul'] . "</td>";
                            echo "<td class='text-center'>" . $kelas['nama_kelas'] . "</td>";
                            echo "<td class='text-center'>";
                            if($tugas['nilai'] == 0){
                                echo "<a class='btn btn-info btn-sm' href='form-edit.php?id=" . $tugas['id'] . "' ><span class='glyphicon glyphicon-edit'></span>Edit</a> | ";
                            }
                            echo "<a  class='btn btn-danger btn-sm' href='hapus.php?id=" . $tugas['id'] . "' 
                            onclick='return confirm(`Apakah anda yakin ingin menghapus item ini?`)'><span class='glyphicon glyphicon-remove'></span>Hapus</a>";
                            echo "</td>";
                            echo "<td class='text-center'>";
                            if($tugas['nilai'] == 0) {
                                echo "-";
                            } else{
                                echo $tugas['nilai'];
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <p style="font-weight : bolder">Total : <?php echo mysqli_num_rows($query) ?></p>
                <div id="editor"></div>
                <!-- <buttont  type="button" class="btn btn-warning float-right" style="margin-top: 2%; margin-right:2%; width: 5%" 
                    id="btn-downloadlist">Print</buttont> -->
            </div>
        </div>
    <footer>
        <h4>All Rights Reserved</h4>
    </footer>
</body>