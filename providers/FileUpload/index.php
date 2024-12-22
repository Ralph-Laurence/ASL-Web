<?php

    class FileUploader {
        
        public $target_dir;
        public $target_file;
        public $error;

        public function upload($file, $path){

            $target_dir = "../uploads/".$path."/";
            $target_file = $target_dir . basename($file["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check file size (limit to 25MB)  
            if ($file["size"] > 250000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Check if everything is ok before uploading
            if ($uploadOk == 1) {
                
                if (move_uploaded_file($file["tmp_name"], $target_file)) {

                    return $target_file;
                
                } else {
                    return false;
                }
            }

        }

    }


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//   // Directory where the uploaded file will be stored
//   $target_dir = "../../uploads/";
//   $target_file = $target_dir . basename($_FILES["floor_plan"]["name"]);
//   $uploadOk = 1;
//   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//   // Check if the file is an actual image
//   $check = getimagesize($_FILES["floor_plan"]["tmp_name"]);
//   if ($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }

//   // Check file size (limit to 25MB)  
//   if ($_FILES["floor_plan"]["size"] > 25000000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
//   }

//   // Allow certain file formats
//   if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//     echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
//     $uploadOk = 0;
//   }

//   // Check if everything is ok before uploading
//   if ($uploadOk == 1) {
//     if (move_uploaded_file($_FILES["floor_plan"]["tmp_name"], $target_file)) {
      
//       echo "The file " . htmlspecialchars(basename($_FILES["floor_plan"]["name"])) . " has been uploaded.";
//       echo "File: ". $target_file;

//       $uploadedFile = "../api/".$target_file;
//       $save = $db->query_set("UPDATE library_settings SET floor_plan = '".$uploadedFile."' WHERE id = 1");
//       if($save){
//         header("Location: ../admin/seats.php");
//       }

//     } else {
//       echo "Sorry, there was an error uploading your file.<br><br>";
//       echo json_encode($_FILES["floor_plan"]);
//       echo "<br><br>";
//       echo $target_file;
//     }
//   }
// }

// ?>
