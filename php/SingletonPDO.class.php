<?php
 
class SingletonPDO extends PDO
{
    private static $instance = null;    // pointeur vers l'objet SingletonPDO instancié dans getInstance()
  
    const DEFAULT_SQL_HOST = 'localhost';
    const DEFAULT_SQL_DBN  = 'watt_landing_page';
    const DEFAULT_SQL_USER = 'spignot';
    const DEFAULT_SQL_PASS = '%&e1nO&ox@G,';
    
    /**
     * Méthode privée accessible uniquement par getInstance() 
     * Constructeur d'une instance de SingeltonPDO
     * Crée une instance PDO dans la propriété $PDOInstance
     * @param void
     */
    private function __construct()
    {
        parent::__construct('mysql:host='.self::DEFAULT_SQL_HOST.';dbname='.self::DEFAULT_SQL_DBN,
                                     self::DEFAULT_SQL_USER,
                                     self::DEFAULT_SQL_PASS);
  
    }
  
    private function __clone (){}  // portée private pour empêcher le clonage 

    /**
     * Méthode statique de classe
     * Crée une instance de SingeltonPDO dans la propriété $instance, si elle n'a pas déjà été créée
     * @param void
     * @return le pointeur vers l'instance unique de SingletonPDO
     */
    public static function getInstance()
    {  
        if(is_null(self::$instance))
        {
            self::$instance = new SingletonPDO();
            self::$instance->exec("SET NAMES UTF8");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}