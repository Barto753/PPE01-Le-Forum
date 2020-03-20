<?php
    include_once("include/header.php");
    
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/data/Message.php");
    include_once("dataManagers/data/Discussion.php");
    
    if(!empty($_POST["idDiscussion"]))
    {
        $discussion = DiscussionManager::findDiscussion($_POST["idDiscussion"]);
        
        $idCategorie=$discussion->getIdCategorie();
        DiscussionManager::deleteMessages($_POST["idDiscussion"]);
        DiscussionManager::deleteDiscussion($_POST["idDiscussion"]);
        
        header('Location: sujet.php?idCateg='.$idCategorie);
        exit;

        
    }
    
    
    include_once("include/footer.php");
?>