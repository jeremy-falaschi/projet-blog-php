<?php

class AdminController
{
    public function checkConnexion()
    {
        require_once(APP_ROOT . '/model/UtilisateurManager.php');
        if (!empty($_POST)) {
            $valide = true;
            $email = $_POST['email'];
            $utilisateurManager = new utilisateurManager();
            $utilisateur = $utilisateurManager->get($email);
            if (empty($_POST['email'])) {
                $alerterror4 = 'Veuillez entrer votre adresse mail';
                $valide = false;
            }
            if (empty($_POST['password'])) {
                $alerterror4 = 'Vous devez saisir un mot de passe';
                $valide = false;
            }
            if (!password_verify($_POST['password'], $utilisateur->getMdp())) {
                $alerterror4 = 'Mot de passe érroné';
                $valide = false;
            } else {
                $_SESSION['pseudo'] = $utilisateur->getPseudo();
                header('location: index.php');
                die;
            }
        }
    }

    public function connexion()
    {
        ob_start();
        include(APP_ROOT . '/view/connexion.php');
        $html = ob_end_flush();
        return $html;
    }

    public function deconnexion()
    {
        unset($_SESSION['pseudo']);
        header('Location: index.php');
    }

    public function admin()
    {
        ob_start();
        require_once(APP_ROOT . '/model/ArticleManager.php');
        require_once(APP_ROOT . '/model/CommentaireManager.php');
        $commentaireManager = new CommentairesManager();
        $commentairesSignal = $commentaireManager->getListSignal();
        $commentairesNoSignal = $commentaireManager->getListNoSignal();
        $articleManager = new ArticleManager();
        $articles = $articleManager->getList();
        include(APP_ROOT . '/view/administration.php');
        $html = ob_end_flush();
        return $html;
    }

    public function supChapitre()
    {
        require_once(APP_ROOT . '/model/ArticleManager.php');
        $articleManager = new ArticleManager();
        $return = $articleManager->delete($_GET['id']);
        header('location: index.php?action=admin');
        die;
    }

    public function supCommentaire()
    {
        require_once(APP_ROOT . '/model/CommentaireManager.php');
        $commentaireManager = new CommentairesManager();
        $return = $commentaireManager->delete($_GET['id']);
        header('location: index.php?action=admin');
        die;
    }

    public function pageInscription()
    {
        ob_start();
        include(APP_ROOT . '/view/inscription.php');
        $html = ob_end_flush();
        return $html;
    }

    public function inscription()
    {
        require_once(APP_ROOT . '/model/UtilisateurManager.php');
        $utilisateurManager = new UtilisateurManager();
        if (!empty($_POST)) {
            $valide = true;
            if (empty($_POST['pseudo'])) {
                $alerterror3 = 'Veuillez entrer un pseudo';
                $valide = false;
            }
            if (empty($_POST['email'])) {
                $alerterror3 = 'Veuillez entrer une adresse mail';
                $valide = false;
            }
            $email = $_POST['email'];
            if (!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)) {
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
            if ($_POST['password'] !== $_POST['password2']) {
                $alerterror3 = 'Les mots de passes doivent être identiques';
                $valide = false;
            }
            if ($valide) {
                $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $utilisateur = new Utilisateur([
                    'pseudo' => $_POST['pseudo'],
                    'email' => $_POST['email'],
                    'mdp' => $pass_hache
                ]);
                $utilisateurManager->add($utilisateur);
                header('location: index.php?action=confirminscription');
                die;
            }
        }
    }

    public function pageConfirmationInscription()
    {
        ob_start();
        include(APP_ROOT . '/view/confirmation-inscription.php');
        $html = ob_end_flush();
        return $html;
    }
}
