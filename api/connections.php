<?php

    header('Content-Type: application/json; charset=utf-8');

    include "../server.php";

    if(isset($_GET["filter"])){

    }else if(isset($_GET["learner_id"])){
        $result = getAPIResponse();
        $res = $db->query_get_with_options("SELECT * FROM transactions WHERE status = 1 AND learner_id = ?", [$_GET["learner_id"]], ["list" => true]);
        if($res){
            
            $tutors = [];
            foreach($res as $transdata){
                $tutorAccountDetails = $db->query_get("SELECT * FROM users WHERE status = 1 AND id = ?", [$transdata["tutor_id"]]);
                $tutors[] = $tutorAccountDetails;
            }
            
            $result->status = 200;            
            $result->data = $tutors;
            echo json_encode($result);
        }
        
    }else if(isset($_GET["tutor_id"])){
        $result = getAPIResponse();
        $res = $db->query_get_with_options("SELECT * FROM transactions WHERE status = 1 AND tutor_id = ?", [$_GET["tutor_id"]], ["list" => true]);
        if($res){
            
            $learners = [];
            foreach($res as $transdata){
                $learnerAccountData = $db->query_get("SELECT * FROM users WHERE status = 1 AND id = ?", [$transdata["learner_id"]]);
                $learners[] = $learnerAccountData;
            }
            
            $result->status = 200;            
            $result->data = $learners;
            echo json_encode($result);
        }
        
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