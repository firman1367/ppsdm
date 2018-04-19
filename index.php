<?php
    include "config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>SISTEM KEMENKES</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!--FAVICON-->
        <!--<link rel="icon" href="../favicon2.png" type="image/x-icon" />-->
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->
        <style media="screen">
        .x-navigation.x-navigation-horizontal {
            height: 50px;
            background-color: #1caf9a;
        }
        .x-navigation > li.xn-logo > a:first-child {
            font-size: 20px;
            border-bottom: 0px;
            color: #FFF;
            height: 50px;
            text-align: center;
            background-color: #1caf9a;
        }
        .x-navigation.x-navigation-horizontal .xn-logo a {
            border-bottom: 0px;
            width: auto;
        }
        .btn-me {
            background-color: #1caf9a;
            border-color: #1caf9a;
            color: white;
        }
        .btn-me:hover {
            background-color: #1ea491;
            border-color: #1ea491;
            color: white;
        }
        .footer {
           position:fixed;
           bottom:0px;
           height:auto;
           width:100%;
           background-color: rgb(50, 53, 58);
           border-color: #32353a;
           color: white;
        }
        .title-footer{
            float: right;
            padding:10px 5px 10px 5px;
            font-weight: bold;
        }
		.modal-open{
			padding-right: 0px !important;
		}
        </style>
    </head>
    <body>

        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">
            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">
                    <li class="xn-logo">
                        <a href="login"><b>SISTEM KEMENKES</b></a>
                    </li>
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- LOGIN -->
                <div class="login-container">

                    <div class="login-box animated fadeInDown">
                        <div class="login-logo"></div>
                        <div class="login-body">
                            <div class="login-title"><strong>LOGIN ADMIN</strong></div>
                            <form action="proses_login.php" class="form-horizontal" method="post">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-me btn-block">Log In</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="login-footer">
                            <div class="pull-left">
                                &copy; 2018 KEMENKES
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END LOGIN -->

            </div>
            <!-- END PAGE CONTENT -->

            <div class="footer">
                <div class="title-footer">Version Close Beta 2018</div>
            </div>

        </div>
        <!-- END PAGE CONTAINER -->

    </body>
</html>
