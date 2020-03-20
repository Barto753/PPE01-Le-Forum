<?php

    class CategorieDiscussion
    {
        private $idCategorie;
        private $nomCategorie;
        
        function getIdCategorie() 
        {
            return $this->idCategorie;
        }

        function setIdCategorie($idCategorie) 
        {
            $this->idCategorie = $idCategorie;
        }

        function getNomCategorie() 
        {
            return $this->nomCategorie;
        }

        function setNomCategorie($nomCategorie) 
        {
            $this->nomCategorie = $nomCategorie;
        }
    }

?>

