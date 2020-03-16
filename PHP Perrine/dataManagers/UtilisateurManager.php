<?php

    include_once("DatabaseLinker.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/Utilisateur.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/Bannissement.php");
    
    class UtilisateurManager
    {
        public static function updatePassword($user)
        {
            $connex = DatabaseLinker::getConnexion();
            
            //$cheminAvatar = $user->getCheminAvatar();
            $password = $user->getPassword();
            $idUser = $user->getIdUser();
            
            $state=$connex->prepare("UPDATE Utilisateur SET password=? WHERE idUser=?");
            //$state->bindParam(1,$cheminAvatar);
            $state->bindParam(1, $password);
            $state->bindParam(2, $idUser);
            
            $state->execute();
        }
        
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
        
        public static function findAllUsers()
        {
            $tabUsers = array();
            
            $connex = DatabaseLinker::getConnexion();
            
            $state = $connex->prepare("SELECT idUser FROM Utilisateur");
            $state->execute();
            
            $resultats = $state->fetchAll();
            
            foreach($resultats as $result)
            {
                $user = UtilisateurManager::findUserWithId($result["idUser"]);
                $tabUsers[] = $user;
            }
            return $tabUsers;
        }
        
        public static function updateBannissement()
        {
            
        }
        
        public static function findBannissement($idUser)
        {
            $connex = DatabaseLinker::getConnexion();
            $banni=null;
            $state=$connex->prepare("SELECT * FROM Bannissement WHERE idUser=?");
            $state->bindParam(1,$idUser);
            
            $state->execute();
                        
            $resultatsBannis=$state->fetchAll();
                    
            if(sizeof($resultatsBannis)>0)
            {
                $resultBanni=$resultatsBannis[0];
                $banni = new Bannissement(); 
                $banni->setIdBannissement($resultBanni["idBannissement"]);
                $banni->setMotif($resultBanni["motif"]);
                $banni->setDateFin($resultBanni["dateFin"]);
                $banni->setIdUser($resultBanni["idUser"]);
            }
            
            return $banni;
        }
        
        public static function insertBannissement($banni) //Mettre dans BannissementManager.php ???
        {
            $connex = DatabaseLinker::getConnexion();
                    
            $state=$connex->prepare("INSERT INTO Bannissement(dateFin, motif, idUser) VALUES (?, ?, ?)");
            
            $dateFin = $banni->getDateFin();
            $motif = $banni->getMotif();
            $idUser = $banni->getIdUser();
            
            $state->bindParam(1,$dateFin);
            $state->bindParam(2,$motif);
            $state->bindParam(3,$idUser);
            
            $state->execute();           
        }
        
    }

?>