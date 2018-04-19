<?php
    if ($_GET["page"] == "dashboard") {
        echo "<label class='label label-info'>Dashboard</label>";
    }else if ($_GET["page"] == "mod_admin") {
        echo "<label class='label label-info'>Data Administrator</label>";
    }else if ($_GET["page"] == "mod_sdmk") {
        echo "<label class='label label-info'>KODIFIKASI SDMK</label>";
    }else if ($_GET["page"] == "mod_pendidikan") {
        echo "<label class='label label-info'>KODIFIKASI PENDIDIKAN</label>";
    }else if ($_GET["page"] == "mod_provinsi") {
        echo "<label class='label label-info'>KODIFIKASI PROVINSI</label>";
    }else if ($_GET["page"] == "mod_kabupaten") {
        echo "<label class='label label-info'>KODIFIKASI KABUPATEN</label>";
    }else if ($_GET["page"] == "mod_fasyankes") {
        echo "<label class='label label-info'>KODIFIKASI FASYANKES</label>";
    }else if ($_GET["page"] == "mod_sdm") {
        echo "<label class='label label-info'>Data SDM</label>";
    }
?>
