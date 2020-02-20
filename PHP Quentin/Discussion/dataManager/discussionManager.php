<?php
    include_once("dataManager/dataBaseLinker.php");
    include_once("data/discution.php");

    class DiscutionManager
    {
        public static function insertDiscution($discution)
        {
            $connexionPdo = dataBaseLinker::getConnexion();

            $state = $connexionPdo->prepare("INSERT INTO Discution(titreDiscution, texteDiscussion , datePublicationDiscussion, idClosed, idCategorie) VALUES( ? ,? ,?, ?, ? )");

            $titreDiscution = $discution->getTitreDiscution();
            $texteDiscussion  = $discution->getTexteDiscussion ();
            $dateParution = $discution->getDatePublicationDiscussion();
            $idClosed = $discution->getIdClosed();
            $idCategorie = $discution->getIdCategorie();

            $state->bindParam(1 ,$titreDiscution);
            $state->bindParam(2 ,$texteDiscussion);
            $state->bindParam(3 ,$datePublicationDiscussion);
            $state->bindParam(4 ,$idClosed);
            $state->bindParam(5 ,$idCategorie);
            $state->execute();
        }

        public static function findDiscution($idDiscution)
        {
            $discution = null;
            $discuTab = new Discution();
            $discuTab = array();

            $connexionPdo = dataBaseLinker::getConnexion();

            $state = $connexionPdo->prepare("SELECT * FROM Discution WHERE idDiscution = ? ")
            $state->bindParam(1, $idDiscution );
            $state->execute();

            $resultat = $state->fetchAll();

            foreach($resultat as $lineResultat)
            {
                $discution = new Discution();
                $discution->setIdDiscution($lineResultat["idDiscution"]);
                $discution->setTitreDiscution($lineResultat["titreDiscution"]);
                $discution->setTexteDiscussion($lineResultat["texteDiscussion"]);
                $discution->setDatePublicationDiscussion($lineResultat["datePublicationDiscussion"]);
                $discution->setIdClosed($lineResultat["idClosed"]);
                $discution->setIdCategorie($lineResultat["idCategorie"]);

                $discuTab [] = $discution;
            }
            return $discuTab;
        }
    }
?>