<?php   
    if(isset($_SESSION['id'])){
        echo'
        <div class="row blockdark fonttype">
            <div class="col-md-1" id="logo">
                <h3><a href="index.php"id=\'anchornav\'>UberEat </a></h3>
            </div>

            <div class="col-md-3">
            </div>

            <div class="col-md-2 navmain">
                <h3>Historique</h3>
            </div>

            <div class="col-md-2 navmain">
                <h3>Panier</h3>
            </div>

            <div class="col-md-2 navmain">
                <h3><a href="profile/profil.php?id='.$_SESSION['id'].'" id=\'anchornav\'>Mon profil</h3></a>
            </div>

            <div class="col-md-2 navmain">
                <h3><a href="profile/deconnexion.php" id=\'anchornav\'>Deconnexion</a></h3>
            </div>
        </div>';
    }
    else{
        echo'
        <div class="row blockdark">
            <div class="col-md-2" id="logo">
                <h3><a href="index.php"id=\'anchornav\'>UberEat</a></h3>
            </div>

            <div class="col-md-8">
            </div>

            <div class="col-md-2 navmain">
                <h3><a href="profile/connexion.php" id=\'anchornav\'>Se connecter</a></h3>
            </div>
        </div>';
    }
?>
