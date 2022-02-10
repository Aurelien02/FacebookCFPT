<?php 
namespace FacebookCFPT\model;

use FacebookCFPT\model\DBConnection;

require_once ("dbConnection.php");

class postDAO{

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