<!DOCTYPE html>
<html>
    <head>
        <title>UberEat</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet" type='text/css'> 
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@800&display=swap" rel="stylesheet" type='text/css'>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    
    <body>
        <?php 
        session_start();
        require 'navmain.php';?>
        <div class="container site">
            <h1 class="text-logo">UberEat</h1>
            <?php
                
                require 'admin/database.php';
                echo '<nav>
                        <ul class="nav nav-pills">';

                $db = Database::connect();
                $statement = $db->query('SELECT * FROM categories');
                $categories = $statement->fetchAll();
                foreach ($categories as $category) 
                {
                    if($category['id'] == '1')
                        echo '<li role="presentation" class="active"><a href="#'. $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a></li>';
                    else
                        echo '<li role="presentation"><a href="#'. $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a></li>';
                }

                echo    '</ul>
                      </nav>';

                echo '<div class="tab-content">';

                foreach ($categories as $category) 
                {
                    if($category['id'] == '1')
                        echo '<div class="tab-pane active" id="' . $category['id'] .'">';
                    else
                        echo '<div class="tab-pane" id="' . $category['id'] .'">';
                    
                    echo '<div class="row">';
                    
                    $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                    $statement->execute(array($category['id']));
                    while ($item = $statement->fetch()) 
                    {
                        echo '
                        <form class="form" action="insertcard.php?id='.$_SESSION['id'].'" role="form" method="post">
                        <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="images/' . $item['image'] . '" alt="...">
                                    <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                                    <div class="caption">
                                        <h4>' . $item['name'] . '</h4>
                                        <p>' . $item['description'] . '</p>
                                        <button type="submit"  name="itemVal" value="'.$item['id'].'"  class="btn btn-order"><span class="glyphicon glyphicon-shopping-cart"></span> Commander </button>
                                    </div>
                                </div>
                            </div>
                            </form>';
                            
                    }

                   echo    '</div>
                        </div>';
                }
                Database::disconnect();
                echo  '</div>';
            ?>
<?php

    $customerId = $_SESSION['id'];
    $itemId     = $_POST['itemVal'];
    if (isset($customerId, $itemId)){
        $db         = Database::connect();
        $statement  = $db->prepare('INSERT INTO cart (cus_id, item_id) VALUES (?, ?)');
        $statement->execute(array((int) $customerId, (int) $itemId));
        $id = $db->lastInsertId();
        echo $id;
        Database::disconnect();
    }
    else{
        echo "les variables sont vides";
    }
?>
        </div>
    </body>
</html>

