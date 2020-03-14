<?php
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/dataManagers/UtilisateurManager.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/dataManagers/DatabaseLinker.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/Utilisateur.php");

    class ConnexionManager
    {
        
        public static function testConnexionUser($pseudo)
        {
            $connexion = false;
            $user = UtilisateurManager::findUser($_POST["pseudo"]);
            if($user!=null && $_POST["password"]==$user->getPassword())
            {
                $connexion = true;
            }
            
            return $connexion;
        }
          
    }

?>
