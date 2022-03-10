<?php

require_once ("./Models/dbConnection.php");
require_once ("./Models/postDAO.php");
require_once ("./Models/mediaDAO.php");

use FacebookCFPT\models\DBConnection;
use FacebookCFPT\models\postDAO;
use FacebookCFPT\models\mediaDAO;

$commentary = filter_input(INPUT_POST, 'commentary', FILTER_SANITIZE_STRING);

/* dans $_FILES : files
- name
- type
- tmp_name
- error
- size
*/

$_SESSION['error'] = "";
$arrayLength = count($_FILES["files"]["name"]);
$fileArray = array();
$AllImageSize = 0;
$errorMsg = "";
//pour s'assurer que tout les fichiers aient bien été déplacé
$moveUploadedFileOk = true;

for($i = 0; $i< $arrayLength; $i++){
    $fileType = explode("/" , $_FILES["files"]["type"][$i]);
    if($_FILES["files"]["size"][$i] <= 3000000 && $fileType[0] == "image" || $fileType[0] == "video" || $fileType[0] == "audio"){
        $arrayTemp = array();
        array_push($arrayTemp, uniqid() . $_FILES["files"]["name"][$i]);
        array_push($arrayTemp,$_FILES["files"]["type"][$i]);
        array_push($arrayTemp,$_FILES["files"]["size"][$i]);
        array_push($arrayTemp,$_FILES["files"]["tmp_name"][$i]);
        array_push($fileArray,$arrayTemp);
        $AllImageSize += $_FILES["files"]["size"][$i];
    }
    else{
        if($_FILES["files"]["error"][$i] == 1){
            $errorMsg = "un ou plusieurs fichier(s) ne correspond(ent) pas au format attendu";
        }
        else if($fileType[0] != "image"){
            $errorMsg = "un ou plusieurs fichier(s) ne correspond(ent) pas au format attendu";
        }
    }
}

//ajoute les médias dans le dossier image
if($errorMsg == ""){
    $dir;
    $dirFile;
    $dir = "./img/";
    foreach ($fileArray as $file) {
        $dirFile = $dir . $file[0];
        if (file_exists($dirFile)) {
        } else {
            try{
                move_uploaded_file($file[3], $dirFile);
            } catch (Exception $e){
                $moveUploadedFileOk = false;
            }
        }
    }


    if($moveUploadedFileOk == true){
        if(!empty($commentary)){
            $db = DBConnection::getConnection();
            try{
                //Début transaction
                $db->beginTransaction();
                //ajout du post
                postDAO::addPost($commentary);
                //récupère le dernier id de post ajouté
                $lastId = postDAO::selectLastId();
                foreach($fileArray as $file){ // ajoute chaques images sélectionnées par l'utilisateur 
                    mediaDAO::addImage( $file[1], $file[0], $lastId[0][0]);
                }
                //validation de la transaction
                $db->commit();
                header("Location: index.php?page=home");
            } catch (\PDOException $e){
                //annulation de la transaction
                error_log($e);
                $db->rollback();
                $errorMsg = "une erreur c'est produite";
            }
        }
    }else{

    }
}else{
    $_SESSION['error'] = $errorMsg;
    header("Location: index.php?page=post");
}

echo "<pre>";
var_dump($fileArray);
echo($AllImageSize);
echo "</pre>";