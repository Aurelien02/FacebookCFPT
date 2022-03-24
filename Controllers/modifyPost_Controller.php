<?php
require_once ("./Models/postDAO.php");
require_once ("./Models/mediaDAO.php");

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
                  <a href='index.php?page=delMedia&idMedia=".$media['idMedia']."&idPost=".$idPost."'>
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
?>