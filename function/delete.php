<?php
    session_start();
    include ("../config/koneksi.php");

    //ambil variable
    error_reporting(0);
    $aksi           = $_GET['aksi'];
    $id_admin       = $_GET['id_admin'];
    $id_sdmk        = $_GET['id_sdmk'];
    $id_dik         = $_GET['id_dik'];
    $kode_prov      = $_GET['kode_prov'];
    $kode_kab       = $_GET['kode_kab'];
    $id_fasyankes   = $_GET['id_fasyankes'];
    $id_sdm         = $_GET['id_sdm'];

    if ($aksi == "del_admin") {
        mysqli_query($koneksi,("DELETE FROM tb_admin WHERE id_admin = '$id_admin'")) or die(mysql_errno("gagal"));
        header("location:../home.php?page=mod_admin");
    }else if ($aksi == "del_sdmk") {
        mysqli_query($koneksi,("DELETE FROM tb_kodesdmk WHERE id_sdmk = '$id_sdmk'")) or die(mysql_errno("gagal"));
        echo "<script>alert('data telah dihapus')</script>";
        echo "<script>window.location='../home.php?page=mod_sdmk'</script>";
    }else if ($aksi == "del_kodedik") {
        mysqli_query($koneksi,("DELETE FROM tb_kodedik WHERE id_dik = '$id_dik'")) or die(mysql_errno("gagal"));
        echo "<script>alert('data telah dihapus')</script>";
        echo "<script>window.location='../home.php?page=mod_pendidikan'</script>";
    }else if ($aksi == "del_provinsi") {
        mysqli_query($koneksi,("DELETE FROM tb_prov WHERE kode_prov = '$kode_prov'")) or die(mysql_errno("gagal"));
        echo "<script>alert('data telah dihapus')</script>";
        echo "<script>window.location='../home.php?page=mod_provinsi'</script>";
    }else if ($aksi == "del_kabupaten") {
        mysqli_query($koneksi,("DELETE FROM tb_kab_kota WHERE kode_kab = '$kode_kab'")) or die(mysql_errno("gagal"));
        echo "<script>alert('data telah dihapus')</script>";
        echo "<script>window.location='../home.php?page=mod_kabupaten'</script>";
    }else if ($aksi == "del_fasyankes") {
        mysqli_query($koneksi,("DELETE FROM tb_fasyankes WHERE id_fasyankes = '$id_fasyankes'")) or die(mysql_errno("gagal"));
        echo "<script>alert('data telah dihapus')</script>";
        echo "<script>window.location='../home.php?page=mod_fasyankes'</script>";
    }else if ($aksi == "del_sdm") {
        mysqli_query($koneksi,("DELETE FROM tb_sdm WHERE id_sdm = '$id_sdm'")) or die(mysql_errno("gagal"));
        echo "<script>alert('data telah dihapus')</script>";
        echo "<script>window.location='../home.php?page=mod_sdm'</script>";
    }
?>
