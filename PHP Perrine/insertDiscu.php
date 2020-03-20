<?php
    include_once("include/header.php");
    
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/data/Discussion.php");
    include_once("dataManagers/CategorieManager.php");
    
    date_default_timezone_set('Europe/Paris');
    
    if(!empty($_POST["idUser"]) && !empty($_POST["titreDiscussion"]) && !empty($_POST["texteDiscussion"]) && !empty($_POST["idCategorie"]))
    {
        $categorie = CategorieManager::findCategorie($_POST["idCategorie"]);
        $idCategorie = $categorie->getIdCategorie();

        $discussion = new Discussion();
        $discussion->setTitreDiscussion($_POST["titreDiscussion"]);
        $discussion->setTexteDiscussion($_POST["texteDiscussion"]);
        $discussion->setDateDiscussion(date("Y-m-d H:i:s"));
        $discussion->setIsClosed(0);
        $discussion->setIdCategorie($idCategorie);
        $discussion->setIdUser($_POST["idUser"]);
        DiscussionManager::insertDiscussion($discussion);

        header('Location: sujet.php?idCateg='.$idCategorie);
        exit;
    }
    
    
    include_once("include/footer.php");
?>
