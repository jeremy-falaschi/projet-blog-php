<?php
    session_start();


    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'phpmyadminsecure166');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } 
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    $reponse = $bdd->query('SELECT id, idbillet, pseudo, commentaire, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%imin%ss\') AS date_message FROM commentaires WHERE signalement = 0 ORDER BY idbillet DESC');

    $reponse2 = $bdd->query('SELECT id, titre, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article_fr FROM article ORDER BY id DESC');
    
    $reponse3 = $bdd->query('SELECT id, idbillet, pseudo, commentaire, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%imin%ss\') AS date_message FROM commentaires WHERE signalement = 1 ORDER BY idbillet DESC');


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
    <script src="https://kit.fontawesome.com/b08bd9950b.js"></script>
    <title>le blog de Jean Forteroche - administration</title>
</head>
<body>
    <?php include("menu.php"); ?>
        <section class="main admin">
            <div class="container">
                <div class="row">
                    <h1>Administration du blog</h1>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>Commentaires signalé</h2>
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                <th scope="col">Chapitre</th>
                                <th scope="col">Pseudo</th>
                                <th scope="col">Commentaire</th>
                                <th scope="col">Publié le:</th>
                                <th scope="col">Gestion</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($donnees3 = $reponse3->fetch()){ ?>
                                <tr>
                                <th scope="row"><?= $donnees3['idbillet']; ?></th>
                                <td><?= $donnees3['pseudo']; ?></td>
                                <td><?= $donnees3['commentaire']; ?></td>
                                <td><?= $donnees3['date_message']; ?></td>
                                <td><a href="suppression_commentaire.php?id=<?= $donnees3['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php } ?>   
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>Commentaires</h2>
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                <th scope="col">Chapitre</th>
                                <th scope="col">Pseudo</th>
                                <th scope="col">Commentaire</th>
                                <th scope="col">Publié le:</th>
                                <th scope="col">Gestion</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($donnees = $reponse->fetch()){ ?>
                                <tr>
                                <th scope="row"><?= $donnees['idbillet']; ?></th>
                                <td><?= $donnees['pseudo']; ?></td>
                                <td><?= $donnees['commentaire']; ?></td>
                                <td><?= $donnees['date_message']; ?></td>
                                <td><a href="suppression_commentaire.php?id=<?= $donnees['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php } ?>   
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>Chapitres</h2>
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                <th scope="col">Chapitre</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Publié le:</th>
                                <th scope="col">Gestion</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($donnees2 = $reponse2->fetch()){ ?>
                                <tr>
                                <th scope="row"><?= $donnees2['id']; ?></th>
                                <td><?= $donnees2['titre']; ?></td>
                                <td><?= $donnees2['date_article_fr']; ?></td>
                                <td><a href="modifier_chapitre.php?id=<?= $donnees2['id']; ?>"><i class="fas fa-pen"></i></a><a href="suppression_chapitre.php?id=<?= $donnees2['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php } ?>   
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </section>
    <?php include("footer.php"); ?>
</body>
</html>