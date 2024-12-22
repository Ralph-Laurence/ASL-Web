<?php

    header('Content-Type: application/json; charset=utf-8');

    include "../server.php";

    if(isset($_GET["filter"])){

    }else if(isset($_GET["account_status"])){
        $result = getAPIResponse();
        $res = $db->query_get("SELECT * FROM users WHERE user_type = 1 AND id = ? ", [$_GET["id"]]);
        if($res){
            $result->status = 200;            
            $result->is_verified = $res["is_verified"];
        }
        echo json_encode($result);
    }else if(isset($_GET["account"])){
        $result = getAPIResponse();
        $res = $db->query_get("SELECT * FROM users WHERE user_type = 1 AND id = ? ", [$_GET["id"]]);
        if($res){
            $result->status = 200;            
            $result->data = $res;
        }
        echo json_encode($result);
    }else if(isset($_GET["self"])){
        $result = getAPIResponse();
        $res = $db->query_get_with_options("SELECT * FROM users WHERE user_type = 1 AND is_verified = 1 AND id != ?", [$_GET["self"]], ['list' => true]);
        if($res){
            $result->status = 200;            
            $result->data = $res;
        }
        echo json_encode($result);
    }else if(isset($_GET["except"]) && isset($_GET["learner_id"])){
        $result = getAPIResponse();
        $transactions = $db->query_get_with_options("SELECT * FROM transactions WHERE status = 1 AND learner_id = ?", [$_GET["learner_id"]], ["list" => true]);
        $availableTutors = $db->query_get_with_options("SELECT * FROM users WHERE user_type = 1 AND is_verified = 1", [], ['list' => true]);
        
        $tutors = [];

        foreach($availableTutors as $tutor){
            $findTransaction = $db->query_get_with_options("SELECT * FROM transactions WHERE status = 1 AND tutor_id = ? AND learner_id = ?", 
            [$tutor["id"], $_GET["learner_id"]], ["list" => true]);
            if(count($findTransaction) == 0){
                $tutors[] = $tutor;
            }
        }
        
        if($tutors){
            $result->status = 200;            
            $result->data = $tutors;
        }
        echo json_encode($result);
    }else {
        $result = getAPIResponse();
        $res = $db->query_get_with_options("SELECT * FROM users WHERE user_type = 1 AND is_verified = 1", [], ['list' => true]);
        if($res){
            $result->status = 200;            
            $result->data = $res;
        }
        echo json_encode($result);
    }
    
    

?>