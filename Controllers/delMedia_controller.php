<?php
require_once ("./Models/dbConnection.php");
require_once ("./Models/mediaDAO.php");

use FacebookCFPT\models\DBConnection;
use FacebookCFPT\models\mediaDAO;

$idMedia = $_GET['idMedia'];
$nameMedia = $_GET['nameMedia'];
$idPost = $_GET['idPost'];

if(!empty($idMedia)){
    $db = DBConnection::getConnection();
    try{
        //Début transaction
        $db -> beginTransaction();
        //Suppression du media
        mediaDAO::deleteMediaById($idMedia);
        //validation de la transaction
        $db -> commit();
        //Suppression du media dans l'arborescence seulement si la transaction est passée
        $path = "./img/";
        $path .= $nameMedia;
        unlink($path);//fonction de suppression
        header("Location: index.php?page=modifyPost&idPost=$idPost");
    }catch(PDOException $e){
        //annulation de la transaction
        error_log($e);
        $db->rollback();
        $errorMsg = "une erreur c'est produite lors de la suppression du media";//message d'erreur
        $_SESSION['error'] = $errorMsg;
    }
}
?>