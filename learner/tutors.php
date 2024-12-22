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

    <link rel="shortcut icon" href="../revamp/static/img/logo-s.png" type="image/x-icon">
    <link rel="stylesheet" href="../revamp/static/lib/bootstrap5/bootstrap.min.css">
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
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
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
                    Whether you're a beginner or looking to advance your skills, our experienced tutors are here to
                    help you achieve your goals. Scroll down to browse through our list of tutors or use the search bar
                    to find a tutor by name. Book a lesson today and start your journey towards mastering American Sign Language.
                </p>
                <div class="find-tutor-wrapper d-flex gap-2 align-items-center">
                    <div class="form-group">
                        <label for="input-find-tutor">Search Tutor</label>
                        <input type="text" class="form-control" id="input-find-tutor" placeholder="Find tutor by name" aria-describedby="find-tutor-help">
                        <small id="find-tutor-help" class="form-text text-muted">You may enter the tutor's firstname or lastname.</small>
                    </div>
                    <button class="btn btn-danger grad-btn-danger">Find Tutor</button>
                </div>
            </div>
            <div class="col text-center">
                <img src="../revamp/static/img/section-choose-tutors.png" alt="tutor-session" height="320">
            </div>
        </div>

    </section>

    <section class="my-4 pt-5 pb-2">
        <h3 class="text-center">Browse from <?= count($tutorsList) ?> ASL tutors</h3>
    </section>

    <section class="tutors-list p-4">
        <div class="tutors-list-view">
            <?php foreach ($tutorsList as $key => $obj): ?>
                <?php
                $profile_photo = $obj["profile_photo"] != "" ? $obj["profile_photo"] : $default_avatar;
                $profile_name = $obj['firstname'].' '.$obj['lastname'];
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
                    <h6 class="card-title tutor-name my-3"><?= $profile_name ?></h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- <div class="row mx-3 mb-5">
            < ?php foreach ($tutorsList as $key => $obj): ?>
                < ?php
                $profile_photo = $obj["profile_photo"] != "" ? $obj["profile_photo"] : $default_avatar;

                //$hireStatus = !empty($hiredTutorIdsList) && in_array($item['id'], $hiredTutorIdsList) ? 'hired' : '';
                ?>
                <div class="col-md-4">
                    <div class="card tutor-card mx-auto shadow-sm">
                        <div class="card-cover-pic">
                            <img class="card-img-top" src="../revamp/static/img/card-bg-firewatch-0.png" alt="Card image cap">
                            <div class="profile-photo-wrapper flex-center">
                                <img src="< ?= $profile_photo ?>" class="tutor-profile-pic" alt="Tutor Profile">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">< ?= $obj['firstname'] .' '. $obj['lastname']; ?></h5>
                        </div>
                    </div>
                </div>
                < ?php if (($key + 1) % 3 == 0): ?>
                    </div>
                    <div class="row mx-3 mb-5">
                < ?php endif; ?>
            < ?php endforeach; ?>
        </div> -->
    </section>

    <script src="../revamp/static/lib/jquery3.7.1/jquery-3.7.1.min.js"></script>
    <script src="../revamp/static/lib/popper2.9.2/popper.min.js"></script>
    <script src="../revamp/static/lib/bootstrap5/bootstrap.min.js"></script>
</body>

</html>