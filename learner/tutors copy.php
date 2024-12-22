<?php

include "../server.php";
include "../admin/components/session.php";

// original:
// $list = $db->query_get_with_options("SELECT * FROM users WHERE is_verified = 1 AND user_type = ? AND id != ?", [1, $_SESSION["logged_in_user_id"]], ["list" => true]);

//------------- BEGIN MODIFIED CODE -------------//
require_once "../globalvars.php";
require_once "../revamp/constants.php";
require_once "../revamp/db/DatabaseHelper.php";

$dbhelper           = new DatabaseHelper();
$loggedOnUserId     = $_SESSION["logged_in_user_id"];
$queryTutorsParams  = [UserTypes::Tutor, $loggedOnUserId];
$queryListOfTutors  = "SELECT * FROM " . TableNames::Users . " WHERE is_verified = 1 AND user_type = ? AND id != ?";

// List all tutors
$list = $dbhelper->query($queryListOfTutors, $queryTutorsParams, ['fetchMode' => 'list']);

// Store here the ids of tutors that were already hired
$sqlGetHiredTutors  = "SELECT tutor_id FROM " . TableNames::Transactions . " WHERE learner_id=?";
$hiredTutorIdsList  = $dbhelper->query(
    $sqlGetHiredTutors,
    [$loggedOnUserId],
    ['fetchMode' => $dbhelper->FETCH_MODE_COLUMN]
);

//------------- END MODIFIED CODE -------------//
?>

<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Learners - Sign Lingua Learner</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "includes/styles.php"; ?>

    <!-- <link rel="stylesheet" href="../revamp/static/lib/bootstrap5/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../revamp/static/css/tutors.revamp.css">
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
                            <li class="active">Tutors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="animated fadeIn">
                <div class="row">

                    <?php foreach ($list as $key => $item): ?>

                        <?php
                        $profile_photo = $item["profile_photo"] != "" ? $item["profile_photo"] : $default_avatar;

                        $hireStatus = !empty($hiredTutorIdsList) && in_array($item['id'], $hiredTutorIdsList) ? 'hired' : '';
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card position-relative">
                                <div class="card-body">
                                    <!-- Badge -->
                                    <div class="hire-badge-container">
                                        <?php if (!empty($hireStatus) && $hireStatus == 'hired'): ?>
                                            <span class="badge badge-success">
                                                <i class="fa fa-check mr-2"></i>Hired
                                            </span>
                                        <?php endif ?>
                                    </div>
                                    <div class="mx-auto d-block">
                                        <img class="rounded-circle mx-auto d-block" src="<?= $profile_photo ?>" alt="Profile Photo" style="width:10rem;height:10rem;">
                                        <h5 class="text-sm-center mt-2 mb-1"> <?= $item["firstname"] . ' ' . $item["lastname"] ?></h5>
                                        <div class="location text-sm-center"><i class="fa fa-map-marker"></i><?= $item["address"] ?></div>
                                    </div>
                                    <hr>
                                    <div class="card-text text-sm-center">
                                        <button class="btn btn-info viewMdBtn" id="btn-tutor-info-<?= $item['id'] ?>" data-toggle="modal" data-target="#viewModal" data-hire-status="<?= $hireStatus ?>" data-data="<?= urlencode(json_encode($item)) ?>">View Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Tutor Profile</h5>
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
                                    <div class="location text-sm-center"><i class="fa fa-map-marker"></i> <span id="viewMdAddress">California, United States</span></div>
                                    <div id="viewMdContactEmail" class="location text-sm-center"> 09876543210 - email@gmail.com</div>
                                </div>
                                <hr>
                                <!-- <form id="hireTutorForm">
                                    <input type="hidden" name="learner_id" value="< ?php echo $_SESSION['logged_in_user_id']; ?>" />
                                    <input type="hidden" name="tutor_id" value="" id="viewMdTutorId" />
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary">Hire Tutor</button>
                                    </div>
                                </form> -->

                                <form class="d-none">
                                    <input type="hidden" id="learner_id" value="<?php echo $_SESSION['logged_in_user_id']; ?>" />
                                    <input type="hidden" id="tutor_id" />
                                </form>

                                <?php // IF TUTOR ISNT HIRED YET 
                                ?>
                                <div class="btn-wrapper-hire-tutor">
                                    <div class="text-center">
                                        <?php
                                        $splitButtonData = [
                                            'mainButtonText'      => 'Hire Tutor',
                                            'actionButtonClasses' => 'tutor-see-identity',
                                            'mainButtonClasses'   => 'btn-hire-tutor',
                                        ];

                                        include('../revamp/ui/splitbutton.php');
                                        ?>
                                    </div>
                                </div>


                                <?php // IF TUTOR IS ALREADY HIRED 
                                ?>
                                <div class="btn-wrapper-end-tutor-contract d-none">
                                    <div class="text-center">
                                        <?php
                                        $splitButtonData = [
                                            'mainButtonText'      => 'End Contract',
                                            'actionButtonClasses' => 'tutor-see-identity',
                                            'mainButtonClasses'   => 'btn-end-tutor-contract',
                                            'style'               => 'danger',
                                        ];

                                        include('../revamp/ui/splitbutton.php');
                                        ?>
                                    </div>
                                </div>

                                <!-- <div class="card-text text-sm-centerx">
                                   <strong class="card-title mb-3">Resume</strong>
                                   <div id="viewMdResume"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeViewModal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "../providers/UIComponents/modal.php"; ?>

    <!-- BEGIN REVISED CODE -->
    <script src="../revamp/static/lib/jquery3.7.1/jquery-3.7.1.min.js"></script>
    <script src="../admin/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- <script src="../revamp/static/lib/bootstrap5/bootstrap.min.js"></script> -->
    <script src="../revamp/static/js/tutors.revamp.js"></script>

    <?php include "../revamp/ui/ajaxmodal.php" ?>
    <!-- END REVISED CODE -->

    <!-- <script src="../admin/vendors/jquery/dist/jquery.min.js"></script> -->
    <!-- <script src="../admin/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> -->
    <!-- <script src="../admin/assets/js/main.js"></script> -->

    <!--<script src="../admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>-->
    <!--<script src="../admin/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>-->
    <!--<script src="../admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>-->
    <!--<script src="../admin/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>-->
    <!--<script src="../admin/vendors/jszip/dist/jszip.min.js"></script>-->
    <!--<script src="../admin/vendors/pdfmake/build/pdfmake.min.js"></script>-->
    <!--<script src="../admin/vendors/pdfmake/build/vfs_fonts.js"></script>-->
    <!--<script src="../admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>-->
    <!--<script src="../admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>-->
    <!--<script src="../admin/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>-->
    <!--<script src="../admin/assets/js/init-scripts/data-table/datatables-init.js"></script>-->

    <script>
        
        //jQuery(document).ready(function($) {


            //$(".viewMdBtn").on("click", (e) => {

            // let datastring = $(e.currentTarget).data("data")
            // let data = JSON.parse(decodeURIComponent(datastring))
            
            // console.log(data)
            // if (data) {

            //     $("#viewMdTutorId").val(data.id)
            //     $("#viewMdName").html(`${data.firstname} ${data.lastname}`)
            //     $("#viewMdAgeGender").html(`${data.age} - ${data.gender}`)
            //     $("#viewMdAddress").html(`${data.address}`)
            //     $("#viewMdContactEmail").html(`${data.contact} - ${data.email}`)

            //     $("#viewMdProfilePhoto").attr("src", data.profile_photo)

            //     // if(data.resume == ""){
            //     //     $("#viewMdResume").html("No files attached")
            //     // }else{
            //     //     let a = document.createElement("a")
            //     //     let url = data.resume?.replace("../", "")
            //     //     $(a).attr("target", "_blank")
            //     //     $(a).attr("href", `${window.location.origin}/${url}`)
            //     //     $(a).html(url + " (Click to review)")
            //     //     console.log(a)
            //     //     $("#viewMdResume").html(a)
            //     // }

            // }
            //})

            // $("#hireTutorForm").on("submit", (e) => {
            //     e.preventDefault()

            //     $("#closeViewModal").click()
            //     $("#loadingModal").modal("show")

            //     let payload = new FormData(document.getElementById("hireTutorForm"))
            //     console.log(payload);
            //     return;

            //     $.ajax({
            //         url: '../api/hire.php',
            //         data: payload,
            //         processData: false,
            //         contentType: false,
            //         type: 'POST',
            //         success: function(res) {
            //             console.log(JSON.stringify(res), res)
            //             if (res) {
            //                 if (res?.status == 200) {
            //                     $("#alertMessageModalLabel").html("Hire Tutor")
            //                     $("#alertMessageModalMessage").html(res?.message || "")
            //                     $("#alertMessageModal").modal("show")
            //                 } else if (res?.status == 500) {
            //                     $("#alertMessageModalLabel").html("Hire Tutor")
            //                     $("#alertMessageModalMessage").html(res?.message)
            //                     $("#alertMessageModal").modal("show")
            //                 }
            //             }

            //         }
            //     }).always(() => {
            //         $("#loadingModal").modal('hide');
            //         $('#loadingModal').on('shown.bs.modal', function(e) {
            //             $("#loadingModal").modal('hide');
            //         })
            //     })
            // })

        //})
    </script>


</body>

</html>