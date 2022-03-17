  <?php
  
  require_once("./Controllers/showPost_controller.php");
  $msg; 
  if(isset($_SESSION['error'])){
    $msg = $_SESSION['error'];
    $_SESSION['error'] = "";
  }
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
        <?php 
        if(!empty($msg)){// vérifie que le message ne soit pas vide puis si c'est le cas affiche le message d'erreur 
        ?>
          <div class="box" style="text-align: center;">
          <b><?=$msg?></b>
          </div>
        <?php
        }
        ?>
        <div id="posts" >
          <?php
          showPost();  
          ?>
        </div>
      </div>
    </div>
  </section>