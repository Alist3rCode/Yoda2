<?php

require_once "../ajaxDatabaseInit.php";

if (isset($_FILES["file"]["type"])) {
    
    if ($_FILES["file"]["size"] < 8000000) {
        
        if ($_FILES["file"]["error"] > 0) {
            
            switch ($_FILES["file"]["error"]) {
                case 1:
                    $error =  "UPLOAD_ERR_INI_SIZE";
                    break;
                case 2:
                    $error =  "UPLOAD_ERR_FORM_SIZE";
                    break;
                case 3:
                    $error =  "UPLOAD_ERR_PARTIAL";
                    break;
                case 4:
                    $error =  "UPLOAD_ERR_NO_FILE";
                    break;
                case 6:
                    $error =  "UPLOAD_ERR_NO_TMP_DIR";
                    break;
                case 7:
                    $error =  "UPLOAD_ERR_CANT_WRITE";
                    break;
                case 8:
                    $error =  "UPLOAD_ERR_EXTENSION";
                    break;
            }

            $array['ok'] = 'nok';
            $array['error'] = 'error file : ' . $error ;
            
        } else {
            
            if (file_exists("../../public/img/interne/" . $_FILES["file"]["name"])) {
                $array['ok'] = 'nok';
                $array['error'] = $_FILES["file"]["name"] . " existe déja.";
            } else {
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = "../../public/img/interne/" . $_FILES['file']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                
                $array['ok'] = 'ok';
                $array['name'] = $_FILES["file"]["name"];
                
            }
        }
    } else {
        $array['ok'] = 'nok';
        $array['error'] = "Taille ou type d'image invalide";
    }
}

header("content-type:application/json");
echo json_encode($array);
?>