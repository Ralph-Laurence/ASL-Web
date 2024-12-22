<?php

    include "../server.php";
    include "../admin/components/session.php";

    $list = $db->query_get_with_options("SELECT * FROM users WHERE user_type = ? AND id != ?", [1, $_SESSION["logged_in_user_id"]], ["list" => true]);

?>

<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Learners - Sign Lingua Tutor</title>
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
                        <h1>List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Other Tutors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="animated fadeIn">
                <div class="row">

                    <?php 
                        
                        foreach($list as $key => $item){
                            
                            $profile_photo = $item["profile_photo"] != "" ? $item["profile_photo"] : $default_avatar;
                            
                            echo '<div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class="rounded-circle mx-auto d-block" src="'.$profile_photo.'" alt="Profile Photo" style="width:10rem;height:10rem;">
                                            <h5 class="text-sm-center mt-2 mb-1">'.$item["firstname"].' '.$item["lastname"].'</h5>
                                            <div class="location text-sm-center"><i class="fa fa-map-marker"></i> '.$item["address"].'</div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                        
                    ?>
                    
                </div>
            </div>

        </div> 
    </div>

    <script src="../admin/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../admin/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../admin/assets/js/main.js"></script>

    <script src="../admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../admin/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../admin/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../admin/vendors/jszip/dist/jszip.min.js"></script>
    <script src="../admin/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../admin/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../admin/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../admin/assets/js/init-scripts/data-table/datatables-init.js"></script>
    
    


</body>

</html>
