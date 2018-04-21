<?php

    $prov           = $_POST['nama_prov'];
    $rumpun         = $_POST['rumpun_sdmk'];
    $kode_strata    = $_POST['strata_pendidikan'];
    $nama_dik       = $_POST['program_studi'];

    $query      = mysqli_query($koneksi,("SELECT * FROM tb_sdm WHERE nama_prov = '$prov' OR rumpun_sdmk = '$rumpun' OR strata_pendidikan = '$kode_strata' OR program_studi = '$nama_dik'"));
    $data_get   = mysqli_fetch_array($query);

?>

<?php echo $data_get['nama_prov'] ?>
<?php echo $data_get['rumpun_sdmk'] ?>
<?php echo $data_get['strata_pendidikan'] ?>
<?php echo $data_get['program_studi'] ?>
