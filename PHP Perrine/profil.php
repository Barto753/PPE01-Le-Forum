<?php
    session_start();
    include_once("include/header.php");
    
    include_once("data/Utilisateur.php");
    include_once("dataManagers/DatabaseLinker.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("dataManagers/CategorieManager.php");
    
    
    $currentUser = new Utilisateur();
    
    if(isset($_SESSION["login"]))
    {
        echo "Vous êtes connecté en tant que ".$_SESSION["login"];
        $currentUser = UtilisateurManager::findUser($_SESSION["login"]); //user connecté
?>
        <a href="index.php?deco=true">Déconnexion</a>
<?php
        echo "<br>";
        echo "Pseudo : ".$currentUser->getPseudo();
        echo " Email : ".$currentUser->getEmail();
        echo "<br><br>";
?>
        <form method="POST" action="modifProfil.php">
            <label>Modification du mot de passe : </label>
            <input type="hidden" name="idUser" value="<?php echo $currentUser->getIdUser(); ?>"/>
            <input type="hidden" name="currentPassword" value="<?php echo $currentUser->getPassword()?>"/>
            <input type="password" name="verifCurrentPassword" placeholder="Mot de passe actuel"/>
            <input type="password" name="newPassword" placeholder="Nouveau mot de passe"/> 
            <input type="submit" value="Modifier"/>
        </form>
            
            
        
<?php
        /*
?>
        <form method="POST" action="modifProfil.php" enctype="multipart/form-data">
            <input type="file" name="newAvatar"/>
            <input type="submit" value="Valider"
        </form>
<?php
        */
        
                
               
    }
    
    
    include_once("include/footer.php");
?>