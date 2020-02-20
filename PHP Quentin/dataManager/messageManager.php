<?php
    include_once("dataManager/dataBaseLinker.php");
    include_once("data/message.php");

    class messageManager
    {
        public static function insertMessage($message) discussion
        {
            $connexionPdo = dataBaseLinker::getConnexion();

            $state=$connexionPdo->prepare("INSERT INTO Message(texteMessage, datePublicationMessage , idUser, idDiscussion) VALUES(?,?,?,?)");

            $texteMessage = $message->getTexteMessage();
            $datePublicationMessage  = $message->getDatePublicationMessage ();
            $idUser = $message->getIdUser();
            $idDiscussion = $message->getIdDiscussion();

            $state->bindParam(1 ,$texteMessage);
            $state->bindParam(2 ,$datePublicationMessage);
            $state->bindParam(3 ,$idUser);
            $state->bindParam(4 ,$idDiscussion);
            $state->execute();
        }

        public static function findMessage($idMessage)
        {
            $message = null;
            $msjTab = new message();
            $msjTab = array();

            $connexionPdo = dataBaseLinker::getConnexion();

            $state = $connexionPdo->prepare("SELECT * FROM message WHERE idMessage = ? ");
            $state->bindParam(1, $idMessage );
            $state->execute();

            $resultat = $state->fetchAll();

            foreach($resultat as $lineResultat)
            {

            }

        }
    }
?>