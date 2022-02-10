<?php

use FacebookCFPT\model\postDAO;

$commentary = filter_input(INPUT_POST, "commentary", FILTER_SANITIZE_STRING);

/* dans $_FILES : files
- name
- type
- tmp_name
- error
- size
*/
//var_dump($_FILES["files"]["name"]);
$arrayLength = count($_FILES["files"]["name"]);
$fileArray = array();
$AllImageSize = 0;

for($i = 0; $i< $arrayLength; $i++){
    $fileType = explode("/" , $_FILES["files"]["type"][$i]);
    if($_FILES["files"]["size"][$i] <= 3000000 && $fileType[0] == "image"){
        $arrayTemp = array();
        array_push($arrayTemp,$_FILES["files"]["name"][$i]);
        array_push($arrayTemp,$_FILES["files"]["type"][$i]);
        array_push($arrayTemp,$_FILES["files"]["size"][$i]);
        array_push($arrayTemp,$_FILES["files"]["tmp_name"][$i]);
        array_push($fileArray,$arrayTemp);
        $AllImageSize += $_FILES["files"]["size"][$i];
        /* array_push($filesName,$_FILES["files"]["name"][$i]);
        array_push($filesSize,$_FILES["files"]["size"][$i]); */
    }
}


$dir;
$dirFile;
$dir = "../img/";
foreach ($fileArray as $file) {
    $dirFile = $dir . $file[0];
    if (file_exists($dirFile)) {
    } else {
        move_uploaded_file($file[3], $dirFile);
    }
}


if($AllImageSize <= 70000000){
    foreach($fileArray as $file){
        /**
         *  TODO: ajouter l'id du post comme parametre de la requete
         */
        postDAO::addImage($file[0], $file[1]);
    }
}else{

}

echo "<pre>";
var_dump($fileArray);
echo($AllImageSize);
echo "</pre>"
?>