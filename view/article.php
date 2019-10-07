
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b08bd9950b.js"></script>
    <title>article</title>
</head>
<body>
    <?php include('menu.php'); ?>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="article">
                    <h1><?= $article->getTitre(); ?></h1>
                    <p>Publié le : <?= $article->getDateArticle(); ?> </p>
                    <div class="contenu_article"><?= $article->getContenu(); ?></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 commentaires">
                    <h2>Commentaires :</h2>
                    <?php if(empty($commentaires)): ?>
                        <p clas="nocomment">Pas de commentaire</p>
                    <?php endif; ?> 
                    <?php foreach ($commentaires as $commentaire): ?>
                        <div class="commentaire">
                            <p class="pseudo"><?= $commentaire->getPseudo(); ?> :</p>
                            <p class="date_message">Le <?= $commentaire->getDateMessage(); ?> ,</p>
                            <p class="message"><?= $commentaire->getCommentaire(); ?></p>
                            <a class="signal" href="index.php?action=signalement&id=<?= $commentaire->getId(); ?>&idbillet=<?= $commentaire->getIdBillet(); ?>"><i class="fas fa-exclamation-triangle"></i>Signaler ce message</a>
                        </div>
                    <?php endforeach; ?>
            
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 créer_commentaire">
                    <h2>Laisser un commentaire : </h2>
                    <?php if (isset($alerterror2)): ?>
                    <p class="block_alert"> <?= $alerterror2; ?></p>
                    <?php endif; ?>
                    <form action="index.php?article=<?= $_GET['article']; ?>" method="POST">
                        <input type="text" class="pseudo_comment" name="pseudo" placeholder="Pseudo"><br/>
                        <textarea class="contenu_commentaire" name="contenucomment" placeholder="Votre message"></textarea><br/>
                        <input type="submit" class="comment_submit" name="submit" value="Envoyer">
                    </form>    
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>    
</body>
</html>