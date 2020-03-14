<?php
    include_once("include/header.php");
    
    include_once("dataManagers/MessageManager.php");
    include_once("data/Message.php");
    
    date_default_timezone_set('Europe/Paris');
    print_r($_POST["idUser"]);
    
    if(!empty($_POST["idUser"]) && !empty($_POST["texteMsg"]))
    {
        if($_POST["nomCategorie"]==("Chien"))
        {
            $message = new Message();
            $message->setTexteMessage($_POST["texteMsg"]);
            $message->setDateMessage(date("Y-m-d"));
            $message->setIdUser($_POST["idUser"]);
            $message->setIdDiscussion($_POST["idDiscussion"]);
            MessageManager::insertMessage($message);
            header('Location: sujet1.php');
            exit;
        }
        else if($_POST["nomCategorie"]==("Chat"))
        {
            $message = new Message();
            $message->setTexteMessage($_POST["texteMsg"]);
            $message->setDateMessage(date("Y-m-d"));
            $message->setIdUser($_POST["idUser"]);
            $message->setIdDiscussion($_POST["idDiscussion"]);
            MessageManager::insertMessage($message);
            header('Location: sujet2.php');
            exit;
        }
        else if($_POST["nomCategorie"]==("Rongeur"))
        {
            $message = new Message();
            $message->setTexteMessage($_POST["texteMsg"]);
            $message->setDateMessage(date("Y-m-d"));
            $message->setIdUser($_POST["idUser"]);
            $message->setIdDiscussion($_POST["idDiscussion"]);
            MessageManager::insertMessage($message);
            header('Location: sujet3.php');
            exit;
        }
    }
    
    
    include_once("include/footer.php");
?>
