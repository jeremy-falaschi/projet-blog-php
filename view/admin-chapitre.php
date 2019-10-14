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
                        <?php foreach ($articles as $article): ?>
                            <tr>
                            <th scope="row"><?= $article->getId(); ?></th>
                            <td><?= $article->getTitre(); ?></td>
                            <td><?= $article->getDateArticle(); ?></td>
                            <td><a href="index.php?action=affichemodifchap&id=<?= $article->getId(); ?>"><i class="fas fa-pen"></i></a><a href="index.php?action=supchap&id=<?= $article->getId(); ?>"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a class="back-admin" href="index.php?action=admin">retour</a>
                </div>
            </div>
        </div>
    </section>                
    <?php include("footer.php"); ?>
</body>
</html>