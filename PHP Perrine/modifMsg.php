<?php
    include_once("include/header.php");
    
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("data/Message.php");
    include_once("data/Discussion.php");
    
    if(!empty($_POST["idDiscussion"]) && !empty($_POST["idMessage"]) && !empty($_POST["texteMessage"]))
    {
        $discussion = DiscussionManager::findDiscussion($_POST["idDiscussion"]);
        $message = MessageManager::findMessage($_POST["idMessage"]);
        
        $message->setTexteMessage($_POST["texteMessage"]);
        //$dateModif = $_POST["dateModif"];
        $idCategorie=$discussion->getIdCategorie();
        
        MessageManager::modifMessage($message);
        
        header('Location: sujet.php?idCateg='.$idCategorie);
        exit;
    }
    
    include_once("include/footer.php");
?>