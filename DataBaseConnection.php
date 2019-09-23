<?php



class DataBaseConnection
{

    private static $_instance = null ;

   public function __construct(){
    
    
   } 

   public static function getInstance(){

    if(is_null(self::$_instance)) {
        try
        {
            $credential = require_once('config.php');
            $dsn = $credential['dsn'].';dbname='.$credential['dbname'].';charset='.$credential['charset'];
                // die(var_dump($dsn));
                $user = $credential['user'];
                $password = $credential['password'];
            self::$_instance = new PDO($dsn, $user, $password);
            // self::$_instance = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'phpmyadminsecure166');
            self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        } 
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
      }
  
      return self::$_instance;
    
    
   }
}

