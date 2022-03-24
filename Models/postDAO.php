<?php 
namespace FacebookCFPT\models;

use FacebookCFPT\models\DBConnection;

require_once ("dbConnection.php");

class postDAO{
    
    public static function getAllPost(){
        $db = DBConnection::getConnection();
        $sql = "SELECT * FROM `db_facebookCFPT`.`POST` ORDER BY `creationDate` DESC";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }

    public static function getPostById($id){
        $db = DBConnection::getConnection();
        $sql = "SELECT * FROM `db_facebookCFPT`.`POST` WHERE idPost IN ('$id')";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }

    public static function addPost($commentaire){
        $db = DBConnection::getConnection();
        $sql = "INSERT INTO `db_facebookCFPT`.`POST` (`commentaire`, `creationDate`, `modificationDate`) VALUES (:commentaire, :dateCreation, NULL)";
        $q = $db ->prepare($sql);
        $q->execute(array(
            ':commentaire' => $commentaire,
            ':dateCreation' => date("Y-m-d H:i:s")
        ));
    }

    public static function deletePost($idPost){
        $db = DBConnection::getConnection();
        $sql = "DELETE FROM POST WHERE idPost = '$idPost'";
        $q = $db->prepare($sql);
        $q->execute();
    }

    public static function selectLastId(){
        $db = DBConnection::getConnection();
        $sql = "SELECT LAST_INSERT_ID()";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }

}

?>