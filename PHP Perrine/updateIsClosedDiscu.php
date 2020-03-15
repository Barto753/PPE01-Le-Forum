<?php
    include_once("include/header.php");
    
    include_once("dataManagers/DiscussionManager.php");
    include_once("data/Discussion.php");
    
    if(!empty($_POST["idDiscussion"]) && isset($_POST["isClosed"]))
    {
        $discussion = DiscussionManager::findDiscussion($_POST["idDiscussion"]);
        $idCategorie = $discussion->getIdCategorie();
        print_r($_POST["isClosed"]);
        
        if($_POST["isClosed"]==0)
        {
            $discussion->setIsClosed(1);
            $discussion = DiscussionManager::updateIsClosedDiscussion($discussion);
            
            header('Location: sujet'.$idCategorie.'.php');
            exit;
        }
        else if($_POST["isClosed"]==1)
        {
            $discussion->setIsClosed(0);
            $discussion = DiscussionManager::updateIsClosedDiscussion($discussion);
            
            header('Location: sujet'.$idCategorie.'.php');
            exit;
        }
     
        /*header('Location: sujet'.$idCategorie.'.php');
        exit;*/
    }
    
    include_once("include/footer.php");
?>