<?php

    header('Content-Type: application/json; charset=utf-8');
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);

    include "../server.php";

    if(isset($_POST["learner_id"]) && isset($_POST["tutor_id"])){

        $result = getAPIResponse();
        $learnerData = $db->query_get("SELECT * FROM users WHERE id = ?", [$_POST["learner_id"]]);
        $tutorData = $db->query_get("SELECT * FROM users WHERE id = ?", [$_POST["tutor_id"]]);
        
        if(!isset($learnerData)){
            $result->status = 500;
            $result->message = "Learner account not found!";
            $result->data = $learnerData;
            echo json_encode($result);
        }
        
        if(!isset($tutorData)){
            $result->status = 500;
            $result->message = "Tutor account not found!";
            $result->data = $tutorData;
            echo json_encode($result);
        }

        if(isset($learnerData) && isset($tutorData)){
            
            // $payload = getQueryFromObjects($_POST, $user, ["profile_photo"]);
            $tutorId = $tutorData["id"];
            $learnerId = $learnerData["id"];
            
            $res = $db->query_set("INSERT INTO transactions (`tutor_id`, `learner_id`, `status`) VALUES (?, ?, 1)", [$tutorId, $learnerId]);
            if($res){
                $result->status = 200;
                $result->message = "Hired Successfully!";
                $result->data = $res;
            }else{
                $result->status = 500;
                $result->message = "An error occured!";
                $result->data = $res;
            }
            echo json_encode($result);
        }

    }

?>