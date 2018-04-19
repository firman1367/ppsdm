<?php

    session_start();
    include "config/koneksi.php";

    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $password2  = md5($password);
    $status     = "active";

    $query      = mysqli_query($koneksi,("SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password2' AND status = '$status'"));
    $cek        = mysqli_num_rows($query);
    $data       = mysqli_fetch_array($query);

    $id         = $data['id_admin'];
    $username   = $data['username'];
    $fullname   = $data['fullname'];
    $level      = $data['level'];

    if ($cek) {
        $_SESSION['id_admin']   = $id;
        $_SESSION['username']   = $username;
        $_SESSION['fullname']   = $fullname;
        $_SESSION['level']      = $level;

        header('location:home.php?page=dashboard');
    }else{
        echo "<script>alert('wrong username or password')</script>";
        echo "<script>window.location = 'index.php'</script>";
    }

?>
