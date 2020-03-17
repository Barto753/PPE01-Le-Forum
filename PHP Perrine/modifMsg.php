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
        
        if($discussion->getIdCategorie()==1)
        {
            $idCategorie=$discussion->getIdCategorie();
            MessageManager::modifMessage($message);
            header('Location: sujet'.$idCategorie.'.php');
            exit;
        }
        else if($discussion->getIdCategorie()==2)
        {
            $idCategorie=$discussion->getIdCategorie();
            MessageManager::modifMessage($message);
            header('Location: sujet'.$idCategorie.'.php');
            exit;
        }
        else if($discussion->getIdCategorie()==3)
        {
            $idCategorie=$discussion->getIdCategorie();
            MessageManager::modifMessage($message);
            header('Location: sujet'.$idCategorie.'.php');
            exit;
        }
        
    }
    
    
    include_once("include/footer.php");
?>