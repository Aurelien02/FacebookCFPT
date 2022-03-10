<?php
$msg; 
  if(isset($_SESSION['error'])){
    $msg = $_SESSION['error'];
  }
?>
<section class="section" id="section">
   <div class="columns">
     <div class="column is-half is-offset-one-quarter">
       <h1>Ajouter un poste</h1>
       <form class="box" method="post" action="" enctype="multipart/form-data">
         <div class="field">
           <label class="label">Commentaire</label>
           <div class="control">
             <input class="input" type="textarea" id="commentary" name="commentary">
           </div>
         </div>

         <div class="field">
           <!-- <input type="file" name="files[]" accept="image/jpeg, image/png, image/gif" multiple> -->
           <input type="file" name="files[]"  multiple>
         </div>

         <button class="button is-primary">Ajouter</button>
         <span><?= $msg?></span>
       </form>
     </div>
   </div>
 </section>