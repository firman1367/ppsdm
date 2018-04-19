<?php
    session_start();
    include ("../config/koneksi.php");

    $aksi = $_GET['aksi'];

    if ($aksi == "edit_admin") {
        $id_admin       = $_POST['id_admin'];
        $fullname       = $_POST['fullname'];
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        $password2      = md5($password);
        $pass_new       = $_POST['password_baru'];
        $pass_conf      = $_POST['password_conf'];
        $pass_conf_2    = md5($pass_conf);
        $level          = $_POST['level'];
        $status         = $_POST['status'];

        $query          = mysqli_query($koneksi,("SELECT * FROM tb_admin WHERE id_admin = '$id_admin'"));
        $row            = mysqli_fetch_array($query);

        if ($password == "") {
            mysqli_query($koneksi,("UPDATE tb_admin SET fullname = '$fullname', username = '$username',
                                           level = '$level', status = '$status'
                                           WHERE id_admin = '$id_admin'")) or die(mysql_errno());
            echo "<script language='javascript'>alert('update berhasil')</script>";
            echo "<script language='javascript'>window.location = '../home.php?page=mod_admin'</script>";
        } else if ($password2 == $row['password']) {
            if ($pass_new == "") {
                mysqli_query($koneksi,("UPDATE tb_admin SET fullname = '$fullname', username = '$username',
                                               level = '$level', status = '$status'
                                               WHERE id_admin = '$id_admin'")) or die(mysql_errno());
                echo "<script language='javascript'>alert('update berhasil')</script>";
                echo "<script language='javascript'>window.location = '../home.php?page=mod_admin'</script>";
            } else if ($pass_conf == $pass_new) {
                mysqli_query($koneksi,("UPDATE tb_admin SET fullname = '$fullname', username = '$username',
                                               password = '$pass_conf_2', level = '$level', status = '$status'
                                               WHERE id_admin = '$id_admin'")) or die(mysql_errno());
                echo "<script language='javascript'>alert('update berhasil')</script>";
                echo "<script language='javascript'>window.location = '../home.php?page=mod_admin'</script>";
            }else {
                echo "<script language='javascript'>alert('update gagal')</script>";
                echo "<script language='javascript'>window.location = '../home.php?page=mod_admin'</script>";
            }
        }
        else{
            echo "<script language='javascript'>alert('update gagal')</script>";
            echo "<script language='javascript'>window.location = '../home.php?page=mod_admin'</script>";
        }
    }

    else if ($aksi == "edit_sdmk") {
        $urut           = $_POST['urut'];
        $id_sdmk        = $_POST['id_sdmk'];
        $nomenklatur    = $_POST['nomenklatur'];
        $rumpun         = $_POST['rumpun'];
        $jenis_rumpun   = $_POST['jenis_rumpun'];

        $query          = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk WHERE id_sdmk = '$id_sdmk'"));
        $row            = mysqli_num_rows($query);

        if ($row > 0) {
            mysqli_query($koneksi,("UPDATE tb_kodesdmk SET nomenklatur = '$nomenklatur',
                                           rumpun = '$rumpun', rumpun_jenis = '$jenis_rumpun'
                                           WHERE urut = '$urut'")) or die(mysql_errno());
            echo "<script>window.location = '../home.php?page=mod_sdmk'</script>";
        }else{
            mysqli_query($koneksi,("UPDATE tb_kodesdmk SET id_sdmk = '$id_sdmk', nomenklatur = '$nomenklatur',
                                           rumpun = '$rumpun', rumpun_jenis = '$jenis_rumpun'
                                           WHERE urut = '$urut'")) or die(mysql_errno());

            echo "<script>alert('update berhasil')</script>";
            echo "<script>window.location = '../home.php?page=mod_sdmk'</script>";
        }
    }

    else if ($aksi == "edit_kodedik") {
        $id_dik         = $_POST['id_dik'];
        $kode_dik       = $_POST['kode_dik'];
        $kode_strata    = $_POST['kode_strata'];
        $nama_dik       = $_POST['nama_dik'];

        $query          = mysqli_query($koneksi,("SELECT * FROM tb_kodedik WHERE kode_dik = '$kode_dik'"));
        $row            = mysqli_num_rows($query);

        if ($row > 0) {
            mysqli_query($koneksi,("UPDATE tb_kodedik SET kode_strata = '$kode_strata', nama_dik = '$nama_dik'
                                           WHERE id_dik = '$id_dik'")) or die(mysql_errno());
            echo "<script>window.location = '../home.php?page=mod_pendidikan'</script>";
        }else{
            mysqli_query($koneksi,("UPDATE tb_kodedik SET kode_dik = '$kode_dik', kode_strata = '$kode_strata', nama_dik = '$nama_dik'
                                           WHERE id_dik = '$id_dik'")) or die(mysql_errno());

            echo "<script>alert('update berhasil')</script>";
            echo "<script>window.location = '../home.php?page=mod_pendidikan'</script>";
        }
    }

    else if ($aksi == "edit_kodeprov") {
        $kode_prov_pr   = $_POST['kode_prov_pr'];
        $kode_prov      = $_POST['kode_prov'];
        $nama_prov      = strtoupper($_POST['nama_prov']);

        $query        = mysqli_query($koneksi,("SELECT * FROM tb_prov WHERE kode_prov = '$kode_prov'"));
        $row          = mysqli_num_rows($query);

        if ($row > 0) {
            mysqli_query($koneksi,("UPDATE tb_prov SET nama_prov = '$nama_prov' WHERE kode_prov = '$kode_prov_pr'")) or die(mysql_errno());
            echo "<script>window.location = '../home.php?page=mod_provinsi'</script>";
        }else{
            mysqli_query($koneksi,("UPDATE tb_prov SET kode_prov = '$kode_prov', nama_prov = '$nama_prov' WHERE kode_prov = '$kode_prov_pr'")) or die(mysql_errno());

            echo "<script>alert('update berhasil')</script>";
            echo "<script>window.location = '../home.php?page=mod_provinsi'</script>";
        }
    }

    else if ($aksi == "edit_kabupaten") {
        $kode_kab_pr    = $_POST['kode_kab_pr'];
        $kode_kab       = $_POST['kode_kab'];
        $nama_kab       = strtoupper($_POST['nama_kab']);
        $kode_prov      = $_POST['kode_prov'];
        $jml_puskesmas  = $_POST['jml_puskesmas'];
        $jml_rs         = $_POST['jml_rs'];

        $query          = mysqli_query($koneksi,("SELECT * FROM tb_kab_kota WHERE kode_kab = '$kode_kab'"));
        $row            = mysqli_num_rows($query);

        if ($row > 0) {
            mysqli_query($koneksi,("UPDATE tb_kab_kota SET nama_kab = '$nama_kab', kode_prov = '$kode_prov',
                                    jml_puskesmas = '$jml_puskesmas', jml_rs = '$jml_rs'
                                    WHERE kode_kab = '$kode_kab_pr'")) or die(mysql_errno());
            echo "<script>window.location = '../home.php?page=mod_kabupaten'</script>";
        }else{
            mysqli_query($koneksi,("UPDATE tb_kab_kota SET  kode_kab = '$kode_kab', nama_kab = '$nama_kab', kode_prov = '$kode_prov',
                                    jml_puskesmas = '$jml_puskesmas', jml_rs = '$jml_rs'
                                    WHERE kode_kab = '$kode_kab_pr'")) or die(mysql_errno());

            echo "<script>alert('update berhasil')</script>";
            echo "<script>window.location = '../home.php?page=mod_kabupaten'</script>";
        }
    }

    else if ($aksi == "edit_fasyankes") {
        $id_fasyankes       = $_POST['id_fasyankes'];
        $kode_fasyankes     = strtoupper($_POST['kode_fasyankes']);
        $nama_fasyankes     = strtoupper($_POST['nama_fasyankes']);
        $tipe               = strtoupper($_POST['tipe']);
        $kode_prov          = $_POST['kode_prov'];
        $kode_kab           = $_POST['kode_kab'];
        $kode_fas_old       = $_POST['kode_fas_old'];

        $query          = mysqli_query($koneksi,("SELECT * FROM tb_fasyankes WHERE kode_fasyankes = '$kode_fasyankes'"));
        $row            = mysqli_num_rows($query);

        if ($row > 0) {

            mysqli_query($koneksi,("UPDATE tb_fasyankes SET nama_fasyankes = '$nama_fasyankes', tipe = '$tipe',
                                    kode_prov = '$kode_prov', kode_kab = '$kode_kab', kode_fas_old = '$kode_fas_old'
                                    WHERE id_fasyankes = '$id_fasyankes'")) or die(mysql_errno());
            echo "<script>window.location = '../home.php?page=mod_fasyankes'</script>";

        }else{

            mysqli_query($koneksi,("UPDATE tb_fasyankes SET kode_fasyankes = '$kode_fasyankes', nama_fasyankes = '$nama_fasyankes', tipe = '$tipe',
                                    kode_prov = '$kode_prov', kode_kab = '$kode_kab', kode_fas_old = '$kode_fas_old'
                                    WHERE id_fasyankes = '$id_fasyankes'")) or die(mysql_errno());
            echo "<script>alert('update berhasil')</script>";
            echo "<script>window.location = '../home.php?page=mod_fasyankes'</script>";

        }
    }

    else if ($aksi == "edit_sdm") {
        $id_sdm_pk      = $_POST['id_sdm_pk'];
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
        $row            = mysqli_num_rows($query);

        if ($row > 0) {

            mysqli_query($koneksi,("UPDATE tb_sdm SET nama = '$nama', jenis_kelamin = '$kelamin', status_kepegawaian = '$status',
                                    nama_prov = '$nama_prov', nama_kab = '$nama_kab', nama_unit = '$nama_unit',
                                    rumpun_sdmk = '$rumpun_sdmk', jenis_sdmk = '$jenis_sdmk',
                                    strata_pendidikan = '$strata', program_studi = '$studi'
                                    WHERE id_sdm = '$id_sdm_pk'")) or die(mysql_errno());
            echo "<script>window.location = '../home.php?page=mod_sdm'</script>";

        }else{

            mysqli_query($koneksi,("UPDATE tb_sdm SET id_sdm = '$id_sdm', nama = '$nama', jenis_kelamin = '$kelamin', status_kepegawaian = '$status',
                                    nama_prov = '$nama_prov', nama_kab = '$nama_kab', nama_unit = '$nama_unit', rumpun_sdmk = '$rumpun_sdmk', jenis_sdmk = '$jenis_sdmk',
                                    strata_pendidikan = '$strata', program_studi = '$studi'
                                    WHERE id_sdm = '$id_sdm_pk'")) or die(mysql_errno());

            echo "<script>alert('update berhasil')</script>";
            echo "<script>window.location = '../home.php?page=mod_sdm'</script>";

        }
    }

?>
