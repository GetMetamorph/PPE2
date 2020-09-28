<!DOCTYPE html>
<?php
    session_start();
        require 'admin/database.php';
        if(isset($_SESSION['id']))
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM customers WHERE id = ?");
            $statement->execute(array($_SESSION['id']));
            $user = $statement->fetch();

            if(isset($_POST['newname']) AND !empty($_POST['newname']) AND $_POST['newname'] != $user['name'])
            {
                $newname = htmlspecialchars($_POST['newname']);
                $statement = $db->prepare("UPDATE customers SET name = ? WHERE  id = ?");
                $statement->execute(array($newname, $_SESSION['id']));
                header('Location: profil.php?id='.$_SESSION['id']);
            }
            if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
            {
                $newmail = htmlspecialchars($_POST['newmail']);
                $statement = $db->prepare("UPDATE customers SET mail = ? WHERE  id = ?");
                $statement->execute(array($newmail, $_SESSION['id']));
                header('Location: profil.php?id='.$_SESSION['id']);
            }
            if(isset($_POST['newpwd']) AND !empty($_POST['newpwd']))
            {
                if($_POST['newpwd'] == $_POST['newpwd2'])
                {
                    $newpwd = htmlspecialchars($_POST['newpwd']);
                    $statement = $db->prepare("UPDATE customers SET password = ? WHERE  id = ?");
                    $statement->execute(array($newpwd, $_SESSION['id']));
                    header('Location: profil.php?id='.$_SESSION['id']);
                }
                else
                {
                    $msg = "Vos mots de passe ne correspondent pas";
                }
            }
            if(isset($_POST['newname']))
            {
                header('Location: profil.php?id='.$_SESSION['id']);
            }

            Database::disconnect();      
            
        
?>

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
    <br /><br />
        <div class="container admin">
            <h2>Edition de mon profil </h2>
            <br /><br />
            <div align="center">
           <form method="POST" action="">
                <table>
                    <tr>
                        <td align="right">
                            <label for="name">Nom:</label>
                        </td>
                        <td >
                        <input type="text" name="newname" placeholder="Nom" value="<?php echo $user['name']; ?>" /><br /><br />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mail">Mail:</label>
                        </td>
                        <td>
                            <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>"/><br /><br />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="password">Mot de passe:</label>
                        </td>
                        <td>
                        <input type="password" name="newpwd" placeholder="Mot de passe" /><br /><br />
                        </td>
                    </tr> 
                    <tr>
                        <td align="right">
                            <label for="password2">Confirmez mot de passe:</label>
                        </td>
                        <td>
                        <input type="password" name="newpwd2" placeholder="Confirmez votre mot de passe" /><br /><br />
                        </td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Mettre à jour mon profil"/><br /><br />
                        </td>
                    </tr>
                </table>
           </form>
           <?php
            if(isset($msg))
            {
                echo '<font color="red">'.$msg.'</font>';
            }
            ?>
        </div>
    </body>
</html>
<?php
}
else{
    header("Location: connexion.php");
}
?>