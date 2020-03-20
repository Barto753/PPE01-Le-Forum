<?php
    include_once("include/header.php");
    
    include_once("dataManagers/UtilisateurManager.php");
    include_once("data/Utilisateur.php");
    
    if(!empty($_POST["idUser"]) && isset($_POST["currentPassword"]) && !empty($_POST["newPassword"]) && !empty($_POST["verifCurrentPassword"]))
    {
        $user = UtilisateurManager::findUserWithId($_POST["idUser"]);
        
        if($_POST["verifCurrentPassword"]==$_POST["currentPassword"])
        {
            $user->setPassword($_POST["newPassword"]);
            $user = UtilisateurManager::updatePassword($user);
?>
            <div class="container-modif-password">
                <div class="modif-password-text">
<?php
            echo "Modification du mot de passe réussie";
            ?>
                    </div>
                <?php
        }
        else
        {
?>
            <div class="modif-password-text">
<?php
                
             echo "Mot de passe actuel erroné, veuillez réessayer.";
?>
                </div>
                <?php
        }
?>
<div class="modif-password-text">
        <a href="account.php">Retour vers le compte</a>
                
            </div>
<?php
        
    }
    
    include_once("include/footer.php");
?>