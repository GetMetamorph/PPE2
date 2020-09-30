<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UberEat</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
        <?php
        session_start();
            require 'navprof.php';
            require '../admin/database.php';
            if(isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $getid = intval($_GET['id']);
                $db = Database::connect();
                $statement = $db->prepare("SELECT * FROM customers WHERE id = ?");
                $statement->execute(array($getid));
                $userinfo  = $statement->fetch();
                Database::disconnect();
                
        ?>

        <br /><br />
        <div class="container admin">
            <h2>Profil de <?php echo $userinfo['name'];?></h2>
            <br /><br />
            Nom : <?php echo $userinfo['name']; ?>
            <br />
            Mail : <?php echo $userinfo['mail']; ?>
            <br />
            <?php
            if($userinfo['id'] == $_SESSION['id'])
            {
            ?>
            <a href="editionprofil.php">Editer mon profil</a>
            <a href="deconexion.php">Se déconnecter</a>
            <?php
            }
            ?>
            
        </div>
    </body>
</html>
<?php
}
else{}
?>