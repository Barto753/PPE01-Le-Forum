<?php
    include_once("UtilisateurManager.php");
    include_once("DatabaseLinker.php");
    include_once("data/Utilisateur.php");

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
