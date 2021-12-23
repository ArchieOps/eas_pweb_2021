<?php
    include("config.php");

    if (isset($_POST['register'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nis = $_POST['nis'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        $sql = "Select * from user where nis='$nis'";
        $query = mysqli_query($db, $sql);
        $cek = mysqli_num_rows($query);

        if ($nis == "" || $email == "" || $nama=="" || $password == "" || $repassword == ""){
            header('Location: form-register.php?regakun=kuranglengkap');
        } else {
            if ($cek <= 0) {
                $sql0 = "Select * from user where email='$email'";
                $query0 = mysqli_query($db, $sql);
                $cek0 = mysqli_num_rows($query);
    
                if($cek0 <= 0){
                    if($password == $repassword){
                        $sql2 = "Insert into user (nama, nis, email, password) values ('$nama', '$nis', '$email', '$password')";
                        $query2 = mysqli_query($db, $sql2);
            
                        if ($query2) {
                            header('Location: index.php?regstatus=sukses');
                        } else {
                            header('Location: form-register.php?regakun=gagal');
                        }
                    }
                    else{
                        // password yang dimasukkan tidak sesuai
                        header('Location: form-register.php?regakun=wrongpass');
                    }
                } 
                else{
                    header('Location: form-register.php?regakun=emailalreadyreg');
                }
            } 
            else {
                // Data akun sudah ada di db
                header('Location: form-register.php?regakun=nisalreadyreg');
            }
        }     
    }
    else{
        die('Akses Dilarang ...');
    }
?>