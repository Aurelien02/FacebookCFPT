<?php 
namespace FacebookCFPT\models;

use FacebookCFPT\models\DBConnection;

require_once ("dbConnection.php");

class postDAO{

    public static function addPost($commentaire){
        $db = DBConnection::getConnection();
        $sql = "INSERT INTO `db_facebookCFPT`.`POST` (`commentaire`, `creationDate`, `modificationDate`) VALUES (:commentaire, :dateCreation, NULL)";
        $q = $db ->prepare($sql);
        $q->execute(array(
            ':commentaire' => $commentaire,
            ':dateCreation' => date("Y-m-d H:i:s")
        ));
    }

    public static function selectLastId(){
        $db = DBConnection::getConnection();
        $sql = "SELECT LAST_INSERT_ID()";
        $q = $db->prepare($sql);
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }

    public static function addImage($type, $nom, $idPost){
        $db = DBConnection::getConnection();
        $sql = "INSERT INTO `db_facebookCFPT`.`MEDIA` (`idMedia`,`typeMedia`,`nomMedia`,`creationDate`,`modificationDate`,`POST_idPost`) VALUES (NULL,  :typeMedia, :nom, :dateCreation, NULL, :idPost)";
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