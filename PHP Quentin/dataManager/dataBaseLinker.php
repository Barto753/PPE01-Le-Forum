<?php

    class DatabaseLinker
    {
        private static $urlBdd="mysql:host=localhost; dbname=bdd_forum; charset=utf8";
        private static $username="root";
        private static $password="root";
        private static $connexionPdo;
            
        public static function getConnexion() #methode qui initialise l'attribue stockant la connexion
        {
            if(DatabaseLinker::$connexionPdo==null)
            {
                DatabaseLinker::$connexionPdo=new PDO(DatabaseLinker::$urlBdd,DatabaseLinker::$username,DatabaseLinker::$password);
            }
            return DatabaseLinker::$connexionPdo;
        }
    }

?>
