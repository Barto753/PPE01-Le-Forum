<?php
    session_name("PPE01");
    session_start();
    
    date_default_timezone_set('Europe/Paris');
    
    if(!empty($_POST["idUser"]) && !empty($_POST["titreDiscussion"]) && !empty($_POST["texteDiscussion"]))
    {
        if($_GET["categorie-discussion"]=="CSS")
        {
            $dicussion = new Discussion();
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
        else if($_GET["categorie-discussion"]=="PHP")
        {
            $dicussion = new Discussion();
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
        else if($_GET["categorie-discussion"]=="Java")
        {
            $dicussion = new Discussion();
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
    
    
    
    
    
?>
