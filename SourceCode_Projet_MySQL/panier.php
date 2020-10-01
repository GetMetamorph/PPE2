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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<?php
require 'navmain.php';
?>
    <br /><br />
    <div class="container admin">
        <h2>Panier</h2>
        <br /><br />
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Retirer article</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  session_start();
                  require 'admin/database.php';
                  $db = Database::connect();
                  $statement = $db->query('SELECT items.id, items.name, items.price, categories.name AS category FROM cart INNER JOIN items ON cart.item_id = items.id INNER JOIN customers ON cart.cus_id = customers.id LEFT JOIN categories ON items.category = categories.id WHERE customers.id='.$_SESSION['id'].' ORDER BY items.id DESC');
                  while($item = $statement->fetch()) 
                  {
                      echo '<tr>';
                      echo '<td>'. $item['name'] . '</td>';
                      echo '<td>'. number_format($item['price'], 2, '.', '') . '</td>';
                      echo '<td>'. $item['category'] . '</td>';
                      echo '<td width=300>';
                      echo '<a class="btn btn-danger" href="delete.php?id='.$item['id'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                      echo '</td>';
                      echo '</tr>';
                  }
                  Database::disconnect();
                ?>
            </tbody>
        </table>
</body>

</html>