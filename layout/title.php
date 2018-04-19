<?php
    if ($_GET["page"] == "dashboard") {
        echo "Dashboard";
    }else if ($_GET["page"] == "mod_admin") {
        echo "Data Administrator";
    }else if ($_GET["page"] == "mod_sdmk") {
        echo "KODIFIKASI SDMK";
    }else if ($_GET["page"] == "mod_pendidikan") {
        echo "KODIFIKASI PENDIDIKAN";
    }else if ($_GET["page"] == "mod_provinsi") {
        echo "KODIFIKASI PROVINSI";
    }else if ($_GET["page"] == "mod_kabupaten") {
        echo "KODIFIKASI KABUPATEN";
    }else if ($_GET["page"] == "mod_fasyankes") {
        echo "KODIFIKASI FASYANKES";
    }else if ($_GET["page"] == "mod_sdm") {
        echo "Data SDM";
    }
?>
