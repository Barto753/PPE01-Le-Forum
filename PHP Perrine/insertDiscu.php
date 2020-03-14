<?php
    include_once("include/header.php");
    
    include_once("dataManagers/DiscussionManager.php");
    include_once("data/Discussion.php");
    
    date_default_timezone_set('Europe/Paris');
    
    if(!empty($_POST["idUser"]) && !empty($_POST["titreDiscussion"]) && !empty($_POST["texteDiscussion"]))
    {
        if($_POST["categorie-discussion"]==("Chien"))
        {
            $discussion = new Discussion();
            $discussion->setTitreDiscussion($_POST["titreDiscussion"]);
            $discussion->setTexteDiscussion($_POST["texteDiscussion"]);
            $discussion->setDateDiscussion(date("Y-m-d"));
            $discussion->setIsClosed(0);
            $discussion->setIdCategorie(1);
            $discussion->setIdUser($_POST["idUser"]);
            DiscussionManager::insertDiscussion($discussion);
            header('Location: sujet1.php');
            exit;
        }
        else if($_POST["categorie-discussion"]==("Chat"))
        {
            $discussion = new Discussion();
            $discussion->setTitreDiscussion($_POST["titreDiscussion"]);
            $discussion->setTexteDiscussion($_POST["texteDiscussion"]);
            $discussion->setDateDiscussion(date("Y-m-d"));
            $discussion->setIsClosed(0);
            $discussion->setIdCategorie(2);
            $discussion->setIdUser($_POST["idUser"]);
            DiscussionManager::insertDiscussion($discussion);
            header('Location: sujet2.php');
            exit;
        }
        else if($_POST["categorie-discussion"]==("Rongeur"))
        {
            $discussion = new Discussion();
            $discussion->setTitreDiscussion($_POST["titreDiscussion"]);
            $discussion->setTexteDiscussion($_POST["texteDiscussion"]);
            $discussion->setDateDiscussion(date("Y-m-d"));
            $discussion->setIsClosed(0);
            $discussion->setIdCategorie(3);
            $discussion->setIdUser($_POST["idUser"]);
            DiscussionManager::insertDiscussion($discussion);
            header('Location: sujet2.php');
            exit;
        }
    }
    
    
    include_once("include/footer.php");
?>
