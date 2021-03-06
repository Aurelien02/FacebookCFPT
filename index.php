<?php
session_start();
//appel le header
require_once ("./Views/header.php");

// variable page qui va etre utile pour rediriger les liens
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

if($page == null){
    $page = "home";
}

switch ($page) {
    case "home":
            require("./Views/home.php");
        break;
    case "post":
        require("./Views/post.php");
        require_once ("./Controllers/addPost_controller.php");
    break;
    case "delPost":
        error_log("delPost");
        require_once("./Controllers/delPost_controller.php");
    break;
    case "delMedia":
        require_once ("./Controllers/delMedia_controller.php");
    break;
    case "modifyPost":
        require("./Views/modifyPost.php");
    break;
}

require_once ("./Views/footer.php");
?>