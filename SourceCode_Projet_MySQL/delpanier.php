<!DOCTYPE html>
<html>
    <head>
        <title>Uber Eat</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
    <?php 
    session_start();
    require 'navmain.php';
    require 'admin/database.php';
        echo '
        <h1 class="text-logo">UberEat</h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Panier</strong></h1>
                <br>
                <form class="form" action="delpanier.php?item='.$_GET['item'].'&id='.$_SESSION['id'].'" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $_POST[\'id\'];?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir retirer l\'article du panier ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning" name="itemId" value="$_GET[\'item\'];">Oui</button>
                      <a class="btn btn-default" href="panier.php?item='.$_GET['item'].'&id='.$_SESSION['id'].'>Non</a>
                    </div>
                </form>
            </div>
        </div>';
    if(!empty($_POST)) 
    {
        $itemId = $_GET['item'];;
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM cart WHERE cus_id = ? AND item_id = ? LIMIT 1;");
        $statement->execute(array((int)$_SESSION['id'],(int) $itemId));
        Database::disconnect();
        header("Location: panier.php");
        echo '<h1>'.$itemId.'</h1>';
        echo '<h1>'.$_SESSION['id'].'</h1>';
    }
    ?>
    </body>
</html>

