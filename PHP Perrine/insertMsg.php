<?php
    include_once("include/header.php");
    
    include_once("dataManagers/MessageManager.php");
    include_once("dataManagers/data/Message.php");
    include_once("dataManagers/CategorieManager.php");
    
    date_default_timezone_set('Europe/Paris');
    print_r($_POST["idUser"]);
    
    if(!empty($_POST["idUser"]) && !empty($_POST["texteMsg"]) && !empty($_POST["idCategorie"]))
    {
        $categorie = CategorieManager::findCategorie($_POST["idCategorie"]);
        $idCategorie = $categorie->getIdCategorie();
               
        $message = new Message();
        $message->setTexteMessage($_POST["texteMsg"]);
        $message->setDateMessage(date("Y-m-d H:i:s"));
        $message->setIdUser($_POST["idUser"]);
        $message->setIdDiscussion($_POST["idDiscussion"]);
        MessageManager::insertMessage($message);

        header('Location: sujet.php?idCateg='.$idCategorie);
        exit;
        
    }
    
    
    include_once("include/footer.php");
?>
