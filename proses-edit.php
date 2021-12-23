<?php

include("config.php");

session_start();

if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $kelas = (int)$_POST['kelas'];
    $user_id = (int)$_SESSION['user_id'];
    $tmpwaktu = date_create();
    $waktu = date_format($tmpwaktu, 'Y-m-d H:i:s');

    if($judul == "" || $kelas == 0){
        header("Location: form-edit.php?id='$id'&status=kuranglengkap");
    } 
    else {
        if(isset($_POST['ubah_dokumen'])){
            $dokumen = $_FILES['dokumen']['name'];
            $tmp = $_FILES['dokumen']['tmp_name'];
    
            $dokumenbaru = date('dmYHis').$dokumen;
            $path = "document/".$dokumenbaru;
    
            if(move_uploaded_file($tmp, $path)){
                $sql= "Select * From assignment WHERE id='$id'";
                $query = mysqli_query($db, $sql);
                $data = mysqli_fetch_array($query);

                if(is_file("document/".$data['dokumen'])) 
                unlink("document/".$data['dokumen']);


                $sql = "Update assignment set judul='$judul', kelas='$kelas', waktu='$waktu', dokumen='$dokumenbaru', nilai=0 Where id='$id'";
                $query = mysqli_query($db, $sql);
        
                if ($query) {
                    header('Location: list-tugas.php');
                } 
                else {
                    die('Gagal menyimpan perubahan');
                }
            } 
            else{
                echo 'alert("Maaf, Dokumen gagal untuk diupload")';
                echo "<br><a href='form-edit.php'>Kembali Ke Form</a>";
            }
        }
        else{
            $sql = "Update assignment set judul='$judul', kelas='$kelas', waktu='$waktu', nilai=0 Where id='$id';";
            $query = mysqli_query($db, $sql);
            if ($query) {
                header('Location: list-tugas.php');
            } 
            else {
                die('Gagal menyimpan perubahan');
            }
        } 
    }
}
else{
    die("Akses dilarang...");
}