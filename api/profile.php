<?php

    header('Content-Type: application/json; charset=utf-8');

    include "../server.php";

    if(isset($_POST["id"])){

        $result = getAPIResponse();
        $user = $db->query_get("SELECT * FROM users WHERE id = ?", [$_POST["id"]]);

        if($user){
            
            // $payloadx = getQueryFromObjects($_POST, $user, ["profile_photo"]);
            $payload = getQueryParamsFormObjects($_POST, $user, ["profile_photo"]);
            
            if(isset($_FILES["profile_photo"])){
                
                $profile_photo = $file_uploader->upload($_FILES["profile_photo"], "profiles");
                
                if($profile_photo){
                    if($payload["query"] != ""){
                        $payload["query"] .= ", profile_photo = ?";
                        $payload["params"][] = $profile_photo;
                    }else{
                        $payload["query"] .= "profile_photo = ?";
                        $payload["params"][] = $profile_photo;
                    }
                }
                
            }

            $res = $db->query_set("UPDATE users SET ".$payload["query"]." WHERE id = ?", array_merge($payload["params"], [$_POST["id"]]));
            if($res){
                $result->status = 200;
                $result->message = "Updated successfully!";
                $result->data = $res;
            }else{
                 $result->status = 500;
                $result->message = "Failed to update!";
                $result->data = $payload;
                $result->params = array_merge($payload["params"], [$_POST["id"]]);
            }
            echo json_encode($result);
        }else{
            $result->status = 500;
            $result->message = "User not found!";
            echo json_encode($result);
        }

    }

?>