<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "Select * from assignment Where id=$id";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_array($query);

    if(is_file("document/".$data['dokumen'])){
        unlink("document/".$data['dokumen']);
    }

    $sql2 = "Delete from assignment Where id=$id";
    $query2 = mysqli_query($db, $sql2);

    if ($query2) {
        header('Location: list-tugas.php?hapus=sukses');
    } else {
        die("Gagal menghapus...");
    }
} else {
    die("Akses Dilarang...");
}
