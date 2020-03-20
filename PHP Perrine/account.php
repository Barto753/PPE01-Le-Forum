<?php
    include_once("include/header.php");
    
    include_once("data/Utilisateur.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/CategorieManager.php");
    
    
    $currentUser = new Utilisateur();
    
    if(isset($_SESSION["login"]))
    {
?>
        <div class="session-container">
<?php
            echo "Vous êtes connecté en tant que ".$_SESSION["login"];
            $currentUser = UtilisateurManager::findUser($_SESSION["login"]); //user connecté
?>
            <div class="deco-bouton"> <a href="index.php?deco=true">Déconnexion</a> </div> 
        </div>

        <div class="account-container">
            <?php
            //BOUTON ADMINISTRATION
            if($currentUser->getIsAdmin()==1)
            {
?>
            <div class="account-bloc"> <div class="deco-bouton"> <a href="administration.php">Administration</a> </div></div>
<?php
            }
            ?>
            <div class="account-bloc"><?php echo "Pseudo : ".$currentUser->getPseudo(); ?></div>
            <div class="account-bloc"><?php echo "Email : ".$currentUser->getEmail(); ?></div>
            <div class="account-bloc">
                <?php echo "Avatar : "?>
                <img class="account-avatar-img" src="images/<?php echo $currentUser->getCheminAvatar(); ?>">
                      </div>

<?php
            //BOX MODIFIER PASSWORD
?>
            <div class="account-bloc">
                <form method="POST" action="modifPassword.php">
                    <label>Modification du mot de passe : </label>
                    <input type="hidden" name="idUser" value="<?php echo $currentUser->getIdUser(); ?>"/>
                    <input type="hidden" name="currentPassword" value="<?php echo $currentUser->getPassword()?>"/>
                    <input type="password" name="verifCurrentPassword" placeholder="Mot de passe actuel"/>
                    <input type="password" name="newPassword" placeholder="Nouveau mot de passe"/> 
                    <input type="submit" value="Modifier"/>
                </form>
            </div>
            
            <div class="account-verif-mdp">
<?php
            
            if(isset($_GET["verifNewMdp"]))
            {
                if($_GET["verifNewMdp"]==1)
                {
                    echo "Modification du mot de passe réussie";
                }
                else
                {
                    echo "Mot de passe actuel erroné, veuillez réessayer";
                }
            }
            
            //BOX MODIFIER AVATAR
?>
            </div>
            
            <div class="account-avatar-modif-container">
                <form method="POST" action="modifAvatar.php" enctype="multipart/form-data">
                    <label>Modification de l'avatar : </label>
                    <input type="hidden" name="idUser" value="<?php echo $currentUser->getIdUser(); ?>"/>
                    <input type="file" name="newAvatar"/>
                    <input type="submit" name="upload" value="Valider"/>
                </form>
            </div>
                
        
            </div> 
<?php
              
    }
    
    include_once("include/footer.php");
?>