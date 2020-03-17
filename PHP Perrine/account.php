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
        echo "<br>";
        echo " Email : ".$currentUser->getEmail();
        echo "<br>";
        echo " Avatar : ";
        echo '<img class="image-avatar" src="images/'.$currentUser->getCheminAvatar().'"/>';
                  
        echo "<br><br>";
        
        //BOX MODIFIER PASSWORD
?>
        <form method="POST" action="modifPassword.php">
            <label>Modification du mot de passe : </label>
            <input type="hidden" name="idUser" value="<?php echo $currentUser->getIdUser(); ?>"/>
            <input type="hidden" name="currentPassword" value="<?php echo $currentUser->getPassword()?>"/>
            <input type="password" name="verifCurrentPassword" placeholder="Mot de passe actuel"/>
            <input type="password" name="newPassword" placeholder="Nouveau mot de passe"/> 
            <input type="submit" value="Modifier"/>
        </form>
        <?php
        
        //BUTTON ADMIN
        if($currentUser->getIsAdmin()==1)
        {
?>
            <a href="administration.php">Administration</a>
<?php
        }
        //BOX MODIFIER AVATAR
?>
        <form method="POST" action="modifAvatar.php" enctype="multipart/form-data">
            <label>Modification de l'avatar : </label>
            <input type="hidden" name="idUser" value="<?php echo $currentUser->getIdUser(); ?>"/>
            <input type="file" name="newAvatar"/>
            <input type="submit" name="upload" value="Valider"/>
        </form>
<?php
        
              
    }
    
    
    include_once("include/footer.php");
?>