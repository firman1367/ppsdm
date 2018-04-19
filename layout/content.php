<!-- PAGE CONTENT -->
<div class="page-content">

    <!-- START X-NAVIGATION VERTICAL -->
    <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
        <!-- SIGN OUT -->
        <li class="xn-icon-button pull-right">
            <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
        </li>
        <!-- TOGGLE NAVIGATION -->
        <li class="xn-icon-button">
            <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
        </li>
        <!-- END TOGGLE NAVIGATION -->
    </ul>
    <!-- END X-NAVIGATION VERTICAL -->

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="home.php?page=dashboard">Dashboard</a></li>
        <li class="active"><?php include('breadcrumb_title.php') ?></li>
    </ul>
    <!-- END BREADCRUMB -->
    <!-- TITLE PAGE -->
    <div class="page-title">
        <h2><?php include('breadcrumb_title.php') ?></h2>
    </div>
    <!-- END OF TITLE PAGE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <?php
                    if ($_GET["page"] == "dashboard") {
                        include "form/dashboard.php";
                    }else if ($_GET["page"] == "mod_admin") {
                        include "form/mod_admin.php";
                    }else if ($_GET["page"] == "mod_sdmk") {
                        include "form/mod_sdmk.php";
                    }else if ($_GET["page"] == "mod_pendidikan") {
                        include "form/mod_pendidikan.php";
                    }else if ($_GET["page"] == "mod_provinsi") {
                        include "form/mod_provinsi.php";
                    }else if ($_GET["page"] == "mod_kabupaten") {
                        include "form/mod_kabupaten.php";
                    }else if ($_GET["page"] == "mod_fasyankes") {
                        include "form/mod_fasyankes.php";
                    }else if ($_GET["page"] == "mod_sdm") {
                        include "form/mod_sdm.php";
                    }
                ?>

            </div>
        </div>

    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->
