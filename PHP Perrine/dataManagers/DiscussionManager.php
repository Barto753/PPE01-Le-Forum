<?php
    include_once("DatabaseLinker.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/Discussion.php");
    include_once("MessageManager.php");

    class DiscussionManager
    {
        public static function findDiscussion($idDiscussion)
        {
            $discussion = null;
            
            $connex = DatabaseLinker::getConnexion();
            
            $state = $connex->prepare("SELECT * FROM Discussion WHERE idDiscussion=?");
            
            $state->bindParam(1, $idDiscussion);
            $state->execute();
            
            $resultats = $state->fetchAll();
            
            if(sizeof($resultats)>0)
            {
                $result = $resultats[0];
                
                $discussion = new Discussion();
                $discussion->setIdDiscussion($idDiscussion);
                $discussion->setTitreDiscussion($result["titreDiscussion"]);
                $discussion->setTexteDiscussion($result["texteDiscussion"]);
                $discussion->setDateDiscussion($result["dateDiscussion"]);
                $discussion->setIsClosed($result["isClosed"]);
                $discussion->setIdCategorie($result["idCategorie"]);
                $discussion->setIdUser($result["idUser"]);
            }
            return $discussion;
        }
        
        public static function findAllDiscussions()
        {
            $tabDiscussions = array();
            
            $connex = DatabaseLinker::getConnexion();
            
            $state = $connex->prepare("SELECT idDiscussion FROM Discussion ORDER BY dateDiscussion DESC");
            $state->execute();
            
            $resultats = $state->fetchAll();
            
            foreach($resultats as $result)
            {
                $discussion = DiscussionManager::findDiscussion($result["idDiscussion"]);
                $tabDiscussions[] = $discussion;
            }
            return $tabDiscussions;
        }
        
        public static function getMessages($idDiscussion)
        {
            $tabMessages = array();
            
            $connex = DatabaseLinker::getConnexion();
            
            $state = $connex->prepare("SELECT idMessage FROM Message WHERE idDiscussion=? ORDER BY dateMessage");
            
            $state->bindParam(1, $idDiscussion);
            $state->execute();
            
            $resultats = $state->fetchAll();
            
            foreach($resultats as $result)
            {
                $message = MessageManager::findMessage($result["idMessage"]);
                $tabMessages[] = $message;
            }
            
            return $tabMessages;
        }
        
        public static function insertDiscussion($discussion)
        {
            $connex = DatabaseLinker::getConnexion();
                    
            $state=$connex->prepare("INSERT INTO Discussion(titreDiscussion, texteDiscussion, dateDiscussion, isClosed, idCategorie, idUser) VALUES (?, ?, ?, ?, ?, ?)");
            
            $titreDiscussion = $discussion->getTitreDiscussion();
            $texteDiscussion = $discussion->getTexteDiscussion();
            $dateDiscussion = $discussion->getDateDiscussion();
            $isClosed = $discussion->getIsClosed();
            $idCategorie = $discussion->getIdCategorie();
            $idUser = $discussion->getIdUser();
            
            $state->bindParam(1,$titreDiscussion);
            $state->bindParam(2,$texteDiscussion);
            $state->bindParam(3,$dateDiscussion);
            $state->bindParam(4,$isClosed);
            $state->bindParam(5,$idCategorie);
            $state->bindParam(6,$idUser);
            
            $state->execute();
        }
        
        public static function deleteDiscussion($idDiscussion)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $state=$connex->prepare("DELETE FROM Discussion WHERE idDiscussion=?");
            
            $state->bindParam(1,$idDiscussion);
            
            $state->execute();
        }
        
        public static function deleteMessages($idDiscussion)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $state=$connex->prepare("DELETE FROM Message WHERE idDiscussion=?");
            
            $state->bindParam(1,$idDiscussion);
            
            $state->execute();
        }
        
    }

?>
