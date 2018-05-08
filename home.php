<?php
    session_start();
    if (isset($_SESSION['level'])) {
        if ($_SESSION['level'] == 'superadmin' OR 'admin') {
            include "config/koneksi.php";
            $fullname   = $_SESSION['fullname'];
            $level      = $_SESSION['level'];
?>
<!DOCTYPE html>
<html lang="en">

    <!-- headers -->
    <?php require_once('layout/header.php') ?>
    <!-- end header -->

    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top-fixed">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar page-sidebar-fixed scroll">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="?page=dashboard">Adminpanel</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="assets/images/users/no-image.jpg"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="assets/images/users/no-image.jpg"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $fullname ?></div>
                                <div class="profile-data-title"><?php echo $level ?></div>
                            </div>
                        </div>
                    </li>
                    <li class="xn-title">Navigation</li>

                    <!-- MENU LEFT NAVIGATION -->
                    <li>
                        <a href="home.php?page=dashboard"><span class="fa fa-home"></span> <span class="xn-text">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="home.php?page=mod_admin"><span class="fa fa-user"></span> <span class="xn-text">Data Administrator</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-folder"></span> <span class="xn-text">Data Kodifikasi</span></a>
                        <ul>
                            <li>
                                <a href="?page=mod_sdmk"><span class="fa fa-ticket"></span> <span class="xn-text">Kodifikasi SDMK</span></a>
                            </li>
                            <li>
                                <a href="?page=mod_pendidikan"><span class="fa fa-ticket"></span> <span class="xn-text">Kodifikasi Pendidikan</span></a>
                            </li>
                            <li>
                                <a href="?page=mod_provinsi"><span class="fa fa-ticket"></span> <span class="xn-text">Kodifikasi Provinsi</span></a>
                            </li>
                            <li>
                                <a href="?page=mod_kabupaten"><span class="fa fa-ticket"></span> <span class="xn-text">Kodifikasi Kabupaten</span></a>
                            </li>
                            <li>
                                <a href="?page=mod_fasyankes"><span class="fa fa-ticket"></span> <span class="xn-text">Kodifikasi FASYANKES</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="home.php?page=mod_sdm"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Data SDM</span></a>
                    </li>
                    <li>
                        <a href="export/laporan_keseluruhan.php"><span class="fa fa-download"></span> <span class="xn-text">Unduh Laporan</span></a>
                    </li>
                    <!-- END -->

                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <?php require_once('layout/content.php') ?>
            <!-- END PAGE CONTENT -->

        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- FOOTER -->
        <?php require_once('layout/footer.php') ?>
        <!-- END FOOTER -->
    </body>
</html>
<?php
        }
    }
    else{
        session_destroy();
        echo "<script>alert('session expired')</script>";
        echo "<script>window.location = 'index.php'</script>";
        exit();
    }
?>
