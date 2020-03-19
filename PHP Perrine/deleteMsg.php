<?php
    include_once("include/header.php");
    
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("data/Message.php");
    include_once("data/Discussion.php");
    
    if(!empty($_POST["idDiscussion"]) && !empty($_POST["idMessage"]))
    {
        $discussion = DiscussionManager::findDiscussion($_POST["idDiscussion"]);
        
        $idCategorie=$discussion->getIdCategorie();
        MessageManager::deleteMessage($_POST["idMessage"]);
        
        header('Location: sujet.php?idCateg='.$idCategorie);
        exit;
    }
    
    
    include_once("include/footer.php");
?>