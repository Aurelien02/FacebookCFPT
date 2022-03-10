<?php
require_once ("./Models/postDAO.php");
require_once ("./Models/mediaDAO.php");

use FacebookCFPT\models\postDAO;
use FacebookCFPT\models\mediaDAO;

function showPost(){
    //récupèrent tous les posts et tous les médias 
    $allPosts = postDAO::getAllPost();
    $allMedias = mediaDAO::getAllMedia();

    $NamesMedias = array();
    $result ="";

    foreach($allPosts as $post){// parcourt tous les posts
        $idPost = $post["idPost"];//récupère l'id du post
        foreach($allMedias as $media){//parcourt tous les médias
            if($idPost == $media["POST_idPost"]){//vérifie si la clé étrangère correspond à l'id du post
                array_push($NamesMedias, $media["nomMedia"]);//ajoute son nom dans un tableau
            }
        }
        $result .= "<div class='box'><h2>" . $post["commentaire"] ."</h2>
        <br>
        <div class='columns'>";
        foreach($NamesMedias as $name){//parcourt tous les noms récupérés
            $result .= "<div class='column'>
            <div class='bd-snippet-preview'>
            <figure class='image'>
            <img src='./img/". $name."'>
          </figure></div></div>";
        }
        $NamesMedias = array();
        $result .= "</div>
        <button class='button is-info'>
        Modifier
        </button>
        <button class='button is-danger'>Supprimer</button>
        </div><br>";
    }
    echo($result);
}
?>