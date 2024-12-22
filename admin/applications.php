<?php

    include "../server.php";
    include "components/session.php";

    $list = $db->query_get_with_options("SELECT * FROM users WHERE user_type = ? AND is_verified = ?", [1, 0], ["list" => true]);

    if(isset($_GET["accept"]) && isset($_GET["id"])){
        $accept = $db->query_set("UPDATE users SET is_verified = ? WHERE id = ?", [1, $_GET["id"]]);
        if($accept){
            header("Location: applications.php");
        }
    }

    if(isset($_GET["reject"]) && isset($_GET["id"])){
        $accept = $db->query_set("UPDATE users SET is_verified = ? WHERE id = ?", [-1, $_GET["id"]]);
        if($accept){
            header("Location: applications.php");
        }
    }

?>

<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Applications - Sign Lingua Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">


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
                        <h1>Tutor Applications</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Administrator</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
    <?php

        foreach ($list as $key => $user) {
            echo "<tr>
                    <td>".$user["firstname"]." ".$user["lastname"]."</td>
                    <td>".$user["age"]."</td>
                    <td>".$user["gender"]."</td>
                    <td>".$user["email"]."</td>
                    <td>".$user["contact"]."</td>
                    <td>
                        <button data-data='".json_encode($user)."' class='btn btn-sm btn-primary viewMdBtn' data-toggle='modal' data-target='#viewModal'>View</button>
                        <a type='button' href='applications.php?accept&id=".$user["id"]."' class='btn btn-sm btn-success text-white'>Accept</a>
                        <a type='button' href='applications.php?reject&id=".$user["id"]."' class='btn btn-sm btn-danger text-white'>Reject</a>
                    </td>
                </tr>";
        }
                                        
    ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Applicant Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Personal Details</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img id="viewMdProfilePhoto" class="rounded-circle mx-auto d-block" width="150px" height="150px" alt="Card image cap">
                                    <h5 id="viewMdName" class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                                    <div id="viewMdAgeGender" class="location text-sm-center"> 21 - Male</div>
                                    <div class="location text-sm-center"><i class="fa fa-map-marker"></i> <span  id="viewMdAddress">California, United States</span></div>
                                    <div id="viewMdContactEmail" class="location text-sm-center"> 09876543210 - email@gmail.com</div>
                                </div>
                                <hr>
                                <div class="card-text text-sm-centerx">
                                    <strong class="card-title mb-3">Resume</strong>
                                    <div id="viewMdResume"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
    
    <script>

        jQuery(document).ready(function($) {

            $(".viewMdBtn").on("click", (e) => {
                let data = $(e.currentTarget).data("data")
                console.log(data)
                if(data){
                    $("#viewMdName").html(`${data.firstname} ${data.lastname}`)
                    $("#viewMdAgeGender").html(`${data.age} - ${data.gender}`)
                    $("#viewMdAddress").html(`${data.address}`)
                    $("#viewMdContactEmail").html(`${data.contact} - ${data.email}`)

                    $("#viewMdProfilePhoto").attr("src", data.profile_photo)

                    if(data.resume == ""){
                        $("#viewMdResume").html("No files attached")
                    }else{
                        let a = document.createElement("a")
                        let url = data.resume?.replace("../", "")
                        $(a).attr("target", "_blank")
                        $(a).attr("href", `${window.location.origin}/${url}`)
                        $(a).html(url + " (Click to review)")
                        console.log(a)
                        $("#viewMdResume").html(a)
                    }

                }
            })
            
        })

    </script>

</body>

</html>
