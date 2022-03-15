  <?php
  
  require_once("./Controllers/showPost_controller.php");
  
  ?>
  <section class="section" id="section">
    <div class="columns">
      <!-- LEFT SIDE -->
      <div class="column is-one-third">
        <div class="card">
          <div class="card-image">
            <figure class="image is-4by3">
              <img src="./img/sv650.jpg" alt="Placeholder image">
            </figure>
          </div>
          <div class="card-content" style="text-align: center;">
            <div class="media">
              <div class="media-left">
              </div>
              <div class="media-content">
                <p class="title is-4">FacebookCFPT</p>
              </div>
            </div>

            <div class="content">
              45 followers 13 Posts
              <br>
            </div>
          </div>
        </div>
      </div>
      <!-- RIGHT SIDE -->
      <div class="column">
        <div class="box" style="text-align: center;">
          <b>Bienvenue !</b>
        </div>
        <div id="posts" >
          <?php
          showPost();
          // TODO Créer une modale personnalisée avec l'id du post pour chaque post  
          ?>
          <!-- Début modal -->
          <div id="modal-js-example" class="modal">
          <div class="modal-background"></div>

          <div class="modal-content">
            <div class="box">
              <div class="columns">
                <div class="column is-half is-offset-one-quarter has-text-centered">
                  <p>Êtes vous sûr de vouloir supprimer le post ?</p>
                  <!-- Your content -->
                  <button class="button is-danger">Supprimer</button>
                </div>
              </div>
            </div>
          </div>
          <button class="modal-close is-large" aria-label="close"></button>
        </div>
        <!-- fin modal -->
        </div>
      </div>
    </div>
  </section>