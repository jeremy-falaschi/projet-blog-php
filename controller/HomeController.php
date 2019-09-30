<?php

class HomeController
{
    public function index()
    {
        ob_start();
        require_once(APP_ROOT . '/model/ArticleManager.php');
        $articleManager = new ArticleManager();
        $articles = $articleManager->getList();
        include(APP_ROOT . '/view/home.php');
        $html = ob_end_flush();
        return $html;
    }
}
