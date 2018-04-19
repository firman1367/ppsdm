<?php
    session_start();
    include ("../config/koneksi.php");

    $aksi = $_GET['aksi'];

    if ($aksi == "add_admin") {
        $fullname   = $_POST['fullname'];
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $password2  = md5($password);
        $level      = $_POST['level'];
        $status     = $_POST['status'];
        $query      = mysqli_query($koneksi,("SELECT username FROM tb_admin WHERE username = '$username'"));
        $cek        = mysqli_num_rows($query);

        if ($cek > 0) {
            echo "<script language='javascript'>alert('data telah tersedia')</script>";
      		echo "<script language='javascript'>window.location = '../administrator'</script>";
        }else {
            mysqli_query($koneksi,("INSERT INTO tb_admin VALUES (NULL,'$username','$password2','$fullname',NOW(),'$level','$status')")) or die(mysql_errno());
            header('location:../home.php?page=mod_admin');
        }
    }

    else if ($aksi == "add_sdmk") {
        $id_sdmk        = $_POST['id_sdmk'];
        $nomenklatur    = $_POST['nomenklatur'];
        $rumpun         = $_POST['rumpun'];
        $jenis_rumpun   = $_POST['jenis_rumpun'];
        $query          = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk WHERE id_sdmk = '$id_sdmk'"));
        $cek            = mysqli_num_rows($query);

        if ($cek > 0) {
            echo "<script language='javascript'>alert('ID SDMK $id_sdmk telah terdaftar')</script>";
      		echo "<script language='javascript'>window.location = '../home.php?page=mod_sdmk'</script>";
        }else{
            mysqli_query($koneksi,("INSERT INTO tb_kodesdmk VALUES (NULL,'$id_sdmk','$nomenklatur','$rumpun','$jenis_rumpun')")) or die(mysql_errno());
            header('location:../home.php?page=mod_sdmk');
        }
    }

    else if ($aksi == "add_kodedik") {
        $kode_dik       = $_POST['kode_dik'];
        $kode_strata    = $_POST['kode_strata'];
        $nama_dik       = $_POST['nama_dik'];
        $query          = mysqli_query($koneksi,("SELECT * FROM tb_kodedik WHERE kode_dik = '$kode_dik'"));
        $cek            = mysqli_num_rows($query);

        if ($cek > 0) {
            echo "<script language='javascript'>alert('Kode Pendidikan $kode_dik telah terdaftar')</script>";
      		echo "<script language='javascript'>window.location = '../home.php?page=mod_pendidikan'</script>";
        }else{
            mysqli_query($koneksi,("INSERT INTO tb_kodedik VALUES (NULL,'$kode_dik','$kode_strata','$nama_dik')")) or die(mysql_errno());
            header('location:../home.php?page=mod_pendidikan');
        }
    }

    else if ($aksi == "add_kodeprovinsi") {
        $kode_prov    = $_POST['kode_prov'];
        $nama_prov    = strtoupper($_POST['nama_prov']);
        $query        = mysqli_query($koneksi,("SELECT * FROM tb_prov WHERE kode_prov = '$kode_prov'"));
        $cek          = mysqli_num_rows($query);

        if ($cek > 0) {
            echo "<script language='javascript'>alert('Kode Provinsi $kode_prov telah terdaftar')</script>";
      		echo "<script language='javascript'>window.location = '../home.php?page=mod_provinsi'</script>";
        }else{
            mysqli_query($koneksi,("INSERT INTO tb_prov VALUES ('$kode_prov','$nama_prov')")) or die(mysql_errno());
            header('location:../home.php?page=mod_provinsi');
        }
    }

    else if ($aksi == "add_kabupaten") {
        $kode_kab       = $_POST['kode_kab'];
        $nama_kab       = strtoupper($_POST['nama_kab']);
        $kode_prov      = $_POST['kode_prov'];
        $jml_puskesmas  = $_POST['jml_puskesmas'];
        $jml_rs         = $_POST['jml_rs'];
        $query          = mysqli_query($koneksi,("SELECT * FROM tb_kab_kota WHERE kode_kab = '$kode_kab'"));
        $cek            = mysqli_num_rows($query);

        if ($cek > 0) {
            echo "<script language='javascript'>alert('Kode Kabupaten $kode_kab telah terdaftar')</script>";
      		echo "<script language='javascript'>window.location = '../home.php?page=mod_kabupaten'</script>";
        }else{
            mysqli_query($koneksi,("INSERT INTO tb_kab_kota VALUES ('$kode_kab','$nama_kab','$kode_prov','$jml_puskesmas','$jml_rs')")) or die(mysql_errno());
            header('location:../home.php?page=mod_kabupaten');
        }
    }

    else if ($aksi == "add_fasyankes") {
        $kode_fasyankes     = strtoupper($_POST['kode_fasyankes']);
        $nama_fasyankes     = strtoupper($_POST['nama_fasyankes']);
        $tipe               = strtoupper($_POST['tipe']);
        $kode_prov          = $_POST['kode_prov'];
        $kode_kab           = $_POST['kode_kab'];
        $kode_fas_old       = $_POST['kode_fas_old'];

        $query          = mysqli_query($koneksi,("SELECT * FROM tb_fasyankes WHERE kode_fasyankes = '$kode_fasyankes'"));
        $cek            = mysqli_num_rows($query);

        if ($cek > 0) {
            echo "<script language='javascript'>alert('Kode Fasyankes $kode_fasyankes telah terdaftar')</script>";
      		echo "<script language='javascript'>window.location = '../home.php?page=mod_fasyankes'</script>";
        }else{
            mysqli_query($koneksi,("INSERT INTO tb_fasyankes VALUES (NULL,'$kode_fasyankes','$nama_fasyankes','$tipe',
                                                                    '$kode_prov','$kode_kab','$kode_fas_old')")) or die(mysql_errno());
            header('location:../home.php?page=mod_fasyankes');
        }
    }

    else if ($aksi == "add_sdm") {
        $id_sdm         = $_POST['id_sdm'];
        $nama           = $_POST['nama'];
        $kelamin        = $_POST['jenis_kelamin'];
        $status         = $_POST['status_kepegawaian'];
        $nama_prov      = $_POST['nama_prov'];
        $nama_kab       = $_POST['nama_kab'];
        $nama_unit      = $_POST['nama_unit'];
        $rumpun_sdmk    = $_POST['rumpun_sdmk'];
        $jenis_sdmk     = $_POST['jenis_sdmk'];
        $strata         = $_POST['strata_pendidikan'];
        $studi          = $_POST['program_studi'];

        $query          = mysqli_query($koneksi,("SELECT * FROM tb_sdm WHERE id_sdm = '$id_sdm'"));
        $cek            = mysqli_num_rows($query);

        if ($cek > 0) {
            echo "<script language='javascript'>alert('ID SDM $id_sdm telah terdaftar')</script>";
      		echo "<script language='javascript'>window.location = '../home.php?page=mod_sdm'</script>";
        }else{
            mysqli_query($koneksi,("INSERT INTO tb_sdm VALUES ('$id_sdm','$nama','$kelamin','$status',
                                                               '$nama_prov','$nama_kab','$nama_unit',
                                                               '$rumpun_sdmk','$jenis_sdmk','$strata','$studi')")) or die(mysql_errno());
            header('location:../home.php?page=mod_sdm');
        }
    }

?>
