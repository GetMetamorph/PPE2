<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UberEat</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <?php
            require 'admin/database.php';
            if (isset($_POST['forminscription']))
            {
                $name = htmlspecialchars($_POST['name']);
                $mail = htmlspecialchars($_POST['mail']);
                $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT); // En mettant le password_hash , je n'arrive pas à faire la double vérification du mot de passe
                $pwd2 = password_hash($_POST['pwd2'], PASSWORD_DEFAULT);
                
                if(!empty($_POST['name']) AND !empty($_POST['mail']) AND !empty($_POST['pwd']) AND !empty($_POST['pwd2']))
                {
                    $namelength = strlen($name);
                    if ($namelength <= 255)
                    {
                        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                        {
                            $db = Database::connect();
                            $statement = $db->prepare("SELECT * FROM customers WHERE mail = ?");
                            $statement->execute(array($mail));
                            Database::disconnect();
                            $mailexist = $statement->rowCount();
                            if($mailexist == 0)
                            {
                                if($_POST['pwd'] == $_POST['pwd2'])
                                {
                                    $db = Database::connect();
                                    $statement = $db->prepare("INSERT INTO customers(name, mail, password) VALUES(?,?,?)");
                                    $statement->execute(array($name,$mail,$pwd));
                                    Database::disconnect();
                                    $correct = "Votre compte a bien été créé   <a href=\"connexion.php\">Me connecter</a>";
                                }
                                else
                                {
                                    $erreur = "Vos mots de passe ne correspondent pas";
                                }
                            }
                            else
                            {
                                $erreur = "Adresse mail déjà utilisé";
                            }
                        }                        
                    }
                    else
                    {
                        $erreur = "Votre nom ne doit pas dépasser 255 caractères";
                    }
                }
                else{
                    $erreur = "Tout les champs doivent être complétés !";
                }
            }
        ?>
        <br /><br />
        <div class="container admin">
            <h2>Inscription</h2>
            <br /><br />
            <form method="POST" action="">
                <table>
                    <tr>
                        <td align="right">
                            <label for="name">Nom:</label>
                        </td>
                        <td >
                            <input type="text" placeholder="Votre  nom" name="name" value="<?php if(isset($name)) { echo $name;} ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mail">Mail:</label>
                        </td>
                        <td>
                            <input type="email" placeholder="Votre  Mail" name="mail" value="<?php if(isset($name)) { echo $mail;} ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="password">Mot de passe:</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Votre mot de passe" name="pwd" />
                        </td>
                    </tr> 
                    <tr>
                        <td align="right">
                            <label for="password2">Confirmez mot de passe:</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Confirmez mot de passe" name="pwd2" />
                        </td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td>
                        <button type="submit" class="btn btn-primary" name="forminscription" value="Inscription">S'inscrire</button>
                        </td>
                    </tr>
                </table>
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