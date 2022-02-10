<?php
require_once ("./Controllers/addPost_controller.php");
?>
 <section class="section" id="section">
   <div class="columns">
     <div class="column is-half is-offset-one-quarter">
       <h1>Ajouter un poste</h1>
       <form class="box" method="post" action="" enctype="multipart/form-data">
         <div class="field">
           <label class="label">Commentaire</label>
           <div class="control">
             <input class="input" type="textarea" id="commentary" name="commnentary">
           </div>
         </div>

         <div class="field">
           <!-- <input type="file" name="files[]" accept="image/jpeg, image/png, image/gif" multiple> -->
           <input type="file" name="files[]"  multiple>
           <!-- <label class="label">Add images</label>
                  <div class="control">
                    <input class="input" type="password" placeholder="********">
                  </div> -->
         </div>

         <button class="button is-primary">Ajouter</button>
       </form>
     </div>
   </div>
 </section>