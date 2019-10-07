<?php

class ArticleController
{
    public function detail($id)
    {
        ob_start();
        $articleManager = new ArticleManager();
        $article = $articleManager->get($id);
        $commentaireManager = new CommentairesManager();
        $commentaires = $commentaireManager->getList($id);
        if (!empty($_POST)) {
            $valide = true;
            if (empty($_POST['pseudo'])) {
                $alerterror2 = 'Veuillez entrer un pseudo';
                $valide = false;
            }
            if (empty($_POST['contenucomment'])) {
                $alerterror2 = 'Merci de saisir votre message';
                $valide = false;
            }
            if ($valide) {
                $commentaire = new Commentaires([
                    "idbillet" => $id,
                    "pseudo" => $_POST['pseudo'],
                    "commentaire" => $_POST['contenucomment']
                ]);
                $commentaireManager->add($commentaire);
            }
        }
        include(APP_ROOT . '/view/article.php');
        $html = ob_end_flush();
        return $html;
    }

    public function pageNewArticle()
    {
        ob_start();
        include(APP_ROOT . '/view/ajouter_article.php');
        $html = ob_end_flush();
        return $html;
    }

    public function newArticle()
    {
        ob_start();
        require_once(APP_ROOT . '/model/ArticleManager.php');
        $articleManager = new ArticleManager;
        if (!empty($_POST)) {
            $valide = true;
            if (empty(trim($_POST['titre']))) {
                $alerterror = 'le titre est obligatoire';
                $valide = false;
            }
            if (empty(trim($_POST['contenu']))) {
                $alerterror = 'le contenu est vide';
                $valide = false;
            }
            if ($valide) {
                $article = new Article([
                    "titre" => $_POST["titre"],
                    "contenu" => $_POST["contenu"]
                ]);
                $articleManager->add($article);
                header('location: index.php');
            }
        }
        $html = ob_end_flush();
        return $html;
    }

    public function modifArticle()
    {
        ob_start();
        $articleManager = new ArticleManager();
        $article = $articleManager->get($_REQUEST['id']);
        if (!empty($_POST)) {
            $valide = true;
            if (empty($_POST['titre'])) {
                $alerterror = 'le titre est obligatoire';
                $valide = false;
            }
            if (empty($_POST['contenu'])) {
                $alerterror = 'le contenu est vide';
                $valide = false;
            }
            if ($valide) {
                $articleManager->update($_REQUEST['id'], $_POST['contenu'], $_POST['titre']);
                header('location: index.php?action=admin');
            }
        }
        $html = ob_end_flush();
        return $html;
    }

    public function afficheModifArticle()
    {
        ob_start();
        $articleManager = new ArticleManager();
        $article = $articleManager->get($_REQUEST['id']);
        include(APP_ROOT . '/view/modifier_chapitre.php');
        $html = ob_end_flush();
        return $html;
    }

    public function signalementCommentaire()
    {
        ob_start();
        $commentaireManager = new CommentairesManager();
        $return = $commentaireManager->signal($_GET['id']);
        header('location: index.php?article=' . $_GET['idbillet']. '');
        $html = ob_end_flush();
        return $html;
    }
}
