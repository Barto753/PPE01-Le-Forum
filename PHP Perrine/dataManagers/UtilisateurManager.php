<?php

    include_once("DatabaseLinker.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/Utilisateur.php");
    
    class UtilisateurManager
    {
        /*public static function initUser($user)
        {
            
        }*/
        
        public static function updateConnexion($user)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $statutConnexion = $user->getIsConnected();
            $pseudo = $user->getPseudo();
            
            $state=$connex->prepare("UPDATE Utilisateur SET isConnected=? WHERE pseudo=?");
            $state->bindParam(1,$statutConnexion);
            $state->bindParam(2,$pseudo);
            $state->execute();
        }
        
        
        public static function insertUser($user)
        {
            $connex = DatabaseLinker::getConnexion();
                    
            $state=$connex->prepare("INSERT INTO Utilisateur(pseudo, email, cheminAvatar, password, isAdmin, isConnected) VALUES (?, ?, ?, ?, ?, ?)");
            
            $pseudo = $user->getPseudo();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $chemin = $user->getCheminAvatar();
            $isAdmin = $user->getIsAdmin();
            $isConnected = $user->getIsConnected();
            
            $state->bindParam(1,$pseudo);
            $state->bindParam(2,$email);
            $state->bindParam(3,$chemin);
            $state->bindParam(4,$password);
            $state->bindParam(5,$isAdmin);
            $state->bindParam(6,$isConnected);
            
            $state->execute();           
        }
        
        public static function findUser($pseudo)
        {
            $connex = DatabaseLinker::getConnexion();
            $user=null;
            $state=$connex->prepare("SELECT * FROM Utilisateur WHERE pseudo=?");
            $state->bindParam(1,$pseudo);
            $state->execute();
                        
            $resultatsUsers=$state->fetchAll();
                    
            if(!empty($resultatsUsers))
            {
                $resultUser=$resultatsUsers[0];
                $user = new Utilisateur(); 
                $user->setIdUser($resultUser["idUser"]);
                $user->setPseudo($resultUser["pseudo"]);
                $user->setEmail($resultUser["email"]);
                $user->setCheminAvatar($resultUser["cheminAvatar"]);
                $user->setPassword($resultUser["password"]);
                $user->setIsAdmin($resultUser["isAdmin"]);
                $user->setIsConnected($resultUser["isConnected"]);
            }
            
            return $user;
        }
        
        public static function findUserWithId($idUser)
        {
            $connex = DatabaseLinker::getConnexion();
            $user=null;
            $state=$connex->prepare("SELECT * FROM Utilisateur WHERE idUser=?");
            $state->bindParam(1,$idUser);
            $state->execute();
                        
            $resultatsUsers=$state->fetchAll();
                    
            if(!empty($resultatsUsers))
            {
                $resultUser=$resultatsUsers[0];
                $user = new Utilisateur(); 
                $user->setIdUser($resultUser["idUser"]);
                $user->setPseudo($resultUser["pseudo"]);
                $user->setEmail($resultUser["email"]);
                $user->setCheminAvatar($resultUser["cheminAvatar"]);
                $user->setPassword($resultUser["password"]);
                $user->setIsAdmin($resultUser["isAdmin"]);
                $user->setIsConnected($resultUser["isConnected"]);
            }
            
            return $user;
        }
    }

?>