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

    for($i = 0; $i <= $nbrPost; $i++){
        
    }
}
?>