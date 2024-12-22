<?php

    header('Content-Type: application/json; charset=utf-8');

    include "../server.php";

    if(isset($_POST["username"]) && isset($_POST["password"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = getAPIResponse();
        
        $res = $db->query_get("SELECT * FROM users WHERE email = ? AND password = ? ORDER BY id DESC LIMIT 1", [$username, $password]);
        if($res){
            $result->status = 200;
            $result->message = "Logged in successfully!";
            $result->data = $res;
        }else{
            $result->message = "Invalid credentials!";
        }

        echo json_encode($result);

    }

?>