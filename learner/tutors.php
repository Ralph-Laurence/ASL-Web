<?php
require_once "../server.php";
require_once "../admin/components/session.php";
require_once "../globalvars.php";
require_once "../revamp/constants.php";
require_once "../revamp/db/DatabaseHelper.php";

$dbhelper           = new DatabaseHelper();
$loggedOnUserId     = $_SESSION["logged_in_user_id"];
$queryTutorsParams  = [UserTypes::Tutor, $loggedOnUserId];
$queryListOfTutors  = "SELECT * FROM " . TableNames::Users . " WHERE is_verified = 1 AND user_type = ? AND id != ?";

// List all tutors
$fetchMode  = ['fetchMode' => $dbhelper->FETCH_MODE_LIST];
$tutorsList = $dbhelper->query($queryListOfTutors, $queryTutorsParams, $fetchMode);

// Store here the ids of tutors that were already hired
$sqlGetHiredTutors  = "SELECT tutor_id FROM " . TableNames::Transactions . " WHERE learner_id=?";
$hiredTutorIdsList  = $dbhelper->query(
    $sqlGetHiredTutors,
    [$loggedOnUserId],
    ['fetchMode' => $dbhelper->FETCH_MODE_COLUMN]
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- FRAMEWORKS, LIBRARIES -->
    <link rel="shortcut icon" href="../revamp/static/img/logo-s.png" type="image/x-icon">
    <link rel="stylesheet" href="../revamp/static/lib/bootstrap5/bootstrap.min.css">
    <link rel="stylesheet" href="../revamp/static/lib/fontawesome6.7.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="../revamp/static/lib/fontawesome6.7.2/css/solid.min.css">

    <!-- MAIN STYLES -->
    <link rel="stylesheet" href="../revamp/static/css/root.css">
    <link rel="stylesheet" href="../revamp/static/css/tutors.css">
</head>

<body>

    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img class="logo-brand" src="../revamp/static/img/logo-brand.png" alt="logo-brand" height="40">
                </a>

                <ul class="nav col-12 col-lg-auto ms-lg-3 me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-active">Find Tutors</a></li>
                    <li><a href="#" class="nav-link px-2">My Tutors</a></li>
                </ul>

                <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control" placeholder="Search by name..." aria-label="Search">
                </form> -->

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?php echo $_SESSION["logged_in_user"]["username"]; ?></small>
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <!-- <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li> -->
                        <li>
                            <a class="dropdown-item text-14" href="#">
                                <i class="fas fa-user me-2"></i>My Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-14" href="#">
                                <i class="fas fa-power-off me-2"></i>Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <section class="emphasize-title py-5 text-center">
        <h3 class="mb-4">Find the Ideal Sign Language Tutor for You</h3>
        <p>Looking to learn sign language? Sign Lingua connects you with the best tutors for personalized, one-on-one lessons.</p>
    </section>

    <section class="section-choose-tutors">
        <div class="row">
            <div class="col">
                <h4 class="mb-3">Many ASL Tutors To Choose From</h4>
                <p class="msw-justify">
                    You can choose from a diverse array of American Sign Language tutors to meet your learning needs.
                    Whether you're a beginner or looking to advance your skills, our knowledgeable tutors are here to help
                    you. Browse through our list of tutors and select the one that best fits your learning style and preferences.
                    <br><br>Don't miss the opportunity to connect with passionate and knowledgeable tutors who are dedicated to your learning success.
                    Book a lesson today and start your journey towards mastering American Sign Language.
                </p>
                
            </div>
            <div class="col text-center">
                <img src="../revamp/static/img/section-choose-tutors.png" alt="tutor-session" height="320">
            </div>
        </div>

    </section>

    <hr class="mt-4 ">
    <section class="my-4 px-4 control-ribbon">
        <div class="row">
            <div class="col">
                <div class="d-flex h-100 align-items-center gap-2">
                    <h5 class="m-0">Browse tutors</h5>
                    <h6 class="m-0">(<?= count($tutorsList) ?> available)</h6>
                </div>
            </div>
            <div class="col d-flex flex-row align-items-center justify-content-end gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle sign-lingua-dropdown-button" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        Tutor Fluency
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><button class="dropdown-item" type="button">Action</button></li>
                        <li><button class="dropdown-item" type="button">Another action</button></li>
                        <li><button class="dropdown-item" type="button">Something else here</button></li>
                    </ul>
                </div>
                <div class="find-tutor-wrapper d-flex gap-2 align-items-center">
                    <div class="form-group">
                        <input type="text" class="form-control sign-lingua-input-field" id="input-find-tutor" placeholder="Tutor name" aria-describedby="find-tutor-help">
                    </div>
                    <button href="#" class="btn btn-secondary search-button">
                        <i class="fas fa-magnifying-glass text-white"></i>
                    </button>
                    <!-- <button class="btn btn-warning grad-btn-danger">Find Tutor</button> -->
                </div>
            </div>
        </div>
    </section>
    <hr>

    <section class="tutors-list p-4">
        <div class="tutors-list-view">
            <?php foreach ($tutorsList as $key => $obj): ?>
                <?php

                $defaultAvatar      = "../revamp/static/img/default_avatar.png";
                $profile_photo      = $obj["profile_photo"] != "" ? $obj["profile_photo"] : $defaultAvatar;
                $profile_name       = $obj['firstname'] . ' ' . $obj['lastname'];
                $profile_verified   = $obj['is_verified'] == 1;
                $isHired            = !empty($hiredTutorIdsList) && in_array($obj['id'], $hiredTutorIdsList);
                $hiredIndicator     = !$isHired ? 'd-none' : '';
                $fluencyLevel       = FluencyLevels::Tutor[$obj['fluency']];
                $fluencyBadgeIcon   = $fluencyLevel['Badge Icon'];
                $fluencyBadgeColor  = $fluencyLevel['Badge Color'];
                $fluencyLevelText   = $fluencyLevel['Level'];
                $profile_bio_notes  = $obj['bio'];
                //$hireStatus = !empty($hiredTutorIdsList) && in_array($item['id'], $hiredTutorIdsList) ? 'hired' : '';
                ?>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row px-3">
                            <div class="col-4 gx-0">
                                <img src="<?= $profile_photo ?>" class="profile-photo" alt="profile-photo">
                            </div>
                            <div class="col"></div>
                        </div>
                        <h6 class="card-title tutor-name mt-3 mb-1">
                            <i class="fas fa-circle-check <?= $hiredIndicator ?> accent-secondary me-2"></i>
                            <?= htmlspecialchars($profile_name) ?>
                        </h6>
                        <span class="badge <?= $fluencyBadgeColor ?> mb-3">
                            <i class="fas <?= $fluencyBadgeIcon ?> me-2"></i>
                            <?= $fluencyLevelText ?>
                        </span>
                        <p class="card-text tutor-bio"><?= $profile_bio_notes ?></p>
                        <div class="flex-end">
                            <a href="#" class="btn btn-sm btn-secondary btn-more-details">More Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </section>

    <footer class="px-3 py-4 text-center">
        &copy; <?= date('Y') ?> SignLingua All rights reserved
    </footer>

    <script src="../revamp/static/lib/jquery3.7.1/jquery-3.7.1.min.js"></script>
    <script src="../revamp/static/lib/popper2.9.2/popper.min.js"></script>
    <script src="../revamp/static/lib/bootstrap5/bootstrap.min.js"></script>
</body>

</html>