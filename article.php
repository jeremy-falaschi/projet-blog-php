<?php
 try
 {
     $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'phpmyadminsecure166');
     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
     
 } 
 catch(Exception $e)
 {
         die('Erreur : '.$e->getMessage());
 }


 if (!empty($_POST)){
    $valide = true;
    if(empty($_POST['Pseudo'])){
        $alerterror2 = 'Veuillez entrer un pseudo';
        $valide = false;
    }

    if (empty($_POST['contenucomment'])) {
        $alerterror2 = 'Merci de saisir votre message';
        $valide = false;
    }

    if ($valide) {
        $req = $bdd->prepare('INSERT INTO commentaires (idbillet, pseudo, commentaire, date_message) VALUES( ?, ?, ?, NOW())');
        $req->execute(array($_GET['id'], 
            $_POST['pseudo'], 
            $_POST['contenucomment']
        ));
    }
 }


 $reponse = $bdd->query('SELECT contenu, titre, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article FROM article WHERE id = "' . $_GET['id']. '"');
 $donnees = $reponse->fetch();

 $reponse2 = $bdd->query('SELECT pseudo, commentaire, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%imin%ss\') AS date_message FROM commentaires WHERE idbillet = "' . $_GET['id']. '"');

 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>article</title>
</head>
<body>
    <?php include('menu.php'); ?>

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="article">
                    <h1><?= $donnees['titre']; ?></h1>
                    <p>Publié le : <?= $donnees['date_article']; ?> </p>

                    <div class="contenu_article"><?= $donnees['contenu']; ?></div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 commentaires">
                    <h2>Commentaires :</h2>
                    
                    <?php while($donnees2 = $reponse2->fetch()){ ?>
                        <div class="commentaire">
                            <p class="pseudo"><?= $donnees2['pseudo']; ?> :</p>
                            <p class="date_message">Le <?= $donnees2['date_message']; ?> ,</p>
                            <p class="message"><?= $donnees2['commentaire']; ?></p>    
                        </div>
                    <?php } ?> 
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 créer_commentaire">
                    <h2>Laisser un commentaire : </h2>
                    <?php if(isset($alerterror2)){ echo '<p class="block_alert">' . $alerterror2 . '</p>';} ?>
                    <form action="article.php?id=<?= $_GET['id']; ?>" method="POST">
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