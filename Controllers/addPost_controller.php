<?php
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
$filesName = array();
$filesSize = array();

for($i = 0; $i< $arrayLength; $i++){
    if($_FILES["files"]["size"][$i] <= 30000){
        array_push($filesName,$_FILES["files"]["name"][$i]);
        array_push($filesSize,$_FILES["files"]["size"][$i]);
    }
}
echo "<pre>";
var_dump($filesName);
echo "</pre>"
?>