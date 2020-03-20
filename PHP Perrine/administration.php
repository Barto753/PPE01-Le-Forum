<?php
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
?>
        <div class="session-container">
<?php
            echo "Vous êtes connecté en tant que ".$_SESSION["login"];
            $currentUser = UtilisateurManager::findUser($_SESSION["login"]); //user connecté
?>
            <div class="deco-bouton"> <a href="index.php?deco=true">Déconnexion</a> </div> 
        </div>
<?php
        if($currentUser->getIsAdmin()==1)
        {
            $tabUsers = UtilisateurManager::findAllUsers();
?>
        <div class="tab-users">
            <table border="1" cellpadding="10" width="100%">
                <tr>
                    <th>IdUser</th>
                    <th>Pseudo</th>
                    <th>Admin</th>
                    <th>Ban</th>
                </tr>
<?php
            foreach ($tabUsers as $user)
            {

?>
                <tr>
                    <td> <?php echo $user->getIdUser(); ?></td>
                    <td> <?php echo $user->getPseudo(); ?></td>
                    <td> <?php if($user->getIsAdmin()==1){echo "Oui";}else{echo"";} ?></td>
                    <td> 
<?php
                        if($user->getIsBanned()==0 && $user->getIsAdmin()==0)
                        {
?>
                            <form method="POST" action="updateBan.php">
                                <input type="hidden" name="idUser" value="<?php echo $user->getIdUser(); ?>"/>
                                <input type="submit" value="Bannir"/>
                            </form>
<?php
                        }
                        else if($user->getIsBanned()==1 && $user->getIsAdmin()==0)
                        {
?>
                            <form method="POST" action="updateBan.php">
                                <input type="hidden" name="idUser" value="<?php echo $user->getIdUser(); ?>"/>
                                <input type="hidden" name="isBanned" value="<?php echo $user->getIsBanned(); ?>"/>
                                <input type="submit" value="Debannir"/>
                            </form>
<?php
                        }
?>
                    </td>
                </tr>
<?php
            }
?>
            </table>
        </div>
<?php
        }
    }
    
    
    
    
    
    
    
    
    
    
    include_once("include/footer.php");
?>

