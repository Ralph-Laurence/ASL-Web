<?php

    include "../server.php";
    include "../admin/components/session.php";

    $data = $db->query_get("SELECT * FROM users WHERE id = ?", [$_SESSION["logged_in_user_id"]]);

?>

<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile - Sign Lingua Tutor</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "includes/styles.php"; ?>
    
    <style>
    .avatar-upload {
      position: relative;
      width: 120px;
      height: 120px;
      border: 2px dashed #ccc;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
      background: #f7f7f7;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .avatar-upload img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
    }

    .avatar-upload input[type="file"] {
      display: none;
    }

    .avatar-upload .placeholder {
      font-size: 14px;
      color: #777;
      text-align: center;
    }

    .avatar-upload:hover {
      border-color: #0d6efd;
    }

    .avatar-upload img.visible {
      display: block;
    }

    .avatar-upload .placeholder.hidden {
      display: none;
    }
  </style>

</head>

<body>


    <?php include "components/sidebar.php"; ?>

    <div id="right-panel" class="right-panel">

        <?php include "components/header.php"; ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Profile</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <form action="#" method="post" novalidate="novalidate">
                                            <div class="form-group text-center">
                                                <div class="text-center">
                                                    <?php
                                                        if($data["profile_photo"] != ""){
                                                            echo '<div class="avatar-upload mx-auto" onclick="document.getElementById(`imageUpload`).click();">
                                                          <img class="visible" src="'.$data["profile_photo"].'" id="avatarPreview" alt="Avatar Preview">
                                                          <div class="placeholder hidden">Upload Photo</div>
                                                          <input type="file" id="imageUpload" accept="image/*" onchange="previewImage(event)" name="profile_photo">
                                                        </div>';
                                                        }else{
                                                            echo '<div class="avatar-upload mx-auto" onclick="document.getElementById(`imageUpload`).click();">
                                                          <img src="'.$default_avatar.'" id="avatarPreview" alt="Avatar Preview">
                                                          <div class="placeholder">Upload Photo</div>
                                                          <input type="file" id="imageUpload" accept="image/*" onchange="previewImage(event)" name="profile_photo">
                                                        </div>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">First Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="firstname" value="<?php echo $data['firstname']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Last Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="lastname" value="<?php echo $data['lastname']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="">Age</label>
                                                        <input type="text" class="form-control" placeholder="" name="age" value="<?php echo $data['age']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="">Gender</label>
                                                        <select class="form-control" name="gender" required="required" value="<?php echo $data['gender']; ?>">
                                                            <option selected disabled>--</option>
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Contact</label>
                                                        <input type="text" class="form-control" placeholder="" name="contact" value="<?php echo $data['contact']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label>Address</label>
                                                    <textarea class="form-control" rows="2" name="address"><?php echo $data['address']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="text" class="form-control" placeholder="" name="email" value="<?php echo $data['email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="input-group-textx">Password</label>
                                                    <div class="form-group input-group mb-3">
                                                        <input type="password" class="form-control" placeholder="" name="password" id="password" value="<?php echo $data['password']; ?>">
                                                        <div class="input-group-append" id="toggle-password">
                                                            <span class="input-group-text"><i class="fa fa-eye-slash" id="toggle-password-icon"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Update Changes</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div>
                    
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
        
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
              const reader = new FileReader();
              reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                preview.src = e.target.result;
                preview.classList.add('visible');
                document.querySelector('.avatar-upload .placeholder').classList.add('hidden');
              };
              reader.readAsDataURL(file);
            }
        }
    </script>
    
    <script>
        $("form").on("submit", (e) => {
            e.preventDefault()
            $("#loadingModal").modal("show")
            
            let payload = new FormData(document.querySelector("form"))
            
            $.ajax({
              url: '../api/profile.php',
              data: payload,
              processData: false,
              contentType: false,
              type: 'POST',
              success: function(res){
                console.log(JSON.stringify(res))
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
            }).error((err) => {
                console.log(err)
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
