<?php

    header('Content-Type: application/json; charset=utf-8');

    include "../server.php";

    if(isset($_GET["filter"])){

    }else if(isset($_GET["account"])){
        $result = getAPIResponse();
        $res = $db->query_get("SELECT * FROM users WHERE user_type = 2 AND id = ?", [$_GET["id"]]);
        if($res){
            $result->status = 200;            
            $result->data = $res;
        }
        echo json_encode($result);
    }else{
        $result = getAPIResponse();
        $res = $db->query_get_with_options("SELECT * FROM users WHERE user_type = 2", [], ["list" => true]);
        if($res){
            $result->status = 200;
            $result->data = $res;
        }
        echo json_encode($result);
    }

?>