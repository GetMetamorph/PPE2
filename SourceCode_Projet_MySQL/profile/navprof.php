<?php
if(isset($_SESSION['id'])){
echo '
    <div class="row blockdark fonttype align-items-center">
        <div class="col-1" id="logoprof">
            <h3><a href="../index.php?id='.$_SESSION['id'].'" id=\'anchornav\'>UberEat</a></h3>
        </div>

        <div class="col-2 offset-3 navprof">
            <h4><a href="../history.php?id='.$_SESSION['id'].'" id=\'anchornav\'>Historique</a></h4>
        </div>

        <div class="col-2 navprof">
            <h4><a href="../panier.php?id='.$_SESSION['id'].'" id=\'anchornav\'>Panier</a></h4>
        </div>

        <div class="col-2 navprof">
            <h4><a href="profil.php" id=\'anchornav\'>Mon profil</a></h4>
        </div>

        <div class="col-2 navprof">
            <h4><a href="deconnexion.php" id=\'anchornav\'>Deconnexion</a></h4>
        </div>
    </div>';
}
else{
  echo '
  <div class="row blockdark fonttype align-items-center">
        <div class="col-1" id="logoprof">
            <h3><a href="../index.php" id=\'anchornav\'>UberEat</a></h3>
        </div>

    <div class="col-2 offset-7 navprof">
        <h4><a href="inscription.php"id=\'anchornav\'>S\'inscrire</h4></a>
    </div>

    <div class="col-2 navprof">
        <h4><a href="connexion.php" id=\'anchornav\'>Se connecter</a></h4>
    </div>
  </div>';
}
  ?>