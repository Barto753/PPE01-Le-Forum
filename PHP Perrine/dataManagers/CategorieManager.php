<?php

    include_once("DatabaseLinker.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/CategorieDiscussion.php");

    class CategorieManager
    {
        public static function findCategorie($idCategorie)
        {
            $categorie = null;
            
            $connex = DatabaseLinker::getConnexion();
            
            $state = $connex->prepare("SELECT * FROM CategorieDiscussion WHERE idCategorie=?");
            
            $state->bindParam(1, $idCategorie);
            $state->execute();
            
            $resultats = $state->fetchAll();
            
            if(sizeof($resultats)>0)
            {
                $result = $resultats[0];
                
                $categorie = new CategorieDiscussion();
                $categorie->setIdCategorie($result["idCategorie"]);
                $categorie->setNomCategorie($result["nomCategorie"]);
            }
            return $categorie;
        }
        
        public static function findAllCategories()
        {
            $tabCategories = array();
            
            $connex = DatabaseLinker::getConnexion();
            
            $state = $connex->prepare("SELECT idCategorie FROM CategorieDiscussion");
            $state->execute();
            
            $resultats = $state->fetchAll();
            
            foreach($resultats as $result)
            {
                $categorie = CategorieManager::findCategorie($result["idCategorie"]);
                $tabCategories[] = $categorie;
            }
            return $tabCategories;
        }
    }

?>