<?php
    include_once("C:/UwAmp/www/TestPPE01/dataManagers/UtilisateurManager.php");
    include_once("C:/UwAmp/www/TestPPE01/dataManagers/DatabaseLinker.php");
    include_once("C:/UwAmp/www/TestPPE01/data/Utilisateur.php");

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
        
        
        //ne modifie pas la bdd
        public static function updateConnexionOnline($user)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $online=1;
            $pseudo = $user->getPseudo();
            
            $state=$connex->prepare("UPDATE Utilisateur SET isConnected=? WHERE pseudo=?");
            $state->bindParam(1,$online);
            $state->bindParam(2,$pseudo);
            $state->execute();
            
            
        }
        
        
        
        
        
        
        
        
        /*$connexion = false;
        $state=$connex->prepare("SELECT * FROM Utilisateur WHERE pseudo=?");
        $state->bindParam(1,$pseudo);
        $state->execute();

        $resultatsConnexion=$state->fetchAll();

        if(!empty($resultatsConnexion))
        {
            echo "Utilisateur présent dans la bdd.";
            $connexion = true;
        }

        return $connexion;*/
        
    }

?>
