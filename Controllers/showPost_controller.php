<?php
require_once ("./Models/postDAO.php");
require_once ("./Models/mediaDAO.php");

use FacebookCFPT\models\postDAO;
use FacebookCFPT\models\mediaDAO;

function showPost(){
    $allPosts = postDAO::getAllPost();
    $allMedias = mediaDAO::getAllMedia();
// TODO: parcourir tout les posts et pour chaques post récupérer toutes les images correspondantes 
    $nbrPost = count($allPosts);

    $NamesMedias = array();
    $result ="";

    foreach($allPosts as $post){
        $idPost = $post["idPost"];
        foreach($allMedias as $media){
            if($idPost == $media["POST_idPost"]){
                array_push($NamesMedias, $media["nomMedia"]);
            }
        }
        $result .= "<div class='box'><h2>" . $post["commentaire"] ."</h2>
        <br>
        <div class='columns'>";
        foreach($NamesMedias as $name){
            $result .= "<div class='column'>
            <div class='bd-snippet-preview'>
            <figure class='image'>
            <img src='./img/". $name."'>
          </figure></div></div>";
        }
        $NamesMedias = array();
        $result .= "</div></div><br>";
    }
    echo($result);
}
?>