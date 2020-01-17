<?php require_once( "load.php" );
global $user, $isLogin;
if ( ! $user || $isLogin == "N" || ! CV_isAdmin() ) {
	header( "Location: index.php" );
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <!-- Start Global Mandatory Style
	   =====================================================================-->
    <!-- jquery-ui css -->
    <link href="assets/mdl/material.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/simplePagination.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Lobipanel css -->
    <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
    <!-- Pace css -->
    <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Pe-icon -->
    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <!-- Themify icons -->
    <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
    <!-- End Global Mandatory Style
	   =====================================================================-->
    <!-- Start page Label Plugins
	   =====================================================================-->
    <!-- Emojionearea -->
    <link href="assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>

    <!-- End page Label Plugins
	   =====================================================================-->
    <!-- Start Theme Layout Style
	   =====================================================================-->
    <!-- Theme style -->
    <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>


    <link href="css/style.css" rel="stylesheet">
    <link href="css/mynewstyle.css" rel="stylesheet">
    <link href="css/simdashboard.css" rel="stylesheet">
    <link href="css/simresponsive.css" rel="stylesheet">
    <link href="assets/responsive.css" rel="stylesheet">
    <link href="assets/style2.css" rel="stylesheet">
    <link href="assets/custom.css" rel="stylesheet">
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    <!-- End Theme Layout Style
	   =====================================================================-->
    <style>
        .sidebar-mini.sidebar-collapse a.sidebar-toggle .pe-7s-angle-left-circle {
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        @media (max-width: 767px) {
            .sidebar-mini.pace-done a.sidebar-toggle .pe-7s-angle-left-circle {
                -webkit-transform: rotate(180deg);
                -moz-transform: rotate(180deg);
                -o-transform: rotate(180deg);
                -ms-transform: rotate(180deg);
                transform: rotate(180deg);
            }

            .sidebar-mini.sidebar-open a.sidebar-toggle .pe-7s-angle-left-circle {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .custom-loader {
            display: flex;
            flex-wrap: wrap;
            width: auto;
            height: 100%;
            align-items: center;
            justify-content: center;
        }

        .custom-loader > div {
            position: relative;
            display: table;
            margin: auto;
            width: 500px;
            height: 200px;
            text-align: center;
            transform: scale(0.7);
        }

        .custom-loader > div > img {
            position: absolute;
            width: 155px;
        }

        .layer1 {
            animation: layer-1 1.5s ease 1;
            left: 120px;
        }

        .layer2 {
            animation: layer-2 1.5s ease 1;
            left: 150px;
            transform: translate(0px, 0px);
        }

        .layer3 {
            animation: layer-3 1.5s ease 1;
            margin-top: 13px;
            left: 215px;
        }

        @-webkit-keyframes layer-1 {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes layer-1 {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @-webkit-keyframes layer-2 {
            0% {
                opacity: 0;
                transform: translate(-1px, -152px);
            }
            100% {
                opacity: 1;
                transform: translate(-1px, -32px);
            }
        }

        @keyframes layer-2 {
            0% {
                opacity: 0;
                transform: translate(0px, -50px);
            }
            100% {
                opacity: 1;
                transform: translate(0px, 0px);
            }
        }

        @-webkit-keyframes layer-3 {
            0% {
                opacity: 0;
                transform: translate(-1px, -152px);
            }
            100% {
                opacity: 1;
                transform: translate(-1px, -32px);
            }
        }

        @keyframes layer-3 {
            0% {
                opacity: 0;
                transform: scale(0);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

    </style>
</head>
<body class="hold-transition sidebar-mini">
<!--preloader-->
<div id="preloader">
    <!--<div id="status"></div>-->
    <div class="custom-loader clearfix">
        <div class="clearfix">
            <img src="img/logo-1.gif" class="layer1">
        </div>
    </div>

</div>
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <h1 class="pageheader-title"></h1>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown tasks-menu">
                        <a href="fav-stores.php">
                            <i class="pe-7s-note2"></i>
                        </a>
                    </li>
                    <li class="dropdown notifications-menu">
                        <a href="stores.php">
                            <i class="pe-7s-search"></i>
                        </a>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/dist/img/avatar5.png" class="img-circle" width="45" height="45" alt="user"></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php">
                                    <i class="fa fa-user"></i> User Profile</a>
                            </li>
                            <li><a href="logout.php">
                                    <i class="fa fa-sign-out"></i> Signout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>