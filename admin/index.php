<?php

    include "../server.php";
    include "components/session.php";
    
    $pendingApplications = $db->query_get_with_options("SELECT * FROM users WHERE user_type = 1 AND is_verified = 0", [], ["count" => true]);
    $activeTutors = $db->query_get_with_options("SELECT * FROM users WHERE user_type = 1 AND is_verified = 1", [], ["count" => true]);
    $activeLearners = $db->query_get_with_options("SELECT * FROM users WHERE user_type = 2", [], ["count" => true]);
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
    <title>Dashboard - Sign Lingua Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

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

            <div class="col-sm-12">
                <!--<div class="alert  alert-success alert-dismissible fade show" role="alert">-->
                <!--    <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.-->
                <!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
                <!--        <span aria-hidden="true">&times;</span>-->
                <!--    </button>-->
                <!--</div>-->
            </div>

             <div class="col-sm-12 mb-4">
                <div class="card-group">
                    <div class="card col-lg-4 col-md-4 no-padding bg-flat-color-1">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-users text-light"></i>
                            </div>
        
                            <div class="h4 mb-0 text-light">
                                <span class="count"><?php echo isset($pendingApplications) ? $pendingApplications : 0 ?></span>
                            </div>
                            <small class="text-uppercase font-weight-bold text-light">Pending Applications</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                        </div>
                    </div>
                    <div class="card col-lg-4 col-md-4 no-padding no-shadow">
                        <div class="card-body bg-flat-color-5">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-user-plus text-light"></i>
                            </div>
                            <div class="h4 mb-0 text-light">
                                <span class="count"><?php echo isset($activeTutors) ? $activeTutors : 0 ?></span>
                            </div>
                            <small class="text-uppercase font-weight-bold text-light">Active Tutors</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                        </div>
                    </div>
                    <div class="card col-lg-4 col-md-4 no-padding no-shadow">
                        <div class="card-body bg-flat-color-3">
                            <div class="h1 text-right mb-4">
                                <i class="fa fa-cart-plus text-light"></i>
                            </div>
                            <div class="h4 mb-0 text-light">
                                <span class="count"><?php echo isset($activeLearners) ? $activeLearners : 0 ?></span>
                            </div>
                            <small class="text-light text-uppercase font-weight-bold">Learners / Students</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                        </div>
                    </div>
                    <!--<div class="card col-lg-2 col-md-6 no-padding no-shadow">-->
                    <!--    <div class="card-body bg-flat-color-5">-->
                    <!--        <div class="h1 text-right text-light mb-4">-->
                    <!--            <i class="fa fa-pie-chart"></i>-->
                    <!--        </div>-->
                    <!--        <div class="h4 mb-0 text-light">-->
                    <!--            <span class="count">28</span>%-->
                    <!--        </div>-->
                    <!--        <small class="text-uppercase font-weight-bold text-light">Returning Visitors</small>-->
                    <!--        <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="card col-lg-2 col-md-6 no-padding no-shadow">-->
                    <!--    <div class="card-body bg-flat-color-4">-->
                    <!--        <div class="h1 text-light text-right mb-4">-->
                    <!--            <i class="fa fa-clock-o"></i>-->
                    <!--        </div>-->
                    <!--        <div class="h4 mb-0 text-light">5:34:11</div>-->
                    <!--        <small class="text-light text-uppercase font-weight-bold">Avg. Time</small>-->
                    <!--        <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="card col-lg-2 col-md-6 no-padding no-shadow">-->
                    <!--    <div class="card-body bg-flat-color-1">-->
                    <!--        <div class="h1 text-light text-right mb-4">-->
                    <!--            <i class="fa fa-comments-o"></i>-->
                    <!--        </div>-->
                    <!--        <div class="h4 mb-0 text-light">-->
                    <!--            <span class="count">972</span>-->
                    <!--        </div>-->
                    <!--        <small class="text-light text-uppercase font-weight-bold">COMMENTS</small>-->
                    <!--        <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
        
            </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    

</body>

</html>
