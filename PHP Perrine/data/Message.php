<?php

    class Message
    {
        private $idMessage;
        private $texteMessage;
        private $dateMessage;
        private $idUser;
        private $idDiscussion;
        
        function getIdMessage() 
        {
            return $this->idMessage;
        }

        function setIdMessage($idMessage) 
        {
            $this->idMessage = $idMessage;
        }

        function getTexteMessage() 
        {
            return $this->texteMessage;
        }

        function setTexteMessage($texteMessage) 
        {
            $this->texteMessage = $texteMessage;
        }

        function getDateMessage() 
        {
            return $this->dateMessage;
        }

        function setDateMessage($dateMessage) 
        {
            $this->dateMessage = $dateMessage;
        }

        function getIdUser() 
        {
            return $this->idUser;
        }

        function setIdUser($idUser) 
        {
            $this->idUser = $idUser;
        }

        function getIdDiscussion() 
        {
            return $this->idDiscussion;
        }

        function setIdDiscussion($idDiscussion) 
        {
            $this->idDiscussion = $idDiscussion;
        } 
    }

?>