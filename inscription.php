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
    if(empty($_POST['pseudo'])){
        $alerterror3 = 'Veuillez entrer un pseudo';
        $valide = false;
    }

    if(empty($_POST['email'])){
        $alerterror3 = 'Veuillez entrer une adresse mail';
        $valide = false;
    }
    $email = $_POST['email'];
    if (!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $email)){
        $alerterror3 = 'L\'adresse mail est invalide';
        $valide = false;
    }

    if (empty($_POST['password'])) {
        $alerterror3 = 'Vous devez saisir un mot de passe';
        $valide = false;
    }

    if (empty($_POST['password2'])) {
        $alerterror3 = 'Vous devez confirmer le mot de passe';
        $valide = false;
    }

    if ($_POST['password'] !== $_POST['password2']){
        $alerterror3 = 'Les mots de passes doivent être identiques';
        $valide = false;
    }

    if ($valide) {
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $req = $bdd->prepare('INSERT INTO utilisateur (pseudo, email, mdp) VALUES( ?, ?, ?)');
        $req->execute(array(
            $_POST['pseudo'], 
            $_POST['email'], 
            $pass_hache
        ));
        header('Location: confirmation-inscription.php');
    }
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
    <title>Inscription</title>
</head>
<body>
    <?php include("menu.php"); ?>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="bloc_inscription">
                    <h1>Inscription</h1>
                    <?php if(isset($alerterror3)){ echo '<p class="block_alert">' . $alerterror3 . '</p>';} ?>
                    <form action="inscription.php" method="POST">
                        <input type="text" name="pseudo" placeholder="Pseudo" required><br/>
                        <input type="email" name="email" placeholder="Email" required><br/>
                        <input type="password" name="password" placeholder="Mot de passe" required><br/>
                        <input type="password" name="password2" placeholder="Confirmer mot de passe" required><br/>
                        <input type="submit" name="submit" value="envoyer">
                    </form>

                </div>
            </div>
        </div>

    </section>
    <?php include("footer.php"); ?>    
</body>
</html>