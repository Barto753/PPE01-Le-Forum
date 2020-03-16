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
    include_once("data/Bannissement.php");
    
    
    $currentUser = new Utilisateur();
    $banni = new Bannissement();
    
    if(isset($_SESSION["login"]))
    {
        echo "Vous êtes connecté en tant que ".$_SESSION["login"];
        $currentUser = UtilisateurManager::findUser($_SESSION["login"]); //user connecté
?>
        <a href="index.php?deco=true">Déconnexion</a>
<?php
        if($currentUser->getIsAdmin()==1)
        {
            $tabUsers = UtilisateurManager::findAllUsers();
?>
            <table>
                <tr>
                    <td>IdUser</td>
                    <td>Pseudo</td>
                    <td>Admin</td>
                </tr>
<?php
            foreach ($tabUsers as $user)
            {
                $banni = UtilisateurManager::findBannissement($user->getIdUser());
?>
                <tr>
                    <td> <?php echo $user->getIdUser(); ?></td>
                    <td> <?php echo $user->getPseudo(); ?></td>
                    <td> <?php if($user->getIsAdmin()==1){echo "Oui";}else{echo"";} ?></td>
                    <td> 
<?php
                        if(empty($banni))
                        {
?>
                            <form method="POST" action="updateBanni.php">
                                <input type="hidden" name="idUser" value="<?php echo $user->getIdUser(); ?>"/>
                                <input type="submit" value="Bannir"/>
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
<?php
        }
    }
    
    
    
    
    
    
    
    
    
    
    include_once("include/footer.php");
?>

