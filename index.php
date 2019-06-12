<?php
session_start();


 try
 {
     $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'phpmyadminsecure166');
     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $reponse = $bdd->query('SELECT id, contenu, titre, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article_fr FROM article ORDER BY id DESC');
 } 
 catch(Exception $e)
 {
         die('Erreur : '.$e->getMessage());
 }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>le blog de Jean Forteroche</title>
</head>
<body>
<?php include("menu.php"); ?>

<section class="main">
    <div class="Container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-home">
                <h1>Un billet simple pour l'alaska</h1>
                <p>Retrouvez tous les chapitres ci-dessous</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php while($donnees = $reponse->fetch()){ ?>
            <div class="bloc_article">
                <h2><?= $donnees['titre']; ?></h2>
                <div class="contenu"><?= $donnees['contenu']; ?></div>
                <div class="date_lien"><p class="date_article">Publié le : <?= $donnees['date_article_fr']; ?> </p><a href="article.php?id=<?= $donnees['id']; ?>">Voir plus</a></div>

            </div>
            <?php } ?>
            </div>    
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
</body>
</html>