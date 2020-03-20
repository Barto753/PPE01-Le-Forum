<?php
    include_once("include/header.php");
    
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/data/Utilisateur.php");
    
    if(!empty($_POST["idUser"]) && isset($_POST["currentPassword"]) && !empty($_POST["newPassword"]) && !empty($_POST["verifCurrentPassword"]))
    {
        $user = UtilisateurManager::findUserWithId($_POST["idUser"]);
        $verifModifPassword = 0;
        if($_POST["verifCurrentPassword"]==$_POST["currentPassword"])
        {
            $user->setPassword($_POST["newPassword"]);
            $user = UtilisateurManager::updatePassword($user);
            $verifModifPassword = 1;
            //echo "Modification du mot de passe réussie"; 
        }
        else
        {
            $verifModifPassword = 0;
            //echo "Mot de passe actuel erroné, veuillez réessayer.";
        }

       
        header('Location: account.php?verifNewMdp='.$verifModifPassword);
        exit;
    }
        
    
    include_once("include/footer.php");
?>