<?php
    include_once("include/header.php");
    
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/data/Discussion.php");
    
    if(!empty($_POST["idDiscussion"]) && isset($_POST["isClosed"]))
    {
        $discussion = DiscussionManager::findDiscussion($_POST["idDiscussion"]);
        $idCategorie = $discussion->getIdCategorie();
        
        if($_POST["isClosed"]==0)
        {
            $discussion->setIsClosed(1);
            $discussion = DiscussionManager::updateIsClosedDiscussion($discussion);
        }
        else if($_POST["isClosed"]==1)
        {
            $discussion->setIsClosed(0);
            $discussion = DiscussionManager::updateIsClosedDiscussion($discussion);
        }
     
        header('Location: sujet.php?idCateg='.$idCategorie);
        exit;
    }
    
    include_once("include/footer.php");
?>