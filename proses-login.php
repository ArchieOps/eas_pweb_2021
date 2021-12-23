<?php
    include ("config.php");
    
    session_start();

    if (isset($_POST['login'])){
        $nis = $_POST['nis'];
        $password = $_POST['password'];
    
        $sql = "Select * from user where nis='$nis' && password='$password'";
        $query = mysqli_query($db, $sql);
        $cek = mysqli_num_rows($query);
    
        if ($cek > 0) {
            $user = mysqli_fetch_assoc($query); 
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['nis'] = $user['nis'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['status'] = "login";
            header('Location: menu.php');
            // header('Location: menu.php?user=' .$user["id"]. '');
        } else {
            header('Location: index.php?status=gagal');
        }
    }
?>