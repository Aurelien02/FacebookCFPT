<?php
require_once ("./Models/dbConnection.php");
require_once("./Models/mediaDAO.php");
require_once("./Models/postDAO.php");

use FacebookCFPT\models\DBConnection;
use FacebookCFPT\models\mediaDAO;
use FacebookCFPT\models\postDAO;

$errorMsg = "";
$idPost = $_GET['idPost'];//Récupère l'id du post dans l'url
if(!empty($idPost)){// vérifie que l'id du post aie bien été récupéré
    $db = DBConnection::getConnection();
    try{
        $allMediasFromPost = mediaDAO::getAllMediaByIdPost($idPost);
        //Début transaction
        $db->beginTransaction();
        //Suppression du post
        postDAO::deletePost($idPost);
        //validation de la transaction
        $db->commit();
        //Suppression des medias dans l'arborescence seulement si la transaction est passée
        foreach($allMediasFromPost as $media){//parcourt tous les médias pour les supprimer
            $path = "./img/";
            $path .= $media['nomMedia'];
            unlink($path);//fonction de suppression
        }
        header("Location: index.php?page=home");
    }catch(PDOException $e){
        //annulation de la transaction
        error_log($e);
        $db->rollback();
        $errorMsg = "une erreur c'est produite lors de la suppression du post";//message d'erreur
        $_SESSION['error'] = $errorMsg;
    }
}
?>