<?php
    include_once("DatabaseLinker.php");
    include_once("dataManagers/data/Message.php");


    class MessageManager
    {
        public static function findMessage($idMessage)
        {
            $message = null;

            $connex = DatabaseLinker::getConnexion();

            $state = $connex->prepare("SELECT * FROM Message WHERE idMessage=?");

            $state->bindParam(1, $idMessage);
            $state->execute();

            $resultats = $state->fetchAll();

            if(sizeof($resultats)>0)
            {
                $result = $resultats[0];

                $message = new Message();
                $message->setIdMessage($idMessage);
                $message->setTexteMessage($result["texteMessage"]);
                $message->setDateMessage($result["dateMessage"]);
                $message->setIdUser($result["idUser"]);
                $message->setIdDiscussion($result["idDiscussion"]);

            }
            return $message;
        }

        public static function insertMessage($message)
        {
            $connex = DatabaseLinker::getConnexion();

            $state = $connex->prepare("INSERT INTO Message (texteMessage, dateMessage, idUser, idDiscussion) VALUES (?, ?, ?, ?)");

            $texteMessage = $message->getTexteMessage();
            $dateMessage = $message->getDateMessage();
            $idUser = $message->getIdUser();
            $idDiscussion = $message->getIdDiscussion();

            $state->bindParam(1, $texteMessage);
            $state->bindParam(2, $dateMessage);
            $state->bindParam(3, $idUser);
            $state->bindParam(4, $idDiscussion);
            $state->execute();
        }
        
        public static function deleteMessage($idMessage)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $state=$connex->prepare("DELETE FROM Message WHERE idMessage=?");
            
            $state->bindParam(1,$idMessage);
            
            $state->execute();
        }
        
        public static function modifMessage($message)
        {
            $connex = DatabaseLinker::getConnexion();
            
            $idMessage = $message->getIdMessage();
            $texteMessage = $message->getTexteMessage();
            
            $state=$connex->prepare("UPDATE Message SET texteMessage=? WHERE idMessage=?");
            
            $state->bindParam(1,$texteMessage);
            $state->bindParam(2,$idMessage);
            
            $state->execute();
        }
        
    }

?>