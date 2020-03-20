<?php

    class Utilisateur
    {
        private $idUser;
        private $pseudo;
        private $email;
        private $cheminAvatar;
        private $password;
        private $isAdmin;
        private $isConnected;
        private $isBanned;
        private $dateFinBan;
        private $motifBan;
        

        function getIsBanned() {
            return $this->isBanned;
        }

        function getDateFinBan() {
            return $this->dateFinBan;
        }

        function getMotifBan() {
            return $this->motifBan;
        }

        function setIsBanned($isBanned) {
            $this->isBanned = $isBanned;
        }

        function setDateFinBan($dateFinBan) {
            $this->dateFinBan = $dateFinBan;
        }

        function setMotifBan($motifBan) {
            $this->motifBan = $motifBan;
        } 
        
        function getIdUser() 
        {
            return $this->idUser;
        }

        function getPseudo() 
        {
            return $this->pseudo;
        }

        function getEmail() 
        {
            return $this->email;
        }

        function getCheminAvatar() 
        {
            return $this->cheminAvatar;
        }

        function getPassword() 
        {
            return $this->password;
        }

        function getIsAdmin() 
        {
            return $this->isAdmin;
        }

        function getIsConnected() 
        {
            return $this->isConnected;
        }

        function setIdUser($idUser) 
        {
            $this->idUser = $idUser;
        }

        function setPseudo($pseudo) 
        {
            $this->pseudo = $pseudo;
        }

        function setEmail($email) 
        {
            $this->email = $email;
        }

        function setCheminAvatar($cheminAvatar) 
        {
            $this->cheminAvatar = $cheminAvatar;
        }

        function setPassword($password) 
        {
            $this->password = $password;
        }

        function setIsAdmin($isAdmin) 
        {
            $this->isAdmin = $isAdmin;
        }

        function setIsConnected($isConnected) 
        {
            $this->isConnected = $isConnected;
        }
        
        


    }

