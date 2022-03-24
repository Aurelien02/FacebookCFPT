<?php
require_once ("./Models/dbConnection.php");
require_once ("./Models/postDAO.php");
require_once ("./Models/mediaDAO.php");

use FacebookCFPT\models\DBConnection;
use FacebookCFPT\models\postDAO;
use FacebookCFPT\models\mediaDAO;

function showMedias(){
    $result = "";
    $modalResult ="";
    $idPost = $_GET['idPost'];
    $post = postDAO::getPostById($idPost);
    $mediasFromPost = mediaDAO::getAllMediasInfosByIdPost($idPost);
    foreach ($mediasFromPost as $media){
        $fileType = explode("/" , $media["typeMedia"]);//sépare le type du média de son extension
        $typeOfMedias = $fileType[0];
        $result .= "<div class='column is-4'>
            ";
            if($typeOfMedias == "image"){//check si le média est une image
                $result .= "<figure class='image'>
                <img src='./img/". $media['nomMedia']."'>
              </figure>";
            }else if($typeOfMedias == "video"){//check si le média est une vidéo
                $result .= "<video controls autoplay loop>
                <source src='./img/".$media['nomMedia']."'>
                </video>";
            }else if($typeOfMedias == "audio"){//check si le média est un audio
                $result .= "<audio controls>
                <source src='./img/".$media['nomMedia']."'>
                </audio>";
            }
        $result .= "
        <button class='js-modal-trigger button is-danger' data-target='delMedia".$media['idMedia']."'>Supprimer</button>
        </div>";

        //Ajout des modals de suppression pour chaques médias
        $modalResult .= "
        <div id='delMedia".$media['idMedia']."' class='modal'>
          <div class='modal-background'></div>

          <div class='modal-content'>
            <div class='box'>
              <div class='columns'>
                <div class='column is-half is-offset-one-quarter has-text-centered'>
                  <p>Êtes vous sûr de vouloir supprimer le média ?</p>
                  <!-- Your content -->
                  <a href='index.php?page=delMedia&idMedia=".$media['idMedia']."&nameMedia=".$media['nomMedia']."&idPost=".$idPost."'>
                  <button class='button is-danger'>Supprimer</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <button class='modal-close is-large' aria-label='close'></button>
        </div>
        ";    
    }
    echo($result);
    echo($modalResult);
}

$commentary = filter_input(INPUT_POST, 'commentary', FILTER_SANITIZE_STRING);
$idPost = $_GET['idPost'];
$post = postDAO::getPostById($idPost);
$DBCommentary = $post[0]['commentaire'];

if(!empty($commentary)){
    if($commentary != $DBCommentary){
        postDAO::updateCommentaryById($idPost, $commentary);
    }
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
                    foreach($fileArray as $file){ // ajoute chaques images sélectionnées par l'utilisateur 
                        mediaDAO::addImage( $file[1], $file[0], $idPost);
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
}
?>