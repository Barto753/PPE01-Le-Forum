<?php

    include_once("DatabaseLinker.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/Utilisateur.php");

    
    class UtilisateurManager
    {
        
        
        public static function updatePassword($user)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $password = $user->getPassword();
            $idUser = $user->getIdUser();
            
            $state=$connex->prepare("UPDATE Utilisateur SET password=? WHERE idUser=?");
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
        
        public static function updateAvatar($user)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $newAvatar = $user->getCheminAvatar();
            $idUser = $user->getIdUser();
            
            $state=$connex->prepare("UPDATE Utilisateur SET cheminAvatar=? WHERE idUser=?");
            $state->bindParam(1,$newAvatar);
            $state->bindParam(2,$idUser);
            
            $state->execute();
        }
        
        public static function verifBanIsOver($user)
        {
            date_default_timezone_set('Europe/Paris');
            //verifier si la dateFinBan est > currentDate
            $currentDate = date("Y-m-d H:i:s");
            $dateFinBan = $user->getDateFinBan();
            
            //$currentDate = newDateTime($currentDate);
            //$currentDate = idate($currentDate);
            //echo $currentDate;
            //$dateFinBan = newDateTime($dateFinBan);
            //$dateFinBan = $dateFinBan->format('YmdHis');
            
            //20200319 132955
            //20200319 164501
            $banIsOver = 0;
            if($dateFinBan <= $currentDate)
            {
                $banIsOver = 1;
            }
            
            return $banIsOver;
        }
        
        public static function insertUser($user)
        {
            $connex = DatabaseLinker::getConnexion();
                    
            $state=$connex->prepare("INSERT INTO Utilisateur(pseudo, email, cheminAvatar, password, isAdmin, isConnected, isBanned, motifBan, dateFinBan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $pseudo = $user->getPseudo();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $chemin = $user->getCheminAvatar();
            $isAdmin = $user->getIsAdmin();
            $isConnected = $user->getIsConnected();
            $isBanned = $user->getIsBanned();
            $motifBan = $user->getMotifBan();
            $dateFinBan = $user->getDateFinBan();
            
            $state->bindParam(1,$pseudo);
            $state->bindParam(2,$email);
            $state->bindParam(3,$chemin);
            $state->bindParam(4,$password);
            $state->bindParam(5,$isAdmin);
            $state->bindParam(6,$isConnected);
            $state->bindParam(7,$isBanned);
            $state->bindParam(8,$motifBan);
            $state->bindParam(9,$dateFinBan);
            
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
                $user->setIsBanned($resultUser["isBanned"]);
                $user->setMotifBan($resultUser["motifBan"]);
                $user->setDateFinBan($resultUser["dateFinBan"]);
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
                $user->setIsBanned($resultUser["isBanned"]);
                $user->setMotifBan($resultUser["motifBan"]);
                $user->setDateFinBan($resultUser["dateFinBan"]);
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
        
        public static function updateBannissement($user)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $idUser = $user->getIdUser();
            $isBanned = $user->getIsBanned();
            $motifBan = $user->getMotifBan();
            $dateFinBan = $user->getDateFinBan();
            
            $state=$connex->prepare("UPDATE Utilisateur SET isBanned=?, motifBan=?, dateFinBan=?  WHERE idUser=?");
            
            $state->bindParam(1, $isBanned);
            $state->bindParam(2, $motifBan);
            $state->bindParam(3, $dateFinBan);
            $state->bindParam(4, $idUser);
            
            $state->execute();
        }
        
        
    }

?>