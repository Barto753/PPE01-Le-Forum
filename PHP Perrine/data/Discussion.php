<?php

    class Discussion
    {
        private $idDiscussion;
        private $titreDiscussion;
        private $texteDiscussion;
        private $dateDiscussion;
        private $isClosed;
        private $idCategorie;
        private $idUser;
        
        
        function getIdDiscussion() 
        {
            return $this->idDiscussion;
        }

        function getTitreDiscussion() 
        {
            return $this->titreDiscussion;
        }

        function getTexteDiscussion() 
        {
            return $this->texteDiscussion;
        }
        
        function getDateDiscussion() 
        {
            return $this->dateDiscussion;
        }
        
        function getIsClosed() 
        {
            return $this->isClosed;
        }

        function getIdCategorie() 
        {
            return $this->idCategorie;
        }

        function getIdUser()
        {
            return $this->idUser;
        }
        
        function setIdDiscussion($idDiscussion) 
        {
            $this->idDiscussion = $idDiscussion;
        }

        function setTitreDiscussion($titreDiscussion) 
        {
            $this->titreDiscussion = $titreDiscussion;
        }

        function setTexteDiscussion($texteDiscussion) 
        {
            $this->texteDiscussion = $texteDiscussion;
        }

        function setDateDiscussion($dateDiscussion) 
        {
            $this->dateDiscussion = $dateDiscussion;
        }
        
        function setIsClosed($isClosed) 
        {
            $this->isClosed = $isClosed;
        }

        function setIdCategorie($idCategorie) 
        {
            $this->idCategorie = $idCategorie;
        }
        
        function setIdUser($idUser)
        {
            $this->idUser = $idUser;
        }
    }

?>
