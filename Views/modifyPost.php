<?php
require_once("./Controllers/modifyPost_Controller.php");
require_once ("./Models/postDAO.php");

use FacebookCFPT\models\postDAO;

$msg; 
  if(isset($_SESSION['error'])){
    $msg = $_SESSION['error'];
  }
  $idPost = $_GET['idPost'];
$post = postDAO::getPostById($idPost);
$commentary = $post[0]['commentaire'];
?>
<section class="section" id="section">
   <div class="columns">
     <div class="column is-half is-offset-one-quarter">
       <h1>Modifer le post</h1>
       <form class="box" method="post" action="" enctype="multipart/form-data">
         <div class="field">
           <label class="label">Commentaire</label>
           <div class="control">
             <input class="input" type="textarea" id="commentary" name="commentary" value="<?= $commentary?>">
           </div>
         </div>
         <div class="field">
           <!-- <input type="file" name="files[]" accept="image/jpeg, image/png, image/gif" multiple> -->
           <input type="file" name="files[]"  multiple>
         </div>

         <button class="button is-primary">Modifier</button>
         <span><?= $msg?></span>
       </form>
       <div class="row columns is-multiline">
             <?php 
             showMedias();
             ?>
         </div>
     </div>
   </div>
 </section>