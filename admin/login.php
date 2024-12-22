<?php

    include "../server.php";

    if(isset($_POST["login-attemp"])){
        if($_POST["username"] == "admin" && $_POST["password"] == "password"){

            $session = array();
            $session["user_type"] = "admin";
            $session["user"] = $result["username"];
            $session["userid"] = $result["id"];

            session_start();
            $_SESSION['logged_in_user'] = $session;
            header("Location: ./");

        }else{
            header("Location: login.php?failure");
        }
    }

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Sign Lingua Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="images/logo.jpg">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="./">
                        <h4 class="text-white">Sign Lingua <span class="text-primary">Admin</span></h4>
                    </a>
                </div>
                <div class="login-form">
                    <div class="text-center">
                        <img src="images/logo.jpg" style="width:100px;height:100px;" />
                    </div>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <button type="submit" name="login-attemp" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
