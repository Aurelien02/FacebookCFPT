<?php
namespace FacebookCFPT\models;

use FacebookCFPT\models\DBConnection;

require_once ("dbConnection.php");

class mediaDAO{

    public static function getAllMedia(){
        $db = DBConnection::getConnection();
        $sql = "SELECT * FROM `db_facebookCFPT`.`MEDIA`";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }

    public static function getAllMediasNameByIdPost($idPost){
        $db = DBConnection::getConnection();
        $sql = "SELECT nomMedia FROM `db_facebookCFPT`.`MEDIA` WHERE POST_idPost = '$idPost'";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }

    public static function getAllMediasInfosByIdPost($idPost){
        $db = DBConnection::getConnection();
        $sql = "SELECT * FROM `db_facebookCFPT`.`MEDIA` WHERE POST_idPost = '$idPost'";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }

    public static function addImage($type, $nom, $idPost){
        $db = DBConnection::getConnection();
        $sql = "INSERT INTO `db_facebookCFPT`.`MEDIA` (`typeMedia`,`nomMedia`,`creationDate`,`modificationDate`,`POST_idPost`) VALUES (:typeMedia, :nom, :dateCreation, NULL, :idPost)";
        $q = $db->prepare($sql);
        $q->execute(array(
            ':typeMedia' => $type,
            ':nom' => $nom,
            ':dateCreation' => date("Y-m-d H:i:s"),
            'idPost' => $idPost
        ));
    }
}
?>