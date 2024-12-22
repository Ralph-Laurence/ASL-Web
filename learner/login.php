<?php

    include "../server.php";

    if(isset($_POST["username"]) && isset($_POST["password"])){

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $res = $db->query_get("SELECT * FROM users WHERE email = ? AND password = ? AND user_type = ? ORDER BY id DESC LIMIT 1", [$username, $password, 2]);
        if($res){
            
            $session = array();
            $session["user_type"] = "learner";
            $session["username"] = $res["firstname"]." ".$res["lastname"];
            $session["profile_photo"] = $res["profile_photo"];
            $session["userid"] = $res["id"];
    
            session_start();
            $_SESSION['logged_in_user'] = $session;
            $_SESSION['logged_in_user_id'] = $res["id"];
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
    <title>Login - Sign Lingua Learner</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "includes/styles.php"; ?>

</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="./">
                        <h4 class="text-white">Sign Lingua - <span class="text-warning">Learner</span></h4>
                    </a>
                </div>
                <div class="login-form">
                    <form method="post" action="login.php">
                        <div class="text-center">
                            <img src="../admin/images/logo.jpg" style="width:100px;height:100px;" />
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="email" class="form-control" placeholder="" name="username" required>
                        </div>
                        <label class="input-group-textx">Password</label>
                        <div class="form-group input-group mb-3">
                            <input type="password" class="form-control" placeholder="" name="password" id="password" required>
                            <div class="input-group-append" id="toggle-password">
                                <span class="input-group-text"><i class="fa fa-eye-slash" id="toggle-password-icon"></i></span>
                            </div>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_GET['failure']) ? 'block' : 'none';  ?>;">
                          Username or password is incorrect.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <button type="submit" name="login-attemp" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="../admin/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../admin/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../admin/assets/js/main.js"></script>

    <script>
        $("#toggle-password").on("click", function(e){
            if($("#password").attr("type") == "password"){
                $("#password").attr("type", "text")
                $("#toggle-password-icon").removeClass("fa-eye-slash")
                $("#toggle-password-icon").addClass("fa-eye")
            }else if($("#password").attr("type") == "text"){
                $("#password").attr("type", "password")
                $("#toggle-password-icon").removeClass("fa-eye")
                $("#toggle-password-icon").addClass("fa-eye-slash")
            }
        })
    </script>

</body>

</html>
