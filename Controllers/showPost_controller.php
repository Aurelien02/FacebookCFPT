<?php
require_once ("./Models/postDAO.php");
require_once ("./Models/mediaDAO.php");

use FacebookCFPT\models\postDAO;
use FacebookCFPT\models\mediaDAO;

function showPost(){
    //récupèrent tous les posts et tous les médias 
    $allPosts = postDAO::getAllPost();
    $allMedias = mediaDAO::getAllMedia();

    $MediasInfos = array();
    $result ="";
    $modalResult = "";

    foreach($allPosts as $post){// parcourt tous les posts
        $idPost = $post["idPost"];//récupère l'id du post
        foreach($allMedias as $media){//parcourt tous les médias
            if($idPost == $media["POST_idPost"]){//vérifie si la clé étrangère correspond à l'id du post
                $mediaWithType = array();//Tableau pour stocker le nom du média + son type
                array_push($mediaWithType, $media["nomMedia"]);//insère le nom du média
                $fileType = explode("/" , $media["typeMedia"]);//sépare le type du média de son extension
                array_push($mediaWithType, $fileType[0]);//insère le type du média
                array_push($MediasInfos, $mediaWithType);//ajoute les infos du média au tableau principal
            }
        }
        $result .= "<div class='box'><h2>" . $post["commentaire"] ."</h2>
        <br>
        <div class='row columns is-multiline'>";
        foreach($MediasInfos as $media){//parcourt tous les médias récupérés
            $result .= "<div class='column is-4'>
            <div class='bd-snippet-preview'>";
            if($media[1] == "image"){//check si le média est une image
                $result .= "<figure class='image'>
                <img src='./img/". $media[0]."'>
              </figure>
              </div></div>";
            }else if($media[1] == "video"){//check si le média est une vidéo
                $result .= "<video controls autoplay loop>
                <source src='./img/".$media[0]."'>
                </video>
                </div></div>";
            }else if($media[1] == "audio"){//check si le média est un audio
                $result .= "<audio controls>
                <source src='./img/".$media[0]."'>
                </audio>
                </div></div>";
            }
        }
        $MediasInfos = array();
        $result .= "</div>
        <a href='index.php?page=modifyPost&idPost=".$idPost."'>
        <button class='button is-info' >
        Modifier
        </button>
        </a>
        <button class='js-modal-trigger button is-danger' data-target='delPost".$idPost."'>Supprimer</button>
        </div><br>";
        //Ajout des modals de suppression pour chaques posts
        $modalResult .= "
        <div id='delPost".$idPost."' class='modal'>
          <div class='modal-background'></div>

          <div class='modal-content'>
            <div class='box'>
              <div class='columns'>
                <div class='column is-half is-offset-one-quarter has-text-centered'>
                  <p>Êtes vous sûr de vouloir supprimer le post ?</p>
                  <!-- Your content -->
                  <a href='index.php?page=delPost&idPost=".$idPost."'>
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