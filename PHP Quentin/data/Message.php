<?php

    class message
    {
        private $idMessage;
        private $texteMessage;
        private $datePublicationMessage;
        private $idUser;
        private $idDiscussion;

        function getIdMessage() {
            return $this->idMessage;
        }
        function setIdMessage($idMessage) {
            $this->idMessage = $idMessage;
        }

        function getTexteMessage() {
            return $this->texteMessage;
        }
        function setTexteMessage($texteMessage) {
            $this->texteMessage = $texteMessage;
        }

        function getDatePublicationMessage() {
            return $this->datePublicationMessage;
        }
        function setDatePublicationMessage($datePublicationMessage) {
            $this->datePublicationMessage = $datePublicationMessage;
        }

        function getIdUser() {
            return $this->idUser;
        }
        function setIdUser($idUser) {
            $this->idUser = $idUser;
        }

        function getIdDiscussion() {
            return $this->idDiscussion;
        }
        function setIdDiscussion($idDiscussion) {
            $this->idDiscussion = $idDiscussion;
        }

    }

?>
