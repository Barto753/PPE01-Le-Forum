<?php

    class Discussion
    {
        private $idDiscussion;
        private $titreDiscussion;
        private $isClosed;
        private $texteDiscussion;
        private $datePublicationDiscussion;
        private $idCategorie;
        
        
        function getIdDiscussion() 
        {
            return $this->idDiscussion;
        }

        function getTitreDiscussion() 
        {
            return $this->titreDiscussion;
        }

        function getIsClosed() 
        {
            return $this->isClosed;
        }

        function getTexteDiscussion() 
        {
            return $this->texteDiscussion;
        }

        function getDatePublicationDiscussion() 
        {
            return $this->datePublicationDiscussion;
        }

        function getIdCategorie() 
        {
            return $this->idCategorie;
        }

        function setIdDiscussion($idDiscussion) 
        {
            $this->idDiscussion = $idDiscussion;
        }

        function setTitreDiscussion($titreDiscussion) 
        {
            $this->titreDiscussion = $titreDiscussion;
        }

        function setIsClosed($isClosed) 
        {
            $this->isClosed = $isClosed;
        }

        function setTexteDiscussion($texteDiscussion) 
        {
            $this->texteDiscussion = $texteDiscussion;
        }

        function setDatePublicationDiscussion($datePublicationDiscussion) 
        {
            $this->datePublicationDiscussion = $datePublicationDiscussion;
        }

        function setIdCategorie($idCategorie) 
        {
            $this->idCategorie = $idCategorie;
        }
        
    }

?>
