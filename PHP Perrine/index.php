<?php
    include_once("include/header.php");
    
    
    include_once("dataManagers/data/Utilisateur.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("dataManagers/CategorieManager.php");

    /*session_unset();
    session_destroy();*/
    
    
    //si le bouton de deconnexion a renvoyé true
    if(!empty($_GET["deco"]) && $_GET["deco"]==true)
    {
        $updateUser = false;

        if(isset($_SESSION["login"]))
        {
            $user = UtilisateurManager::findUser($_SESSION["login"]);
            $user->setIsConnected(0);
            UtilisateurManager::updateConnexion($user);

            if($user->getIsConnected()==0)
            {
                $updateUser = true;
            }
        }  
        
        if($updateUser==true)
        {
            session_unset();
            session_destroy();
            unset($_SESSION["login"]); 
        }
    }
    
    
    

    $user = null;
    //si qqch est rentré dans le form mais qu'il manque un champ 
    //NON CONNECTE + FORM MAL REMPLI + AFFICHE ERREURS
    $tabErreursConnexion=array();
    
    if(!empty($_POST))
    {
        if(empty($_POST["pseudo"]))
        {
            $tabErreursConnexion["pseudo"]= "Veuillez saisir un pseudo.";
        }

        if(empty($_POST["password"]))
        {
            $tabErreursConnexion["password"]= "Veuillez saisir un mot de passe.";
        }

        foreach($tabErreursConnexion as $errorCo)
        {
            echo $errorCo;
        }
    }
    
    
    //s'il n'y a pas eu d'erreurs dans le form
    if(empty($tabErreursConnexion))
    {
        //si pseudo et password du form ne sont pas vides
        //DOUBLE VERIF
        if(!empty($_POST["pseudo"]) && !empty($_POST["password"]))
        {
            //si le user est dans la bdd avec un pseudo qui correspond au password
            if(ConnexionManager::testConnexionUser($_POST["pseudo"])==true)
            {
                $user = UtilisateurManager::findUser($_POST["pseudo"]);
                
                if($user->getIsBanned()==0 || UtilisateurManager::verifBanIsOver($user)==1)
                {
                    $user->setIsConnected(1);
                    UtilisateurManager::updateConnexion($user);
                    
                    $user->setIsBanned(0);
                    $user->setDateFinBan("2000-01-01");
                    $user->setMotifBan("null"); 
                    UtilisateurManager::updateBannissement($user);
                    
                    //on set le parametre login de la session avec le pseudo du user connecté
                    $_SESSION["login"]=$_POST["pseudo"];
                }
                else 
                {
?>
                        <div class="bannissement-msg">
<?php
                    echo "Vous avez été banni jusqu'au ".$user->getDateFinBan();
                    echo " à cause de ".$user->getMotifBan();
?>
                    </div>
<?php
                }
            }
            else
            {
                echo "Pseudo ou mot de passe erroné, veuillez vous inscrire.";
            }
        }
    }
    
    //si la session n'est pas définie 
    //NON CONNECTE
    if(!isset($_SESSION["login"]))
    {
?>
        <div class="inscription-connexion-box">
            
            <div class="button">
                <a href="inscription.php">Inscription</a>
            </div>

            <div class="connexion-box">
                <form method="POST" action="index.php">
                    <label> Pseudo </label>
                    <input type="text" name="pseudo"/>
                    <label> Mot de passe </label>
                    <input type="password" name="password"/>
                    <input type="submit" value="Connexion"/>
                </form>
            </div>
            
        </div> 
<?php
    }
    
    $tabCategories = CategorieManager::findAllCategories();
    //si le login de la session existe bien 
    if(isset($_SESSION["login"]))
    {
        $user = UtilisateurManager::findUser($_SESSION["login"]);
?>
        <div class="session-container">
<?php
            echo "Vous êtes connecté en tant que ".$_SESSION["login"];
?>
            <div class="deco-bouton"> <a href="index.php?deco=true">Déconnexion</a> </div> 
        
<?php
        
        
        if($user->getIsConnected()==1)
        {
?>
                <div class="account-icone">
                    <a href="account.php">
                        <img class="session-settings-img" src="images-general/navigation-menu-horizontal-1.png"/>
                        <input type="hidden" name="idUser" value="<?php $user->getIdUser();?>">
                    </a>
                    <div class="session-settings-text"> Compte </div>
                </div>
            </div>
<?php
            //AFICHAGE BOX NOUVELLE DISCUSSION
            $tabCategories = CategorieManager::findAllCategories();
?>
            
            <div class="new-discussion-container">  
                <div class="new-discussion-entete">Créer un nouveau fil de discussion</div>
                <form method="POST" action="insertDiscu.php">
                    <div class="new-discussion-liste">
                        <?php echo "A propos de :"; ?>
                        <SELECT name="categorie-discussion" size="1" style="width: 30%; height: 30px; font-size: 20px;">
                            <?php
                            foreach ($tabCategories as $categorie)
                            {
                                echo "<option>".$categorie->getNomCategorie();
                            }
                            ?>
                        </SELECT>
                    </div>
                    <div class="new-discussion-titre"> <input type="text" name="titreDiscussion" placeholder="Titre de la nouvelle discussion" required style="width: 100%; height: 30px; font-size: 20px;"/> </div>
                    <div class="new-discussion-contenu"> <textarea rows="6" cols="20" name="texteDiscussion" placeholder="Contenu" required style="width: 100%; height: 100%; font-size: 20px; resize:none;"></textarea> </div>
                    <input type="hidden" name="idUser" value="<?php echo $user->getIdUser(); ?>"/>
                    <input type="hidden" name="idCategorie" value="<?php echo $categorie->getIdCategorie(); ?>"/>
                    <div class="new-discussion-button"> <button type="submit">Créer</button> </div>
                </form> 
            </div>  
<?php  
        }
    }
    
      
//AFFICHAGE CATEGORIES
?>
    <div class="categorie-titre">Catégories</div>
    <div class="categorie-container">
      
<?php
        foreach($tabCategories as $categorie)
        {
?>
            <div class="categorie-link">
                <a class="categorie-nom" href='sujet.php?idCateg=<?php echo $categorie->getIdCategorie(); ?>'> <?php echo $categorie->getNomCategorie()?> </a> 
            </div> 
<?php
        }
?>
    </div>
<?php
    include("include/footer.php");
?>   