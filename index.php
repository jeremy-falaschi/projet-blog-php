<?php
session_start();
define('APP_ROOT', __DIR__);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (empty($_SERVER['QUERY_STRING'])) {
    require_once(APP_ROOT . '/controller/HomeController.php');
    $controller = new HomeController();
    $controller->index();
} elseif (isset($_GET['article'])) {
    require_once(APP_ROOT . '/controller/ArticleController.php');
    $controller = new ArticleController();
    $controller->detail($_GET['article']);
} elseif (isset($_GET['action'])) {
    if ($_GET['action'] == 'connexion') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->connexion();
    } elseif ($_GET['action'] == 'checkconnexion') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->checkConnexion();
    } elseif ($_GET['action'] == 'admin') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->admin();
    } elseif ($_GET['action'] == 'supchap') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->supChapitre();
    } elseif ($_GET['action'] == 'supcomment') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->supCommentaire();
    } elseif ($_GET['action'] == 'modifchap') {
        require_once(APP_ROOT . '/controller/ArticleController.php');
        $controller = new ArticleController();
        $controller->modifArticle();
    } elseif ($_GET['action'] == 'affichemodifchap') {
        require_once(APP_ROOT . '/controller/ArticleController.php');
        $controller = new ArticleController();
        $controller->afficheModifArticle();
    } elseif ($_GET['action'] == 'signalement') {
        require_once(APP_ROOT . '/controller/ArticleController.php');
        $controller = new ArticleController();
        $controller->signalementCommentaire();
    } elseif ($_GET['action'] == 'deconnexion') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->deconnexion();
    } elseif ($_GET['action'] == 'affichenewarticle') {
        require_once(APP_ROOT . '/controller/ArticleController.php');
        $controller = new ArticleController();
        $controller->pageNewArticle();
    } elseif ($_GET['action'] == 'ajouterarticle') {
        require_once(APP_ROOT . '/controller/ArticleController.php');
        $controller = new ArticleController();
        $controller->newArticle();
    } elseif ($_GET['action'] == 'inscription') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->pageInscription();
    } elseif ($_GET['action'] == 'checkinscription') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->inscription();
    } elseif ($_GET['action'] == 'confirminscription') {
        require_once(APP_ROOT . '/controller/AdminController.php');
        $controller = new AdminController();
        $controller->pageConfirmationInscription();
    }
} else {
    throw new Exception('Erreur 404');
}
