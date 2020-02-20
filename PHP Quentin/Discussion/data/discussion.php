<?php

    class Discussion
    {
        private $idDiscussion;
        private $titreDiscussion ;
        private $texteDiscussion;
        private $datePublicationDiscussion ;
        private $idClosed;
        private $idCategorie ;

        function getIdDiscussion() {
            return $this->idDiscussion;
        }
        function setIdDiscussion($idDiscussion) {
            $this->idDiscussion = $idDiscussion;
        }

        function getTitreDiscussion() {
            return $this->titreDiscussion;
        }
        function setTitreDiscussion($titreDiscussion) {
            $this->titreDiscussion = $titreDiscussion;
        }

        function getTexteDiscussion() {
            return $this->texteDiscussion;
        }
        function setTexteDiscussion($texteDiscussion) {
            $this->texteDiscussion = $texteDiscussion;
        }
        
        function getDatePublicationDiscussionn() {
            return $this->datePublicationDiscussion;
        }
        function setDatePublicationDiscussion($datePublicationDiscussion) {
            $this->datePublicationDiscussion = $datePublicationDiscussion;
        }

        function getIdClosed() {
            return $this->idClosed;
        }
        function setIdClosed($idClosed) {
            $this->idClosed = $idClosed;
        }

        function getIdCategorie() {
            return $this->idCategorie;
        }
        function setIdCategorie($idCategorie) {
            $this->idCategorie = $idCategorie;
        }
    }

?>