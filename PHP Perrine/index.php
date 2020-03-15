<?php
    include_once("include/header.php");
    session_start();
    
    include_once("data/Utilisateur.php");
    include_once("dataManagers/DatabaseLinker.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("dataManagers/CategorieManager.php");

    /*session_unset();
    session_destroy();
    unset($_SESSION["login"]);*/
    
    
    
    //si le bouton de deconnexion a renvoyé true
    if(!empty($_GET["deco"]) && $_GET["deco"]==true)
    {
        $updateUser = false;
        echo "bonjour deco=true";
        
        if(isset($_SESSION["login"]))
        {
            $user = UtilisateurManager::findUser($_SESSION["login"]);
            $user->setIsConnected(0);
            UtilisateurManager::updateConnexion($user);
            echo "bonjour session login est defini";
            if($user->getIsConnected()==0)
            {
                echo "bonjour isconnected=0";
                $updateUser = true;
            }
        }  
        
        if($updateUser==true)
        {
            echo "bonjour updateuser=true";
            session_unset();
            session_destroy();
            unset($_SESSION["login"]); 
        }
    }
    
    
    

    $user = null;
    //si qqch est rentré dans le form mais qu'il manque un champ 
    //NON CONNECTE + FORM MAL REMPLI + AFFICHE ERREURS
    $tabErreurs=array();
    if(!empty($_POST))
    {
        if(empty($_POST["pseudo"]))
        {
            $tabErreurs["pseudo"]= "Veuillez saisir un pseudo.";
        }

        if(empty($_POST["password"]))
        {
            $tabErreurs["password"]= "Veuillez saisir un mot de passe.";
        }

        foreach($tabErreurs as $error)
        {
            echo $error;
        }
    }
    
    
    //s'il n'y a pas eu d'erreurs dans le form
    if(empty($tabErreurs))
    {
        //si pseudo et password du form ne sont pas vides
        //DOUBLE VERIF
        if(!empty($_POST["pseudo"]) && !empty($_POST["password"]))
        {
            echo "bonjour post de pseudo et password sont remplis";
            //si le user est dans la bdd avec un pseudo qui correspond au password
            if(ConnexionManager::testConnexionUser($_POST["pseudo"])==true)
            {
                echo "bonjour le post pseudo a été trouvé dans la bdd + mdp";
                $user = UtilisateurManager::findUser($_POST["pseudo"]);
                $user->setIsConnected(1);
                UtilisateurManager::updateConnexion($user);
                //on set le parametre login de la session avec le pseudo du user connecté
                $_SESSION["login"]=$_POST["pseudo"];
            }
            else
            {
                echo "bonjour le post pseudo ou mdp n'a pas été trouvé dans bdd";
                echo "Pseudo ou mot de passe erroné, veuillez vous inscrire.";
            }
        }
    }
    
    //si la session n'est pas définie 
    //NON CONNECTE
    if(!isset($_SESSION["login"]))//&& !empty($_POST)
    {
        echo "bonjour session login n'est pas defini";
?>
        <div class="inscription-button">
            <form action="inscription.php">
                <button type="submit">Inscription</button>
            </form>
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
<?php
    }
    
    //si le login de la session existe bien 
    if(isset($_SESSION["login"]))
    {
        echo "bonjour session login est defini";
?>
        
        <a href="index.php?deco=true">Déconnexion</a>
<?php
        echo "Vous êtes connecté en tant que ".$_SESSION["login"];
        $user = UtilisateurManager::findUser($_SESSION["login"]);
        //echo $user->getPseudo();

        if($user->getIsConnected()==1)
        {
?>
            <div class="icone-profil">
                <a href="profil.php">
                <img src="images/style-one-pin-user.png" alt="logo-avatar">
                <input type="hidden" name="idUser" value="<?php $user->getIdUser();?>">
                </a>
            </div>
<?php
            echo "bonjour isconnected du user = 1";
            //AFICHAGE BOX NOUVELLE DISCUSSION
?>
            
            <div class="new-discussion-container">  
                <div class="new-discussion-entete">Créer un nouveau fil de discussion</div>
                <form method="POST" action="insertDiscu.php">
                    <div class="new-discussion-liste">
                        <SELECT name="categorie-discussion" size="1">
                            <option>Chien
                            <option>Chat
                            <option>Rongeur
                        </SELECT>
                    </div>
                    <div class="new-discussion-titre">
                        <input type="text" name="titreDiscussion" placeholder="Titre de la nouvelle discussion"/>
                    </div>
                    <div class="new-discussion-contenu">
                        <input type="text" name="texteDiscussion" placeholder="Contenu" style="width: 100%; height: 100%"/> <?php //<textarea> plusieurs lignes </textarea> ?>
                    </div>
                    <input type="hidden" name="idUser" value="<?php echo $user->getIdUser(); ?>"/>
                    <div class="new-discussion-button">
                        <button type="submit">Créer</button>
                    </div>
                </form> 
            </div>  
<?php  
        }
    }
    
    
    
//AFFICHAGE CATEGORIES
    $tabCategories = CategorieManager::findAllCategories();
?>
    <div class="categorie-container">
        <div class="sujet-titre">SUJETS</div>
<?php

    foreach($tabCategories as $categorie)
    {
?>
        <div class="categorie-nom">
            <img src="images/folder.png"  alt="icone-dossier-categorie">
            <a href='sujet<?php echo $categorie->getIdCategorie().".php?"; ?>'> <?php echo $categorie->getNomCategorie()?> </a> 
        </div>
<?php
    }
    ?>
    </div>

<?php
    include("include/footer.php");
?>   