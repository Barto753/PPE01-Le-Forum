<?php
    include_once("dataManager/dataBaseLinker.php");
    include_once("data/discussion.php");

    class DiscussionManager
    {
        public static function insertDiscussion($discussion)
        {
            $connexionPdo = dataBaseLinker::getConnexion();

            $state=$connexionPdo->prepare("INSERT INTO Discussion(titreDiscussion, texteDiscussion , datePublicationDiscussion, idClosed, idCategorie) VALUES( ? ,? ,?, ?, ? )");

            $titreDiscussion = $discussion->getTitreDiscussion();
            $texteDiscussion  = $discussion->getTexteDiscussion ();
            $dateParution = $discussion->getDatePublicationDiscussion();
            $idClosed = $discussion->getIdClosed();
            $idCategorie = $discussion->getIdCategorie();

            $state->bindParam(1 ,$titreDiscussion);
            $state->bindParam(2 ,$texteDiscussion);
            $state->bindParam(3 ,$datePublicationDiscussion);
            $state->bindParam(4 ,$idClosed);
            $state->bindParam(5 ,$idCategorie);
            $state->execute();
        }

        public static function findDiscution($idDiscussion)
        {
            $disussion = null;
            $discuTab = new Discussion();
            $discuTab = array();

            $connexionPdo = dataBaseLinker::getConnexion();

            $state = $connexionPdo->prepare("SELECT * FROM Discussion WHERE idDiscussion = ? ");
            $state->bindParam(1, $idDiscussion );
            $state->execute();

            $resultat = $state->fetchAll();

            foreach($resultat as $lineResultat)
            {
                $discussion = new Discussion();
                $discussion->setIdDiscussion($lineResultat["idDiscussion"]);
                $discussion->setTitreDiscussion($lineResultat["titreDiscussion"]);
                $discussion->setTexteDiscussion($lineResultat["texteDiscussion"]);
                $discussion->setDatePublicationDiscussion($lineResultat["datePublicationDiscussion"]);
                $discussion->setIdClosed($lineResultat["idClosed"]);
                $discussion->setIdCategorie($lineResultat["idCategorie"]);

                $discuTab [] = $discussion;
            }
            return $discuTab;
        }

        public static function getMessage($idDiscu)
        {
            $connexionPdo = Databaselinker::getConnection();

            $msjTab = array();

            $state = $connexionPdo->prepare("SELECT idMessage FROM  WHERE idArticle=? ORDER BY dateParution")
            $state->bindParam(1, $idDiscu);
            $state->execute();

            $resultat = $state->fetchAll();

            foreach($resultat as $lineResult)
            {
                $msj = DiscussionManager::findDiscution($lineResult["idMessage"]);
                $msjTab [] = $msj;
            }
        }
    }
?>