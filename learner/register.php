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
    <title>Learner Registration - Sign Lingua Web</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "includes/styles.php"; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#" class="text-white" style="text-decoration:none;">
                        <h2>Register as Learner</h2>
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="register.php">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="" name="lastname" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="number" class="form-control" placeholder="" name="age" required>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" required="required">
                                        <option selected disabled>--</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" placeholder="" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" rows="2" name="address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="" name="email" required>
                        </div>
                        <label class="input-group-textx">Password</label>
                        <div class="form-group input-group mb-3">
                            <input type="password" class="form-control" placeholder="" name="password" id="password" required>
                            <div class="input-group-append" id="toggle-password">
                                <span class="input-group-text"><i class="fa fa-eye-slash" id="toggle-password-icon"></i></span>
                            </div>
                        </div>
                        <hr></hr>
                        <br>
                        <input type="hidden" value="1" name="user_type" />
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="register_attempt">Register</button>
                        <div class="register-link m-t-15 text-center m-5">
                            <p>Already have account ? <a href="login.php"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php include "../providers/UIComponents/modal.php"; ?>
    
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
    
    <script>

        $("form").on("submit", (e) => {
            e.preventDefault()
            $("#loadingModal").modal("show")
            
            let payload = new FormData(document.querySelector("form"))
            
            $.ajax({
              url: '../api/register.php',
              data: payload,
              processData: false,
              contentType: false,
              type: 'POST',
              success: function(res){
                
                if(res){
                    if(res?.status == 200){
                        $("#alertMessageModalLabel").html("Registration")
                        $("#alertMessageModalMessage").html(res?.message || "")
                        $("#alertMessageModal").modal("show")
                    }else if(res?.status == 500){
                        $("#alertMessageModalLabel").html("Registration")
                        $("#alertMessageModalMessage").html(res?.message)
                        $("#alertMessageModal").modal("show")
                    }
                }
              }
            }).always(() => {
                $("#loadingModal").modal('hide');
                $('#loadingModal').on('shown.bs.modal', function (e) {
                    $("#loadingModal").modal('hide');
                })  
            })
        })
    </script>

</body>

</html>
