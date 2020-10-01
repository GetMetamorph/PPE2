<?php
if(isset($_SESSION['id'])){
  echo '
    <div class="row blockdark fonttype align-items-center">
    <div class="col-1" id="logoprof">
        <h3><a href="'.dirname("../index.php").'" id=\'anchornav\'>UberEat</a></h3>
    
    </div>
    <div class="col-1">
    </div>

    <div class="col-2 offset-2 navprof">
        <h4>Historique</h4>
    </div>

    <div class="col-2 navprof">
        <h4>Panier</h4>
    </div>

    <div class="col-2 navprof">
        <h4>Mon profil</h4>
    </div>

    <div class="col-2 navprof">
        <h4><a href="deconnexion.php" id=\'anchornav\'>Deconnexion</a></h4>
    </div>
    </div>';
}
else{
  echo '
  <div class="row blockdark fonttype align-items-center">
  <div class="col-2" id="logoprof">
      <h3><a href="index.php"id=\'anchornav\'>UberEat</a></h3>
  </div>

  <div class="col-2 offset-6 navprof">
      <h4><a href="inscription.php"id=\'anchornav\'>S\'inscrire</h4></a>
  </div>

  <div class="col-2 navprof">
      <h4><a href="connexion.php" id=\'anchornav\'>Se connecter</a></h4>
  </div>
  </div>';
}
  ?>