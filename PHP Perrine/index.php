<?php
    session_name("PPE01");
    session_start();
    
    include_once("include/header.php");
?>
    <div class="page-container">
        <div class="page-content">
<?php    
    
    include_once("data/Utilisateur.php");
    include_once("dataManagers/DatabaseLinker.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("dataManagers/CategorieManager.php");

    if(empty($_POST["pseudo"]) && empty($_POST["password"]))
    {
?>
            <form action="inscription.php">
                <button type="submit">Inscription</button>
            </form>
            
            <div class="connexion-box">
                <form method="POST" action="index.php">
                    <label> Pseudo </label>
                    <input type="text" id="idPseudo" name="pseudo"/>
                    <label> Mot de passe </label>
                    <input type="password" id="idPassword" name="password"/>
                    <input type="submit" value="Connexion"/>
                </form>
            </div>
<?php
    }

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

        if(empty($tabErreurs))
        {
            if((ConnexionManager::testConnexionUser($_POST["pseudo"]))==true)
            {
                $user = UtilisateurManager::findUser($_POST["pseudo"]);
                $user->setIsConnected(1);
                UtilisateurManager::updateConnexion($user);

                $_SESSION["login"]=$_POST["pseudo"];
                print_r($_POST["pseudo"]);
                echo '<a href="index.php?deco=true"> Deconnexion </a>';
            }
            else
            {
                echo "Utilisateur ou mot de passe erroné, veuillez vous inscrire.";
                echo "<a href='inscription.php'> OK </a>";
            }
        }
    }

    if(!empty($_GET["deco"]) && $_GET["deco"]==true)
    {
        $user = UtilisateurManager::findUser($_SESSION["login"]);
        $user->setIsConnected(0);
        UtilisateurManager::updateConnexion($user);
        if($user->getIsConnected()==0)
        {
            session_unset();
            session_destroy();
        }
    }
    
    
    //AFICHAGE BOUTON NOUVELLE DISCUSSION
?>
        <div class="new-discussion-container">  
        <div class="new-discussion-button">Créer un nouveau fil de discussion</div>
        <form action="insertDiscussion.php">
            <SELECT name="categorie-discussion" size="1">
                <option>CSS
                <option>PHP
                <option>Java
            </SELECT>
            <button type="submit">Créer un nouveau fil de discussion</button>
        </form> 
        </div>
        
<?php
    //AFFICHAGE CATEGORIES
    echo "<br>";
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
        <a href='sujet<?php echo $categorie->getIdCategorie()?>.php?'> <?php echo $categorie->getNomCategorie()?> </a>
        
    </div>
<?php
    }
    ?>
    </div>
<?php
    //AFFICHAGE DISCUSSIONS
    echo "<br>";
    $tabDiscussions = DiscussionManager::findAllDiscussions();
           
    foreach($tabDiscussions as $discussion)
    {
        $tabMessages = DiscussionManager::getMessages($discussion->getIdDiscussion());
?>
        <div class="discussion-container">
            <div class="discussion-titre"><?php echo $discussion->getTitreDiscussion(); ?></div>
            <div class="discussion-date"><?php echo "Créé le ".$discussion->getDateDiscussion(); ?></div>
            <div class="discussion-texte"><?php echo "Texte: ".$discussion->getTexteDiscussion(); ?></div>
            <div class="discussion-user"><?php echo "Par ".$discussion->getIdUser(); ?></div>

 <?php
        foreach($tabMessages as $message)
        {
?>
            <div class="message-container">
                <div class="message-user"><?php echo $message->getIdUser(); ?></div>
                <div class="message-date"><?php echo $message->getDateMessage(); ?></div>
                <div class="message-texte"><?php echo $message->getTexteMessage(); ?></div>
            </div>
<?php
        }
?>
        </div>
<?php
    }

    include("include/footer.php");
?>
        </div>
    </div>