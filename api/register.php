<?php

    header('Content-Type: application/json; charset=utf-8');

    include "../server.php";

    if(isset($_POST["email"]) && isset($_POST["password"])){

        $fname = $_POST["firstname"];
        $lname = $_POST["lastname"];        
        $email = $_POST["email"];
        $password = $_POST["password"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];
        $contact = $_POST["contact"];
        $address = $_POST["address"];
        $user_type = $_POST["user_type"];
        $resume = "";
        $profile_photo = "";      

        $result = getAPIResponse();

        $check = $db->query_get_with_options("SELECT * FROM users WHERE email = ? ", [$email], ["count"=>true]);
        if($check > 0){
            $result->status = 500;
            $result->message = "Email already registered";
        }else{

            // UPLOAD FILES
            if(isset($_FILES["resume"])){
                $resume = $file_uploader->upload($_FILES["resume"], "files");
            }

            if(isset($_FILES["profile_photo"])){
                $profile_photo = $file_uploader->upload($_FILES["profile_photo"], "profiles");
            }

            $res = $db->query_set("INSERT INTO `users` (
                `firstname`, 
                `lastname`, 
                `email`, 
                `password`, 
                `age`,
                `gender`,
                `contact`, 
                `address`, 
                `user_type`, 
                `resume`, 
                `profile_photo`, 
                `is_verified`, 
                `status`) 
            VALUES
            (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                0,
                1
            )", [$fname, $lname, $email, $password, $age, $gender, $contact, $address, $user_type, $resume, $profile_photo]);
            if($res){
                $result->status = 200;
                $result->message = "Registered successfully!";
                $result->data = $res;
            }

        }

        echo json_encode($result);

    }   

?>