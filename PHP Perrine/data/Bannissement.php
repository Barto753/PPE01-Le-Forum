<?php

    class Bannissement
    {
        private $idBannissement;
        private $dateFin;
        private $motif;
        private $idUser;
        
        function getIdBannissement() 
        {
            return $this->idBannissement;
        }

        function setIdBannissement($idBannissement) 
        {
            $this->idBannissement = $idBannissement;
        }

        function getDateFin() 
        {
            return $this->dateFin;
        }

        function setDateFin($dateFin) 
        {
            $this->dateFin = $dateFin;
        }

        function getMotif() {
            return $this->motif;
        }

        function setMotif($motif) {
            $this->motif = $motif;
        }

                
        
        function getIdUser() 
        {
            return $this->idUser;
        }

        function setIdUser($idUser) 
        {
            $this->idUser = $idUser;
        }

    }
    
?>