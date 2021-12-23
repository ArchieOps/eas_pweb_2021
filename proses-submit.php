<?php

include("config.php");

session_start();

if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $kelas = (int)$_POST['kelas'];
    $user_id = (int)$_SESSION['user_id'];
    $tmpwaktu = date_create();
    $waktu = date_format($tmpwaktu, 'Y-m-d H:i:s');

    if($judul == "" || $kelas == 0){
        header('Location: form-submit.php?status=kuranglengkap');
    } 
    else {
        if(isset($_POST['ubah_dokumen'])){
            $dokumen = $_FILES['dokumen']['name'];
            $tmp = $_FILES['dokumen']['tmp_name'];
    
            $dokumenbaru = date('dmYHis').$dokumen;
            $path = "document/".$dokumenbaru;
    
            if(move_uploaded_file($tmp, $path)){
                $sql = "Insert into assignment (judul, kelas, dokumen, user_id, waktu) values ('$judul', $kelas, '$dokumenbaru', $user_id, '$waktu');";
                $query = mysqli_query($db, $sql);
        
                if ($query) {
                    header('Location: menu.php?status=sukses');
                } else {
                    header('Location: menu.php?status=gagal');
                }
            } else{
                echo 'alert("Maaf, Dokumen gagal untuk diupload")';
                echo "<br><a href='form-submit.php'>Kembali Ke Form</a>";
            }
        }
        else{
            $sql = "Insert into assignment (judul, kelas, user_id, waktu) values ('$judul', $kelas, $user_id, '$waktu');";
            $query = mysqli_query($db, $sql);
            if ($query) {
                header('Location: menu.php?status=sukses');
            } else {
                header('Location: menu.php?status=gagal');
            }
        } 
    }
}
else{
    die("Akses dilarang...");
}
