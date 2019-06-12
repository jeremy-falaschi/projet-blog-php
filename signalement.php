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

    $req = $bdd->prepare('UPDATE commentaires SET signalement = :nvsignalement WHERE id = "' . $_GET['id']. '"');
    $req->execute(array(
        'nvsignalement' => 1
    ));
    header('location: article.php?id=' . $_GET['idbillet']. '');

?>