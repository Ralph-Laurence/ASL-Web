<?php

    include "../server.php";
    include "../admin/components/session.php";


?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard - Sign Lingua Learner</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "includes/styles.php"; ?>

</head>

<body>


    <?php include "components/sidebar.php"; ?>

    <div id="right-panel" class="right-panel">

        <?php include "components/header.php"; ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <!--<div class="col-sm-12">-->
            <!--    <div class="alert  alert-success alert-dismissible fade show" role="alert">-->
            <!--        <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.-->
            <!--        <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
            <!--            <span aria-hidden="true">&times;</span>-->
            <!--        </button>-->
            <!--    </div>-->
            <!--</div>-->

            <!--<div class="col-lg-3 col-md-6">-->
            <!--    <div class="social-box facebook">-->
            <!--        <i class="fa fa-facebook"></i>-->
            <!--        <ul>-->
            <!--            <li>-->
            <!--                <span class="count">40</span> k-->
            <!--                <span>friends</span>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <span class="count">450</span>-->
            <!--                <span>feeds</span>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </div>-->
                <!--/social-box-->
            <!--</div>-->
            <!--/.col-->


            <!--<div class="col-lg-3 col-md-6">-->
            <!--    <div class="social-box twitter">-->
            <!--        <i class="fa fa-twitter"></i>-->
            <!--        <ul>-->
            <!--            <li>-->
            <!--                <span class="count">30</span> k-->
            <!--                <span>friends</span>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <span class="count">450</span>-->
            <!--                <span>tweets</span>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </div>-->
                <!--/social-box-->
            <!--</div>-->
            <!--/.col-->


            <!--<div class="col-lg-3 col-md-6">-->
            <!--    <div class="social-box linkedin">-->
            <!--        <i class="fa fa-linkedin"></i>-->
            <!--        <ul>-->
            <!--            <li>-->
            <!--                <span class="count">40</span> +-->
            <!--                <span>contacts</span>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <span class="count">250</span>-->
            <!--                <span>feeds</span>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </div>-->
                <!--/social-box-->
            <!--</div>-->
            <!--/.col-->


            <!--<div class="col-lg-3 col-md-6">-->
            <!--    <div class="social-box google-plus">-->
            <!--        <i class="fa fa-google-plus"></i>-->
            <!--        <ul>-->
            <!--            <li>-->
            <!--                <span class="count">94</span> k-->
            <!--                <span>followers</span>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <span class="count">92</span>-->
            <!--                <span>circles</span>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </div>-->
                <!--/social-box-->
            <!--</div>-->
            <!--/.col-->

            <!--<div class="col-xl-3 col-lg-6">-->
            <!--    <div class="card">-->
            <!--        <div class="card-body">-->
            <!--            <div class="stat-widget-one">-->
            <!--                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>-->
            <!--                <div class="stat-content dib">-->
            <!--                    <div class="stat-text">Active Projects</div>-->
            <!--                    <div class="stat-digit">770</div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    
    <?php include "includes/scripts.php"; ?>


</body>

</html>
