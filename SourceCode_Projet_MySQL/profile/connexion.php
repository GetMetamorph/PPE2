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
            if(isset($_POST['formconnect']))
            {
                $mailconnect = htmlspecialchars($_POST['mailconnect']);
                $pwdconnect = $_POST['pwdconnect'];
                if(!empty($mailconnect) AND !empty($pwdconnect))
                {
                    $db = Database::connect();
                    $statement = $db->prepare("SELECT * FROM customers WHERE mail = ?");
                    $statement->execute(array($mailconnect ));
                    $userexist =  $statement->rowCount();
                    if($userexist == 1)
                    {
                        $userinfo = $statement->fetch();
                        if(password_verify($pwdconnect, $userinfo['password'])){
                           
                            $_SESSION['id'] = $userinfo['id'];
                            $_SESSION['pseudo'] = $userinfo['pseudo'];
                            $_SESSION['mail'] = $userinfo['mail'];
                            header("Location: profil.php?id=".$_SESSION['id']);
                            $correct = "Vous allez être redirigé";
                        }
                        else
                        {
                            $erreur = "Mauvais mot de passe.";
                        }
                    }

                    Database::disconnect();
                }
                else{
                    $erreur = "Tout les champs doivent être complétés";
                }
            }
        ?>

        <br /><br />
        <div class="container admin">
            <h2>Connexion</h2>
            <br /><br />
            
            <form method="POST" action="">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-md-4 ">
                        <input type="text" class="form-control" name="mailconnect" placeholder="Mail" />
                    </div>
                </div>
                <div class="row">
                <div class="col-4"></div>
                    <div class="col-md-4">
                        <input type="password" class="form-control" name="pwdconnect" placeholder="Mot de passe" />
                    </div>
                </div>
                <div class="row">
                <div class="col-4"></div>
                    <div class="col-4">
                        <input type="submit" class="form-control btn btn-primary" name="formconnect" value="Se connecter"  />
                    </div>
                </div>
            </form>
            <?php
            if(isset($erreur))
            {
                echo '<font color="red">'.$erreur.'</font>';
            } 
            if(isset($correct))
            {
                echo '<font color="blue">'.$correct.'</font>';
            } 
            ?>
        </div>
    </body>
</html>