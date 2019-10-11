<?php
session_start();
define('APP_ROOT', __DIR__);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(APP_ROOT . '/DataBaseConnection.php');
require_once(APP_ROOT . '/controller/ArticleController.php');
require_once(APP_ROOT . '/controller/AdminController.php');
require_once(APP_ROOT . '/controller/HomeController.php');
require_once(APP_ROOT . '/model/ArticleManager.php');
require_once(APP_ROOT . '/model/Article.php');
require_once(APP_ROOT . '/model/CommentaireManager.php');
require_once(APP_ROOT . '/model/Commentaire.php');
require_once(APP_ROOT . '/model/UtilisateurManager.php');
require_once(APP_ROOT . '/model/Utilisateur.php');
$homeController = new HomeController();
$articleController = new ArticleController();
$adminController = new AdminController();

if (empty($_SERVER['QUERY_STRING'])) {
    $homeController->index();
} elseif (isset($_GET['article'])) {
    $articleController->detail($_GET['article']);
} elseif (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'connexion':
            $adminController->connexion();
            break;
        case 'admin':
            $adminController->admin();
            break; 
        case 'supchap':
            $adminController->supChapitre();
            break;
        case 'supcomment':
            $adminController->supCommentaire();
            break;
        case 'modifchap':
            $articleController->modifArticle();
            break;
        case 'affichemodifchap':
            $articleController->afficheModifArticle();
            break;  
        case 'signalement':
            $articleController->signalementCommentaire();
            break;
        case 'deconnexion':
            $adminController->deconnexion();
            break;
        case 'affichenewarticle':
            $articleController->pageNewArticle();
            break;   
        case 'ajouterarticle':
            $articleController->newArticle();
            break;
        case 'inscription':
            $adminController->inscription();
            break;
        case 'confirminscription':
            $adminController->pageConfirmationInscription();
            break; 
        default:
            header('Location: error.php');                  
    }
} else {
    throw new Exception('Erreur 404');
}
